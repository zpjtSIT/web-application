<!DOCTYPE html>
<html lang="en">
<head>
  <?php include 'head.php';
        include 'language/login.php'; ?>
</head>
<body id="page-top">
  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header"><?php echo "Forgot Password" ?></div>
      <div class="card-body">
        <form>
          <div class="form-group">
            <label for="username"><?php echo "Enter your username" ?></label>
            <input type="text" class="form-control" id="username" name="username" placeholder="Enter email" autofocus>
          </div>
          
          <button type="button" class="btn btn-primary btn-block" id="btn_forgotpassword"><?php echo $language_submit; ?></button>
        </form>
        <div class="text-center">
          <br/>
          <a class="form-control" href="index.php"><?php echo "Back" ?></a>
        </div>
      </div>
    </div>
  </div>
  <?php include 'footer.php'; ?>
  <script>
    $("#btn_forgotpassword").click(function() {
    var username = $("#username").val();
      $.ajax({
        url: url + "user/forget",
        type: "post",
        data: {
          "email": username
        },
        success: function(response) {
          if(response.respond){
            alert(response.respond);
          }
          else {
            alert(response.error);
          }
        }
      });
    });
  </script>
</body>
</html>