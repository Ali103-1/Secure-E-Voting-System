$(document).ready(function(){

// هنا ملفات جافا سكريبت

$('#a-btn-option').click(function(){

  $.ajax({
    url: 'register-ajax.php',
    method : 'POST',
    data:  $('#form-info').serialize(),
    success: function(data)
    {
      $('.err-msg').html(data);
    }
  });



});
  $(document).on('click', '.mprekt', function() {

      $(".lsitte").animate({"right":"0"}, 500);
      $('.rmkt').empty();
      htmlStr = '<i class="fas fa-long-arrow-alt-right mppkte"></i>';

    $(".rmkt").html(htmlStr);



  })
  $(document).on('click', '.mppkte', function() {
    $(".lsitte").animate({"right":"-100%"}, 500);
    htmlStr = ' <span class="fas fa-bars mprekt"></span>';

  $(".rmkt").html(htmlStr);


});









             $('.merelgj li a').removeClass('active');
             $(function () {
                 var pgurl = window.location.href.substr(window.location.href.lastIndexOf("/") + 1);
                 $(".merelgj li a").each(function () {
                     if ($(this).attr("href") == pgurl) {
                         $(this).closest('a').addClass("active");
                     }
                 })
             });

               function toggleSidebar() {
                 $(".button").toggleClass("active");
                 $("main").toggleClass("move-to-left");
                 $(".sidebar-item").toggleClass("active");
               }

               $(".button").on("click tap", function() {
                 toggleSidebar();
               });

               $(document).keyup(function(e) {
                 if (e.keyCode === 27) {
                   toggleSidebar();
                 }
               });


  // $(".merelgj").on('click','li',function(){
  //     // remove classname 'active' from all li who already has classname 'active'
  //     $("#navMenus li.active").removeClass("active");
  //     // adding classname 'active' to current click li
  //     $(this).addClass("active");
  // });
  //




$('#close').click(function(){
  $('#openpop').fadeOut();
})


  $(document).on('click', '.votebtn', function() {

  var election = $(this).attr("election");
  var condidate = $(this).attr("condidate");

  $.ajax({
    url: 'vote.php',
    method : 'POST',
    data:  {election:election,condidate:condidate},
    success: function(data)
    {
        $('#openpop').fadeIn();
  
      // $('.showcontent').html(data);
    }
  });
});












  $('#dsrer').click(function(){
    $(this).css('display','none');
    $('.retty').css('display','flex');

  // $(".retty").animate({"display":"flex"}, 1000);
  })




    $('.sdlrrr').click(function(){
    $(".boxs").animate({"bottom":"0"}, 500);
    })








$(document).on('click', '#close', function() {

  $('.showcontent').empty();


});
  // function when click on question will show the answer of this question
  $('.acc h3').click(function(){
  $(this).next('.content-faq').slideToggle();
  $(this).parent().toggleClass('active');
  $(this).parent().siblings().children('.content-faq').slideUp();
  $(this).parent().siblings().removeClass('active');
  });



$("#bbmpprk").on('change', function(){
  var val = $(this).val();
  $('#dsd').html(val);
})

let start = 0;
    let end = $('.num1').html();
    let speed = 2;

    setInterval(function(){
      if (start < end)
      {
        start++;
      }
      $('.num1').html(start);
    }, speed);


    let start2 = 0;
    let end2 = $('.num2').html();
    let speed2 = 2;

    setInterval(function(){
      if (start2 < end2)
      {
        start2++;
      }
      $('.num2').html(start2);
    }, speed);


    let start3 = 0;
    let end3 = $('.num3').html();
    let speed3 = 2;

    setInterval(function(){
      if (start3 < end3)
      {
        start3++;
      }
      $('.num3').html(start3);
    }, speed);



  $('#open-add-page').click(function(){
    $('#add-page').fadeIn();
    $('#form-info-g').slideDown();
  })

      $('#close').click(function(){
        $('#add-page').fadeOut();
      })

  /* bottombar fixed on scroll*/
     window.onscroll = function() {scrollFunction()};

      function scrollFunction() {
        if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
          document.getElementById("bb0099a").style.position = "fixed";
          document.getElementById("bb0099a").style.width = "100%";
          document.getElementById("bb0099a").style.backgroundColor = "white";
          document.getElementById("bb0099a").style.top = "0";
          document.getElementById("bb0099a").style.left = "0";

          document.getElementById("bb0099a").style.zIndex = "99999999999999999999999999999999999999999999999999999999999999999";
          document.getElementById("bb0099a").style.boxShadow = "0px 10px 10px rgba(0,0,0,.1)";

          document.getElementById("bb0099a").style.transition = "5";

        } else {
          document.getElementById("bb0099a").style.backgroundColor = "rgba(25, 21, 20,.0)";

             document.getElementById("bb0099a").style.position = "relative";
              document.getElementById("bb0099a").style.width = "100%";
              document.getElementById("bb0099a").style.top = "0";
              document.getElementById("bb0099a").style.zIndex = "9999999999999999999999999999";
              document.getElementById("bb0099a").style.boxShadow = "0px 10px 10px rgba(0,0,0,.0)";

        }

  }

    // insert consultation time
      $('#message-btn').click(function(){
          $.ajax({
            url: 'insert_message.php',
            method:'POST',
            data:$("#message-form").serialize(),
            success:function(data)
            {
              $('#msg2').html(data);
            }
          })

      });















});
