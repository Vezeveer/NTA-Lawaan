<?php include_once 'header.php'?>

<div class="card bg-light mb-3" style="width: 18rem;">
  
  <div class="card-header text-center"><img class="card-img-top" style="width: 50%; margin: auto;" src="img/project-status.png" alt="Card image cap"></div>
  <div class="card-body">
    <h5 class="card-title"><i class="far fa-money-check"></i> STATUS</h5>
        <?php 
            $bdc_init = "<p class=\"card-text\">Barangay Development Council is currently initializing the Annual Investment Plan.</p>";
            $bc_finalize = "<p class=\"card-text\">Barangay Committee is currently adjusting the Annual Investment Plan.</p>";
            $bo_waiting = "<p class=\"card-text\">Waiting for Budget Office to approve the Annual Investment Plan.</p>";
                    if($_SESSION["status"] == "bdc_initialize"){
                        echo $bdc_init;
                    } else if($_SESSION["status"] == "bc_finalizing") {
                        echo $bc_finalize;
                    } else if($_SESSION["status"] == "pending_bo_approval"){
                        echo $bo_waiting;
                    }
        ?>
    
    <a href="main.php" class="btn btn-primary" style="">Go To Plan</a>
    
  </div>
</div>

<?php include_once 'footer.php'?>