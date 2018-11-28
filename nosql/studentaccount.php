<?php 
      include 'base/authentication.php'; 
      include 'language/studentaccount.php';
      include 'model/student.php';
      include 'model/course.php';
      include 'model/studentaccount.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php 
      include 'head.php'; 
   ?>
</head>
<body id="page-top">
  <?php include 'menu.php' ?>
  <div id="wrapper">
    <!--Must use this for sidebar -->
    <?php include 'sideMenu.php'; ?>
  </div>
  
  <article id="content-wrapper">
    <section class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="dashboard.php"><?php echo $language_dashboard; ?></a>
        </li>
        <li class="breadcrumb-item active"><?php echo $language_account_title; ?></li>
      </ol>
    </section>
  </article>
  
  
<!-- All Student Datas -->
  <div class="container-fluid">
    <!-- Top row -->
    <div class="card mb-3">
      <div class="card-header">
        <i class="fas fa-table"></i> <?php echo $language_all_account; ?>
<!--         <button type="button" id="add_button" data-toggle="modal" data-target="#addStudentModal" class="btn btn-info btn-sm" style="float: right">
            <?php echo $language_add_account; ?>
          </button> -->
      </div>
      <!-- Table data -->
      <div class="card-body">
        <div class="table-responsive">
          <!-- must use dataTable for the filter to works. unless you find the javascript and create a new one -->
          <table id="dataTable" class="table table-bordered table-striped" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th><?php echo "Account ID"; ?></th>
                <th><?php echo $language_image; ?></th>
                <th><?php echo $language_name; ?></th>
                <th><?php echo $language_metric; ?></th>
                <th><?php echo $language_phone; ?></th>
                <th><?php echo $language_dob; ?></th>
                <th><?php echo $language_address; ?></th>
                <th><?php echo $language_course; ?></th>
                <th><?php echo "Create Account"; ?></th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th><?php echo "Account ID"; ?></th>
                <th><?php echo $language_image; ?></th>
                <th><?php echo $language_name; ?></th>
                <th><?php echo $language_metric; ?></th>
                <th><?php echo $language_phone; ?></th>
                <th><?php echo $language_dob; ?></th>
                <th><?php echo $language_address; ?></th>
                <th><?php echo $language_course; ?></th>
                <th><?php echo "Create Account"; ?></th>
              </tr>
            </tfoot>
            <tbody>
              <?php $studentInfo = new student();
                    foreach($studentInfo->getStudentWithNoAccount() as $studentWithNoAccount) {
               ?>
                <tr>
                    <td><?php echo $studentWithNoAccount->studentid;?></td>
                    <td><img style="width: 50px; height: 50px;" src="<?php echo 'http://ict2103group12.tk:3001' . $studentWithNoAccount->studentimage;?>"></td>
                    <td><?php echo $studentWithNoAccount->studentname; ?></td>
                    <td><?php echo $studentWithNoAccount->studentmatrics; ?></td>
                    <td><?php echo $studentWithNoAccount->studentphone; ?></td>
                    <td><?php echo date("Y-m-d", strtotime($studentWithNoAccount->studentdob)); ?></td>
                    <td><?php echo $studentWithNoAccount->studentaddress; ?></td>
                    <td><?php echo $studentWithNoAccount->studentcourse; ?></td>
                    <td><button type="button" id="add_button" data-toggle="modal" data-target="#createAccModal" class="btn btn-info btn-sm"><?php echo $language_add_account; ?></button></td>
                </tr>
                <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  
  
  <article id="content-wrapper">
    <?php include 'footer.php' ?>
  </article>
</body>
</html>

<!-- Modal display for ADDING student-->
<div id="createAccModal" class="modal fade">
  <div class="modal-dialog">
    <form method="post" id="std_form" enctype="multipart/form-data">
      <div class="modal-content">
        <div class="modal-header">
          <h4 align="left" class="modal-title"><?php echo $language_add_account; ?></h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <input style="display:none;" type="text" name="accountid" id="add_accountid" class="form-control" />
          <label for="name"><?php echo $language_enter_account_studentname; ?></label>
          <input type="text" name="name" id="add_studentname" class="form-control" disabled/>
          <br />
          <label for="course"><?php echo $language_enter_account_studentcourse; ?></label><br>
<!--           <input type="text" name="course" id="add_course" class="form-control" /> -->
          <textarea rows="2" type="text" name="course" id="add_course" class="form-control" style="resize: none" disabled> </textarea>
          <br />
          
          <label for="username"><?php echo $language_enter_account_username; ?></label>
          <input type="text" name="username" id="add_username" class="form-control" disabled/>
          <br />
          <label for="password"><?php echo $language_enter_account_password; ?></label>
          <input type="password" name="password" id="add_password" class="form-control"/>
          <br />
          
<!--           <label for="cfmpassword"><?php echo $language_enter_account_cfmpassword; ?></label>
          <input type="password" name="cfmpassword" id="add_cfmpassword" class="form-control"/>
          <br /> -->
          
          <br />

        </div>
        <div class="modal-footer">
          <input type="hidden" name="std_id" id="std_id" />
          <input type="hidden" name="operation" id="operation" />
          <input type="button" name="action" id="btn_create" class="btn btn-success" value="Create" />
          <button type="button" id="create_close" class="btn btn-default" data-dismiss="modal"><?php echo $language_close; ?></button>
        </div>
      </div>
    </form>
  </div>
</div>


<script>

  var table = $('#dataTable').DataTable();
  
  // Handles create button
  $('#dataTable').on('click', 'tbody #add_button', function () {
    var data_row = table.row($(this).closest('tr')).data();
    $('#add_accountid').val(data_row[0]);
    $('#add_studentname').val(data_row[2]);
    $('#add_username').val(data_row[3]+'@sit.singaporetech.edu.sg');
    $('#add_course').val(data_row[7]);
   });
  
  // Handles creating student account
  $('#btn_create').on('click', function() {
    var id          = $('#add_accountid').val();
    var studentname = $('#add_studentname').val();
    var username    = $('#add_username').val();
    var course      = $('#add_course').val();
    var password    = $('#add_password').val();
//     var cfmpassword = $('#add_cfmpassword').val();
    $.ajax({
       url:  url_no_port + 'model/studentaccount.php?action=createStudentAccount',
       type: 'post',
       dataType: 'json',
       data: {
         "id" : id, 
         "studentname" : studentname, 
         "username" : username, 
         "course" : course, 
         "password" : password, 
//          "cfmpassword" : cfmpassword
       },
       success: function(response) {
        alert(response.respond); 
        $('#create_close').trigger('click');
        location.reload();
      }
    });
  });
  
</script>