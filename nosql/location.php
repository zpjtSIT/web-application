<?php include 'base/authentication.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'head.php'; 
          include 'model/location_process.php';
          include 'language/location.php';
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
              <li class="breadcrumb-item active"><?php echo $language_location_management; ?></li>
            </ol>
        </section>
    </article>

    <!-- All Student Datas -->
    <div class="container-fluid">
        <!-- Top row -->
        <div class="card mb-3">
            <div class="card-header">
                <i class="fas fa-table"></i> <?php echo $language_location_management; ?>
                <button type="button" id="add_button" data-toggle="modal" data-target="#addLocationModal" class="btn btn-info btn-sm"
                    style="float: right">
                    <?php echo $language_add_location; ?>
              </button>
            </div>
            <!-- Table data -->
            <div class="card-body">
                <div class="table-responsive">
                    <!-- must use dataTable for the filter to works. unless you find the javascript and create a new one -->
                    <table id="dataTableLocation" class="table table-bordered table-striped" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th><?php echo $language_location_id; ?></th>
                                <th><?php echo $language_name; ?></th>
                                <th><?php echo $language_address; ?></th>
                                <th><?php echo $language_lat; ?></th>
                                <th><?php echo $language_lng; ?></th>
                                <th><?php echo $language_description; ?></th>
                                <th><?php echo $language_opening; ?></th>
                                <th><?php echo $language_update; ?></th>
                                <th><?php echo $language_delete; ?></th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th><?php echo $language_location_id; ?></th>
                                <th><?php echo $language_name; ?></th>
                                <th><?php echo $language_address; ?></th>
                                <th><?php echo $language_lat; ?></th>
                                <th><?php echo $language_lng; ?></th>
                                <th><?php echo $language_description; ?></th>
                                <th><?php echo $language_opening; ?></th>
                                <th><?php echo $language_update; ?></th>
                                <th><?php echo $language_delete; ?></th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php $locationAllLocations = new locations();
                                  foreach ($locationAllLocations->getAllLocations() as $locations) { 
                            ?>
                            <tr>
                                <td><?php echo $locations->locationid;?></td>
                                <td><?php echo $locations->locationname;?></td>
                                <td><?php echo $locations->locationaddress;?></td>
                                <td><?php echo $locations->locationlat;?></td>
                                <td><?php echo $locations->locationlong;?></td>
                                <td><?php echo $locations->locationdescription;?></td>
                                <td><?php echo $locations->locationopening;?></td>

                                <!--TO DO, EDIT BUTTON, DELETE BUTTON. PUT&DELETE REQUEST-->
                                <td><button type="button" id="loc_edit_button" data-toggle="modal" data-target="#editLocationModal"><i class="fas fa-edit"></i></button></td>
                                <td><button type="button" id="loc_delete_button"><i class="fas fa-trash-alt"></i></button></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <!-- Top row -->
        <div class="card mb-3">
            <div class="card-header">
                <i class="fas fa-table"></i> <?php echo $language_room_management; ?>
                <button type="button" id="add_button" data-toggle="modal" data-target="#addRoomModal" class="btn btn-info btn-sm" style="float: right">
                    <?php echo $language_add_room; ?>
                </button>
            </div>
            <!-- Table data -->
            <div class="card-body">
                <div class="table-responsive">
                    <!-- must use dataTable for the filter to works. unless you find the javascript and create a new one -->
                    <table id="dataTableRoom" class="table table-bordered table-striped" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th><?php echo $language_room_id; ?></th>
                                <th><?php echo $language_name; ?></th>
                                <th><?php echo $language_room_size; ?></th>
                                <th><?php echo $language_description; ?></th>
                                <th><?php echo $language_room_location; ?></th>
                                <th><?php echo $language_update; ?></th>
                                <th><?php echo $language_delete; ?></th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th><?php echo $language_room_id; ?></th>
                                <th><?php echo $language_name; ?></th>
                                <th><?php echo $language_room_size; ?></th>
                                <th><?php echo $language_description; ?></th>
                                <th><?php echo $language_room_location; ?></th>
                                <th><?php echo $language_update; ?></th>
                                <th><?php echo $language_delete; ?></th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                             $roomAllRooms = new rooms();
                             foreach($roomAllRooms->getAllRooms() as $rooms){
                             ?>
                            <tr>
                                <td><?php echo $rooms->id;?></td>
                                <td><?php echo $rooms->name;?></td>
                                <td><?php echo $rooms->size;?></td>
                                <td><?php echo $rooms->description;?></td>
                                <td><?php echo $rooms->location;?></td>
                                <!--TO DO, EDIT BUTTON, DELETE BUTTON. PUT&DELETE REQUEST-->
                                <td><button type="button" id="rm_edit_button" data-toggle="modal" data-target="#editRoomModal"><i class="fas fa-edit"></i></button></td>
                                <td><button type="button" id="rm_delete_button"><i class="fas fa-trash-alt"></i></button></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <article id="content-wrapper">
            <?php include 'footer.php' ?>
        </article>
</body>

</html>
<!-- Modal display for ADDING Location-->
<div id="addLocationModal" class="modal fade">
  <div class="modal-dialog">
    <form method="post" id="std_form" enctype="multipart/form-data">
      <div class="modal-content">
        <div class="modal-header">
          <h4 align="left" class="modal-title"><?php echo $language_add_location; ?></h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <label for="loc_name"><?php echo $language_location_name; ?></label>
          <input type="text" name="loc_name" id="add_loc_name" class="form-control" />
          <br />
          <label for="loc_address"><?php echo $language_location_address; ?></label>
          <input type="text" name="loc_address" id="add_loc_address" class="form-control" />
          <br />
          <label for="loc_lat"><?php echo $language_location_lat; ?></label>
          <input type="text" name="loc_lat" id="add_loc_lat" class="form-control" />
          <br />
          <label for="loc_lng"><?php echo $language_location_lng; ?></label>
          <input type="text" name="loc_lng" id="add_loc_lng" class="form-control" />
          <br />
          <label for="loc_desc"><?php echo $language_location_desc; ?></label>
          <input type="text" name="loc_address" id="add_loc_desc" class="form-control" />
          <br />
          <label for="loc_op"><?php echo $language_location_op; ?></label>
          <input type="text" name="loc_op" id="add_loc_op" class="form-control" />
          <br />
        </div>
        <div class="modal-footer">
          <input type="hidden" name="std_id" id="std_id" />
          <input type="hidden" name="operation" id="operation" />
          <input type="button" name="action" id="btn_add_loc" class="btn btn-success" value="Add" />
          <button id = "add_close_loc" type="button" class="btn btn-default" data-dismiss="modal"><?php echo $language_close; ?></button>
        </div>
      </div>
    </form>
  </div>
</div>
  
<!-- Modal display for Editing Location-->
<div id="editLocationModal" class="modal fade">
  <div class="modal-dialog">
    <form method="post" id="std_form" enctype="multipart/form-data">
      <div class="modal-content">
        <div class="modal-header">
          <h4 align="left" class="modal-title"><?php echo $language_edit_location; ?></h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <input style="display:none;" type="text" name="locationid" id="edit_loc_id" class="form-control" />
          <label for="loc_name"><?php echo $language_location_name; ?></label>
          <input type="text" name="loc_name" id="edit_loc_name" class="form-control" />
          <br />
          <label for="loc_address"><?php echo $language_location_address; ?></label>
          <input type="text" name="loc_address" id="edit_loc_address" class="form-control" />
          <br />
          <label for="loc_lat"><?php echo $language_location_lat; ?></label>
          <input type="text" name="loc_lat" id="edit_loc_lat" class="form-control" />
          <br />
          <label for="loc_lng"><?php echo $language_location_lng; ?></label>
          <input type="text" name="loc_lng" id="edit_loc_lng" class="form-control" />
          <br />
          <label for="loc_desc"><?php echo $language_location_desc; ?></label>
          <input type="text" name="loc_desc" id="edit_loc_desc" class="form-control" />
          <br />
            <label for="loc_op"><?php echo $language_location_op; ?></label>
          <input type="text" name="loc_op" id="edit_loc_op" class="form-control" />
          <br />
        </div>
        <div class="modal-footer">
          <input type="hidden" name="std_id" id="std_id" />
          <input type="hidden" name="operation" id="operation" />
          <input type="button" name="action" id="btn_edit_loc" class="btn btn-success" value="Edit" />
          <button id="edit_close_loc" type="button" class="btn btn-default" data-dismiss="modal"><?php echo $language_close; ?></button>
        </div>
      </div>
    </form>
  </div>
</div>
  
  <!-- Modal display for ADDING Room-->
<div id="addRoomModal" class="modal fade">
  <div class="modal-dialog">
    <form method="post" id="std_form" enctype="multipart/form-data">
      <div class="modal-content">
        <div class="modal-header">
          <h4 align="left" class="modal-title"><?php echo $language_add_room; ?></h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <label for="rm_name"><?php echo $language_room_name; ?></label>
          <input type="text" name="rm_name" id="add_rm_name" class="form-control" />
          <br />
          <label for="rm_size"><?php echo  $language_room_size; ?></label>
          <input type="text" name="rm_size" id="add_rm_size" class="form-control" />
          <br />
          
<!--           <label for="rm_location"><?php echo  $language_room_location; ?></label>
          <input type="text" name="rm_location" id="add_rm_loc" class="form-control" />
          <br /> -->
          
          <label for="rm_location"><?php echo $language_room_location; ?></label>
          <select name="rm_location" style="width:100%;" id="add_rm_loc" class="form-control">
            <?php $locations = new locations();
              foreach ($locations->getAllLocations() as $location) { 
            ?>
              <option value="<?php echo $location->locationid; ?>"><?php echo $location->locationname; ?></option>
            <?php } ?>
          </select>
          <br />

          
          <label for="rm_des"><?php echo  $language_room_desc; ?></label>
          <input type="text" name="rm_des" id="add_rm_des" class="form-control" />
          <br />
        </div>
        <div class="modal-footer">
          <input type="hidden" name="std_id" id="std_id" />
          <input type="hidden" name="operation" id="operation" />
          <input type="button" name="action" id="btn_add_rm" class="btn btn-success" value="Add" />
          <button type="button" id="add_close_rm" class="btn btn-default" data-dismiss="modal"><?php echo $language_close; ?></button>
        </div>
      </div>
    </form>
  </div>
</div>
    <!-- Modal display for EDITING Room-->
  <div id="editRoomModal" class="modal fade">
  <div class="modal-dialog">
    <form method="post" id="std_form" enctype="multipart/form-data">
      <div class="modal-content">
        <div class="modal-header">
          <h4 align="left" class="modal-title"><?php echo $language_edit_room; ?></h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <input style="display:none;" type="text" name="rm_id" 
                 id="edit_rm_id" class="form-control" />
          <label for="rm_name"><?php echo $language_room_name; ?></label>
          <input type="text" name="rm_name" id="edit_rm_name" class="form-control" />
          <br />
          <label for="rm_size"><?php echo  $language_room_size; ?></label>
          <input type="text" name="rm_size" id="edit_rm_size" class="form-control" />
          <br />
          
<!--           <label for="rm_location"><?php echo  $language_room_location; ?></label>
          <input type="text" name="rm_location" id="edit_rm_loc" class="form-control" />
          <br /> -->
          
          <label for="rm_location"><?php echo $language_room_location; ?></label>
          <select name="rm_location" style="width:100%;" id="edit_rm_loc" class="form-control">
            <?php $locations = new locations();
              foreach ($locations->getAllLocations() as $location) { 
            ?>
              <option value="<?php echo $location->locationid; ?>"><?php echo $location->locationname; ?></option>
            <?php } ?>
          </select>
          <br />

          
          <label for="rm_desc"><?php echo  $language_room_desc; ?></label>
          <input type="text" name="rm_desc" id="edit_rm_desc" class="form-control" />
          <br />
        </div>
        <div class="modal-footer">
          <input type="hidden" name="std_id" id="std_id" />
          <input type="hidden" name="operation" id="operation" />
          <input type="button" name="action" id="btn_edit_rm" class="btn btn-success" value="Edit" />
          <button type="button" class="btn btn-default" id="edit_close_rm" data-dismiss="modal"><?php echo $language_close; ?></button>
        </div>
      </div>
    </form>
  </div>
</div>
<script>

    var table = $('#dataTableLocation').DataTable(); //replace id as per your need
     // Handles table edit button
    table.on('click','tbody #loc_edit_button',function(){
    var data_row = table.row($(this).closest('tr')).data();
    $('#edit_loc_id').val(data_row[0]);
    $('#edit_loc_name').val(data_row[1]);
    $('#edit_loc_address').val(data_row[2]);
    $('#edit_loc_lat').val(data_row[3]);
    $('#edit_loc_lng').val(data_row[4]);
    $('#edit_loc_desc').val(data_row[5]);
    $('#edit_loc_op').val(data_row[6]);
    
    });
    
  $('#btn_add_loc').on('click', function() {
   
      var name = $('#add_loc_name').val();
      var address = $('#add_loc_address').val();
      var lat = $('#add_loc_lat').val();
      var lng = $('#add_loc_lng').val();
      var desc = $('#add_loc_desc').val();
      var op = $('#add_loc_op').val();

      $.ajax({
        url:  url_no_port + 'model/location_process.php?action=addLocationDetail',
         type: 'post',
         dataType: 'json',
         data: {"name" : name, 
                "address" : address, 
                "lat" : lat, 
                "long" : lng, 
                "description" : desc, 
                "opening" : op},
         success: function(response) {
          alert(response.respond); 
          $('#add_close_loc').trigger('click');
          location.reload();
        }
      });
    });
  
   $('#btn_edit_loc').on('click', function() {
   
      var name    = $('#edit_loc_name').val();
      var address = $('#edit_loc_address').val();
      var lat     = $('#edit_loc_lat').val();
      var lng     = $('#edit_loc_lng').val();
      var desc    = $('#edit_loc_desc').val();
      var op      = $('#edit_loc_op').val();
      var id      = $("#edit_loc_id").val();
      //alert('edit button clicked');
      $.ajax({
         url:  url_no_port + 'model/location_process.php?action=updateLocationDetail',
         type: 'post',
         dataType: 'json',
         data: {"name" : name, "address" : address, "lat" : lat,"long" : lng,"description" : desc,"opening" : op, "locid":id},
          success: function(response) {
            alert(response.respond); 
            $('#edit_close_loc').trigger('click');
            location.reload();
        }
      });
    });
  
  $('#dataTableLocation').on('click', 'tbody #loc_del_button', function () {
    var data_row = table.row($(this).closest('tr')).data();

    
    var id      = data_row[0];
    var name    = data_row[1];
    var address = data_row[2];
    var lat     = data_row[3];
    var lng     = data_row[4];
    var desc    = data_row[5];
    var op      = data_row[6]
    var active  = "1";
    
    if (confirm('<?php echo $language_delete_location_title; ?>')) {
      $.ajax({
        url: url_no_port + 'model/location_process.php?action=updateLocationDetail',
        type: 'post',
        dataType: 'json',
        data: { "name" : name, "address" : address, "lat" : lat,"long" : lng,"description" : desc,"opening" : op, "locid":id,"active":active},
        success: function(response) {
          alert(response.respond); 
          location.reload();
        }
      });
    }  
  });
  
  
  var roomTbl = $('#dataTableRoom').DataTable(); //replace id as per your need
    roomTbl.on('click','tbody #rm_edit_button', function() {
      var data_row = roomTbl.row($(this).closest('tr')).data();
      $('#edit_rm_id').val(data_row[0]);
      $('#edit_rm_name').val(data_row[1]);
      $('#edit_rm_size').val(data_row[2]);
      $('#edit_rm_desc').val(data_row[3]);
      $('#edit_rm_loc').val(data_row[4]);
    });
  
  $('#btn_edit_rm').on('click', function() {
     var id           = $('#edit_rm_id').val();
     var name         = $('#edit_rm_name').val();
     var size         = $('#edit_rm_size').val();
     var description  = $('#edit_rm_desc').val();
     var locationid   = $('#edit_rm_loc').val();
     $.ajax({
       url:  url_no_port + 'model/room.php?action=updateRoomDetail',
       type: 'post',
       dataType: 'json',
       data: {"id" : id, 
              "name" : name, 
              "size" : size, 
              "description" : description, 
              "locationid" : locationid
             },
       success: function(response) {
        alert(response.respond); 
        $('#edit_close_rm').trigger('click');
        location.reload();
      }
     });
  });
  
  $('#btn_add_rm').on('click', function() {
     var name         = $('#add_rm_name').val();
     var size         = $('#add_rm_size').val();
     var description  = $('#add_rm_des').val();
     var locationid   = $('#add_rm_loc').val();
    $.ajax({
       url:  url_no_port + 'model/room.php?action=addRoomDetail',
       type: 'post',
       dataType: 'json',
       data: {
              "name" : name, 
              "size" : size, 
              "description" : description, 
              "locationid" : locationid
             },
       success: function(response) {
        alert(response.respond); 
        $('#add_close_rm').trigger('click');
        location.reload();
      }
    });
  });
    
</script>


 