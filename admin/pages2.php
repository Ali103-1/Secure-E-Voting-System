<?php
  ob_start();
  session_start();
  if (isset($_SESSION['admin']))
  {

    $page = isset($_GET['page']) ? $_GET['page'] : 'manage';

    if ($page == 'manage')
    {
      $pageTitle = 'content managements';
      include 'init.php';
      $ord = 'ASC';

      if (isset($_GET['ordering']))
      {
        $ord = $_GET['ordering'];
      }

      $stmt = $conn->prepare("SELECT * FROM pages ORDER BY id $ord");
                $stmt->execute();
                $posts = $stmt->fetchAll();


        ?>
        <div class="content-management default-management-list users-management">
          <div class="container cnt-spc">
            <div class="row justify-content-end">


              <div class="col-md-6">
                <div class="right-header management-header">
                  <div class="btns">
                    <!-- <a href="posts.php?page=add" id="open-add-page" class="add-btn"><i class="fas fa-plus"></i> اضافة منشور</a> -->

                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="left-header management-header">
                </div>
              </div>
              <div class="col-md-6 srch-sp">
                <div class="search-box">
                  <!-- <input type="search" class="form-control" name="search" id="categories-search" onkeyup="tabletwo()" autocomplete="off" placeholder="search by name"> -->
                </div>
              </div>
              <div class="col-md-6">

              </div>
              <?php
                $stmt = $conn->prepare("SELECT * FROM pages WHERE id =1");
                $stmt->execute();
                $ctn = $stmt->fetch();

               ?>
              <div class="col-md-12">
                <div class="management-body">
                  <div class="default-management-table pages-content">
                    <form class="" action="pages2.php?page=update" method="post" style="text-align:left" enctype="multipart/form-data">
                      <div class="row">

                        <div class="col-12">
                          <h3>about us content</h3>
                          <textarea id="" name="aboutus" class="form-control" ><?php echo $ctn['aboutus'] ?></textarea>

                        </div>

                      </div>

                      <h3>privacy</h3>
                      <textarea id="content" name="privacy" class="form-control" ><?php echo $ctn['privacy'] ?></textarea>

                      <input type="submit"  class="btn btn-primary" name="" value="save" style="margin:10px 0" style="background:var(--mainColor) !important">

                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>



        <?php


      ?>

        <?php
      include $tpl . 'footer.php';

    }

    elseif ($page == 'update') {


      $pageTitle = 'صفحة حفظ التعديلات';
      include 'init.php';




                                if($_SERVER['REQUEST_METHOD'] == 'POST')
                                {




                                $aboutus = $_POST['aboutus'];
                                $privacy = $_POST['privacy'];









                                $formErrors = array();









                                foreach ($formErrors as $error ) {
                                  ?>
                                  <div class="container">
                                      <?php
                                        echo '<div class="alert alert-danger" style="width: 50%;">' . $error . '</div>';
                                       ?>

                                  </div>
                                  <?php
                                }
                                ?>
                                  <div class="container">
                                    <a href="pages.php?page=edit&id=<?php echo $id ?>">اضغط هنا للعودة الى الصفحة السابقة</a>
                                  </div>
                                <?php

                                if (empty($formErrors))
                                {



                                  $stmt = $conn->prepare("UPDATE pages SET   aboutus = ?,privacy=? WHERE id=1   ");
                                  $stmt->execute(array($aboutus,$privacy));
                                  header('location: ' . $_SERVER['HTTP_REFERER']);
                                }
                              }





                              else {
                                header('location: dashboard.php');
                              }

      include $tpl . 'footer.php';


    }
    elseif ($page == 'active') {

        include 'init.php';

          $stmt = $conn->prepare("UPDATE pages SET sv = 1 WHERE id= 1 LIMIT 1  ");
          $stmt->execute();
          header('location:pages.php');

    }
    elseif ($page == 'unactive') {

        include 'init.php';

          $stmt = $conn->prepare("UPDATE pages SET sv = 0 WHERE id= 1 LIMIT 1  ");
          $stmt->execute();
          header('location:pages.php');

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
