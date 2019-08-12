<?php
if (isset($_POST['complaint-btn'])) {
    session_start();
    require 'dbh.inc.php';
    $rollnum = $_POST['c_rnum'];
    $pass    = $_POST['c_pwd'];
    $type    = $_POST['type'];
    $wing    = $_POST['wing'];
    $floor    = $_POST['floor'];
    $room     =$_POST['room'];
    $text     =$_POST['text'];
    $UCN;
    $status  = 0;
    
   
    
    $sql  = "SELECT * FROM student WHERE rollnum=?";
    $stmt = mysqli_stmt_init($conn);
    
    //checking whether the sql statement is valid for database
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        $_SESSION['complaint_status']="error in sql statment";
        header("Location: ../complaintStatus.php?status=sqlerror1");
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
                $_SESSION['complaint_status']="Wrong password";
                header("Location: ../complaintStatus.php?status=WrongPass");
                exit();
            }
            //this else if is just for cross checking the input from $pwdcheck
            if ($pwdcheck == true) {
                session_start();
                $_SESSION['type']        = 'student';
                $_SESSION['studentRoll'] = $row['userid'];
               
                $_SESSION['complaint_status']="OK";

                
                //here getting the latest status to form complaint number
                $sql2  = "SELECT * FROM complaints WHERE userid=? AND stamp=?";
                $stmt2 = mysqli_stmt_init($conn);
                $sno;
                if (!mysqli_stmt_prepare($stmt2, $sql2)) {
                    $_SESSION['complaint_status']="error in sql statment";
                    header("Location: ../complaintStatus.php?status=sqlerror2");
                    exit();
                } else{
                    $x1="L";
                    mysqli_stmt_bind_param($stmt2, "ss", $rollnum,$x1);
                    mysqli_stmt_execute($stmt2);
                    $results2 = mysqli_stmt_get_result($stmt2);
                    if ($row2 = mysqli_fetch_assoc($results2)) {
                        $sno=$row2['complaintNo'];
                        $sno=substr($sno,strlen($sno)-11);

                        //now removing status of current complaint
                        $sql3 = "UPDATE complaints SET stamp='' WHERE complaintNo=?";
                        $stmt3 = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($stmt3, $sql3)) {
                            $_SESSION['complaint_status']="error in sql statment";
                            header("Location: ../complaintStatus.php?status=sqlerror3");
                            exit();
                        } else{
                            mysqli_stmt_bind_param($stmt3, "s", $sno);
                            mysqli_stmt_execute($stmt3);
                        }
                        //here update value.....................

                    }else{
                        $sno=001;
                    }
                }

                //here complaint is getting registered
                $UCN=substr($rollnum,0,1);  //B
                // $UCN.=substr($_SESSION['user']['post'],0,1);    //BS
                $UCN.="S";
                $temp=date('Y');    //BS
                $temp=substr($temp,0,2);    //BS
                $UCN.=$temp;    //BS20
                $UCN.=substr($rollnum,2,2); //BS2017
                $UCN.=substr($rollnum,4,1); //BS2017C
                $UCN.=substr($rollnum,8); //BS2017C039
                $UCN.="C";  //BS2017C039C
                $UCN.=$sno; //BS2017C039C001

                //UCN is ready

                //here register complaint.....................................
                        $sql4 = "INSERT INTO complaints VALUES (?,?,?,?,?,?,?,?,?,?,?)";
                        $stmt4 = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($stmt4, $sql4)) {
                            $_SESSION['complaint_status']="error in sql statment";
                            header("Location: ../complaintStatus.php?status=sqlerror4");
                            exit();
                        } else{
                            $t1=date("Y/m/d");
                            //$t2=$_SESSION['user']['post'];
                            $t2="Student";
                            $t3="pending";
                            $t4="L";
                            mysqli_stmt_bind_param($stmt4, "sssssssssis", $rollnum,$UCN,$t2,$t1,$type,$t3,$t4,$text,$wing,$floor,$room);
                            mysqli_stmt_execute($stmt4);
                        }

                header("Location: ../complaintStatus.php?status=registered&".$sno);
                exit();
            } else {
                $_SESSION['complaint_status']="error in pwd checking";
                header("Location: ../complaintStatus.php?status=pwdcheckError");
                exit();
            }
            
        } else {
            $_SESSION['complaint_status']="NO";
            header("Location: ../complaintStatus.php?status=wrongUser");
                exit();
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_stmt_close($stmt2);
    mysqli_stmt_close($stmt3);
    mysqli_stmt_close($stmt4);
    mysqli_close();
}

//if button is not at all clicked
else {
    header("Location: ../complaintStatus.php?status=illegalAccess");
    exit();
}
