<?php
  ob_start();
  session_start();

    // هنا نتححق من ان الادمين قام بتسجيل دخوله
  if (isset($_SESSION['admin']))
  {

    // افضل طريقة لتقسيم الصفحات الموقع دون الاكثار من ملفات الموقع هي باستعمال الخاصية الشرط التي في الاسفل



      // هنا نضع نقسم صفحة واحد الى عدة صفحات من خلال وضع شرط اسم الصفحة
    $page = isset($_GET['page']) ? $_GET['page'] : 'manage';


        if ($page == 'manage')
        {
          $pageTitle = 'message managements page';
          include 'init.php';
          $ord = 'DESC';

          if (isset($_GET['ordering']))
          {
            $ord = $_GET['ordering'];
          }

          $stmt = $conn->prepare("SELECT * FROM consultation  ORDER BY id $ord");
                    $stmt->execute();
                    $posts = $stmt->fetchAll();


            ?>
            <div class="default-management-list users-management">
              <div class="container-fluid cnt-spc">
                <div class="row">


                  <div class="col-md-12">
                    <div class="right-header management-header">
                      <div class="btns">
                      </div>
                    </div>
                    <div class="page-direction-bnts btns2">


                    </div>
                  </div>

                  <?php
                      foreach($posts as $post)

                      {

                        ?>
                        <div class="col-md-12">
                          <div class="row boxds">

                            <div class="col-md-10">
                              <div class="contenttrea" style="text-align:left">
                                <a style="color:rgba(0,0,0,.6)" href="consultation.php?page=edit&id=<?php echo $post['id'] ?>">

      <h2 style="margin-bottom:20px;font-size:30px;color:black"><?php echo $post['fname'] ?></h2>
      <h6 style="margin-bottom:20px;font-size:14px;color:var(--mainColor)"><?php echo $post['title'] ?></h6>

      <p style="margin:0"><?php echo $post['content'] ?></p>
      <?php
          if (empty($post['repons']))
          {
            ?>
            <span style="font-size: 11px;color:red;padding-top:10px">No response yet</span>
            <?php
          }
          if (!empty($post['repons']))
          {
            ?>
            <span style="color:green">Answered <i style="margin-top:10px;;font-size:8px;background:green" class="fas fa-check"> </i> </span>
            <?php
          }
       ?>
                                </a>
                              </div>
                            </div>

                                                        <div class="col-md-1" style="text-align:left">
                                                          <span style="font-size:13px;color:black"><?php echo $post['created'] ?></span>

                                                        </div>
                            <div class="col-md-1">
                              <div class="tticon" style="text-align: center;padding-top:20px">
                                <div class="tticon" style="display:flex">
                                  <a style="padding:0 !important" class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-h" style="margin:0 !important"></i>
                                  </a>
                                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                                    <a class="dropdown-item" href="consultation.php?page=delete&id=<?php echo $post['id'] ?>" style="padding:">
                                    <i class="fas fa-trash" style="margin:0 !important"></i>

                            delete
                                    </a>
                                  </div>

                                </div>


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


          ?>

            <?php
          include $tpl . 'footer.php';

        }
    elseif ($page == "edit") {
  $pageTitle = 'message details  ';
  include 'init.php';

  $id = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : header('location: consultation.php');;
  $stmt = $conn->prepare("SELECT * FROM consultation WHERE id = ? LIMIT 1");
  $stmt->execute(array($id));
  $data = $stmt->fetch();



  ?>
  <div class="add-default-page add-post-page  add-product-page " id="add-page">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <form class="add-fomr" method="POST" action="consultation.php?page=insert" enctype="multipart/form-data"  id="ca-form-info"  >
            <h3><a style="margin-left:5px;font-size:15px;border-radius: 10px;background:var(--mainColor);color:white;padding:8px" href="consultation.php?page=manage" class="fas fa-long-arrow-alt-right"></a> Message details :  <?php echo $data['fname'] ?>   </h3>
              <div class="row">


                <div class="col-md-6 ">
                  <input type="text" name="fname" disabled placeholder="" value="<?php echo $data['fname'] ?>" id="image2" value="">
                </div>
                <div class="col-md-6 ">
                  <input type="text" name="qst" disabled value="<?php echo $data['title'] ?>"  placeholder="" id="image2" value="">
                </div>

<input type="hidden" name="id" value="<?php echo $data['id'] ?>">
                <div class="col-md-12 ">
                  <textarea name="ans" class="form-control" disabled><?php echo $data['content'] ?></textarea>
                </div>


<?php
    if (empty($data['repons']))
    {
      ?>

                                          <div class="col-md-12 ">
                                            <textarea name="repons" class="form-control" >Reply to the message here</textarea>
                                          </div>
      <?php
    }
    if (!empty($data['repons']))
    {
      ?>

                                          <div class="col-md-12 ">
                                            <textarea name="repons" class="form-control" disabled ><?php echo $data['repons'] ?></textarea>
                                          </div>
      <?php
    }
      ?>

              </div>
              <?php
              if (empty($data['repons']))
              {
                ?>
                <input type="submit" class="btn btn-primary" id="ca-btn-option"  value="ارسال">

                <?php
              }
              if (!empty($data['repons']))
              {
                ?>

                                                    <div class="col-md-12 ">
                                                      <div class="alert alert-success">
                                                        <p style="margin:0;text-align:right">تم الرد على الاستفسار مباشرة على بريد الالكتروني صاحب الاستفسار</p>
                                                      </div>
                                                    </div>
                <?php
              }
               ?>
            <div class="err-msg">

            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <?php

  include $tpl . 'footer.php';
}
    elseif ($page == 'insert') {
      $pageTitle = 'insert  post';
      include 'init.php';

      if ($_SERVER['REQUEST_METHOD'] == 'POST')
      {
        $id = $_POST['id'];
        $repons = $_POST['repons'];




            $stmt = $conn->prepare("SELECT * FROM pages WHERE id = 1");
            $stmt->execute();
            $lg = $stmt->fetch();
        $formErrors = array();




                                      foreach ($formErrors as $error ) {
                                        ?>
                                        <div class="container" style="margin-top:50px">
                                          <div class="row justify-content-center">
                                              <div class="col-md-4">
                                                <?php
                                                  echo '<div class="alert alert-danger" style="width: 100%;text-align:center">' . $error . '</div>';
                                                 ?>

                                              </div>
                                          </div>
                                        </div>
                                        <?php
                                      }



                          if (empty($formErrors))
                            {

                              $stmt = $conn->prepare("UPDATE consultation SET repons = ? WHERE id = ?");
                              $stmt->execute(array($repons,$id));



                              $stmt = $conn->prepare("SELECT * FROM consultation WHERE id = ? LIMIT 1");
                              $stmt->execute(array($id));
                              $data = $stmt->fetch();
                              $subject = "الرد على الاستفسار- answer the question";
                                       $message = $repons;
                                $sender = "From: ".$lg['email'] ."";
                                $email = $data['email'];
                                if(mail($email, $subject, $message, $sender)){

                                  ?>
                                  <div class="alert alert-success" style="margin-top: 15px">
                            تم ارسال الرد
                                  </div>
                                  <?php
                                    exit();
                                }
                                ?>


                                <?php
                                header('location:' . $_SERVER['HTTP_REFERER']);
                              }




      }else {
        header('location: posts.php');
      }
      include $tpl . 'footer.php';

      ?>
      <?php
    }

  elseif ($page == 'delete') {
     include 'init.php';
      if ($_SESSION['type'] == 2)
      {
        $id = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : header('location: consultation.php');;
        $stmt = $conn->prepare("SELECT * FROM consultation WHERE id = ? LIMIT 1");
        $stmt->execute(array($id));
        $check = $stmt->rowCount();

        if ($check > 0 )
        {
          $stmt = $conn->prepare("DELETE FROM consultation WHERE id = :zid");
          $stmt->bindParam(":zid", $id);
          $stmt->execute();
          header('location: consultation.php');

        }
        else {
          header('location: consultation.php');
        }
      }
    }
    elseif ($page == 'active') {

        include 'init.php';
        $id = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : header('location: users.php');;

          $stmt = $conn->prepare("UPDATE consultation SET status = 1 WHERE id= ? LIMIT 1  ");
          $stmt->execute(array($id));
          header('location:consultation.php');

    }
    elseif ($page == 'unactive') {

        include 'init.php';
        $id = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : header('location: users.php');;

          $stmt = $conn->prepare("UPDATE consultation SET status = 0 WHERE id= ? LIMIT 1  ");
          $stmt->execute(array($id));
          header('location:consultation.php');

    }


    else {
      header('location: dashboard.php');
    }

    ?>


    <?php


  }else {
    header('location: logout.php');
  }
  ob_end_flush();
 ?>
