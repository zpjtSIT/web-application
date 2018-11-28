<!DOCTYPE html>
<html lang="en">
<head>
  <?php include 'head.php';
        include 'language/login.php'; ?>
</head>
<body id="page-top">
  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header"><?php echo $language_login; ?></div>
      <div class="card-body">
        <form>
          <div class="form-group">
            <label for="username"><?php echo $language_username; ?></label>
            <input type="text" class="form-control" id="username" name="username" placeholder="Enter email" autofocus>
          </div>
          <div class="form-group">
            <label for="password"><?php echo $language_password; ?></label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
          </div>
          <button type="button" class="btn btn-primary btn-block" id="btn_login"><?php echo $language_submit; ?></button>
        </form>
        <div class="text-center">
<!--           <a class="d-block small mt-3" href="register.html"><?php echo $language_register_account; ?></a> -->
          <br/>
          <a class="form-control" href="forgotpassword.php"><?php echo $language_forgot_password; ?></a>
        </div>
      </div>
    </div>
  </div>
  <?php include 'footer.php'; ?>
  <script>
    $("#btn_login").click(function() {
    var username = $( "#username" ).val();
    var password = $("#password").val();
    var json  = {"username" : username , "password" : password};
      $.ajax({
        url: url + "login",
        type: "post",
        data: json,
        success: function(response) {
          // you will get response from your php page (what you echo or print)                 
         if(!response.error){
           $.cookie("token", response.token);
           window.location.replace("dashboard.php");
         } 
         else{
           alert(response.respond)
         }
         
        },
        error: function(jqXHR, textStatus, errorThrown) {
          console.log(textStatus, errorThrown);
        }
      });
    });
  </script>
</body>
</html>