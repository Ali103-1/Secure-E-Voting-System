<?php
    include 'connect.php';

// هنا صفحة ادخال الرسائل التي ترسل من طرف المستخدم
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
      $fname = $_POST['fname'];
      $email = $_POST['email'];
      $message = $_POST['message'];


      $formErrors = array();
      if (empty($fname) )
      {
        $formErrors[] = 'Full name is requierd';
      }
      if (empty($email))
      {
        $formErrors[] = 'Email is required';
      }

      if (empty($message))
      {
        $formErrors[] = 'Message is required';
      }







      foreach ($formErrors as $error ) {
        ?>
        <div class="container-fluid">

          <?php
          echo '<div class="alert alert-danger"  style="text-align:center">' . $error . '</div>';
          ?>

        </div>
        <?php
      }




      if (empty($formErrors))
      {
        // هنا عملية داخل رسائل في قواعد البيانات
        $stmt = $conn->prepare("INSERT INTO consultation(fname,email,content,created)
         VALUES(:zf,:ze,:zm,now())");
        $stmt->execute(array(
          'zf' => $fname,
          'ze' => $email,
          'zm' => $message



        ));

        // هنا عملية ادخال رسالة على انها اشعار جديد
        $stmt = $conn->prepare("INSERT INTO notifications(fname,content,created)
         VALUES(:zf,:ze,now())");
        $stmt->execute(array(
          'zf' => $fname,
          'ze' => $message



        ));

        ?>
        <div class="alert alert-success" style="margin-top: 15px">
<p style="text-align:center">Your inquiry has been sent successfully</p>        </div>
        <?php
      }


    }else {
      header('location: index.php');
    }
 ?>
