<?php
include './connect.php';
$stmt = $conn->prepare("SELECT * FROM pages WHERE id = 1");
$stmt->execute();
$lg = $stmt->fetch();
 ?>
<!-- هنا جزء الاسفل للموقع -->
 <footer class="footer" style="background:var(--mainColor);padding-bottom:40px">
   <div class="container">
     <div class="row">
       <div class="col-md-12">
         <ul>
           <li>
             <a href="webpage.php?page=privacy">privacy policy
</a>
           </li>
           <li>
             <a href="index.php#contactuspage">aboutus
</a>
           </li>
           <li>
             <a href="webpage.php?page=faq">FAQ

</a>
           </li>

           <li>
             <a href="index.php">Home page

</a>
           </li>
         </ul>
       </div>
       <div class="col-md-12">
         <div class="ds" style="text-align:center">
           <img src="<?php echo $logo . $lg['logo'] ?>" style="width:150px" alt="">
         </div>
       </div>
     </div>
   </div>
 </footer>
 <section class="smfooter" style="background:var(--mainColor);padding:10px 0">
   <div class="container">
     <div class="row">
       <div class="col-md-12">
         <div class="ds" style="text-align:center;">
           <p style="color:white;margin:0">All rights reserved &copy; e-Voting system 2023</p>
         </div>
       </div>
     </div>
   </div>
 </section>
<!-- footer end -->



<script src="https://unpkg.com/swiper/swiper-bundle.js"></script>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script type="text/javascript" src="<?php echo $js ?>chartist.js"></script>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
 <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"  crossorigin="anonymous"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" crossorigin="anonymous"></script>
   <script type="text/javascript" src="<?php echo $js ?>lightbox.js"></script>

<script type="text/javascript" src="<?php echo $js ?>main.js"></script>
<script type="text/javascript" src="<?php echo $js ?>player.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lightslider/1.1.6/js/lightslider.js"></script>
<script>
  AOS.init();
</script>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script>

</body>
</html>
