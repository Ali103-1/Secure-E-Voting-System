<?php
// صفحة عرض صحفتين التسجيل وانشاء حساب جديد من خلال تقسم الصفحة الى صفحتين صفحة تسجيل و صفحة انشاء حساب جديد
session_start();
ob_start();
  if (!isset($_SESSION['clientid']))
  {
    $page = isset($_GET['page']) ? $_GET['page'] : 'login';


// صفحة دخول الى الحساب
      if ($page == 'login')
      {
        $noNavbar = "";
        $pageTitle = 'login page';
        include 'init.php';

        ?>
        <div class="account-page" id="account-page" style="margin:80px 0">
          <div class="container">
            <div class="row justify-content-center">

              <div class="col-md-5">
                <div class="login-page">

                  <form class="#" action="account.php?account=login" method="post">

                    <h1>Login Page</h1>


                    <div class="form-group">
                      <input type="text" name="email" class="form-control col-md-12" placeholder="Email adress" required="required">
                    </div>
                    <div class="form-group bt-mg">
                      <input type="password" name="password" class="form-control col-md-12" placeholder="password " autocomplete="new-password" required="required">
                    </div>
                    <div class="form-group">
                      <input type="submit" class="btn btn-primary"  value="login">

                    </div>
                    <?php
                    if ($_SERVER['REQUEST_METHOD'] == 'POST')
                    {
                            $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);

                            // هنا قمت بوضع تشفير لكلمة المرور من نوع sha1
                            $password = sha1($_POST['password']);

                            $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? AND password = ? LIMIT 1 ");
                            $stmt->execute(array($email,$password));
                            $clientExist = $stmt->rowCount();
                            $client = $stmt->fetch();
                            // في حالة تطابق بيانات المدخلة مع قواعد البيانات يتم انشاء سيشن
                            if ($clientExist > 0)
                            {

                              // هنا قمت بانشاء session
                                  $_SESSION['client'] = $client['username'];
                                $_SESSION['clientid'] = $client['id'];
                                $_SESSION['email'] = $client['email'];

                                header('location: index.php');


                            }else {
                              ?>
                              <div class="alert alert-danger">
                              email or password are wrong
                              </div>
                              <?php
                            }

                    }
                     ?>
                    <div class="new-acc">
                      <a href="account.php?page=register" class="new-acc">Create New Account</a>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php

        include $tpl . 'footer.php';


// صفحة تسجيل حساب  جديد
      }elseif($page == "register") {
        $noNavbar = "";

        $pageTitle = 'create new account';
        include 'init.php';
        ?>
        <div class="account-page" id="account-page" style="margin:60px 0">
          <div class="container">
            <div class="row justify-content-center">

              <div class="col-md-8">
                <div class="login-page">

                  <form class="register-form" action="#" method="post" id="form-info">
                    <div class="icon">



                    </div>
                    <h1>Create New Account</h1>
                    <div class="row">
                      <div class="col-6">
                        <label for="username">Email Adress</label>
                        <input type="text" name="email" id="username" placeholder="" class="form-control">
                      </div>
                      <div class="col-6">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" placeholder="" class="form-control">
                      </div>
                      <div class="col-6">
                        <label for="username">Age</label>
                        <input type="text" name="age" id="username" placeholder="" class="form-control">
                      </div>

                      <div class="col-6">
                        <label for="username">Phone</label>
                        <input type="text" name="phone" id="username" placeholder="" class="form-control">
                      </div>

                      <div class="col-6">
                        <label for="password">Password </label>
                        <input type="password" name="npassword" placeholder="" class="form-control">
                      </div>
                      <div class="col-6">
                        <label for="cpassword">Confirm Password</label>
                        <input type="password" name="cpassword" placeholder="" class="form-control">
                      </div>



                    </div>


                                        <div class="form-group">
                                          <input id="a-btn-option" type="button" class="btn btn-primary"  value="create">

                                        </div>
                    <div class="err-msg" id="err-msg">

                    </div>
                    <div class="new-acc">
                      <a href="account.php?page=login" class="ald-acc new-acc">Already Have Account</a>
                    </div>
                  </form>
                </div>
              </div>

            </div>
          </div>
        </div>
        <?php

        include $tpl . 'footer.php';
      }else {
        header('location: account.php?page=login');
      }

  }else {
    header('location: index.php');

  }

  ob_end_flush();

  ?>
