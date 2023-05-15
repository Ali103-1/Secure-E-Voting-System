<?php
session_start();
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
                      <h4 style="margin:40px 0;color:var(--mainColor)"> <a href="webpage.php?page=result&id=<?php echo $id ?>">Result <i class="far fa-file"></i> </a> </h4>



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


      elseif ($page == "result") {
        $noNavbar = '';
        $pageTitle = 'election result';
        include 'init.php';
        $id = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : header('location: index.php');

        $stmt = $conn->prepare("SELECT * FROM election WHERE id = ?");
        $stmt->execute(array($id));
        $post = $stmt->fetch();




        ?>



        <section class="serj" style="padding:40px 0">
          <div class="container-fluid">
            <div class="row justify-content-center">
              <div class="col-md-12">

              </div>
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


                    <h2>Result for <?php echo $post['name'] ?>

                    </h2>
                    <?php

                    $given_date = $post['end_date']; // replace with your given date
                    $given_timestamp = strtotime($given_date);
                    $current_timestamp = time();


                    if ($current_timestamp > $given_timestamp) {


                      $stmt = $conn->prepare('SELECT * FROM vote WHERE election = ?');
                      $stmt->execute(array($id));
                      $data = $stmt->rowCount();
                      $s = $stmt->fetchAll();
                      $maxval=0;
                      foreach($s as $max)
                      {

                        $stmt = $conn->prepare('SELECT * FROM vote WHERE condidate = ? AND election = ?');
                        $stmt->execute(array($max['condidate'],$id));
                        $total = $stmt->rowCount();
                        $get =$stmt->fetch();
                        if ($maxval < $total)
                          {
                            $winner = $get['condidate'];
                            $maxval = $total;
                          }
                      }





                                              $stmt = $conn->prepare('SELECT * FROM condidate WHERE id = ?');
                                              $stmt->execute(array($winner));
                                              $dat =$stmt->fetch();
                        ?>
                    <h4 style="color:green;text-align:left">Winner is :<?php echo $dat['condidate_name'] ?> with <?php echo $maxval ?> votes  <br> <a href="webpage.php?page=print&id=<?php echo $id ?>" style="background:var(--mainColor);color:white;padding:8px 20px">List of voters</a> </h4>
                        <?php
                    }else {
                      ?>
          <h5 style="color:red">The voting period has not ended yet (end on : <?php echo $post['end_date'] ?>)</h5>
                      <?php
                    }
                     ?>

                  </div>
                  <div class="bd total">







                    <?php

                     ?>
                    <div class="row" style="background:white">
                      <div class="col-md-12">
                        <div class="management-body">
                          <div class="default-management-table">
                            <table class="table" id="election-table" style="margin-top:0px">
                              <thead>
                                <tr>
                                  <th scope="col">condidate id</th>
                                  <th scope="col">condidate avatar</th>

                                  <th scope="col">condidate name</th>
                                  <th scope="col">total votes</th>


                                </tr>
                              </thead>
                              <tbody>

                                <?php
                                $stmt = $conn->prepare('SELECT * FROM condidate WHERE election = ?');
                                $stmt->execute(array($id));
                                $r = $stmt->fetchAll();
                                foreach($r as $user)
                                {
                                  ?>
                                  <tr>


                                    <td>
                                      <p class="u-s"><?php
                                        echo $user['id']
                                       ?></p>
                                    </td>

                                    <td>
                                      <div class="avatar">
                                        <?php
                                            if (empty($user['image']))
                                            {
                                              ?>
                                              <img src="<?php echo $avatar  ?>default.png" alt="avart" style="width:40px">

                                              <?php
                                            }
                                            if (!empty($user['image']))
                                            {
                                              ?>
                                              <img src="<?php echo $images . $user['image']  ?>" alt="avart" style="width:40px">

                                              <?php
                                            }
                                         ?>
                                      </div>
                                    </td>
                                    <td>
                                      <p class="u-s"><?php
                                        echo $user['condidate_name']
                                       ?></p>
                                    </td>
                                    <?php
                                    $stmt = $conn->prepare('SELECT * FROM vote WHERE condidate = ? AND election = ?');
                                    $stmt->execute(array($user['id'],$id));
                                    $total = $stmt->rowCount();
                                     ?>
                                    <td>
                                      <span style="background:#ff7b47;color:white;padding:8px 12px;border-radius:10px" class="e-m"><?php echo $total ?></span>
                                    </td>





                                  </tr>
                                  <tr>

                                  <?php
                                }
                                 ?>



                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>

                    </div>
                    <div class="col-md-12" style="text-align:center">
                      <?php
                      $stmt = $conn->prepare('SELECT DISTINCT condidate FROM vote WHERE election = ?');
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
                                                    $stmt = $conn->prepare('SELECT * FROM vote WHERE condidate = ? AND election =?');
                                                    $stmt->execute(array($vote['condidate'],$id));
                                                    $dt = $stmt->fetch();
                                                    $total = $stmt->rowCount();


                                                    $stmt2 = $conn->prepare('SELECT * FROM condidate WHERE id = ?');
                                                    $stmt2->execute(array($dt['condidate']));
                                                    $dt = $stmt2->fetch();
                                                    ?>
                           ['<?php echo $dt['condidate_name'] ?>',     <?php echo $total ?>],
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
      elseif ($page == 'print') {
        $noNavbar = '';

        $pageTitle = "print data";
        include 'init.php';



        $id = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : header('location: anys.php');
        $stmt = $conn->prepare("SELECT * FROM vote WHERE election = ? ");
        $stmt->execute(array($id));
        $data = $stmt->rowCount();
        $users = $stmt->fetchAll();
        if ($data > 0)
        {


            ?>

            <?php

             ?>


              <div class="printpdfpage mpprvrt" id="printpdfpage" style="background:white;position:relative">
                <div class="ovbg">
                </div>
                <div class="container-fluid" style="max-width:100% !important;padding:0">
                  <div class="row justify-content-end pppzrr"  >
                    <div class="col-md-6" style="background-repeat: no-repeat;background-image:url(<?php echo $images ?>br.);background-size:contain;" >
                      <div class="minf" style="min-height:auto;text-align:left">
                        <img src="<?php echo $logo . $lg['logo'] ?>" alt="" style="width:40%;margin-top:20px">
                      </div>
                    </div>
                    <div class="col-md-6" style="text-align:right">
                      <img src="<?php echo $logo ?>lg.png" alt="" style="width:70%">

                    </div>


                  </div>
                  <div class="row justify-content-center">
                    <div class="col-md-12">
                      <?php
                      $stmt = $conn->prepare("SELECT * FROM election WHERE id = ? ");
                      $stmt->execute(array($id));
                      $dat = $stmt->fetch();
                       ?>
                      <h1 style="text-align:center;text-decoration:underline;margin-top:0px;color:black;line-height:1.6em">elecion: <?php echo $dat['name'] ?></h1>
                      <table class="table" id="users-table" style="margin-top:60px">
                        <thead>
                          <tr>
                            <th scope="col">id</th>
                            <th scope="col">vote name</th>
                            <th scope="col">condidate</th>

                            <th scope="col">vote date</th>


                          </tr>
                        </thead>
                        <tbody>

                          <?php
                          foreach($users as $user)
                          {
                            $stmt = $conn->prepare("SELECT * FROM users WHERE id = ? ");
                            $stmt->execute(array($user['user']));
                            $f = $stmt->fetch();
                            $check = $stmt->rowCount();

                            $stmt = $conn->prepare("SELECT * FROM condidate WHERE id = ? ");
                            $stmt->execute(array($user['condidate']));
                            $c = $stmt->fetch();
                            ?>
                            <tr>
                              <td>
                                <p><?php echo $user['id'] ?></p>
                              </td>
                              <td>
                                <?php
                                if ($check >0 )
                                {
                                  ?>
  <p><?php echo $f['username'] ?></p>
                                  <?php
                                }else {
                                  ?>
  <p>empty name</p>
                                  <?php
                                }
                                  ?>
                              </td>
                              <td>
                                <p><?php echo $c['condidate_name'] ?></p>
                              </td>
                              <td>
                                <p><?php echo $user['created'] ?></p>
                              </td>

                            </tr>
                            <tr>

                            <?php
                          }
                           ?>



                        </tbody>
                      </table>

                    </div>
                  </div>

                </div>
              </div>

            <?php


        }
        else {
          header('location: anys.php');
        }
        ?>


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
                    if (isset($_SESSION['clientid']))
                    {
                      $user = $_SERVER['HTTP_USER_AGENT'];

                      $stmt = $conn->prepare('SELECT * FROM vote WHERE user = ? AND election = ?');
                      $stmt->execute(array($_SESSION['clientid'],$post['election']));
                      $check = $stmt->rowCount();
                    }
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
                          if (isset($_SESSION['clientid']))
                          {
                            ?>
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
                            <?php
                          }else {
                        ?>
                        <a href="account.php?page=login" style="font-size:15px;text-transform: capitalize;margin-top: 20px;border-radius: 20px;background:grey;color:white;padding:8px 30px;padding-top:-60px" > <i class="fas fa-user"></i> You need to login to your account to be able to vote</a>

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
        elseif ($page == 'myprofile') {
          $noNavbar = '';

          $pageTitle = "my profile";
          include 'init.php';
          $id = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : header('location: users.php');
          $stmt = $conn->prepare("SELECT * FROM users WHERE id = ? LIMIT 1");
          $stmt->execute(array($id));
          $checkIfuserExist = $stmt->rowCount();
          $userInfo = $stmt->fetch();
          if ($checkIfuserExist > 0)
          {

            if (isset($_SESSION['clientid']) && $_SESSION['clientid'] == $userInfo['id'])
            {

              ?>
              <section class="page-header page-header-modern bg-color-primary page-header-md">
                        <div class="container">
                          <div class="row">

                            <div class="col-md-4 order-1 order-md-2 align-self-center">
                              <ul class="breadcrumb d-block text-md-right breadcrumb-light">
                                <li><a href="index.php">home</a></li>

                                <li class="active">profile</li>
                              </ul>
                            </div>
                            <div class="col-md-8 order-2 order-md-1 align-self-center p-static">
                              <h1>profile</h1>

                            </div>
                          </div>
                        </div>
                      </section>
              <div class="edit-page user-edit-pages deep-page" style="margin:60px 0">
                <div class="container">
                  <div class="row justify-content-end">




                    <div class="col-md-12">
                      <div class="use-fl-info" style="margin-top:40px">

                        <h4 style="text-align:left;padding:15px;border-bottom:1px solid grey">Account information</h4>

                        <form class="accountinfo" method="post" action="webpage.php?page=update" style="text-align:right">

        <div class="form-row">



          <div class="form-group col-md-6">
            <label for="">email address</label>
            <input type="email" name="email" class="form-control"  required  value="<?php  echo $userInfo['email'] ?>">
          </div>
          <div class="form-group col-md-6">
            <label for="">username</label>
            <input type="text" name="username" class="form-control"  required  value="<?php  echo $userInfo['username'] ?>" >
          </div>
        <input type="hidden" name="id" value="<?php echo $userInfo['id'] ?>">
          <div class="form-group col-md-6">
            <label for="">confirm new password  </label>
            <input type="password" name="cpassword" class="form-control"   >
          </div>
          <div class="form-group col-md-6">
            <label for="inputPassword4">new password</label>
            <input type="password" name="password" class="form-control"  >
          </div>

                <div class="form-group col-md-6">
                  <label for="">phone</label>
                  <input type="text" name="phone" class="form-control"  required  value="<?php  echo $userInfo['phone'] ?>">
                </div>


          <div class="form-group col-md-6">
            <label for="">age</label>
            <input type="text" name="age" class="form-control"  required  value="<?php  echo $userInfo['age'] ?>">

          </div>
          <div class="form-group col-md-12">
            <label for="">location adress</label>

            <input type="text" name="adress" class="form-control col-md-12" placeholder="location " value="<?php  echo $userInfo['adress'] ?>" autocomplete="off" required="required">
          </div>


        </div>


        <button type="submit" class="btn btn-primary">save</button>
        </form>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
              <?php





              ?>

              <?php
            }else {
              header('location: index.php');
            }
              ?>

              <?php


          }
          else {
            header('location: index.php');
          }
          ?>


          <?php

          include $tpl . 'footer.php';
        }


        elseif ($page == 'update') {


          $pageTitle = 'update page';
          include 'init.php';
          $id = $_POST['id'];

                                $stmt = $conn->prepare("SELECT * FROM users WHERE id = ? LIMIT 1");
                                $stmt->execute(array($id));
                                $checkIfuser = $stmt->rowCount();

                                if($_SERVER['REQUEST_METHOD'] == 'POST')
                                {
                                  $email = $_POST['email'];
                                  $username = $_POST['username'];
                                  $pass = $_POST['password'];
                                  $cpass = $_POST['cpassword'];
                                  $phone = $_POST['phone'];
                                  $adress = $_POST['adress'];


                                  $age = $_POST['age'];

                                $formErrors = array();
                                if (empty($username))
                                {
                                  $formErrors[] = 'اسم المستخدم اجباري';
                                }

                                if (empty($pass))
                                {
                                  $stmt=$conn->prepare("SELECT password FROM users WHERE id = ? LIMIT 1");
                                  $stmt->execute(array($id));
                                  $passs = $stmt->fetch();

                                  $password = $passs['password'];
                                }
                                if(!empty($pass))
                                {
                                    if ($pass!=$cpass)
                                    {
                                      $formErrors[] = 'كلمة المرور غير مطابقة';
                                    }
                                    else {
                                      $password = sha1($_POST['cpassword']);
                                    }
                                }

                                if (empty($email))
                                {
                                  $formErrors[] = 'بريد الالكتروني اجباري';
                                }



                                foreach ($formErrors as $error ) {
                                  ?>
                                  <div class="container">
                                      <?php
                                        echo '<div class="alert alert-danger" style="width: 50%;">' . $error . '</div>';
                                       ?>

                                  </div>
                                  <?php
                                  // header('refresh:4;url=' . $_SERVER['HTTP_REFERER']);
                                }
                                ?>
                                  <div class="container">
                                    <a href="users.php?page=edit&id=<?php echo $id ?>">اضغط هنا للعودة الى اخر صفحة</a>
                                  </div>
                                <?php

                                if (empty($formErrors))
                                {


                                      $stmt = $conn->prepare("UPDATE users SET username= ?, email =?,password=?,phone=?,age=?,adress=?
                                         WHERE id= ? LIMIT 1  ");
                                      $stmt->execute(array($username,$email,$password,$phone,$age,$adress,$id));
                                      header('location: ' . $_SERVER['HTTP_REFERER']);


                                }
                              }


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
