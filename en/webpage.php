<?php
ob_start();
// افضل طريقة لتقسيم الصفحات الموقع دون الاكثار من ملفات الموقع هي باستعمال الخاصية الشرط التي في الاسفل



  // هنا نضع نقسم صفحة واحد الى عدة صفحات من خلال وضع شرط اسم الصفحة
    $page = isset($_GET['page']) ? $_GET['page'] : header('location: index.php');



// هنا في حالة تحقق شرط ان اسم الصفحة هو faq
    if ($page == "faq") {
      $noNavbar = '';

      // هنا عنوان الصفحة
      $pageTitle = 'Faq page';

      // هنا نعمل جلب للملف الرئيسي للموقع
      include 'init.php';

      ?>

      <section class="aboutus" style="margin:80px 0" id="about">
              <div class="container">
                <div class="row">


                  <div class="col-md-6 aos-init aos-animate" data-aos="fade-up" data-aos-anchor-placement="top-bottom">



                                    <?php
                                    $stmt = $conn->prepare("SELECT * FROM faq ");
                                    $stmt->execute();
                                    $faqs = $stmt->fetchAll();
                                     ?>



                                      <?php
                                      foreach ($faqs as $faq)
                                      {
                                        ?>
                                        <div class="acc">
                                          <h3><?php echo $faq['qst'] ?></h3>
                                          <div class="content-faq">
                                            <div class="content-inner">
                                              <p><?php echo $faq['ans'] ?></p>
                                            </div>
                                          </div>
                                        </div>

                                        <?php
                                      }
                                       ?>









                </div>
                <div class="col-md-6">
                  <img src="<?php echo $images ?>bg.png" alt="aboutus" style="width:100%;border-radius:50px;">
                  <div class="spcimg">
                    <h3>You still have a question</h3>
                                             <p>Click and send an inquiry regarding your case, and we will respond as soon as possible</p>
                    <a href="index.php#contactuspage">contact us</a>
                  </div>
                </div>
              </div>
            </section>
        <?php


      include $tpl . 'footer.php';
    }
    // هنا صفحة اخرى
      elseif ($page == "details") {
        $noNavbar = '';
        $pageTitle = 'Details';
        include 'init.php';
        $id = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : header('location: index.php');

        $stmt = $conn->prepare("SELECT * FROM election WHERE id = ?");
        $stmt->execute(array($id));
        $post = $stmt->fetch();




        ?>



        <section class="serj" style="padding:40px 0">
          <div class="container-fluid">
            <div class="row justify-content-center">
              <div class="col-md-3">
                <div class="spcsr">
                 <div class="form-group">
                          </div>
                 <div class="dsrre">
                     <a href="webpage.php?page=serj">
                       <?php
                        if (!empty($post['image']))
                        {
                          ?>
                          <img src="<?php echo $images . $post['image'] ?>" style="width:120px;height:120px;" alt="">

                          <?php
                        }else {
                          ?>
                          <img src="<?php echo $avatar ?>default.png" style="width:120px;height:120px;" alt="">

                          <?php
                        }
                        ?>
                       <h3><?php echo $post['name'] ?></h3>
                     </a>
                 </div>
                 <?php
                 $stmt = $conn->prepare('SELECT * FROM condidate WHERE election = ?');
                 $stmt->execute(array($id));
                 $rr = $stmt->fetchAll();
                 foreach ($rr as $t)
                 {
                   ?>
                   <div class="premg">
                     <a href="webpage.php?page=condidate">
                   <?php echo $t['condidate_name'] ?>        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                       <path d="M5.825 22L7.45 14.975L2 10.25L9.2 9.625L12 3L14.8 9.625L22 10.25L16.55 14.975L18.175 22L12 18.275L5.825 22Z" fill="black"/>
                       </svg>
                     </a>
                   </div>
                   <?php
                 }
                  ?>


                </div>
              </div>
              <div class="col-md-9">
                <div class="content">
                  <?php
                  $user = $_SERVER['HTTP_USER_AGENT'];

                  $stmt = $conn->prepare('SELECT * FROM vote WHERE user = ? AND election = ?');
                  $stmt->execute(array($user,$id));
                  $check = $stmt->rowCount();
                   ?>
                  <div class="hd " style="text-align:right">

                    <h5 style="color:var(--mainColor)">Total votes: <?php echo $post['total_votes'] ?></h5>
                    <h2><?php echo $post['name'] ?>

                    </h2>


                  </div>
                  <div class="bd total">
                    <p style="margin-bottom:60px"><?php echo $post['descr'] ?></p>






                    <?php
                    $stmt = $conn->prepare('SELECT * FROM condidate WHERE election = ?');
                    $stmt->execute(array($id));
                    $r = $stmt->fetchAll();
                     ?>
                    <div class="row" style="background:white">
                      <?php
                        foreach($r as $post)
                        {
                          ?>
                          <div class="col-md-6">
                      <div class="box" style="border:unset">
                        <?php
                          if (empty($post['image']))
                          {
                            ?>
                            <img src="<?php echo $avatar  ?>default.png" alt="خدماتنا" style="margin:40px 0;width:80px;height:80px;border-radius:50%">

                            <?php
                          }else {
                            ?>
                            <img src="<?php echo $images . $post['image'] ?>" alt="خدماتنا" style="margin:40px 0;width:80px;height:80px;border-radius:50%">

                            <?php
                          }
                         ?>
                      <h3><?php echo $post['condidate_name'] ?></h3>
                      <p><?php echo $post['descr'] ?>
                      </p>
                      <a href="webpage.php?page=condidate&id=<?php echo $post['id'] ?>">Vote</a>
                      </div>
                      </div>

                          <?php
                        }
                       ?>
                    </div>
                    <div class="col-md-12" style="text-align:center">
                      <h1 style="margin-top:40px;color:var(--mainColor)">Result</h1>
                      <?php
                      $stmt = $conn->prepare('SELECT * FROM vote WHERE election = ?');
                      $stmt->execute(array($id));
                      $all = $stmt->fetchAll();
                       ?>
                                          <script type="text/javascript">
                                             google.charts.load('current', {'packages':['corechart']});
                                             google.charts.setOnLoadCallback(drawChart);

                                             function drawChart() {

                                               var data = google.visualization.arrayToDataTable([
                                                 ['Task', 'Hours per Day'],
                                                 <?php
                                                  foreach($all as $vote)
                                                  {
                                                    $stmt = $conn->prepare('SELECT * FROM condidate WHERE id = ?');
                                                    $stmt->execute(array($vote['condidate']));
                                                    $dt = $stmt->fetch();

                                                    ?>
                           ['<?php echo $dt['condidate_name'] ?>',     <?php echo $dt['total_votes'] ?>],
                                                    <?php
                                                  }
                                                  ?>

                                               ]);

                                               var options = {
                                                 title: ''
                                               };

                                               var chart = new google.visualization.PieChart(document.getElementById('piechart'));

                                               chart.draw(data, options);
                                             }
                                           </script>
                                           <div id="piechart" style="width: 900px; height: 500px;"></div>

                    </div>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </section>


          <?php


        include $tpl . 'footer.php';
      }

      // هنا صفحة اخرى
        elseif ($page == "condidate") {
          $noNavbar = '';
          $pageTitle = 'condidate Details';
          include 'init.php';
          $id = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : header('location: index.php');

          $stmt = $conn->prepare("SELECT * FROM condidate WHERE id = ?");
          $stmt->execute(array($id));
          $post = $stmt->fetch();




          ?>
          <!-- هنا رسالة تظهر للمصوت انه ادخل تصويته -->


  <section class="popupwindowd" id="openpop">
    <div class="containe">
      <div class="row justify-content-center">
          <div class="col-md-6">
              <div class="dslje">
                <i class="far fa-check-circle"></i>
                <h1>Vote has been sent successfully</h1>
                <a id="close" style="cursor:pointer"> close</a>
              </div>
          </div>
      </div>
    </div>
  </section>

          <!-- هنا تنتهي الرسالة -->



          <section class="serj" style="padding:40px 0">
            <div class="container-fluid">
              <div class="row justify-content-center">
                <div class="col-md-3">
                  <div class="spcsr">
                   <div class="form-group">
                            </div>
                   <div class="dsrre">
                       <a href="webpage.php?page=serj">
                         <?php
                          if (!empty($post['image']))
                          {
                            ?>
                            <img src="<?php echo $images . $post['image'] ?>" style="width:120px;height:120px;" alt="">

                            <?php
                          }else {
                            ?>
                            <img src="<?php echo $avatar ?>default.png" style="width:120px;height:120px;" alt="">

                            <?php
                          }
                          ?>
                         <h3><?php echo $post['condidate_name'] ?></h3>
                       </a>
                   </div>
                   <h4>Other condidate</h4>
                   <?php
                   $stmt = $conn->prepare('SELECT * FROM condidate WHERE election = ?');
                   $stmt->execute(array($id));
                   $rr = $stmt->fetchAll();
                   foreach ($rr as $t)
                   {
                     ?>
                     <div class="premg">
                       <a href="webpage.php?page=condidate">
                     <?php echo $t['condidate_name'] ?>        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                         <path d="M5.825 22L7.45 14.975L2 10.25L9.2 9.625L12 3L14.8 9.625L22 10.25L16.55 14.975L18.175 22L12 18.275L5.825 22Z" fill="black"/>
                         </svg>
                       </a>
                     </div>
                     <?php
                   }
                    ?>


                  </div>
                </div>
                <div class="col-md-9">
                  <div class="content">
                    <?php
                    $user = $_SERVER['HTTP_USER_AGENT'];

                    $stmt = $conn->prepare('SELECT * FROM vote WHERE user = ? AND election = ?');
                    $stmt->execute(array($user,$post['election']));
                    $check = $stmt->rowCount();
                     ?>
                    <div class="hd " style="text-align:right">

                      <?php
                      $stmt = $conn->prepare('SELECT * FROM election WHERE id = ?');
                      $stmt->execute(array($post['election']));
                      $data = $stmt->fetch();
                       ?>
                      <h5 style="color:var(--mainColor)">Election: <?php echo $data['name'] ?></h5>
                      <h2><?php echo $post['condidate_name'] ?>
                      <?php
                        if ($check == 0)
                        {
                          ?>
  <a class="votebtn" election="<?php echo $post['election'] ?>" condidate="<?php echo $post['id'] ?>" style="font-size:15px;text-transform: capitalize;margin-top: 20px;border-radius: 20px;background:var(--mainColor);color:white;padding:8px 30px;padding-top:-60px" href="#"> <i class="fas fa-envelope"></i> vote for <?php echo $post['condidate_name'] ?></a>
                          <?php
                        }else {
                          ?>
                          <a style="font-size:15px;text-transform: capitalize;margin-top: 20px;border-radius: 20px;background:var(--mainColor);color:white;padding:8px 30px;padding-top:-60px" > <i class="fas fa-check-circle"></i> Your vote has been entered successfully for this election</a>
                          <?php
                        }
                       ?>

                      </h2>


                    </div>
                    <div class="bd total">
                      <p style="margin-bottom:60px"><?php echo $post['descr'] ?></p>



                      <h4 style="border-radius: 10px;text-align:left;background:#f1f1f1;padding:20px">Other condidate for <?php echo $data['name'] ?></h4>


                      <?php
                      $stmt = $conn->prepare('SELECT * FROM condidate WHERE election = ?');
                      $stmt->execute(array($id));
                      $r = $stmt->fetchAll();
                       ?>
                      <div class="row" style="background:white">
                        <?php
                          foreach($r as $post)
                          {
                            ?>
                            <div class="col-md-6">
                        <div class="box" style="border:unset">
                          <?php
                            if (empty($post['image']))
                            {
                              ?>
                              <img src="<?php echo $avatar  ?>default.png" alt="خدماتنا" style="margin:40px 0;width:80px;height:80px;border-radius:50%">

                              <?php
                            }else {
                              ?>
                              <img src="<?php echo $images . $post['image'] ?>" alt="خدماتنا" style="margin:40px 0;width:80px;height:80px;border-radius:50%">

                              <?php
                            }
                           ?>
                        <h3><?php echo $post['condidate_name'] ?></h3>
                        <p><?php echo $post['descr'] ?>
                        </p>
                        <a href="webpage.php?page=condidate&id=<?php echo $post['id'] ?>">Vote</a>
                        </div>
                        </div>

                            <?php
                          }
                         ?>
                      </div>

                    </div>
                  </div>
                </div>

              </div>
            </div>
          </section>


            <?php


          include $tpl . 'footer.php';
        }


      elseif ($page == "privacy") {


        $noNavbar ='';
        $pageTitle ='privacy';
        include 'init.php';

        $stmt = $conn->prepare("SELECT * FROM pages WHERE id = 1");
        $stmt->execute();
        $page = $stmt->fetch();

        ?>

                <section class="aboutus" style="background:#f1f1f1;padding:40px 0">
                  <div class="container">
                    <div class="row justify-content-center">

                      <div class="col-md-7">

                        <div class="ret" style="text-align:center">
                          <h3 style="color:var(--mainColor)">
                  privacy
                          </h3>

                              <?php echo $page['privacy'] ?>

                        </div>


                        </div>

                    </div>
                  </div>
                </section>



          <?php


        include $tpl . 'footer.php';
      }

      elseif ($page == "comment") {


        $noNavbar ='';
        $pageTitle ='comment';
        include 'init.php';

        $stmt = $conn->prepare("SELECT * FROM pages WHERE id = 1");
        $stmt->execute();
        $page = $stmt->fetch();

        ?>

                <section class="aboutus comment" style="background:#f1f1f1;padding:40px 0">
                  <div class="container">
                    <div class="row justify-content-center">

                      <div class="col-md-7">

                        <div class="ret" style="text-align:center">
                          <h3 style="color:var(--mainColor)">
              Leave a comment
                          </h3>


                        </div>

                        <form class="" action="index.html" method="post" id="message-form2">
                          <div class="row">
                            <div class="col-6">
                              <input type="text" name="fname" value="Full name" class="form-control" value="">
                            </div>
                            <div class="col-6">
                              <input type="text" name="title" value="Title" class="form-control" value="">
                            </div>
                            <div class="col-12">
                              <textarea name="comment"  style="padding:20px !important" class="form-control" >comment
                    </textarea>
                            </div>
                            <div class="col-md-12">
                              <div class="ds" style="text-align:center">
                                <input id="message-btn2" type="button" style="height: 50px !important;border-radius: 10px !important;background:var(--mainColor) !important;color:white" class="btn " name="" value="send">
                              </div>
                            </div>
                            <div class="col-md-12">
                              <div class="msg22" id="msg22">

                              </div>
                            </div>
                          </div>
                        </form>
                        </div>

                    </div>
                  </div>
                </section>



          <?php


        include $tpl . 'footer.php';
      }



      else {
        header('location: index.php');
      }



  ob_end_flush();

  ?>
