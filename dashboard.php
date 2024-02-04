<?php

    error_reporting(E_ALL);
    session_start();
    require_once('user_guard.php');
    require_once('classes/User.php');
    require_once('classes/Category.php');
    require_once('partials/head.php');
    require_once('classes/Goal.php');

    $user_id = $_SESSION['user_online'];

    $cat = $category->fetch_category();
    $goals = $goal->fetch_goals($user_id);
    

?>
<body>
   <div class="container-fluid">
   <?php
    require_once('partials/nav.php');
  ?>
    <head>
        <div class="row py-3">
            <div class="col-md-3 ps-md-4">
                <h2>Dashboard</h2>
            </div>
        </div>
    </head>
    <main>
        <div class="row py-3 align-items-center justify-content-center">
            <div class="col-md-6">
                <?php
                    require_once('session_messages.php');
                    // print_r($goals);
                    if (!empty($goals)) { 
                   foreach($goals as $g){

                  
                ?>
               <div>
                    <?php
                        if ($g['goal_date_set'] == date("Y-m-d") && $g['cat_name'] == "Walk Time") {
                            $activity = $goal->fetch_goals_cat($g['goal_id']);
                            $percentage = $activity['activity_amt']/$activity['goal_target']*100;
                           
                    ?>
                    <span class="fs-3"><i class="fa-solid fa-person-walking"></i> <?php echo $activity['activity_amt'] ?> Hours</span>
                    <div class="progress mb-3" role="progressbar" aria-label="Example with label" aria-valuenow="<?php echo $percentage ?>" aria-valuemin="0" aria-valuemax="100">
                        <div class="progress-bar bg-primary" style="width: <?php echo $percentage ."%"; ?>"><?php echo $percentage ."%"; ?></div>
                    </div>
                    <?php
                     }
                    ?>
               </div>

               <div>
                    <?php
                        if ($g['goal_date_set'] == date("Y-m-d") && $g['cat_name'] == "Sleep Time") {
                            $activity = $goal->fetch_goals_cat($g['goal_id']);
                            $percentage = $activity['activity_amt']/$activity['goal_target']*100;
                    ?>
                    <span class="fs-3"><i class="fa-solid fa-bed"></i> <?php echo $activity['activity_amt'] ?> Hours</span>
                    <div class="progress mb-3" role="progressbar" aria-label="Example with label" aria-valuenow="<?php echo $percentage ?>" aria-valuemin="0" aria-valuemax="100">
                        <div class="progress-bar bg-success" style="width: <?php echo $percentage ."%"; ?>"><?php echo $percentage ."%"; ?></div>
                    </div>
                    <?php
                     }
                    ?>
                </div>

                <div>
                    <?php
                        if ($g['goal_date_set'] == date("Y-m-d") && $g['cat_name'] == "Exercise Time") {
                            $activity = $goal->fetch_goals_cat($g['goal_id']);
                            $percentage = $activity['activity_amt']/$activity['goal_target']*100;
                    ?>
                    <span class="fs-3"><i class="fa-solid fa-dumbbell"></i> <?php echo $activity['activity_amt'] ?> Hours</span>
                    <div class="progress mb-3" role="progressbar" aria-label="Example with label" aria-valuenow="<?php echo $percentage ?>" aria-valuemin="0" aria-valuemax="100">
                        <div class="progress-bar bg-danger" style="width: <?php echo $percentage ."%"; ?>"><?php echo $percentage ."%"; ?></div>
                    </div>
                    <?php
                     }
                    ?>
                </div>

                <div>
                    <?php
                        if ($g['goal_date_set'] == date("Y-m-d") && $g['cat_name'] == "Water Taken") {
                            $activity = $goal->fetch_goals_cat($g['goal_id']);
                            $percentage = $activity['activity_amt']/$activity['goal_target']*100;
                            // print_r($activity);
                    ?>
                    <span class="fs-3"><i class="fa-solid fa-glass-water"></i> <?php echo $activity['activity_amt'] ?> Litres</span>
                    <div class="progress mb-3" role="progressbar" aria-label="Example with label" aria-valuenow="<?php echo $percentage ?>" aria-valuemin="0" aria-valuemax="100">
                        <div class="progress-bar bg-warning" style="width: <?php echo $percentage ."%"; ?>"><?php echo $percentage ."%"; ?></div>
                    </div>
                    <?php
                     }
                    ?>
                </div>
                <?php
                     }
                    }
                ?>
            </div>
        </div>
        <div class="row py-3 justify-content-center">
            <div class="col-md-6">
                <h4>All Goals</h4>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addGoalModal">
                    Add Goal
                  </button>
                <table class="table table-success mt-3 table-hover">
                    <thead>
                        <tr>
                            <td>Date</td>
                            <td>Category</td>
                            <td>Target</td>
                            <td>Unit</td>
                            <td>Status</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if (!empty($goals)) { 
                            foreach($goals as $goal){
                        ?>

                        <tr>
                            <td><?php echo $goal['goal_date_set'] ?></td>
                            <td><?php echo $goal['cat_name'] ?></td>
                            <td><?php echo $goal['goal_target'] ?></td>
                            <td><?php echo $goal['cat_unit'] ?></td>
                            <?php
                                if (isset($goal['goal_status'])) {
                            ?>
                                <td class="text-success"><?php echo $goal['goal_status']; ?></td>  
                            <?php
                                } else {
                            ?>
                                    <td class="text-danger">Failed</td>  
                            <?php
                                }
                                
                            ?>                            
                            <td><a class="btn btn-warning" href="goal_detail.php?goal_id=<?php echo $goal['goal_id'] ?>">View Details</a></td>
                        </tr>

                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php
            include_once('exercise.php');
        ?>
    </main>
   </div>

   <div class="modal fade" id="addGoalModal" tabindex="-1" aria-labelledby="addGoalModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addGoalModalLabel">Add Goal</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="process/process_goal.php" method="post">
            <div class="modal-body">
                <div>
                    <label for="cat_name">Category</label>
                    <select name="cat_name" id="cat_name" class="form-control">
                        <option value="">Please Select</option>
                        <?php
                            foreach($cat as $category){
                        ?>
                            <option value="<?php echo $category['cat_id'] ?>"><?php echo $category['cat_name'] ?></option>
                        <?php
                            }
                        ?>
                    </select>
                </div>
                <div class="py-2">
                    <label for="cat_unit">Unit</label>
                    <input type="text" name="cat_unit" id="cat_unit" readonly class="form-control">
                </div>
                <div>
                    <label for="goal_target">Target (in digits)</label>
                    <input type="text" name="goal_target" id="goal_target" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <input type="submit" value="Add" class="btn btn-primary" name="add_goal">
            </div>
        </form>
      </div>
    </div>
  </div>

   <script src="assets/bootstrap/js/bootstrap.min.js"></script>
   <script src="assets/css/jquery.min.js"></script>
   <script>
        $(document).ready(function(){
          $('#cat_name').change(function(){
            var data = 'catid='+$(this).val();
            $('#cat_unit').load('process/process_cat_val.php',data,function(response){
                $('#cat_unit').val(response);
            });
          });
        })
      </script>
</body>
</html>