<?php include 'base/authentication.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php 
      include 'head.php'; 
      include 'model/student.php';
      include 'model/course.php';
      include 'language/student.php';
      include 'model/room.php';
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
          <a href="dashboard.php">
            <?php echo $language_dashboard; ?>
          </a>
        </li>
        <li class="breadcrumb-item active">
          <?php echo $language_student_title; ?>
        </li>
      </ol>
    </section>
  </article>

  <!-- All Student Datas -->
  <div class="container-fluid">
    <!-- Top row -->
    <div class="card mb-3">
      <div class="card-header">
        <i class="fas fa-table"></i>
        <?php echo $language_all_student; ?>
        <button type="button" id="add_button" data-toggle="modal" data-target="#addStudentModal" class="btn btn-info btn-sm" style="float: right">
            <?php echo $language_add_student; ?>
          </button>
      </div>
      <!-- Table data -->
      <div class="card-body">
        <div class="table-responsive">
          <!-- must use dataTable for the filter to works. unless you find the javascript and create a new one -->
          <table id="dataTable" class="table table-bordered table-striped" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>
                  <?php echo $language_image; ?>
                </th>
                <th>
                  <?php echo $language_name; ?>
                </th>
                <th>
                  <?php echo $language_metric; ?>
                </th>
                <th>
                  <?php echo $language_phone; ?>
                </th>
                <th>
                  <?php echo $language_dob; ?>
                </th>
                <th>
                  <?php echo $language_address; ?>
                </th>
                <th>
                  <?php echo $language_course; ?>
                </th>
                <th style="display: none;">
                  <?php echo $language_course_id; ?>
                </th>
                <th style="display: none;">
                  <?php echo "account id"; ?>
                </th>
                <th>
                  <?php echo $language_update; ?>
                </th>
                <th>
                  <?php echo $language_delete; ?>
                </th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>
                  <?php echo $language_image; ?>
                </th>
                <th>
                  <?php echo $language_name; ?>
                </th>
                <th>
                  <?php echo $language_metric; ?>
                </th>
                <th>
                  <?php echo $language_phone; ?>
                </th>
                <th>
                  <?php echo $language_dob; ?>
                </th>
                <th>
                  <?php echo $language_address; ?>
                </th>
                <th>
                  <?php echo $language_course; ?>
                </th>
                <th style="display: none;">
                  <?php echo $language_course_id; ?>
                </th>
                <th style="display: none;">
                  <?php echo "account id"; ?>
                </th>
                <th>
                  <?php echo $language_update; ?>
                </th>
                <th>
                  <?php echo $language_delete; ?>
                </th>
              </tr>
            </tfoot>
            <tbody>
              <?php $studentAllInfo = new student();
                    foreach($studentAllInfo->getAllStudent() as $student) {
               ?>
              <tr>
                <td><img style="width: 50px; height: 50px;" src="<?php echo 'http://ict2103group12.tk:3000' . $student->studentimage;?>"></td>
                <td>
                  <?php echo $student->studentname; ?>
                </td>
                <td>
                  <?php echo $student->studentmatrics; ?>
                </td>
                <td>
                  <?php echo $student->studentphone; ?>
                </td>
                <td>
                  <?php echo date("Y-m-d", strtotime($student->studentdob)); ?>
                </td>
                <td>
                  <?php echo $student->studentaddress; ?>
                </td>
                <td>
                  <?php echo $student->studentcourse; ?>
                </td>
                <td style="display:none;">
                  <?php echo $student->studentcourseid; ?>
                </td>
                <td style="display:none;">
                  <?php echo $student->accountid;?>
                </td>
                <td><button type="button" id="edit_button" data-toggle="modal" data-target="#editStudentModal"><i class="fas fa-edit"></i></button></td>
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
<script>
  $(document).ready(function() {
    $('#add_button').click(function() {
      $('#std_form')[0].reset();
      $('.modal-title').text("Add Student");
      $('#action').val("Add");
      $('#operation').val("Add");
      $('#std_uploaded_image').html('');
    });
  });
</script>

</html>

<!-- Modal display for ADDING student-->
<div id="addStudentModal" class="modal fade">
  <div class="modal-dialog">
    <form method="post" id="std_form">
      <div class="modal-content">
        <div class="modal-header">
          <h4 align="left" class="modal-title">
            <?php echo $language_add_student; ?>
          </h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <label for="name"><?php echo $language_enter_student_name; ?></label>
          <input type="text" name="name" id="add_name" class="form-control" />
          <br />
          <label for="matrics"><?php echo $language_enter_student_matric; ?></label>
          <input type="text" name="matrics" id="add_matrics" class="form-control" maxlength="10" />
          <br />
          <label for="phone"><?php echo $language_enter_student_phone; ?></label>
          <input type="text" name="phone" id="add_phone" class="form-control" maxlength="8" />
          <br />
          <label for="birth"><?php echo $language_enter_student_dob; ?></label>
          <div class="input-group date" data-provide="datepicker" data-date-format="yyyy-mm-dd">
            <input type="text" name="birth" class="form-control" id="add_birth">
            <div class="input-group-addon">
              <span class="glyphicon glyphicon-th"></span>
            </div>
          </div>
          <br />
          <label for="address"><?php echo $language_enter_student_address; ?></label>
          <input type="text" name="address" id="add_address" class="form-control" />
          <br />
          <label for='formCourses'><?php echo $language_edit_student_course; ?></label><br>
          <select name="formCourses" style="width:100%;" id="add_course" class="form-control">
            <?php $courses = new Course(); 
                  foreach ($courses->getAllCourses() as $course) { 
            ?>
              <option value="<?php echo $course->id; ?>"><?php echo $course->name; ?></option>
            <?php } ?>
          </select>
          <br />

          <label for="std_image"><?php echo $language_enter_student_image; ?></label>
          <input type="file" name="std_image" id="add_std_image" class="form-control" />
          <span id="std_uploaded_image"></span>
        </div>
        <div class="modal-footer">
          <input type="hidden" name="std_id" id="std_id" />
          <input type="hidden" name="operation" id="operation" />
          <input type="button" name="action" id="btn_add" class="btn btn-success" value="Add" />
          <button id="add_close" type="button" class="btn btn-default" data-dismiss="modal"><?php echo $language_close; ?></button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- Modal display for EDITING student-->
<div id="editStudentModal" class="modal fade">
  <div class="modal-dialog">
    <form id="std_edit_form" enctype="multipart/form-data">
      <div class="modal-content">
        <div class="modal-header">
          <h4 align="left" class="modal-title">
            <?php echo $language_edit_student; ?>
          </h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <input style="display:none;" type="text" name="accountid" id="edit_account_id" class="form-control" />
          <label for="name"><?php echo $language_edit_student_name; ?></label>
          <input type="text" name="name" id="edit_name" class="form-control" />
          <br />
          <label for="matrics"><?php echo $language_edit_student_matric; ?></label>
          <input type="text" name="matrics" id="edit_matrics" class="form-control" disabled/>
          <br />
          <label for="phone"><?php echo $language_edit_student_phone; ?></label>
          <input type="text" name="phone" id="edit_phone" class="form-control" maxlength="8" />
          <br />
          <label for="dob"><?php echo $language_edit_student_dob; ?></label>
          <div class="input-group date" data-provide="datepicker" data-date-format="yyyy-mm-dd">
            <input type="text" name="dob" class="form-control" id="edit_dob">
            <div class="input-group-addon">
              <span class="glyphicon glyphicon-th"></span>
            </div>
          </div>
          <br />
          <label for="address"><?php echo $language_edit_student_address; ?></label>
          <input type="text" name="address" id="edit_address" class="form-control" />
          <br />
          <label for='courseid'><?php echo $language_edit_student_course; ?></label><br>
          <select name="courseid" style="width:100%;" id="edit_course" class="form-control">
            <?php $courses = new Course(); 
                  foreach ($courses->getAllCourses() as $course) { 
            ?>
              <option value="<?php echo $course->id; ?>"><?php echo $course->name; ?></option>
            <?php } ?>
          </select>
          <br />

          <label for="std_image"><?php echo $language_edit_student_image; ?></label>
          <input type="file" name="std_image" id="edit_std_image" class="form-control" accept="image/*" />
          <span id="std_uploaded_image"></span>
        </div>
        <div class="modal-footer">
          <input type="hidden" name="std_id" id="std_id" />
          <input type="hidden" name="operation" id="operation" />
          <input type="button" name="action" id="btn_edit" class="btn btn-success" value="Edit" />
          <button id="edit_close" type="button" class="btn btn-default" data-dismiss="modal"><?php echo $language_close; ?></button>
        </div>
      </div>
    </form>
  </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="js\jquery.cookie.min.js"></script>
<script>
  var table = $('#dataTable').DataTable();
  // Handles edit button
  $('#dataTable').on('click', 'tbody #edit_button', function() {
    var data_row = table.row($(this).closest('tr')).data();
    $('#edit_name').val(data_row[1]);
    $('#edit_matrics').val(data_row[2]);
    $('#edit_phone').val(data_row[3]);
    $('#edit_dob').val(data_row[4]);
    $('#edit_address').val(data_row[5]);
    $('#edit_course').val(data_row[6]);
    $("#edit_course option[value='" + data_row[7] + "']").prop('selected', true)
    $('#edit_account_id').val(data_row[8]);
  });

  // Handles delete button
  $('#dataTable').on('click', 'tbody #delete_button', function() {
    var data_row = table.row($(this).closest('tr')).data();
    var name = data_row[1];
    var matric = data_row[2];
    var phone = data_row[3];
    var dob = data_row[4];
    var address = data_row[5];
    var accountid = data_row[7];
    var courseid = "1";
    var active = "1";

    if (confirm('<?php echo $language_delete_student_title; ?>')) {
      $.ajax({
        url: url_no_port + 'model/student.php?action=updateStudentDetail',
        type: 'post',
        dataType: 'json',
        data: {
          "name": name,
          "matrics": matric,
          "phone": phone,
          "dob": dob,
          "address": address,
          "courseid": courseid,
          "active": active,
          "accountid": accountid
        },
        success: function(response) {
          alert(response.respond);
          location.reload();
        }
      });
    }
  });


  // Handles edit student info
  $('#btn_edit').on('click', function() {
    var name = $('#edit_name').val();
    var matric = $('#edit_matrics').val();
    var phone = $('#edit_phone').val();
    var dob = $('#edit_dob').val();
    var address = $('#edit_address').val();
    var accountid = $('#edit_account_id').val();
    var courseid = $('#edit_course').val();
    var active = "0";

    
   if( document.getElementById("edit_std_image").files.length == 0 ){
//     console.log("no files selected");
     $.ajax({
        url: url_no_port + 'model/student.php?action=updateStudentDetail',
        type: 'post',
        dataType: 'json',
        data: {
          "name": name,
          "matrics": matric,
          "phone": phone,
          "dob": dob,
          "address": address,
          "courseid": courseid,
          "active": active,
          "accountid": accountid
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
        url: url_no_port + 'model/student.php?action=updateStudentDetail',
        type: 'post',
        dataType: 'json',
        data: {
          "name": name,
          "matrics": matric,
          "phone": phone,
          "dob": dob,
          "address": address,
          "img": base64image,
          "courseid": courseid,
          "active": active,
          "accountid": accountid
        },
        success: function(response) {
          alert(response.respond);
          $('#edit_close').trigger('click');
          location.reload();
        }
      });
    };
    reader.onerror = function(error) {
      console.log('Error: ', error);
    };

  }
      });

  // Handles adding student info
  $('#btn_add').on('click', function() {
    var name = $('#add_name').val();
    var matric = $('#add_matrics').val();
    var phone = $('#add_phone').val();
    var dob = $('#add_birth').val();
    var address = $('#add_address').val();
    var courseid = $('#add_course').val();


    if( document.getElementById("add_std_image").files.length == 0 ){
        $.ajax({
          url: url_no_port + 'model/student.php?action=addStudentDetail',
          type: 'post',
          dataType: 'json',
          data: {
            "name": name,
            "matrics": matric,
            "phone": phone,
            "dob": dob,
            "address": address,
            "courseid": courseid
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
          url: url_no_port + 'model/student.php?action=addStudentDetail',
          type: 'post',
          dataType: 'json',
          data: {
            "name": name,
            "matrics": matric,
            "phone": phone,
            "dob": dob,
            "address": address,
            "img": base64image,
            "courseid": courseid
          },
          success: function(response) {
            alert(response.success);
            $('#add_close').trigger('click');
            location.reload();
          }
        });
      };
      reader.onerror = function(error) {
        console.log('Error: ', error);
      };
    }
  });
</script>