<?php
  session_start();

  if (isset($_SESSION['admin']))
  {



    
    $pageTitle = 'dashboard - notifications';
    include 'init.php';
    $stmt = $conn->prepare("UPDATE notifications SET status = 1 WHERE status = 0 ");
    $stmt->execute();
    $admin = $stmt->fetch();

    ?>
      <div class="dashboard lf-pd" id="dashboard">
        <div class="container cnt-spc">
          <div class="row justify-content-start">

            <?php
            $stmt = $conn->prepare("SELECT * FROM notifications ORDER BY id DESC");
            $stmt ->execute();
            $all = $stmt->fetchAll();
            $total = $stmt->rowCount();
             ?>
                <div class="col-md-12">
                  <div class="content-header">
                    <span class="dashboard-overview" >  notifications  <span><?php echo $total ?></span></span>
                  </div>
                </div>
                <?php

                foreach ($all as $a)
                {
                  ?>
                  <div class="col-md-10">
                    <div class="noti">
                      <div class="row">
                        <div class="col-md-1">
                            <a href="consultation.php?page=deletenoti&id=<?php echo $a['id'] ?>" class="fas fa-times"></a>
                        </div>
                        <div class="col-md-9" style="text-align:left">
                          <?php
                            if ($a['type'] == 0)
                            {
                              ?>
        <h3> You have new message: <strong><?php echo $a['fname'] ?></strong> </h3>
                              <?php
                            }

                           ?>
                           <p><?php $text = strip_tags($a['content']); echo mb_strimwidth($text, 0, 120, "...")  ?></p>
                        </div>
                        <div class="col-md-2">
                            <span><?php echo $a['created'] ?></span>
                        </div>

                      </div>
                    </div>
                  </div>
                  <?php
                }
                 ?>



          </div>
        </div>
      </div>
    <?php
    include $tpl . 'footer.php';
  }else {
    header('location: index.php');

  }

 ?>
