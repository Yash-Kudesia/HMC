<?php
require 'header.php'
?>
<br>
<main class="jumbotron text-success" style="text-align:center">

<?php
    if(isset($_SESSION['type'])){
        if($_SESSION['type']=='student'){
            echo ' <p>You are logged in as student</p>';
        }
        else if($_SESSION['type']=='warden'){
            echo ' <p>You are logged in as warden</p>';
        }
        else if($_SESSION['type']=='hmc'){
            echo ' <p>You are logged in as hmc</p>';
        }
        else if($_SESSION['type']=='staff'){
            echo ' <p>You are logged in as staff</p>';
        }
    }
    else{
        echo ' <p>You are logged out</p>';
    }
?>
</main>

<?php
require 'home.php'
?>

<?php
require 'footer.php'
?>
