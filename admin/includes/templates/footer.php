
<!--
 <script>
    DecoupledEditor
        .create( document.querySelector( '#editor' ) )
        .then( editor => {
            const toolbarContainer = document.querySelector( '#toolbar-container' );

            toolbarContainer.appendChild( editor.ui.view.toolbar.element );
        } )
        .catch( error => {
            console.error( error );
        } );
</script> -->
<script>
 CKEDITOR.replace( 'content', {
  height: 200,
  filebrowserUploadUrl: "upload.php"
 });
</script>
<script>
 CKEDITOR.replace( 'content2', {
  height: 200,
  filebrowserUploadUrl: "upload.php"
 });
</script>
<script type="text/javascript" src="<?php echo $js ?>chartist.js"></script>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
 <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"  crossorigin="anonymous"></script> -->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"  crossorigin="anonymous"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" crossorigin="anonymous"></script>
   <!-- <script type="text/javascript" src="<?php echo $js ?>jquery-ui.js"></script> -->

<script type="text/javascript" src="<?php echo $js ?>main.js"></script>
</body>
</html>
