<?php include 'base/authentication.php'; 
      include 'language/clinic.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php 
      include 'head.php'; 
//       include 'base/authentication.php';

      include 'model/clinic.php';
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
        <li class="breadcrumb-item active"><?php echo $language_clinic_title; ?></li>
      </ol>
    </section>
  </article>
  <!-- All Student Datas -->
  <div class="container-fluid">
    <!-- Top row -->
    <div class="card mb-3">
      <div class="card-header">
        <i class="fas fa-table"></i> <?php echo $language_all_clinic; ?>
<!--         <button type="button" id="add_button" data-toggle="modal" data-target="#addClinicModal" class="btn btn-info btn-sm" style="float: right">
            <?php echo $language_add_clinic; ?>
          </button> -->
      </div>
      <!-- Table data -->
      <div class="card-body">
        <div class="table-responsive">
          <!-- must use dataTable for the filter to works. unless you find the javascript and create a new one -->
          <table id="dataTable" class="table table-bordered table-striped" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th><?php echo $language_sn; ?></th>
                <th><?php echo $language_name; ?></th>
                <th><?php echo $language_address; ?></th>
                <th><?php echo $language_postcode; ?></th>
                <th><?php echo $language_building; ?></th>
                <th><?php echo $language_contact; ?></th>
               
<!--                 <th><?php echo $language_update; ?></th>
                <th><?php echo $language_delete; ?></th> -->
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th><?php echo $language_sn; ?></th>
                <th><?php echo $language_name; ?></th>
                <th><?php echo $language_address; ?></th>
                <th><?php echo $language_postcode; ?></th>
                <th><?php echo $language_building; ?></th>
                <th><?php echo $language_contact; ?></th>
            
<!--                 <th><?php echo $language_update; ?></th>
                <th><?php echo $language_delete; ?></th> -->
              </tr>
            </tfoot>
            <tbody>
              <?php $clinicAllInfo = new clinic();
                 foreach($clinicAllInfo->getAllClinic() as $clinic){
               ?>
                <tr>
                  <td><?php echo $clinic->id;?></td>
                  <td><?php echo $clinic->name;?></td>
                  <td><?php echo $clinic->address;?></td>
                  <td><?php echo $clinic->postal;?></td>
                  <td><?php echo $clinic->buildingname;?></td>
                  <td><?php echo $clinic->phone;?></td>
            
<!--                   <td><button type="button" id="edit_button" data-toggle="modal" data-target="#editClinicModal"><i class="fas fa-edit"></i></button></td>
                  <td><button type="button" id="delete_button"><i class="fas fa-trash-alt"></i></button></td> -->
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
<div id="addClinicModal" class="modal fade">
  <div class="modal-dialog">
    <form method="post" id="std_form" enctype="multipart/form-data">
      <div class="modal-content">
        <div class="modal-header">
          <h4 align="left" class="modal-title"><?php echo $language_add_clinic; ?></h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <label><?php echo $language_enter_clinic_name; ?></label>
          <input type="text" name="name" id="name" class="form-control" />
          <br />
          <label><?php echo $language_enter_clinic_address; ?></label>
          <input type="text" name="address" id="address" class="form-control" />
          <br />
          <label><?php echo $language_enter_clinic_postal; ?></label>
          <input type="text" name="postal" id="postal" class="form-control" />
          <br />
          <label><?php echo $language_enter_clinic_building; ?></label>
          <input type="text" name="buildingname" id="buildingname" class="form-control" />
          <br />
          <label><?php echo $language_enter_clinic_number; ?></label>
          <input type="text" name="phone" id="phone" class="form-control" />
          <br />
          <label><?php echo $language_enter_clinic_latitude; ?></label>
          <input type="text" name="lat" id="lat" class="form-control" />
          <br />
          <label><?php echo $language_enter_clinic_longitude; ?></label>
          <input type="text" name="lng" id="lng" class="form-control" />
          <br />
          <label><?php echo $language_enter_clinic_estate; ?></label>
          <input type="text" name="estate" id="estate" class="form-control" />
          <br />
          <label><?php echo $language_enter_clinic_fax; ?></label>
          <input type="text" name="fax" id="fax" class="form-control" />
          <br />
          <label><?php echo $language_enter_clinic_opening; ?></label>
          <input type="text" name="openinghours" id="openinghours" class="form-control" />
          <br />
          <label><?php echo $language_enter_clinic_remarks; ?></label>
          <input type="text" name="remarks" id="remarks" class="form-control" />
        </div>
        <div class="modal-footer">
          <input type="hidden" name="std_id" id="std_id" />
          <input type="hidden" name="operation" id="operation" />
          <input type="submit" name="action" id="action" class="btn btn-success" value="Add" />
          <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $language_close; ?></button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- Modal display for EDITING student-->
<div id="editClinicModal" class="modal fade">
  <div class="modal-dialog">
    <form method="post" id="std_form" enctype="multipart/form-data">
      <div class="modal-content">
        <div class="modal-header">
          <h4 align="left" class="modal-title"><?php echo $language_edit_clinic; ?></h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <input style="display:none;" type="text" name="clinicid" id="edit_clinic_id" class="form-control" />
          <label><?php echo $language_edit_clinic_name; ?></label>
          <input type="text" name="name" id="edit_name" class="form-control" />
          <br />
          <label><?php echo $language_edit_clinic_address; ?></label>
          <input type="text" name="address" id="edit_address" class="form-control" />
          <br />
          <label><?php echo $language_edit_clinic_postal; ?></label>
          <input type="text" name="postal" id="edit_postal" class="form-control" />
          <br />
          <label><?php echo $language_edit_clinic_building; ?></label>
          <input type="text" name="buildingname" id="edit_buildingname" class="form-control" />
          <br />
          <label><?php echo $language_edit_clinic_number; ?></label>
          <input type="text" name="phone" id="edit_phone" class="form-control" />
          <br />
          <label><?php echo $language_edit_clinic_latitude; ?></label>
          <input type="text" name="lat" id="edit_lat" class="form-control" />
          <br />
          <label><?php echo $language_edit_clinic_longitude; ?></label>
          <input type="text" name="lng" id="edit_lng" class="form-control" />
          <br />
          <label><?php echo $language_edit_clinic_estate; ?></label>
          <input type="text" name="estate" id="edit_estate" class="form-control" />
          <br />
          <label><?php echo $language_edit_clinic_fax; ?></label>
          <input type="text" name="fax" id="edit_fax" class="form-control" />
          <br />
          <label><?php echo $language_edit_clinic_opening; ?></label>
          <input type="text" name="openinghours" id="edit_openinghours" class="form-control" />
          <br />
          <label><?php echo $language_edit_clinic_remarks; ?></label>
          <input type="text" name="remarks" id="edit_remarks" class="form-control" />
        </div>
        <div class="modal-footer">
          <input type="hidden" name="std_id" id="std_id" />
          <input type="hidden" name="operation" id="operation" />
          <input type="submit" name="action" id="action" class="btn btn-success" value="Edit" />
          <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $language_close; ?></button>
        </div>
      </div>
    </form>
  </div>
</div>
  
<script>
  var table = $('#dataTable').DataTable();
 
  table.on('click', 'tbody #edit_button', function () {
    var data_row = table.row($(this).closest('tr')).data();
    $('#edit_clinic_id').val(data_row[0]);
    $('#edit_name').val(data_row[1]);
    $('#edit_address').val(data_row[2]);
    $('#edit_postal').val(data_row[3]);
    $('#edit_buildingname').val(data_row[4]);
    $('#edit_phone').val(data_row[5]);
  //  $('#edit_lat').val(data_row[6]);
//     $('#edit_lng').val(data_row[8]);
//     $('#edit_estate').val(data_row[9]);
//     $('#edit_fax').val(data_row[10]);
//     $('#edit_openinghours').val(data_row[11]);
//     $('#edit_remarks').val(data_row[12]);
   });
   // Handles edit clinic info
   $('#btn_edit').on('click', function() {
     var clinicid = $('#edit_clinic_id').val();
     var name      = $('#edit_name').val();
     var address    = $('#edit_address').val();
     var postal     = $('#edit_postal').val();
     var buildingname = $('#edit_buildingname').val();
     var phone  = $('#edit_phone').val();
    // var lat = $('#edit_lat').val();
//      var lng = $('#edit_lng').val();
//      var estate = $('#edit_estate').val();
//      var fax = $('#edit_fax').val();
//      var openinghours = $('#edit_openinghours').val();
//      var remarks = $('#edit_remarks').val();
   });
                 
 </script>