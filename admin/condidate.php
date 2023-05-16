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
      $pageTitle = 'condidate managements';
      include 'init.php';
      $ord = 'ASC';

      if (isset($_GET['ordering']))
      {
        $ord = $_GET['ordering'];
      }

      $condidate = AllItems($conn, 'condidate', $ord);


      ?>
      <div class="default-management-list condidate-management">
        <div class="container cnt-spc">
          <div class="row">



            <div class="col-md-6">
              <div class="left-header management-header">
                <h1>Candidate Managements List</h1>
              </div>
            </div>
            <div class="col-md-6">
              <div class="right-header management-header">
                <?php
                    if($_SESSION['type'] == 2)
                    {
                        ?>
                        <div class="btns">
                          <a href="condidate.php?page=add" id="open-add-page" class="add-btn"><i class="fas fa-plus"></i></a>

                        </div>
                        <?php
                    }
                 ?>
              </div>
            </div>


            <div class="col-md-12">
              <div class="management-body">
                <div class="default-management-table">
                  <table class="table" id="condidate-table" style="margin-top:60px">
                    <thead>
                      <tr>
                        <th scope="col">Candidate id</th>
                        <th scope="col">Candidate name</th>
                        <th scope="col">Candidate image</th>
                        <th scope="col">total votes </th>

                        <th scope="col">election </th>




                        <th scope="col">action</th>

                      </tr>
                    </thead>
                    <tbody>

                      <?php
                      foreach($condidate as $user)
                      {
                        ?>
                        <tr>
                          <td>
                            <p><?php echo $user['id'] ?></p>
                          </td>


                          <td>
                            <p class="u-s"><?php
                              echo $user['condidate_name']
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
                                                        echo $user['total_votes']
                                                       ?></p>
                                                    </td>
                          <?php

                            $stmt = $conn->prepare('SELECT * FROM election WHERE id = ?');
                            $stmt->execute(array($user['election']));
                            $data = $stmt->fetch();
                            $check = $stmt->rowCount();
                           ?>
                          <td>
                            <?php
                              if ($check > 0)
                              {
                                ?>
    <p class="e-m"><?php echo $data['name'] ?></p>
                                <?php
                              }else {
                                ?>
    <p class="e-m">*****</p>
                                <?php
                              }
                             ?>
                          </td>




                          <td>
                            <?php
                              if ($_SESSION['type'] == 2 )
                              {
                                  ?>
                                  <ul>
                                    <li class=" dropdown">
                                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                              <i class="fas fa-ellipsis-h"></i>
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                              <a class="dropdown-item" href="condidate.php?page=edit&id=<?php echo $user['id'] ?>">
                                                <i class="fas fa-edit" ></i>

                      edit
                                              </a>

                                              <div class="dropdown-divider"></div>
                                              <a class="dropdown-item" href="condidate.php?page=delete&id=<?php echo $user['id'] ?>">
                                                <i class="fas fa-trash"></i>
                                          delete
                                              </a>

                                            </div>
                                          </li>
                                  </ul>
                                  <?php
                              }


                              elseif ($_SESSION['id'] == $user['id'] )
                              {
                                ?>
                                <ul>
                                  <li class=" dropdown">
                                          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-h"></i>
                                          </a>
                                          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="condidate.php?page=edit&id=<?php echo $user['id'] ?>">
                                              <i class="fas fa-edit" ></i>

                    edit
                                            </a>

                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="condidate.php?page=delete&id=<?php echo $user['id'] ?>">
                                              <i class="fas fa-trash"></i>
                                        delete
                                            </a>

                                          </div>
                                        </li>
                                </ul>
                                <?php
                              }
                              else
                              {
                                echo 'You do not have permission to access this content';
                              }
                             ?>

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
        </div>
      </div>

    <?php

          if ($_SESSION['type'] == 2)
          {
            ?>

            <?php
          }
     ?>
      <?php
      include $tpl . 'footer.php';

    }
    elseif ($page == 'add') {
      $pageTitle = "add new condidate";
      include 'init.php';




        if ($_SESSION['type'] == 2)
        {

          ?>
          <div class="add-default-page add-user-page" id="add-page">
            <div class="container cnt-spc">
              <div class="row justify-content-start">
                <div class="col-md-8">
                  <form class="add-fomr" method="POST" action="condidate.php?page=insert" id="form-info" enctype="multipart/form-data"  >
                    <h3><a style="margin-left:5px;font-size:15px;border-radius: 10px;background:var(--mainColor);color:white;padding:8px" href="condidate.php?page=manage" class="fas fa-long-arrow-alt-left"></a>  Fill in the information to add a new condidate </h3>
                    <div class="err-msg">

                    </div>
                      <div class="row">
                        <div class="col-12">
                          <label for="username">condidate name</label>
                          <input type="text" name="name" id="username" placeholder="" class="form-control">
                        </div>

                        <div class="col-12">
                          <label for="username">condidate description</label>
                          <textarea name="descr" class="form-control"></textarea>
                        </div>
                        <div class="col-12">
                          <label for="username">election</label>
                            <?php
                            $stmt = $conn->prepare('SELECT * FROM election ORDER BY id DESC');
                            $stmt->execute();
                            $all = $stmt->fetchAll();
                             ?>
                          <select class="form-control" name="election">
                            <?php
                              foreach ($all as $a)
                              {
                                ?>
                                <option value="<?php echo $a['id'] ?>"><?php echo $a['name'] ?></option>
                                <?php
                              }
                             ?>
                          </select>
                        </div>

                      </div>
                    <input type="submit" class="btn btn-primary" id="a-"  value="add">

                  </form>
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



      ?>


      <?php

      include $tpl . 'footer.php';
    }
    elseif ($page == 'insert') {
      $pageTitle = "insert data";
      include 'init.php';
      if ($_SERVER['REQUEST_METHOD'] == 'POST')
      {
        $name = $_POST['name'];
        $descr = $_POST['descr'];

        $election = $_POST['election'];




        $formErrors = array();
        if (empty($name))
        {
          $formErrors[] = 'name is required';
        }




        foreach ($formErrors as $error ) {
          ?>
          <div class="container">
            <?php
            echo '<div class="alert alert-danger" >' . $error . '</div>';
            ?>

          </div>
          <?php
        }




        if (empty($formErrors))
        {


          $stmt = $conn->prepare("INSERT INTO condidate(election,descr, condidate_name) VALUES(:zusername,:zdes, :zpass)");
          $stmt->execute(array(
            'zusername' => $election,
            'zdes' => $descr,

            'zpass' => $name
          ));
          ?>
          <div class="alert alert-success" style="margin-top: 15px">
            <p style="text-align:center">  The condidate has been added successfully. Please reload the page</p>
          </div>
          <?php
          header('refresh:3;url= condidate.php');
        }



      }

      include $tpl . 'footer.php';
    }
    elseif ($page == 'edit') {
      $pageTitle = "edit condidate";
      include 'init.php';

      $id = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : header('location: condidate.php');
      $stmt = $conn->prepare("SELECT * FROM condidate WHERE id = ? LIMIT 1");
      $stmt->execute(array($id));
      $checkIfuserExist = $stmt->rowCount();
      $userInfo = $stmt->fetch();
      if ($checkIfuserExist > 0)
      {

        if ($_SESSION['type'] == 2 or $_SESSION['id'] == $userInfo['id'])
        {

          ?>
          <div class="edit-page user-edit-pages deep-page">
            <div class="container cnt-spc">
              <div class="row">
                <div class="col-md-12">
                  <div class="pg-tt">
                    <h1 dir="rtl" style="display:block;text-align:left">edit condidate </h1>
                  </div>
                </div>

                <div class="col-md-8">
                  <div class="use-fl-info">
                    <form method="post" action="condidate.php?page=update" enctype="multipart/form-data">
                      <div class="row">
                        <div class="col-12">
                          <label for="username">condidate name</label>
                          <input type="text" name="name" id="username" placeholder="" value="<?php echo $userInfo['condidate_name'] ?>" class="form-control">
                        </div>
                        <div class="col-12">
                          <label for="username">condidate description</label>
                          <textarea name="descr" class="form-control"><?php echo $userInfo['descr'] ?></textarea>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $userInfo['id'] ?>">
                        <div class="col-12">
                          <label for="username">election</label>
                            <?php
                            $stmt = $conn->prepare('SELECT * FROM election ORDER BY id DESC');
                            $stmt->execute();
                            $all = $stmt->fetchAll();
                             ?>
                          <select class="form-control" name="election">
                            <?php
                              foreach ($all as $a)
                              {
                                ?>
                                <option <?php if ($a['id'] == $userInfo['election']) { echo 'selected'; } ?> value="<?php echo $a['id'] ?>"><?php echo $a['name'] ?></option>
                                <?php
                              }
                             ?>
                          </select>
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
        header('location: condidate.php');
      }
      ?>


      <?php

      include $tpl . 'footer.php';
    }
    elseif ($page == 'update') {


      $pageTitle = 'update page';
      include 'init.php';
      $id = $_POST['id'];

                            $stmt = $conn->prepare("SELECT * FROM condidate WHERE id = ? LIMIT 1");
                            $stmt->execute(array($id));
                            $checkIfuser = $stmt->rowCount();
                            $data = $stmt->fetch();

                            if($_SERVER['REQUEST_METHOD'] == 'POST')
                            {

                              $name = $_POST['name'];
                              $descr = $_POST['descr'];

                              $election = $_POST['election'];




                            $formErrors = array();
                            if (empty($name))
                            {
                              $formErrors[] = 'name is required';
                            }









                            foreach ($formErrors as $error ) {
                              ?>
                              <div class="container">
                                  <?php
                                    echo '<div class="alert alert-danger" style="width: 50%;">' . $error . '</div>';
                                   ?>

                              </div>
                              <?php
                              ?>
                                <div class="container">
                                  <a href="condidate.php?page=edit&id=<?php echo $id ?>">اضغط هنا للعودة الى اخر صفحة</a>
                                </div>
                              <?php
                              // header('refresh:4;url=' . $_SERVER['HTTP_REFERER']);
                            }


                            if (empty($formErrors))
                            {

                              $stmt = $conn->prepare("UPDATE condidate SET election = ?, descr= ?,condidate_name = ?
                                 WHERE id=?  ");
                              $stmt->execute(array($election,$descr,$name,$id));
                              header('location: ' . $_SERVER['HTTP_REFERER']);
                            }
                          }


      include $tpl . 'footer.php';


    }elseif ($page == 'delete') {
     include 'init.php';
      if ($_SESSION['type'] == 2)
      {
        $id = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : header('location: condidate.php');;
        $stmt = $conn->prepare("SELECT * FROM condidate WHERE id = ? LIMIT 1");
        $stmt->execute(array($id));
        $pfl = $stmt->fetch();
        $check = $stmt->rowCount();


          $stmt = $conn->prepare("DELETE FROM condidate WHERE id = :zid");
          $stmt->bindParam(":zid", $id);
          $stmt->execute();
          header('location: condidate.php');



      }
    }elseif ($page == 'activate') {
      if (isset($_SESSION['type']) == 2)
      {
        include 'init.php';
        $id = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : header('location: condidate.php');;

          $stmt = $conn->prepare("UPDATE condidate SET status = 1 WHERE id= ? LIMIT 1  ");
          $stmt->execute(array($id));
          header('location:condidate.php');
      }
    }
    elseif ($page == 'deactivate') {
      if (isset($_SESSION['type']) == 2)
      {
        include 'init.php';
        $id = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : header('location: condidate.php');;

          $stmt = $conn->prepare("UPDATE condidate SET status = 0 WHERE id= ? LIMIT 1  ");
          $stmt->execute(array($id));
          header('location:condidate.php');
      }
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
