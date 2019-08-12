<?php
 session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <title>Portal Hostel</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="css/newflipfloppost.css">
    <link rel="stylesheet" href="css/navbar.css">
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    <!-- <script src="./gototop.js"></script> -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>
    <style>
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">
            <img src="img/logo.jpg" width="50" height="50">
            <b>HMC</b> <small>IIITN</small>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ">
                <li class="nav-item active mar1 mx-4">
                    <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item mar1  mx-4">
                    <a class="nav-link" href="#">About</a>
                </li>
                <li class="nav-item mar1  mx-4">
                    <a class="nav-link" href="#">Gallery</a>
                </li>

                <?php
                 if(isset($_SESSION['type'])){
                     echo ' <li class="nav-item mar1  mx-4">
                            <a class="nav-link" href="#">Notices</a>
                            </li>';
                     if($_SESSION['type']=='student'){
                        echo '  <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                        Student Corner
                        </a>
                        <div class="dropdown-menu">
                        <a class="dropdown-item " href="editprofile.php">Edit Profile</a>
                        <a class="dropdown-item " href="complaint.php">Register Complaint</a>
                        <a class="dropdown-item " href="sleave.php">Request Leave</a>
                        <a class="dropdown-item " href="leave.php">My Leaves</a>
                        <a class="dropdown-item " href="leave.php">My Complaints</a>
                        </div>
                        </li>';
                     }
                     else if($_SESSION['type']=='warden'){
                        echo '  <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                        Warden Corner
                        </a>
                        <div class="dropdown-menu">
                        <a class="dropdown-item " href="student/editprofile.php">Edit Profile</a>
                        <a class="dropdown-item " href="student/complaint.php">Complaint Logs</a>
                        <a class="dropdown-item " href="student/leave.php">Leave Logs</a>
                        <a class="dropdown-item " href="student/leave.php">Put Notice</a>
                        <a class="dropdown-item " href="student/leave.php">Manage Students</a>
                        <a class="dropdown-item " href="student/leave.php">Manage HMC</a>
                        </div>
                        </li>';
                     }
                     else if($_SESSION['type']=='hmc'){
                        echo '  <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                        HMC Corner
                        </a>
                        <div class="dropdown-menu">
                        <a class="dropdown-item " href="student/editprofile.php">Edit Profile</a>
                        <a class="dropdown-item " href="student/complaint.php">Register Complaint</a>
                        <a class="dropdown-item " href="student/complaint.php">Complaint Logs</a>
                        <a class="dropdown-item " href="student/leave.php">Leave Logs</a>
                        <a class="dropdown-item " href="student/leave.php">Put Notice</a>
                        </div>
                        </li>';
                     }
                     if($_SESSION['type']=='staff'){
                        echo '  <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                        Staff Corner
                        </a>
                        <div class="dropdown-menu">
                        <a class="dropdown-item " href="student/editprofile.php">Edit Profile</a>
                        <a class="dropdown-item " href="student/complaint.php">Complaint Logs</a>
                        <a class="dropdown-item " href="student/leave.php">Leave Logs</a>
                        </div>
                        </li>';
                     }
                }
                ?>
            </ul>
            
           
        </div>

    </nav>
    <hr>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div>
        <?php
                if(isset($_SESSION['type'])){
                    echo '  <form class="form-inline mar2 mx-5" action="includes/logout.inc.php" method="POST">
                            <button type="submit" name="logout_btn" class="btn btn-primary mb-2">Logout</button>
                              </form>';
                }
                else{
                    echo ' <form class="form-inline" action="includes/login.inc.php" method="POST">
                            <label for="rollnumber" class="mr-sm-2 text-white">Username:</label>
                            <input type="text" class="form-control mb-2 mr-sm-2 " name="rollnumber" autocomplete="off" required>
                            <label for="pwd" class="mr-sm-2 text-white">Password:</label>
                            <input type="password" class="form-control ml-1 mb-2 mr-sm-2" name="pwd" required>
                            <button type="submit" name="login_btn" class="btn btn-primary mb-2">Login</button>
                            </form>';
                }
            ?>
            
        </div>
    </nav>