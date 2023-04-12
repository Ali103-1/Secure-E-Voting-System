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
          $pageTitle = 'Faq managements page';
          include 'init.php';
          $ord = 'ASC';

          if (isset($_GET['ordering']))
          {
            $ord = $_GET['ordering'];
          }

          $stmt = $conn->prepare("SELECT * FROM faq  ORDER BY id $ord");
                    $stmt->execute();
                    $posts = $stmt->fetchAll();


            ?>
            <div class="default-management-list users-management">
              <div class="container-fluid cnt-spc">
                <div class="row">


                  <div class="col-md-12">
                    <div class="right-header management-header">
                      <div class="btns">
                        <a href="faq.php?page=add" class="add-btn"> <i class="fas fa-plus"></i>  </a>
                      </div>
                    </div>
                    <div class="page-direction-bnts btns2">

                      <ul>




<li></li>
                      </ul>
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
                                <a style="color:rgba(0,0,0,.6)" href="faq.php?page=edit&id=<?php echo $post['id'] ?>">

      <h2 style="margin-bottom:20px;font-size:25px;color:var(--)"><?php echo $post['qst'] ?></h2>
      <p><?php echo $post['ans'] ?></p>
                                </a>
                              </div>
                            </div>
                            <div class="col-md-2">
                              <div class="tticon" style="text-align: center;padding-top:20px">
                                <div class="tticon" style="display:flex">
                                  <a style="padding:0 !important" class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-h" style="margin:0 !important"></i>
                                  </a>
                                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                                    <a class="dropdown-item" href="faq.php?page=delete&id=<?php echo $post['id'] ?>" style="padding:">
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

        }elseif ($page == "add") {
      $pageTitle = 'add new faq' ;
      include 'init.php';
      ?>
      <div class="add-default-page add-post-page  add-product-page " id="add-page">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-md-8">
              <form class="add-fomr" method="POST" action="faq.php?page=insert" enctype="multipart/form-data"  id="ca-form-info"  >
                <h3><a style="margin-left:5px;font-size:15px;border-radius: 10px;background:var(--mainColor);color:white;padding:8px" href="faq.php?page=manage" class="fas fa-long-arrow-alt-right"></a> Fill in the information to add a new question  </h3>
                  <div class="row">



                    <div class="col-md-12 ">
                      <input type="text" name="qst" placeholder="question" id="image2" value="">
                    </div>


                    <div class="col-md-12 ">
                      <textarea name="ans" class="form-control">Answer</textarea>
                    </div>




                  </div>

                <input type="submit" class="btn btn-primary" id="ca-btn-option"  value="add">
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
        $ans = $_POST['ans'];
        $qst = $_POST['qst'];




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

                                $stmt = $conn->prepare("INSERT INTO faq(qst,ans)
                                VALUES(:zn,:zj )");
                                $stmt->execute(array(
                                  'zn' => $qst,
                                  'zj' => $ans

                                ));
                                ?>

                                <?php
                                header('location: faq.php?page=manage');
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
        $id = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : header('location: faq.php');;
        $stmt = $conn->prepare("SELECT * FROM faq WHERE id = ? LIMIT 1");
        $stmt->execute(array($id));
        $check = $stmt->rowCount();

        if ($check > 0 )
        {
          $stmt = $conn->prepare("DELETE FROM faq WHERE id = :zid");
          $stmt->bindParam(":zid", $id);
          $stmt->execute();
          header('location: faq.php');

        }
        else {
          header('location: faq.php');
        }
      }
    }
    elseif ($page == 'active') {

        include 'init.php';
        $id = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : header('location: users.php');;

          $stmt = $conn->prepare("UPDATE faq SET status = 1 WHERE id= ? LIMIT 1  ");
          $stmt->execute(array($id));
          header('location:faq.php');

    }
    elseif ($page == 'unactive') {

        include 'init.php';
        $id = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : header('location: users.php');;

          $stmt = $conn->prepare("UPDATE faq SET status = 0 WHERE id= ? LIMIT 1  ");
          $stmt->execute(array($id));
          header('location:faq.php');

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
