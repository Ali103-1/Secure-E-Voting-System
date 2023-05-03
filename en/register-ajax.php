
<?php
// صفحة ادخال بيانات تسجيل حساب جديد 
    include 'connect.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {

      $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
      $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
      $age = filter_var($_POST['age'], FILTER_SANITIZE_STRING);

      $phone = $_POST['phone'];

      $pass = $_POST['npassword'];
      $cpass = $_POST['cpassword'];

      $formErrors = array();

      if (empty($email))
    {
      $formErrors[] = 'Email is required';
    }
    if (empty($username))
  {
    $formErrors[] = 'username is required';
  }



    if (empty($pass))
    {
      $formErrors[] =  'password is required';
    }
      if (empty($cpass))
      {
        $formErrors[] =  'confirm password is required';
      }
      if(!empty($pass))
      {
          if ($pass!=$cpass)
          {
            $formErrors[] = 'passwords not matchs';
          }
          else {
            $password = sha1($_POST['npassword']);
          }
      }





      foreach ($formErrors as $error ) {
        ?>
        <div class="container-fluid" style="text-align:center">
          <?php
          echo '<div class="alert alert-danger" >' . $error . '</div>';
          ?>

        </div>
        <?php
      }




      if (empty($formErrors))
      {
        $stmt = $conn->prepare("INSERT INTO users(username,email,password,phone,age, created)
        VALUES(:zus,:zem,:zpass,:zph,:zage, now())");
        $stmt->execute(array(
          'zus' => $username,
          'zem' => $email,
          'zpass' => $password,
          'zph' => $phone,
          'zage' => $age
        ));






        ?>
        <div class="alert alert-success" style="margin-top: 15px">
<p style="text-align:left;">Your account has been successfully registered with us</p>
        </div>
        <?php

      }

    }
 ?>
