<?php
include './connect.php';
$stmt = $conn->prepare("SELECT * FROM pages WHERE id = 1");
$stmt->execute();
$lg = $stmt->fetch();
 ?>



<div class="header" style="background:url(<?php echo $images ?>)">
  <div class="high-c"  >
    <div class="topbar">
      <div class="container">
        <nav class="navbar navbar-expand-lg ">


      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#topbar" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon fas fa-bars" style="color:white"></span>
      </button>
      <div class="collapse navbar-collapse" id="topbar">
        <ul class="navbar-nav mr-auto act">

          <li>
            <a href="mailto:<?php echo $lg['email'] ?>" > <i class="fa fa-envelope"></i>    <?php echo $lg['email'] ?></a>
          </li>







        </ul>
        <ul class="navbar-nav ml-auto">
<?php


          if (!empty($lg['snap']))
          {
            ?>
            <li class="nav-item">
              <a class="nav-link fab fa-snapchat " target="_blank" href="<?php echo $lg['snap'] ?>"></a>
            </li>
            <?php
          }
          if (!empty($lg['inst']))
          {
            ?>
            <li class="nav-item">
              <a class="nav-link fab fa-instagram " target="_blank" href="<?php echo $lg['inst'] ?>"></a>
            </li>
            <?php
          }
          if (!empty($lg['twi']))
          {
            ?>
            <li class="nav-item">
              <a class="nav-link fab fa-twitter " target="_blank" href="<?php echo $lg['twi'] ?>"></a>
            </li>
            <?php
          }


          if (!empty($lg['whats']))
          {
            ?>
            <li class="nav-item">
              <a class="nav-link fab fa-whatsapp " target="_blank" href="https://api.whatsapp.com/send?phone=<?php echo $lg['whats'] ?>"></a>
            </li>
            <?php
          }
?>



        </ul>

      </div>
    </nav>
      </div>
    </div>
    <div class="bottombar" id="bb0099a">
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
            <a class="nav-link" href="webpage.php?page=faq">Faq's</a>
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
          <a href="/elec/admin" target="_blank"> admin</a>
        </li>







      </ul>

    </nav>
      </div>
    </div>
  </div>

    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">


  		<div class="carousel-inner">
  			<div class="carousel-item active">
  				<div class="cot">
            <div class="row">

              <div class="col-md-5">
                <div class="hdcotnt">
                  <h5 style="text-align:left">
                     <img src="<?php echo $images ?>grid2.png" style="margin-left:60px;margin-bottom: -30px;width:15% ! important;height:auto !important" >
    <h5 style="color:white;text-align:left;color:rgba(0,0,0,.6)">welcome to</h5> </h5>
                       <h1>Secure e-Voting system
    </h1>
                       <p style="margin:20px 0 !important;margin-right:80px !important">In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form of a document or
        </p>
        <a href="#services">get started</a>

                </div>
              </div>
              <div class="col-md-7">
                <div class="drrs" style="text-align:center !important;width:100%">
                  <img class="ergdf9t" src="<?php echo $images . $lg['h_image4'] ?>" style="width:100%;margin-top:pw " alt="First slide">

                </div>
              </div>
            </div>
  				</div>
  			</div>


  	</div>

</div>
</div>
