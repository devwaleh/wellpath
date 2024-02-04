<?php

    error_reporting(E_ALL);
    session_start();
    require_once('user_guard.php');
    require_once('classes/User.php');
    require_once('partials/head.php');

    $user_id = $_SESSION['user_online'];
    $u = $user->get_userbyid($user_id);
    $username = $u['user_name'];
    $gender = $u['user_gender'];
    $birthday = $u['user_dob'];
    $weight = $u['user_weight'];
    $height = $u['user_height'];

    $dp = $user->fetch_dp($user_id);
   if (isset($dp['picture_file'])) {
    $profile_picture = $dp['picture_file'];
   }


?>
<body>
   <div class="container-fluid">
  <?php
    require_once('partials/nav.php');
  ?>
    <head>
        <div class="row py-3 justify-content-between">
            <div class="col-md-3 ps-md-4">
                <h2>Profile</h2>
            </div>
            <div class="col-md-2 ps-md-4">
                <a class="btn btn-danger" id="logout">Logout</a>
            </div>
        </div>
    </head>
    <main>
      <div class="row justify-content-center">
        <div class="col-md-6 text-center">
            <div>
            <?php
                    if (isset($profile_picture)) {
                ?>
                      <p class="dp"><img src="uploads/<?php echo $profile_picture; ?>" alt="" class="img-fluid" id="dp"></p>  
                <?php
                    } else {
                ?>
                      <p class="dp"><img src="assets/images/dummy.jpg" alt="" class="img-fluid" id="dp"></p>  
                <?php
                    }  
                ?>
                <?php
                    require_once('session_messages.php');
                ?> 
            </div>
            <div>
            <p class="fs-4">@<?php echo $username; ?></p>
            </div>
        </div>
      </div>
      <div class="row justify-content-center mb-5">

        <div class="row justify-content-center mb-5 pt-3">
            <div class="col-md-6">
                <h4>About You</h4>
                <hr>
                <div class="row">
                    <div class="col">
                        <label for="gender">Gender</label>
                        <input type="text" name="gender" id="gender" class="form-control" readonly value="<?php echo $gender; ?>">
                    </div>
                    <div class="col">
                        <label for="dob">Birthday</label>
                        <input type="date" name="dob" id="dob" class="form-control" readonly value="<?php echo $birthday; ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="weight">Weight (kg)</label>
                        <input type="number" name="weight" id="weight" class="form-control" readonly value="<?php echo $weight; ?>">
                    </div>
                    <div class="col">
                        <label for="height">Height (Inches)</label>
                        <input type="number" name="height" id="height" class="form-control" readonly value="<?php echo $height; ?>">
                    </div>
                </div>
                <div class="row py-3">
                    <div class="col text-center">
                        <a href="editprofile.php" class="btn btn-primary col-6">Edit</a>
                    </div>
                </div>
            </div>
      </div>  
    </main>
   </div>

   <script src="assets/css/jquery.min.js"></script>
   <script>
        $(document).ready(function(){
            $('#logout').click(function(){
            var out = confirm("Are you sure you want to logout?");
            if (out == true) {
                $(this).attr('href','logout.php');
            }
          });
        })
   </script>

   
</body>
</html>