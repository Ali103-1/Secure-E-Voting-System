<?php
include './connect.php';
$stmt = $conn->prepare("SELECT * FROM pages WHERE id = 1");
$stmt->execute();
$lg = $stmt->fetch();
 ?>



<div class="header" style="background:url(<?php echo $images ?>)">
  <div class="high-c"  >

    <div class="bottombar" id="">
      <div class="container">

        <nav class="navbar navbar-expand-lg " id="">

          <a class="navbar-brand" href="index.php">
            <img src="<?php echo $logo . $lg['logo'] ?>" alt="logo" style="width:80px !important">
          </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon fas fa-bars" style="color:var(--mainColor)"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">

        <ul class="navbar-nav mr-auto merelgj">
          <li class="nav-item">
            <a class="nav-link" href="webpage.php?page=faq">FAQs</a>
          </li>
          <li class="nav-item">
            <a class="nav-link"  href="#contactuspage">contact us</a>
          </li>
          <li class="nav-item">
            <a class="nav-link"  href="home">secure</a>
          </li>

          <li class="nav-item">
            <a class="nav-link"  href="#aboutus">about us</a>
          </li>


          <li class="nav-item">
            <a class="nav-link active"  onclick="activeMe(this)" href="index.php">Home</a>
          </li>
        </ul>


      </div>
      <ul class="navbar-nav ml-auto act">


        <li>
          <a href="<?php echo $fsen ?>">admin</a>
        </li>







      </ul>

    </nav>
      </div>
    </div>
  </div>


</div>
