<?php
session_start();

// هنا قمت بوضع شرط في حالة الادمين مسجل مسبقا يتم تحويل تلقائيا الى داشبورد
if (isset($_SESSION['admin']))
{
  header('location: dashboard.php');
}

// في حالة ان لم يكن الادمين مسجل يقوم تلقائيا بتحويله الى صفحة الدخةل
    $pageTitle = 'لوحة التحكم - تسجيل الدخول';
    $noNavbar = '';
    include 'init.php';
    $stmt = $conn->prepare("SELECT * FROM pages WHERE id = 1");
    $stmt->execute();
    $lg = $stmt->fetch();
    ?>
      <div class="login" id="login" style="padding:60px 0;background:#0b101c">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-md-4">
              <form class="login-form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                  <div class="form-header">
                      <img src="<?php echo $logo . $lg['logo'] ?>" style="width:100px;margin:20px 0" alt="">
                    <!-- <svg width="100" height="100" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M70 59.375C63.5938 59.375 60.5134 62.5 50 62.5C39.4866 62.5 36.4286 59.375 30 59.375C13.4375 59.375 0 71.1328 0 85.625V90.625C0 95.8008 4.79911 100 10.7143 100H89.2857C95.2009 100 100 95.8008 100 90.625V85.625C100 71.1328 86.5625 59.375 70 59.375ZM89.2857 90.625H10.7143V85.625C10.7143 76.3281 19.375 68.75 30 68.75C33.2589 68.75 38.5491 71.875 50 71.875C61.5402 71.875 66.7188 68.75 70 68.75C80.625 68.75 89.2857 76.3281 89.2857 85.625V90.625ZM50 56.25C67.7455 56.25 82.1429 43.6523 82.1429 28.125C82.1429 12.5977 67.7455 0 50 0C32.2545 0 17.8571 12.5977 17.8571 28.125C17.8571 43.6523 32.2545 56.25 50 56.25ZM50 9.375C61.808 9.375 71.4286 17.793 71.4286 28.125C71.4286 38.457 61.808 46.875 50 46.875C38.192 46.875 28.5714 38.457 28.5714 28.125C28.5714 17.793 38.192 9.375 50 9.375Z" fill="black"/>
                    </svg> -->
                  </div>
                <input type="text" class="form-control" name="username" id="username" autocomplete="off" placeholder="اسم المستخدم" >
                <input type="password" class="form-control" name="password" id="password" autocomplete="off" placeholder="كلمة المرور">
                <input type="submit" class="btn btn-primary" value="دخول">
              </form>
            </div>
          </div>
        </div>
      </div>

    <?php

// هنا بعد ادخال بيانات الدخول يقوم سرفر بتاكد من البيانات ان كانت البيانات صحيحة يتم تحويله الى صفحة داشبورد مع تسجيل سيشن جديد له
    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
      $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
      $password = sha1($_POST['password']);


      $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ? AND type > 0 LIMIT 1");
      $stmt->execute(array($username, $password));
      $userInfo = $stmt->fetch();
      $checkUser = $stmt->rowCount();

      if ($checkUser > 0)
      {


            // هنا نقوم بتسجيل سيشن جديد من خلاله يمكننا تغيير بيانات وحفظه لكل مستخدم
                  $_SESSION['admin'] = $userInfo['username'];
                  $_SESSION['id'] = $userInfo['id'];
                  $_SESSION['type'] = $userInfo['type'];



                  header('location: dashboard.php');
      }
    }



    include $tpl . 'footer.php';

 ?>
