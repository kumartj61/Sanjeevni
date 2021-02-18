<?php
  if(isset($_POST['submit'])){
    echo $_POST['editor1'];
  }
?>
<!DOCTYPE html>
<html>
        <head>
                <meta charset="utf-8">
                <title>CKEditor</title>
                <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
        </head>
        <body>
          <form method="post">
                <textarea name="editor1"></textarea>
                <script>
                        CKEDITOR.replace( 'editor1' );
                </script>
                <input name="submit" type="submit"></input>
          </form>
        </body>
</html>
