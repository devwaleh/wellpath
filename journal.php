<?php

    error_reporting(E_ALL);
    session_start();
    require_once('user_guard.php');
    require_once('partials/head.php');
    require_once('classes/Journal.php');


    $user_id = $_SESSION['user_online'];

    $journals = $journal->fetch_journal($user_id);

    if (isset($_SESSION['result'])) {
      $search_result = $_SESSION['result'];
    }

?>
<body>
   <div class="container-fluid" id="fluid">
   <?php
    require_once('partials/nav.php');
  ?>
    <head>
        <div class="row py-3">
            <div class="col-md-3 ps-md-4">
                <h2>Journal</h2>
            </div>
        </div>
    </head>
    <main class="mb-5">
      <div class="row justify-content-center">
          <div class="col-md-3 pb-3">
            <form action="process/process_search.php" method="post" class="d-flex">
              <input class="form-control my-2" type="search" placeholder="Search" name="search_journal" value="<?php if(isset($_SESSION['search'])){ echo $_SESSION['search'];} ?>">
              &nbsp;
              <input type="submit" value="search" class="btn btn-primary" name="btn_search">
            </form>
          <?php 
          require_once('session_messages.php');
          // print_r($search_result);
        ?>  
          </div>
      </div>
       <div class="row">

       <?php
          if (!isset($search_result)&&isset($journals[0])) {
          foreach($journals as $journal){
        ?>
           <div class="col-md-3 pb-2">
               
               <div class="card" style="width: 18rem;">
                   <img src="uploads/<?php echo $journal['journal_img']; ?>" class="card-img-top" alt="...">
                   <div class="card-body">
                       <p class="card-text journalContent"><?php echo $journal['journal_content']; ?></p>
                       <button class="btn btn-primary editjournal" data-bs-toggle="modal" data-bs-target="#editJournal" value="<?php echo $journal['journal_id'];?>" data-location="<?php echo $journal['journal_content']; ?>"> Edit</button>
                       <a class="btn btn-danger delete" data-location="<?php echo $journal['journal_id']; ?>">Delete</a>
                       <p class="mt-2 card-text"><?php echo $journal['time_written']; ?></p>
                   </div>
                 </div>
           </div>
        <?php
           }
          } elseif (isset($search_result)) {
            foreach($search_result as $result){
        ?>
            <div class="col-md-3 pb-2">
               
               <div class="card" style="width: 18rem;">
                   <img src="uploads/<?php echo $result['journal_img']; ?>" class="card-img-top" alt="...">
                   <div class="card-body">
                       <p class="card-text journalContent"><?php echo $result['journal_content']; ?></p>
                       <button class="btn btn-primary editjournal" data-bs-toggle="modal" data-bs-target="#editJournal" value="<?php echo $result['journal_id'];?>" data-location="<?php echo $result['journal_content']; ?>"> Edit</button>
                       <a class="btn btn-danger delete" data-location="<?php echo $result['journal_id']; ?>">Delete</a>
                       <p class="mt-2 card-text"><?php echo $result['time_written']; ?></p>
                   </div>
                 </div>
           </div>
        <?php
            }
          }
        ?>
      
       
       </div>

       
       <button type="button" class="btn btn-primary fs-3" data-bs-toggle="modal" data-bs-target="#exampleModal" id="addjournal">
            <i class="fa-solid fa-circle-plus"></i>
        </button>
       
    </main>
        
          <!-- Add journal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Add Journal</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                  <form action="process/process_journal.php" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                    <div>
                        <textarea name="journal_content" id="journal_content" class="form-control" rows="7" placeholder="Type Message Here" maxlength="350"></textarea>
                    </div>
                    <div class="py-2">
                        <input type="file" name="journal_img" id="journal_img" class="form-control">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="add_journal">Add</button>
                      </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <!-- Edit Journal -->
          <div class="modal fade" id="editJournal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Journal</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
                  
                  <form action="process/process_editjournal.php" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                    <div>
                        <textarea name="journal_content" id="journal_contents" class="form-control" rows="7" placeholder="Type Message Here" maxlength="350"></textarea>
                    </div>
                    <div class="py-2">
                        <input type="file" name="journal_img" id="journal_img" class="form-control">
                    </div>
                    <div>
                      <input type="hidden" name="journal_id" id="journalId">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="edit_journal">Update</button>
                    </div>
                  </form>
      </div>
    </div>
  </div>
</div>
 
    

          <script src="assets/bootstrap/js/bootstrap.min.js"></script>
          <script src="assets/css/jquery.min.js"></script>

          <script>
            $(document).ready(function(){
              $('.editjournal').click(function(){
                var id = $(this).val();
                var content = $(this).attr('data-location');
                $('#journalId').val(id);
                // alert(content);
                $('#journal_contents').html(content);

              });

              $('.delete').click(function(){
                var deleted = confirm("Are you sure you want to delete journal?");
                var id = $(this).attr('data-location');
                // alert(id);
                if (deleted == true) {
                    $(this).attr('href','delete_journal.php?journal_id='+id);
                }
              });
            });
          </script>

</body>
</html>