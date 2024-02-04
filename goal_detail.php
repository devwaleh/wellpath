<?php

    error_reporting(E_ALL);
    session_start();
    require_once('user_guard.php');
    require_once('classes/User.php');
    require_once('classes/Category.php');
    require_once('partials/head.php');
    require_once('classes/Goal.php');

    $user_id = $_SESSION['user_online'];
    $goal_id = $_GET['goal_id'];

    $cat = $category->fetch_category();
    $goals = $goal->fetch_goals_cat($goal_id);

    $percentage = $goals['activity_amt']/$goals['goal_target']*100;

?>
<body>
   <div class="container-fluid">
   <?php
    require_once('partials/nav.php');
  ?>
    <head>
        <div class="row py-2 align-items-center justify-content-center">
            <div class="col-md-6 text-center">
                <h2 id="goal_name"><?php echo $goals['cat_name']; ?></h2>
            </div>
        </div>
    </head>
    <main>
    <div class="row py-1 align-items-center justify-content-center">
        <div class="col-md-6">
           
            <?php
                    require_once('session_messages.php');
                    // print_r($goals);
                ?>
                <h3>Progress</h3>
                <?php
                        if (isset($goals['activity_amt'])) {
                    ?>
                            <?php
                    if ($goals['cat_name'] == 'Water Taken') {
                ?>
                     <div>
                    <span class="fs-3"><i class="fa-solid fa-glass-water"></i> <?php echo $goals['activity_amt'] . ' ' . $goals['cat_unit']?></span>
                    <div class="progress mb-3" role="progressbar" aria-label="Example with label" aria-valuenow="<?php echo $percentage ?>" aria-valuemin="0" aria-valuemax="100">
                        <div class="progress-bar bg-warning" style="width:<?php echo $percentage ."%" ?>"><?php echo $percentage ."%" ?></div>
                    </div>
                </div>
                <?php
                    }
                ?>

                <?php
                    if ($goals['cat_name'] == 'Sleep Time') {
                ?>
                     <div>
                    <span class="fs-3"><i class="fa-solid fa-bed"></i> <?php echo $goals['activity_amt'] . ' ' . $goals['cat_unit']?></span>
                    <div class="progress mb-3" role="progressbar" aria-label="Example with label" aria-valuenow="<?php echo $percentage ?>" aria-valuemin="0" aria-valuemax="100">
                        <div class="progress-bar bg-success" style="width: <?php echo $percentage ."%" ?>"><?php echo $percentage ."%" ?></div>
                    </div>
                </div>
                <?php
                    }
                ?>

                <?php
                    if ($goals['cat_name'] == 'Exercise Time') {
                ?>
                      <div>
                    <span class="fs-3"><i class="fa-solid fa-dumbbell"></i> <?php echo $goals['activity_amt'] . ' ' . $goals['cat_unit']?></span>
                    <div class="progress mb-3" role="progressbar" aria-label="Example with label" aria-valuenow="<?php echo $percentage ?>" aria-valuemin="0" aria-valuemax="100">
                        <div class="progress-bar bg-danger" style="width: <?php echo $percentage ."%" ?>"><?php echo $percentage ."%" ?></div>
                    </div>
                </div>
                <?php
                    }
                ?>

                
                <?php
                    if ($goals['cat_name'] == 'Walk Time') {
                ?>
                       <div>
                    <span class="fs-3"><i class="fa-solid fa-person-walking"></i> <?php echo $goals['activity_amt'] . ' ' . $goals['cat_unit']?></span>
                    <div class="progress mb-3" role="progressbar" aria-label="Example with label" aria-valuenow="<?php echo $percentage ?>" aria-valuemin="0" aria-valuemax="100">
                        <div class="progress-bar bg-primary" style="width: <?php echo $percentage ."%" ?>"><?php echo $percentage ."%" ?></div>
                    </div>
               </div>
                </div>
                <?php
                    }
                ?>
                    <?php
                        }
                    ?>
                
        </div>
        <div class="row py-1 align-items-center justify-content-center">
                <div class="col-md-6 ">
                    <h4>Date set: <?php echo $goals['goal_date_set'] ?></h4>
                    <h4>Target: <?php echo $goals['goal_target'] . ' ' . $goals['cat_unit']?></h4>
                    <?php
                        if (isset($goals['activity_amt'])) {
                    ?>
                            <h4>Amount recorded: <?php echo $goals['activity_amt'] . ' ' . $goals['cat_unit']?></h4>
                    <?php
                        }
                    ?>
                </div>
        </div>
        
    </div>
    <div class="row pt-3 pb-5 align-items-center justify-content-center">
        <div class="col-md-6">
            <form action="process/process_record.php" method="post" class="text-light bg-primary p-3"> 
                <h3 class="text-center">Record Progress</h3>
                <div class="py-2">
                    <label for="cat_unit">Unit</label>
                    <input type="text" name="cat_unit" id="cat_unit" readonly class="form-control" value="<?php echo $goals['cat_unit'] ?>">
                </div>
                <div>
                    <label for="goal_target">Record</label>
                    <input type="text" name="goal_target" id="goal_target" class="form-control">
                </div>
                <div>
                    <input type="hidden" name="goal_id" value="<?php echo $goal_id ?>">
                </div>
                <div>
                    <input type="hidden" name="activity_amt" value="<?php echo $goals['activity_amt'] ?>">
                </div>
                <div class="text-center py-2">
                    <input type="submit" value="Record" class="btn btn-light col-6" name="record_goal">
                </div>
            </form>
           <div class="text-center py-2">
           <button type="button" class="btn btn-primary col-4" data-bs-toggle="modal" data-bs-target="#exampleModal">Edit</button>
           <a class="btn btn-danger col-4" id="delete">Delete</a>
           </div>
        </div>
    </div>
    </main>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Goal</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="process/process_editgoal.php" method="post">
      <div class="modal-body">
        <div>
            <label for="new_target">Set New target</label>
            <input type="text" name="new_target" id="new_target" class="form-control">
        </div>
        <div class="py-2">
            <label for="cat_unit">Unit</label>
            <input type="text" name="cat_unit" id="cat_unit" readonly class="form-control" value="<?php echo $goals['cat_unit'] ?>">
        </div>
        <div>
            <input type="hidden" name="goal_id" value="<?php echo $goal_id ?>">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="edit_goal">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>

   <script src="assets/bootstrap/js/bootstrap.min.js"></script>
   <script src="assets/css/jquery.min.js"></script>

   <script>
        $(document).ready(function(){
            $('#delete').click(function(){
            var deleted = confirm("Are you sure you want to delete goal?");
            if (deleted == true) {
                $(this).attr('href','delete_goal.php?goal_id=<?php echo $goal_id; ?>');
            }
          });
        })
   </script>

</body>
</html>