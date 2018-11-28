<?php include 'base/authentication.php'; 
      include 'language/events.php';
      include 'model/room.php';
//       include 'language/api_url.php';
      
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php include 'head.php'; 
        include 'model/event.php';
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
          <?php echo $language_event_title; ?>
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
        <?php echo $language_all_events; ?>
        <button type="button" id="event_add_button" data-toggle="modal" data-target="#addEventModal" class="btn btn-info btn-sm" style="float: right">
            <?php echo $language_add_events; ?>
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
                  <?php echo $language_event_id; ?>
                </th>
                <th>
                  <?php echo $language_image; ?>
                </th>
                <th>
                  <?php echo $language_name; ?>
                </th>
                <th>
                  <?php echo $language_description; ?>
                </th>
                <th>
                  <?php echo $language_start; ?>
                </th>
                <th>
                  <?php echo $language_end; ?>
                </th>
                <th>
                  <?php echo $language_room; ?>
                </th>
                <th>
                  <?php echo $language_created_by; ?>
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
                  <?php echo $language_event_id; ?>
                </th>
                <th>
                  <?php echo $language_image; ?>
                </th>
                <th>
                  <?php echo $language_name; ?>
                </th>
                <th>
                  <?php echo $language_description; ?>
                </th>
                <th>
                  <?php echo $language_start; ?>
                </th>
                <th>
                  <?php echo $language_end; ?>
                </th>
                <th>
                  <?php echo $language_room; ?>
                </th>
                <th>
                  <?php echo $language_created_by; ?>
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
              <?php $eventAllInfo = new event();
                    foreach($eventAllInfo->getAllEvent() as $event){
               ?>
              <tr>
                <td>
                  <?php echo $event->eventid;?>
                </td>
                <td><img style="width: 50px; height: 50px;" src="<?php echo 'http://ict2103group12.tk:3001' . $event->eventimage;?>"></td>
                <td>
                  <?php echo $event->eventname;?>
                </td>
                <td>
                  <?php echo $event->eventdescription;?>
                </td>
                <!--                   <td><?php echo $event->eventstarttime;?></td> -->
                <!--                   <td><?php echo $event->eventendtime;?></td> -->
                <td>
                  <?php echo date("Y-m-d H:i:s", strtotime($event->eventstarttime)); ?>
                </td>
                <td>
                  <?php echo date("Y-m-d H:i:s", strtotime($event->eventendtime)); ?>
                </td>
                <td>
                  <?php echo $event->eventlocation;?>
                </td>
                <td>
                  <?php echo $event->eventcreatedby;?>
                </td>
                
                <td><button type="button" id="event_edit_button" data-toggle="modal" data-target="#editEventModal"><i class="fas fa-edit"></i></button></td>
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
    $('#event_add_button').click(function() {
      $('#std_form')[0].reset();
      $('.modal-title').text("Add Event");
      $('#action').val("Add");
      $('#operation').val("Add");
      $('#std_uploaded_image').html('');
      console.log('');
    });

  });
</script>

</html>

<!-- Modal display for ADDING Event-->
<div id="addEventModal" class="modal fade">
  <div class="modal-dialog">
    <form method="post" id="std_form" enctype="multipart/form-data">
      <div class="modal-content">
        <div class="modal-header">
          <h4 align="left" class="modal-title">
            <?php echo $language_add_events; ?>
          </h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <label for="name"><?php echo $language_enter_event_name; ?></label>
          <input type="text" name="name" id="add_name" class="form-control"/>
          <br />
          <label for="description"><?php echo $language_enter_event_description; ?></label>
          <input type="text" name="description" id="add_description" class="form-control" />
          <br />


          <label for="starttime"><?php echo $language_enter_event_start_time; ?></label>
          <!--           <input type="text" name="starttime" id="add_starttime" class="form-control" />
          <br /> -->



          <div class="input-group date" data-provide="datepicker" data-date-format="yyyy-mm-dd">
            <input type="text" name="starttime" class="form-control" id="add_starttime">
            <div class="input-group-addon">
              <span class="glyphicon glyphicon-th"></span>
            </div>
          </div>
          <br />



          <label for="endtime"><?php echo $language_enter_event_end_time; ?></label>
          <!--           <input type="text" name="endtime" id="add_endtime" class="form-control" />
          <br /> -->


          <div class="input-group date" data-provide="datepicker" data-date-format="yyyy-mm-dd">
            <input type="text" name="endtime" class="form-control" id="add_endtime">
            <div class="input-group-addon">
              <span class="glyphicon glyphicon-th"></span>
            </div>
          </div>
          <br />


          <label for='formRooms'><?php echo "Select Room" ?></label>
          <select name="formRooms" style="width:100%;" id="add_select_room" class="form-control">
            <?php $rooms = new Rooms();
              foreach ($rooms->getAllRooms() as $room) { 
            ?>
              <option value="<?php echo $room->id; ?>"><?php echo $room->name . ' - ' . $room->location; ?></option>
            <?php } ?>
          </select>
          <br />
          
          <label for="hostname"><?php echo $language_enter_host_name; ?></label>
          <input type="text" name="hostname" id="add_hostname" class="form-control" />
          <br />
          <label for="url"><?php echo $language_enter_event_url; ?></label>
          <input type="text" name="url" id="add_url" class="form-control" />
          <br />
          <label for="std_image"><?php echo $language_select_event_image; ?></label>
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

<!-- Modal display for EDITING Event-->
<div id="editEventModal" class="modal fade">
  <div class="modal-dialog">
    <form method="post" id="std_form" enctype="multipart/form-data">
      <div class="modal-content">
        <div class="modal-header">
          <h4 align="left" class="modal-title">
            <?php echo $language_edit_event; ?>
          </h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <input style="display:none;" type="text" name="eventid" id="edit_event_id" class="form-control" />
          <label for="eventname"><?php echo $language_edit_event_name; ?></label>
          <input type="text" name="eventname" id="edit_event_name" class="form-control" />
          <br />
          <label for="eventdescription"><?php echo $language_edit_event_description; ?></label>
          <input type="text" name="eventdescription" id="edit_event_description" class="form-control" />
          <br />
          <label><?php echo $language_edit_event_start_time; ?></label>
<!--           <input type="text" name="starttime" id="edit_event_starttime" class="form-control" />
          <br /> -->
          
          <div class="input-group date" data-provide="datepicker" data-date-format="yyyy-mm-dd">
            <input type="text" name="starttime" class="form-control" id="edit_event_starttime">
            <div class="input-group-addon">
              <span class="glyphicon glyphicon-th"></span>
            </div>
          </div>
          <br />
          
          <label><?php echo $language_edit_event_end_time; ?></label>
<!--           <input type="text" name="endtime" id="edit_event_endtime" class="form-control" />
          <br /> -->
          
          <div class="input-group date" data-provide="datepicker" data-date-format="yyyy-mm-dd">
            <input type="text" name="endtime" class="form-control" id="edit_event_endtime">
            <div class="input-group-addon">
              <span class="glyphicon glyphicon-th"></span>
            </div>
          </div>
          <br />
          
          <label for="formRooms"><?php echo "Select Room" ?></label>
          <select name="formRooms" style="width:100%;" id="edit_select_room" class="form-control">
            <?php $rooms = new Rooms();
              foreach ($rooms->getAllRooms() as $room) { 
            ?>
              <option value="<?php echo $room->id; ?>"><?php echo $room->name . ' - ' . $room->location; ?></option>
            <?php } ?>
          </select>
          <br />

          <label><?php echo $language_edit_host_name; ?></label>
          <input type="text" name="hostname" id="edit_event_hostname" class="form-control" />
          <br />
          <label><?php echo $language_edit_event_url; ?></label>
          <input type="text" name="url" id="edit_event_url" class="form-control" />
          <br />
          <label><?php echo $language_edit_event_image; ?></label>
          <input type="file" name="std_image" id="edit_std_image" class="form-control" />
          <span id="std_uploaded_image"></span>
        </div>
        <div class="modal-footer">
          <input type="hidden" name="std_id" id="std_id" />
          <input type="hidden" name="operation" id="operation" />
          <input type="button" name="action" id="btn_edit_event" class="btn btn-success" value="Edit" />
          <button id="edit_close" type="button" class="btn btn-default" data-dismiss="modal"><?php echo $language_close; ?></button>
        </div>
      </div>
    </form>
  </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>

<script>
  // No API PUT for Editing yet.
  var table = $('#dataTable').DataTable();

  $('#dataTable').on('click', 'tbody #event_edit_button', function() {
    var data_row = table.row($(this).closest('tr')).data();
    $('#edit_event_id').val(data_row[0]);
    $('#edit_event_name').val(data_row[2]);
    $('#edit_event_description').val(data_row[3]);
   
    
    var start = new Date(data_row[4]);
    var start_date = start.getFullYear() + "-" + (start.getMonth() + 1) + "-" + start.getDate();
    
    var end = new Date(data_row[5]);
    var end_date = end.getFullYear() + "-" + (end.getMonth() + 1) + "-" + end.getDate();
    
        
    $('#edit_event_starttime').val(start_date);
    $('#edit_event_endtime').val(end_date);
    $('#edit_event_room').val(data_row[6]);
    $('#edit_event_hostname').val(data_row[7]);
  });


  // Query result to API via ajax
  $('#btn_edit_event').on('click', function() {
    var eventid = $('#edit_event_id').val();
    var eventname = $('#edit_event_name').val();
    var eventdescription = $('#edit_event_description').val();
    var eventstarttime = $('#edit_event_starttime').val();
    var eventendtime = $('#edit_event_endtime').val();
    var roomid = $('#edit_select_room').val();
    var eventcreatedby = $('#edit_event_hostname').val();
    var eventimage = $('#add_std_image').val();
    var eventurl = $('#edit_event_url').val();

    if( document.getElementById("edit_std_image").files.length == 0 ){
        $.ajax({
          url: url_no_port + 'model/event.php?action=updateEventDetail',
          type: 'post',
          dataType: 'json',
          data: {
            "eventid": eventid,
            "eventname": eventname,
            "eventdescription": eventdescription,
            "eventstarttime": eventstarttime,
            "eventendtime": eventendtime,
            "roomid": roomid,
            "eventcreatedby": eventcreatedby,
            "eventimage": eventimage,
            "eventurl": eventurl
          },
          success: function(response) {
            alert(response.respond);
            $('#edit_close').trigger('click');
            location.reload();
          }
        })
      }
    else{
    
    var file = document.querySelector('#edit_std_image').files[0];
    var reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = function() {

    var base64image = reader.result;
    $.ajax({
          url: url_no_port + 'model/event.php?action=updateEventDetail',
          type: 'post',
          dataType: 'json',
          data: {
            "eventid": eventid,
            "eventname": eventname,
            "eventdescription": eventdescription,
            "eventstarttime": eventstarttime,
            "eventendtime": eventendtime,
            "roomid": roomid,
            "eventcreatedby": eventcreatedby,
            "eventimage": base64image,
            "eventurl": eventurl
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


  // Query Add Event API via AJAX POST
  $('#btn_add').on('click', function() {
    var eventname = $('#add_name').val();
    var eventdescription = $('#add_description').val();
    var eventstarttime = $('#add_starttime').val();
    var eventendtime = $('#add_endtime').val();
    var roomid = $('#add_select_room').val();
    var eventcreatedby = $('#add_hostname').val();
    var eventimage = $('#add_std_image').val();
    var eventurl = $('#add_url').val();

    if( document.getElementById("add_std_image").files.length == 0 ){
        $.ajax({
          url: url_no_port + 'model/event.php?action=addEventDetail',
          type: 'post',
          dataType: 'json',
          data: {
            "eventname": eventname,
            "eventdescription": eventdescription,
            "eventstarttime": eventstarttime,
            "eventendtime": eventendtime,
            "roomid": roomid,
            "eventcreatedby": eventcreatedby,
            "eventimage": eventimage,
            "eventurl": eventurl
          },
          success: function(response) {
            alert(response.respond);
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
          url: url_no_port + 'model/event.php?action=addEventDetail',
          type: 'post',
          dataType: 'json',
          data: {
            "eventname": eventname,
            "eventdescription": eventdescription,
            "eventstarttime": eventstarttime,
            "eventendtime": eventendtime,
            "roomid": roomid,
            "eventcreatedby": eventcreatedby,
            "eventimage": base64image,
            "eventurl": eventurl
          },
          success: function(response) {
            alert(response.respond);
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