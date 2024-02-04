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
        <div class="row py-3">
            <div class="col-md-3 ps-md-4">
                <h2>Edit Profile</h2>
            </div>
        </div>
    </head>
    <main>
      <div class="row justify-content-center">
        <div class="col-md-6 text-center">
            <div>
                
            </div>
            <div>
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
               </div>
                  <button type="button" class="btn btn-primary my-1" data-bs-toggle="modal" data-bs-target="#exampleModal">
                  <i class="fa-solid fa-user-pen"></i> Edit Profile Picture
</button>
                <?php
                    require_once('session_messages.php');
                ?>
                <p class="fs-4">@<?php echo $username ?></p>
            </div>
        </div>
      </div>

        <div class="row justify-content-center mb-5 pt-3">
            <div class="col-md-6">
                <h4>About You</h4>
                <hr>
                <form action="process/process_profile.php" method="post">
                    <div class="row">
                        <div class="col">
                            <label for="gender">Gender</label>
                            <select name="gender" id="gender" class="form-control" required>
                                <?php
                                    if (isset($gender)) {
                                ?>
                                    <option value="<?php echo $gender; ?>"><?php echo $gender; ?></option>
                                <?php
                                    }
                                ?>
                                <option value="">Please Select</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                        <div class="col">
                            <label for="dob">Birthday</label>
                            <input type="date" name="dob" id="dob" class="form-control" value="<?php echo $birthday; ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="weight">Weight (kg)</label>
                            <input type="text" name="weight" id="weight" class="form-control" value="<?php echo $weight; ?>">
                            <p id="feedback" class="text-danger"></p>
                        </div>
                        <div class="col">
                            <label for="height">Height (Inches)</label>
                            <input type="text" name="height" id="height" class="form-control" value="<?php echo $height; ?>">
                        </div>
                    </div>
                    <div class="row py-3">
                        <div class="col text-center">
                            <input type="submit" value="Save" class="btn btn-primary col-6">
                        </div>
                    </div>
                </form>
            </div>
      </div>  
    </main>
   </div>

  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Upload Profile Picture</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="process/process_dp.php" method="post" enctype="multipart/form-data">
            <input type="file" name="dp" id="dp" class="p-3">
           <div>
           <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <input type="submit" value="Save changes" name="upload_btn" class="btn btn-primary">
           </div>
        </form>
      </div>
    </div>
  </div>
</div>

  <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>