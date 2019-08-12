<?php
if (isset($_POST['complaint-btn'])) {
    session_start();
    require 'dbh.inc.php';
    $rollnum = $_POST['l_rnum'];
    $email    = $_POST['l_email'];
    $pass    = $_POST['l_pwd'];
    $reason    = $_POST['reason'];
    $address    = $_POST['address'];
    $leavedate    = $_POST['leavedate'];
    $arrivaldate    = $_POST['arrivaldate'];
    $vacDays    = $_POST['vacDays'];
    $LCN;
    $status  = 0;
    
   
    
    $sql  = "SELECT * FROM student WHERE rollnum=?";
    $stmt = mysqli_stmt_init($conn);
    
    //checking whether the sql statement is valid for database
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        $_SESSION['status']="error in sql statment";
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
                $_SESSION['status']="Wrong password";
                header("Location: ../complaintStatus.php");
                exit();
            }
            //this else if is just for cross checking the input from $pwdcheck
            if ($pwdcheck == true) {
                session_start();
                $_SESSION['type']        = 'student';
                $_SESSION['studentRoll'] = $row['userid'];
               
                $_SESSION['status']="OK";

                
                //here getting the latest status to form complaint number
                $sql2  = "SELECT * FROM complaints WHERE userid=? AND stamp=L";
                $stmt2 = mysqli_stmt_init($conn);
                $sno;
                if (!mysqli_stmt_prepare($stmt2, $sql2)) {
                    $_SESSION['status']="error in sql statment";
                    exit();
                } else{
                    mysqli_stmt_bind_param($stmt2, "s", $rollnum);
                    mysqli_stmt_execute($stmt2);
                    $results2 = mysqli_stmt_get_result($stmt2);
                    if ($row2 = mysqli_fetch_assoc($results2)) {
                        $sno=$row2['complaintNo'];
                        $sno=substr($sno,strlen($sno)-11);

                        //now removing status of current complaint
                        $sql3 = "UPDATE complaints SET stamp='' WHERE complaintNo=$sno";
                        //here update value.....................

                    }else{
                        $sno=001;
                    }
                }

                //here complaint is getting registered
                $LCN=substr($rollnum,0,1);  //B
                $LCN.=substr($_SESSION['user']['post'],0,1);    //BS
                $temp=date('Y');    //BS
                $temp=substr($temp,0,2);    //BS
                $LCN.=$temp;    //BS20
                $LCN.=substr($rollnum,2,2); //BS2017
                $LCN.=substr($rollnum,4,1); //BS2017C
                $LCN.=substr($rollnum,8); //BS2017C039
                $LCN.="C";  //BS2017C039C
                $LCN.=$sno; //BS2017C039C001

                //LCN is ready

                //here register complaint.....................................


                header("Location: ../complaintStatus.php");
                exit();
            } else {
                $_SESSION['status']="error in pwd checking";
                header("Location: ../complaintStatus.php");
                exit();
            }
            
        } else {
            $_SESSION['status']="NO";
            header("Location: ../complaintStatus.php");
                exit();
        }
    }
}

//if button is not at all clicked
else {
    header("Location: ../complaintStatus.php");
    exit();
}
