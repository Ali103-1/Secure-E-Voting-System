<?php
session_start();
// صفحة الرئيسية للموقع




// عنوان الموقع
$pageTitle = "home page";
include 'init.php';

// هنا قمت بجلب بيانات من نحن وغيرها من البيانات التي يمكن تغييرها من لوحة التحكم كالصور
$stmt = $conn->prepare("SELECT * FROM pages WHERE id = 1");
$stmt->execute();
$lg = $stmt->fetch();

// الص
?>





<section class="aboutus" style="background-image:url(<?php echo $images ?>vec2.png);background-size:contain" id="about">
    <div class="container" style="max-width:99% !important">
      <div class="row justify-content-end">




        <div class="col-md-6" style="text-align:center">
          <img class="rtt" src="<?php echo $images ?>circle.png" alt="">
          <img src="<?php echo $images . $lg['h_image'] ?>" alt="" class="mmimg" style="width:90%">

        </div>
        <div class="col-md-6 aos-init aos-animate" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
          <div class="content-a" style="text-align:right">

            <h3>Learn more about us
                 </h3>
                 <h1>e-voting system
                 </h1>
                 <h5 style="color:var(--mainColor);font-size:20px">your location <img src="<?php echo $images ?>location.png" style="width:17px; height: auto ! important" alt="">    </h5>
    <p><?php echo $lg['aboutus'] ?></p>


          </div>
        </div>
        
      </div>
    </div>
  </section>

  <section class="aboutus" style="background-image:url(<?php echo $images ?>vec2.png);background-size:contain" id="about">
      <div class="container" style="max-width:99% !important">
        <div class="row justify-content-end">




          <div class="col-md-6 aos-init aos-animate" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
            <div class="content-a" style="text-align:right">

              <h3>Learn more about us
                   </h3>
                   <h1>Secure system
                   </h1>

      <p>Security is fundamental in all fields and at all times and places. Also, its importance is
increasing with systems related to critical decisions. One aspect of security is Cybersecurity which revolves around protecting information systems from unauthorized access
and encrypting data. Also, many more technologies are used in this field to achieve CIA
(confidentiality, integrity, and availability). The system is centered on developing secure electronic voting and to understand this system a look at its history is mandatory.
Paper-based voting was one of the earliest methods for voting but it was having major
issues such as the lack of mobility, large number of papers, and the difficulty of storing
and preserving them. This is solved by using E-voting systems but these systems need to
ensure verification and integrity to reach their potential. Otherwise, it will be vulnerable
to fraud and lack of verification leading to unreliable and unfair systems. Therefore, a
secure E-voting system is capable of solving integrity, verification problems and ease the
process of voting.</p>
      

            </div>
          </div>


                  <div class="col-md-6" style="text-align:center">
                    <img class="rtt" src="<?php echo $images ?>circle.png" alt="">
                    <img src="<?php echo $images . $lg['h_image2'] ?>" alt="" class="mmimg" style="width:90%">

                  </div>

        </div>
      </div>
    </section>
    <section class="total" id="services">
        <div class="container-fluid">
          <?php
          $stmt = $conn->prepare('SELECT * FROM election ORDER BY id DESC');
          $stmt->execute();
          $posts = $stmt->fetchAll();
           ?>
          <div class="row">
            <div class="col-md-12">
              <div class="content-header">
                <h3>Elections</h3>
                <p>Here are the registered Elections.</p>

              </div>
            </div>
                        <?php
                          foreach($posts as $post)
                          {
                            ?>
                            <div class="col-md-4">
                        <div class="box">
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

                        <h3><?php echo $post['name'] ?></h3>
                        <p><?php echo $post['descr'] ?>
                        </p>
                        <a href="webpage.php?page=details&id=<?php echo $post['id'] ?>">details</a>
                        </div>
                        </div>

                            <?php
                          }
                         ?>



          </div>
        </div>
      </section>

      <section class="total" id="services">
          <div class="container-fluid">
            <?php
            // نقوم بجلب جميع المتشرحين
            $stmt = $conn->prepare('SELECT * FROM condidate ORDER BY id DESC');
            $stmt->execute();
            $posts = $stmt->fetchAll();
             ?>
            <div class="row">
              <div class="col-md-12">
                <div class="content-header">
                  <h3>Candidates</h3>
                  <p>Candidates that are in an active Election.</p>

                </div>
              </div>
                          <?php
                            foreach($posts as $post)
                            {
                              ?>
                              <div class="col-md-4">
                          <div class="box">
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
                          <a href="webpage.php?page=condidate&id=<?php echo $post['id'] ?>">details</a>
                          </div>
                          </div>

                              <?php
                            }
                           ?>



            </div>
          </div>
        </section>


        <section class="total results" id="services">
            <div class="container">
              <?php
              // نقوم بجلب بيانات كل الانتخابات
              $stmt = $conn->prepare('SELECT * FROM election ORDER BY total_votes DESC');
              $stmt->execute();
              $posts = $stmt->fetchAll();
              $i = 1;
               ?>
              <div class="row">
                <div class="col-md-12">
                  <div class="content-header">
                    <h3>Result</h3>
                    <p>Elections Results</p>
                  </div>
                </div>
                            <?php
                              foreach($posts as $post)
                              {
                                ?>
                                <div class="col-md-6">
                            <div class="box">
                              <span>Palce: <?php echo $i ?></span> <br>
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
                            <h3><?php echo $post['name'] ?></h3>
                            <p><?php echo $post['descr'] ?>
                            </p>
                            <a style="color:white">Total votes : <?php echo $post['total_votes'] ?></a>
                            </div>
                            </div>

                                <?php
                                  $i += 1;
                              }
                             ?>



              </div>
            </div>
          </section>
<section class="contactuspage"  id="contactuspage">
<div class="container">


<div class="row justify-content-center">


  <div class="col-md-11" >
    <div class="cnf" style="padding:50px 0;margin-bottom: 180">
      <form class="" action="index.html" method="post" id="message-form">
                  <h1 style="color:black;margin:60px 0;text-align:center;text-transform:capitalize;font-weight:bold">have a question ?</h1>
        <div class="row">

          <div class="col-6">
            <i class="fas fa-envelope"></i>
            <input type="text" name="email" placeholder="Email adress" class="form-control" value="">
          </div>
          <div class="col-6">
            <i class="fas fa-user"></i>
            <input type="text" name="fname" placeholder="Full name" class="form-control" value="">
          </div>
          <div class="col-12">
            <textarea name="message"  style="padding:20px !important" class="form-control" >Details
</textarea>
          </div>
          <div class="col-md-12">
            <div class="ds" style="text-align:center">
              <input id="message-btn" type="button" style="height: 50px !important;border-radius: 10px !important;background:var(--mainColor) !important;color:white;text-align:center !important" class="btn " name="" value="Send">
            </div>
          </div>
          <div class="col-md-12">
            <div class="msg2" id="msg2">

            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
</div>
</section>


<?php
include $tpl . 'footer.php';
?>
