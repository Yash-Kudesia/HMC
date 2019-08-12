<?php
if (isset($_POST['login_btn'])) {
    
    require 'dbh.inc.php';
    $rollnum = $_POST['rollnumber'];
    $pass    = $_POST['pwd'];
    $status  = 0;
    
    //checking in student table->>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
    
    $sql  = "SELECT * FROM student WHERE rollnum=?";
    $stmt = mysqli_stmt_init($conn);
    
    //checking whether the sql statement is valid for database
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../index.php?error=sqlerrorstu");
        exit();
    } else {
        //here we are executing sql on databse
        mysqli_stmt_bind_param($stmt, "s", $rollnum);
        mysqli_stmt_execute($stmt);
        $results = mysqli_stmt_get_result($stmt);
        
        //here we are getting the result in row and validating the user with the password
        if ($row = mysqli_fetch_assoc($results)) {
            
            $pwdcheck = false;
            if ($pass == $row['password']) {
                $pwdcheck = true;
            }
            if ($pwdcheck == false) {
                header("Location: ../index.php?error=wrongpasswordstu");
                exit();
            }
            //this else if is just for cross checking the input from $pwdcheck
            if ($pwdcheck == true) {
                session_start();
                $_SESSION['type']        = 'student';
                $_SESSION['user'] = array(
                    'id' => $row['rollnum'],
                    'fname' => $row['fname'],
                    'lname' => $row['lname'],
                    'pwd' => $row['password'],
                    'post' => 'student',
                    'email' => $row['email'],
                    'contact'=>$row['contact']);
                header("Location: ../index.php?login=successstu");
                $status = 1;
                exit();
            } else {
                header("Location: ../index.php?error=someerrorinpwdcheckstu");
                exit();
            }
            
        } else {
            $status = 0;
        }
    }
    if ($status == 0) {
        //cheking in staff table->>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
        $sql2  = "SELECT * FROM staff WHERE staffid=?";
        $stmt2 = mysqli_stmt_init($conn);
        
        //checking whether the sql statement is valid for database
        if (!mysqli_stmt_prepare($stmt2, $sql2)) {
            header("Location: ../index.php?error=sqlerrorstf");
            exit();
        } else {
            //here we are executing sql on databse
            mysqli_stmt_bind_param($stmt2, "s", $rollnum);
            mysqli_stmt_execute($stmt2);
            $results2 = mysqli_stmt_get_result($stmt2);
            
            //here we are getting the result in row and validating the user with the password
            if ($row2 = mysqli_fetch_assoc($results2)) {
                $pwdcheck2 = false;
                if ($pass == $row2['password']) {
                    $pwdcheck2 = true;
                }
                if ($pwdcheck2 == false) {
                    header("Location: ../index.php?error=wrongpasswordstf");
                    exit();
                }
                //this else if is just for cross checking the input from $pwdcheck
                if ($pwdcheck2 == true) {
                    session_start();
                    
                   $_SESSION['type']=$row2['post'];
                   $_SESSION['user'] = array(
                    'id' => $row['staffid'],
                    'fname' => $row['fname'],
                    'lname' => $row['lname'],
                    'pwd' => $row['password'],
                    'post' => $row['post'],
                    'email' => $row['email'],
                    'contact'=>$row['contact']);
                    
                    header("Location: ../index.php?login=successstf");
                    exit();
                } else {
                    header("Location: ../index.php?error=someerrorinpwdcheckstf");
                    exit();
                }
                
            }else{
                header("Location: ../index.php?error=nouserfoundstf");
                exit();
            }
        }
    }
    
}

//if button is not at all clicked
else {
    header("Location: ../index.php");
    exit();
}
