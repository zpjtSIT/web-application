<?php 
      include 'base/authentication.php'; 
      include 'language/adminaccount.php';
      include 'model/student.php';
      include 'model/course.php';
      include 'model/adminaccount.php';
      include 'model/department.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php 
      include 'head.php';
   ?>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css" rel="stylesheet" />
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
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
  
  

  <div class="container-fluid">
    <!-- Top row -->
    <div class="card mb-3">
      <div class="card-header">
        <i class="fas fa-table"></i> <?php echo $language_all_account; ?>
        <button type="button" id="add_profile_button" data-toggle="modal" data-target="#addAdminProfileModal" class="btn btn-info btn-sm" style="float: right">
            <?php echo $language_add_adminprofile; ?>
          </button>
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
                <th><?php echo "Staff ID" ?></th>
                <th><?php echo $language_phone; ?></th>
                <th><?php echo $language_dob; ?></th>
                <th><?php echo $language_address; ?></th>
                <th><?php echo "Department"; ?></th>
                <td style="display:none;"><?php echo "Department ID" ?></td>
                <td style="display:none;"><?php echo "Account ID" ?></td>
                <th><?php echo "Add"; ?></th>
                <th><?php echo $language_update; ?></th>
                <th><?php echo $language_delete; ?></th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th><?php echo "Account ID"; ?></th>
                <th><?php echo $language_image; ?></th>
                <th><?php echo $language_name; ?></th>
                <th><?php echo "Staff ID" ?></th>
                <th><?php echo $language_phone; ?></th>
                <th><?php echo $language_dob; ?></th>
                <th><?php echo $language_address; ?></th>
                <th><?php echo "Department"; ?></th>
                <td style="display:none;"><?php echo "Department ID" ?></td>
                <td style="display:none;"><?php echo "Account ID" ?></td>
                <th><?php echo "Add"; ?></th>
                <th><?php echo $language_update; ?></th>
                <th><?php echo $language_delete; ?></th>
              </tr>
            </tfoot>
            <tbody>
              <?php $adminProfile = new adminAccount();
                    foreach($adminProfile->getAllAdminProfile() as $adminProfiles) {
               ?>
              <tr>
                <td><?php echo $adminProfiles->adminid; ?></td>
                <td><img style="width: 50px; height: 50px;" src="<?php echo 'http://ict2103group12.tk:3001' . $adminProfiles->adminimage;?>"></td>
                <td><?php echo $adminProfiles->adminname; ?></td>
                <td><?php echo $adminProfiles->adminmatrics; ?></td>
                <td><?php echo $adminProfiles->adminphone; ?></td>
                <td><?php echo date("Y-m-d", strtotime($adminProfiles->admindob)); ?></td>
                <td><?php echo $adminProfiles->adminaddress; ?></td>
                <td><?php echo $adminProfiles->admindepartment; ?></td>
                <td style="display:none;"><?php echo $adminProfiles->departmentid; ?></td>
                <td style="display:none;"><?php echo $adminProfiles->accountid;?></td>
                <td><button type="button" id="add_button" data-toggle="modal" data-target="#createAccModal" class="btn btn-info btn-sm"><?php echo $language_add_adminaccount; ?></button></td>
                <td><button type="button" id="edit_button" data-toggle="modal" data-target="#editAccModal"><i class="fas fa-edit"></i></button></td>
                <td><button type="button" id="delete_button"><i class="fas fa-trash-alt"></i></button></td>
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

<!-- Modal display for ADDING -->
<div id="addAdminProfileModal" class="modal fade">
  <div class="modal-dialog">
    <form method="post" enctype="multipart/form-data">
      <div class="modal-content">
        <div class="modal-header">
          <h4 align="left" class="modal-title"><?php echo $language_add_adminprofile; ?></h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <input style="display:none;" type="text" name="accountid" id="add_accountid" class="form-control" />
          <label for="name"><?php echo $language_enter_account_adminname; ?></label>
          <input type="text" name="name" id="add_adminname" class="form-control" />
          <br />
          <label for="matric"><?php echo $language_enter_account_adminmatric; ?></label>
          <input type="text" name="matric" id="add_adminmatric" class="form-control" maxlength="10" />
          <br />
          <label for="phone"><?php echo $language_enter_account_adminphone; ?></label>
          <input type="text" name="phone" id="add_adminphone" class="form-control" maxlength="8" />
          <br />
          <label for="birth"><?php echo $language_enter_account_admindob; ?></label>
          <div class="input-group date" data-provide="datepicker" data-date-format="yyyy-mm-dd">
            <input type="text" name="birth" class="form-control" id="add_admindob">
            <div class="input-group-addon">
              <span class="glyphicon glyphicon-th"></span>
            </div>
          </div>
          <br />
          <label for="address"><?php echo $language_enter_account_adminaddress; ?></label>
          <input type="text" name="address" id="add_adminaddress" class="form-control" />
          <br />
          <label for="formDept"><?php echo $language_enter_account_admindepartment; ?></label>
          <select name="formDept" style="width:100%;" id="add_admindepartment" class="form-control">
            <?php $departments = new Department(); 
                  foreach ($departments->getAllDepartments() as $department) { 
            ?>
              <option value="<?php echo $department->id; ?>"><?php echo $department->name; ?></option>
            <?php } ?>
          </select>
          <br />
          
          <label for="std_image"><?php echo $language_enter_account_adminimage; ?></label>
          <input type="file" name="std_image" id="add_std_image" class="form-control" />
          <span id="std_uploaded_image"></span>
          <br />

        </div>
        <div class="modal-footer">

          <input type="button" name="action" id="btn_add_profile" class="btn btn-success" value="Add" />
          <button type="button" id="add_profile_close" class="btn btn-default" data-dismiss="modal"><?php echo $language_close; ?></button>
        </div>
      </div>
    </form>
  </div>
</div>


<!-- Modal display for EDITING -->
<div id="editAccModal" class="modal fade">
  <div class="modal-dialog">
    <form method="post" enctype="multipart/form-data">
      <div class="modal-content">
        <div class="modal-header">
          <h4 align="left" class="modal-title"><?php echo $language_edit_account; ?></h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <input style="display:none;" type="text" name="accountid" id="edit_accountid" class="form-control" />
          <label for="name"><?php echo $language_edit_account_adminname; ?></label>
          <input type="text" name="name" id="edit_adminname" class="form-control" />
          <br />
          <label for="matric"><?php echo $language_edit_account_adminmatric; ?></label>
          <input type="text" name="matric" id="edit_adminmatric" class="form-control" maxlength="10" disable/>
          <br />
          <label for="phone"><?php echo $language_edit_account_adminphone; ?></label>
          <input type="text" name="phone" id="edit_adminphone" class="form-control" maxlength="8" />
          <br />
          <label for="birth"><?php echo $language_edit_account_admindob; ?></label>
          <div class="input-group date" data-provide="datepicker" data-date-format="yyyy-mm-dd">
            <input type="text" name="birth" class="form-control" id="edit_admindob">
            <div class="input-group-addon">
              <span class="glyphicon glyphicon-th"></span>
            </div>
          </div>
          <br />
          <label for="address"><?php echo $language_edit_account_adminaddress; ?></label>
          <input type="text" name="address" id="edit_adminaddress" class="form-control" />
          <br />
          <label for="dept"><?php echo $language_edit_account_admindepartment; ?></label>
          <select name="dept" style="width:100%;" id="edit_admindepartment" class="form-control">
            <?php $departments = new Department(); 
                  foreach ($departments->getAllDepartments() as $department) { 
            ?>
              <option value="<?php echo $department->id; ?>"><?php echo $department->name; ?></option>
            <?php } ?>
          </select>
          <br />
          
          <label for="std_image"><?php echo $language_edit_account_adminimage; ?></label>
          <input type="file" name="std_image" id="edit_std_image" class="form-control" accept="image/*"/>
          <span id="std_uploaded_image"></span>
          <br />

        </div>
        <div class="modal-footer">

          <input type="button" name="action" id="btn_edit_profile" class="btn btn-success" value="Edit" />
          <button type="button" id="edit_profile_close" class="btn btn-default" data-dismiss="modal"><?php echo $language_close; ?></button>
        </div>
      </div>
    </form>
  </div>
</div>


<!-- Modal display for CREATING -->
<div id="createAccModal" class="modal fade">
  <div class="modal-dialog">
    <form method="post"enctype="multipart/form-data">
      <div class="modal-content">
        <div class="modal-header">
          <h4 align="left" class="modal-title"><?php echo $language_add_adminaccount; ?></h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <input style="display:none;" type="text" name="accountid" id="create_accountid" class="form-control" />
          <label for="name"><?php echo $language_account_adminname; ?></label>
          <input type="text" name="name" id="create_adminname" class="form-control" disabled/>
          <br />
          <label for="course"><?php echo $language_account_admindept; ?></label><br>
<!--           <input type="text" name="course" id="add_course" class="form-control" /> -->
          <textarea rows="2" type="text" name="course" id="create_admindept" class="form-control" style="resize: none" disabled> </textarea>
          <br />
          
          <label for="username"><?php echo $language_account_adminusername; ?></label>
          <input type="text" name="username" id="create_adminusername" class="form-control" disabled/>
          <br />
          <label for="password"><?php echo $language_account_adminpassword; ?></label>
          <input type="password" name="password" id="create_adminpassword" class="form-control"/>
          <br />
          
<!--           <label for="cfmpassword"><?php echo $language_account_admincfmpassword; ?></label>
          <input type="password" name="cfmpassword" id="create_admincfmpassword" class="form-control"/>
          <br /> -->
          
          <br />

        </div>
        <div class="modal-footer">

          <input type="button" name="action" id="btn_create" class="btn btn-success" value="Create" />
          <button type="button" id="create_close" class="btn btn-default" data-dismiss="modal"><?php echo $language_close; ?></button>
        </div>
      </div>
    </form>
  </div>
</div>



<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>

<script>
  
  var table = $('#dataTable').DataTable();
  
  // For Edit Modal with preload values from datatable
  $('#dataTable').on('click', 'tbody #edit_button', function() {
    var data_row = table.row($(this).closest('tr')).data();
    $('#edit_adminname').val(data_row[2]);
    $('#edit_adminmatric').val(data_row[3]);
    $('#edit_adminphone').val(data_row[4]);
    $('#edit_admindob').val(data_row[5]);
    $('#edit_adminaddress').val(data_row[6]);
    $("#edit_admindepartment option").filter(function() {
        return $(this).text() == data_row[7]; 
    }).prop('selected', true);
    $('#edit_account_id').val(data_row[9]);
  });
  
  // For Create Modal with preload values from datatable
  $('#dataTable').on('click', 'tbody #add_button', function () {
    var data_row = table.row($(this).closest('tr')).data();
    $('#create_accountid').val(data_row[0]);
    $('#create_adminname').val(data_row[2]);
    $('#create_adminusername').val(data_row[3]+'@singaporetech.edu.sg');
    $('#create_admindept').val(data_row[7]);
   });

  // Add Admin Profile
  $('#btn_add_profile').on('click', function() {
    var adminname = $('#add_adminname').val();
    var adminmatric = $('#add_adminmatric').val();
    var adminphone = $('#add_adminphone').val();
    var admindob = $('#add_admindob').val();
    var adminaddress = $('#add_adminaddress').val();
    var departmentid = $('#add_admindepartment').val();
    

    if( document.getElementById("add_std_image").files.length == 0 ){
        $.ajax({
          url: url_no_port + 'model/adminaccount.php?action=createAdminProfile',
          type: 'post',
          dataType: 'json',
          data: {
            "name": adminname,
            "matrics": adminmatric,
            "phone": adminphone,
            "dob": admindob,
            "address": adminaddress,
            "departmentid": departmentid
          },
          success: function(response) {
            alert(response.success);
            $('#add_close').trigger('click');
            location.reload();
          }
        });
    }
    else{
    
    var file = document.querySelector('#add_std_image').files[0];
    var reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = function() {

    var base64image = reader.result;
    $.ajax({
          url: url_no_port + 'model/adminaccount.php?action=createAdminProfile',
          type: 'post',
          dataType: 'json',
          data: {
            "name": adminname,
            "matrics": adminmatric,
            "phone": adminphone,
            "dob": admindob,
            "address": adminaddress,
            "departmentid": departmentid,
            "image": base64image
          },
          success: function(response) {
            alert(response.success);
            $('#add_profile_close').trigger('click');
            location.reload();
          }
        });
      };
      reader.onerror = function(error) {
        console.log('Error: ', error);
      };
    }
  });
  
  
  // Update Admin Profile
  $('#btn_edit_profile').on('click', function() {
    var adminname = $('#edit_adminname').val();
    var adminmatric = $('#edit_adminmatric').val();
    var adminphone = $('#edit_adminphone').val();
    var admindob = $('#edit_admindob').val();
    var adminaddress = $('#edit_adminaddress').val();
    var departmentid = $('#edit_admindepartment').val();
    var accountid = $('#edit_account_id').val();
    var active = "0";

    
   if( document.getElementById("edit_std_image").files.length == 0 ){
//     console.log("no files selected");
     $.ajax({
        url: url_no_port + 'model/adminaccount.php?action=updateAdminProfile',
        type: 'post',
        dataType: 'json',
        data: {
          "name": adminname,
          "matrics": adminmatric,
          "phone": adminphone,
          "dob": admindob,
          "address": adminaddress,
          "departmentid": departmentid,
          "accountid": accountid,
          "active": active
        },
        success: function(response) {
          alert(response.respond);
          $('#edit_close').trigger('click');
          location.reload();
        }
      });
    }
    else{
    
    var file = document.querySelector('#edit_std_image').files[0];
    var reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = function() {

    var base64image = reader.result;

      console.log(base64image);

      $.ajax({
        url: url_no_port + 'model/adminaccount.php?action=updateAdminProfile',
        type: 'post',
        dataType: 'json',
        data: {
          "name": adminname,
          "matrics": adminmatric,
          "phone": adminphone,
          "dob": admindob,
          "address": adminaddress,
          "departmentid": departmentid,
          "accountid": accountid,
          "img": base64image,
          "active": active
        },
        success: function(response) {
          alert(response.respond);
          $('#edit_profile_close').trigger('click');
          location.reload();
        }
        });
      };
      reader.onerror = function(error) {
        console.log('Error: ', error);
      };

    }
   });
  
  // Create Admin Account
  $('#btn_create').on('click', function() {
    var id          = $('#create_accountid').val();
    var name        = $('#create_adminname').val();
    var username    = $('#create_adminusername').val();
    var department  = $('#create_admindept').val();
    var password    = $('#create_adminpassword').val();
//     var cfmpassword = $('#add_cfmpassword').val();
    $.ajax({
       url:  url_no_port + 'model/adminaccount.php?action=createAdminAccount',
       type: 'post',
       dataType: 'json',
       data: {
         "id" : id, 
         "name" : name, 
         "username" : username, 
         "department" : department, 
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