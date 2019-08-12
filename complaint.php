<?php
require 'header.php'
?>
<br>
<main class="jumbotron bg-light" style="text-align:center;">

<?php
    if(isset($_SESSION['type'])){
       echo '   
                    <div class="overflow-auto">
                        <form action="includes/complaint.inc.php" class="my-2" method="POST" >
                            <div class="text-bold text-success">
                                <h3>Complaint form : </h3>
                            </div><br>
                            <div class="row">
                                <div class="col">
                                <input type="text" name="c_rnum" class="form-control" id="roll" placeholder="Enrollment No.">
                                </div>
                                <div class="col">
                                <input type="password" name="c_pwd" class="form-control" id="pwd" placeholder="Password">
                                </div>
                            </div> <hr>

                            <div class="row">
                                <div class="col">
                                    <p class="text-bold text-primary"> Type of Complaint : </p>
                                    <select name="type" class="custom-select">
                                        <option value="Mess" selected>Mess</option>
                                        <option value="Hostel Electrician">Hostel Electrician</option>
                                        <option value="Hostel Plumber">Hostel Plumber</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                            </div> <hr>

                            <div class="row">
                                <div class="col">
                                    <p class="text-bold text-primary">Select your wing/block : </p>
                                    <select name="wing" class="custom-select">
                                        <option value="Bwing" selected>B Wing</option>
                                        <option value="Cwing">C Wing</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <p class="text-bold text-primary">Select your floor : </p>
                                    <select name="floor" class="custom-select">
                                        <option selected>Ground Floor</option>
                                        <option value="First">First Floor</option>
                                        <option value="Second">Second Floor</option>
                                        <option value="Third">Third Floor</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <p class="text-bold text-primary">Type your Room Number : </p>
                                    <div class="form-group">
                                        <input type="number" class="form-control" name="room" id="roomNo">
                                     </div>
                                </div>
                            </div> <hr>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label  class="text-bold text-primary" for="complaint">Complaint:</label>
                                        <textarea class="form-control" rows="5" id="comment" name="text"></textarea>
                                    </div>
                                </div>
                                <div class="col">
                                    <button type="submit" name="complaint-btn" class="btn btn-danger">Submit</button>
                                </div>
                            </div>
                    </form> 
                </div>';
    }
   
?>
</main>


<?php
require 'footer.php'
?>
