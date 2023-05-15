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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.min.js"></script>

<script src="http://zeptojs.com/zepto.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js" ></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.min.js" ></script>


</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


<script>
    var element = document.getElementById('printpdfpage');
var opt = {
  margin:       0,
  filename:     'election.pdf',
  image:        { type: 'jpeg', quality: 1 },

  html2canvas:  {  scale: 4,dpi: 300,scrollY: 0,bottom:0,top:0,left:0,right:0, letterRendering: true},
      pagebreak: {before: '.newPage', after: '.avoidThisRow'},
  jsPDF:        { unit: 'mm', format: 'letter', orientation: 'portrait' }
};

// New Promise-based usage:

// // Old monolithic-style usage:
$(window).ready(function(){
  html2pdf().set(opt).from(element).save();

});

// html2pdf(element, opt);
</script>

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
