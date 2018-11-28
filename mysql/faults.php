<?php include 'base/authentication.php'; 
      include 'language/faults.php';
      include 'language/lost.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php 
      include 'head.php'; 
      include 'model/faults_process.php';
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
          <a href="dashboard.php">
            <?php echo $language_dashboard; ?>
          </a>
        </li>
        <li class="breadcrumb-item active">
          <?php echo $language_fault_title; ?>
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
        <?php echo $language_fault_title; ?>
      </div>
      <!-- Table data -->
      <div class="card-body">
        <div class="table-responsive">
          <!-- must use dataTable for the filter to works. unless you find the javascript and create a new one -->
          <table id="dataTable" class="table table-bordered table-striped" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>
                  <?php echo $language_fault_id; ?>
                </th>
                <th>
                  <?php echo $language_date_reported; ?>
                </th>
                <th>
                  <?php echo $language_image; ?>
                </th>
                <th>
                  <?php echo $language_fault_location; ?>
                </th>
                <th>
                  <?php echo $language_fault_room; ?>
                </th>
                <th>
                  <?php echo $language_description; ?>
                </th>
                <th>
                  <?php echo $language_fault_status; ?>
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
                  <?php echo $language_fault_id; ?>
                </th>
                <th>
                  <?php echo $language_date_reported; ?>
                </th>
                <th>
                  <?php echo $language_image; ?>
                </th>
                <th>
                  <?php echo $language_fault_location; ?>
                </th>
                <th>
                  <?php echo $language_fault_room; ?>
                </th>
                <th>
                  <?php echo $language_description; ?>
                </th>
                <th>
                  <?php echo $language_fault_status; ?>
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
              <?php $faultAllFaults = new faults();
                    foreach ($faultAllFaults->getAllFaults() as $faults) {
               ?>
              <tr>
                <td>
                  <?php echo $faults->id;?>
                </td>
                <td>
                  <?php echo date("Y-m-d H:i:s", strtotime($faults->date));?>
                </td>
                <td><img style="width: 50px; height: 50px;" src="<?php echo 'http://ict2103group12.tk:3000' . $faults->image;?>"></td>
                <td>
                  <?php echo $faults->location;?>
                </td>
                <td>
                  <?php echo $faults->classroom;?>
                </td>
                <td>
                  <?php echo $faults->description;?>
                </td>
                <td>
                  <?php echo $faults->fixed;?>
                </td>

                <!--TO DO, EDIT BUTTON, DELETE BUTTON. PUT&DELETE REQUEST-->
                <td><button type="button" id="edit_button" data-toggle="modal" data-target="#editFaultModal"><i class="fas fa-edit"></i></button></td>
                <td><button type="button" id="delete_button"><i class="fas fa-trash-alt"></i></button></td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
      <!-- Table data -->
    </div>
  </div>
    


  <div class="container-fluid">
    <!-- Top row -->
    <div class="card mb-3">
      <div class="card-header">
        <i class="fas fa-cloud"></i> Word Cloud
      </div>
      <div class="card-body">
        <div id="wordCloud">
        </div>
        <script>
          <?php 
              $word_cloud = "";
              $faultCloud = new faults();
              foreach ($faultCloud->getFaultCloud() as $cloud) {
                $new_word = str_replace("\n", "", $cloud->name);
                $word_cloud .= $new_word; 
              }
          
              ?>

          var word_java_cloud = '<?php echo $word_cloud; ?>'

          var myConfig = {
            type: 'wordcloud',
            options: {
              text: word_java_cloud
            }
          };

          zingchart.render({
            id: 'wordCloud',
            data: myConfig,
            height: 400,
            width: '100%'
          });
        </script>
      </div>
    </div>
  </div>
  <div class="container-fluid">
    <!-- Top row -->
    <div class="card mb-3">
      <div class="card-header">
        <i class="fas fa-chart-bar"></i> Top 10 Keywords Reported
      </div>
      <div class="card-body">
        <div class="col-md-12">
          <canvas id="myChart"></canvas>
        </div>

        <script>
          var ctx = document.getElementById("myChart").getContext('2d');
          var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
              labels:
                //                 ["Red", "Blue", "Yellow", "Green", "Purple"]
                <?php
                $faultChart = new faults();
                $chart = $faultCloud->getFaultChart();
                echo "[";
                for ($x = 0; $x < 10; $x++){
                  echo '"';
                  echo $chart[$x]->value;
                  echo '"';
                  if ($x <> 10)
                    echo ",";
                }
                echo "]";
                ?>,
              datasets: [{
                label: '# of Word',
                data:
                  //                     [12, 19, 3, 5, 2]
                  <?php
                $faultChart = new faults();
                $chart = $faultCloud->getFaultChart();
                echo "[";
                for ($x = 0; $x < 10; $x++){
                  echo '"';
                  echo $chart[$x]->total;
                  echo '"';
                  if ($x <> 10)
                    echo ",";
                }
                echo "]";
                ?>,
                backgroundColor: [
                  'rgba(255, 99, 132, 0.2)',
                  'rgba(54, 162, 235, 0.2)',
                  'rgba(255, 206, 86, 0.2)',
                  'rgba(75, 192, 192, 0.2)',
                  'rgba(153, 102, 255, 0.2)',
                  'rgba(255, 99, 132, 0.2)',
                  'rgba(54, 162, 235, 0.2)',
                  'rgba(255, 206, 86, 0.2)',
                  'rgba(75, 192, 192, 0.2)',
                  'rgba(153, 102, 255, 0.2)'
                ],
                borderColor: [
                  'rgba(255,99,132,1)',
                  'rgba(54, 162, 235, 1)',
                  'rgba(255, 206, 86, 1)',
                  'rgba(75, 192, 192, 1)',
                  'rgba(153, 102, 255, 1)',
                  'rgba(255,99,132,1)',
                  'rgba(54, 162, 235, 1)',
                  'rgba(255, 206, 86, 1)',
                  'rgba(75, 192, 192, 1)',
                  'rgba(153, 102, 255, 1)'
                ],
                borderWidth: 1
              }]
            },
            options: {
              scales: {
                yAxes: [{
                  ticks: {
                    beginAtZero: true
                  }
                }]
              }
            }
          });
        </script>
      </div>
    </div>
  </div>
  <article id="content-wrapper">
    <?php include 'footer.php' ?>
  </article>
</body>

</html>

<!-- Modal display for EDITING Fault (Stauts)-->
<div id="editFaultModal" class="modal fade">
  <div class="modal-dialog">
    <form method="post" id="std_form" enctype="multipart/form-data">
      <div class="modal-content">
        <div class="modal-header">
          <h4 align="left" class="modal-title">
            <?php echo $language_edit_fault; ?>
          </h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">

          <label for="faultid"><?php echo $language_fault_id; ?></label>
          <input type="text" name="faultid" id="edit_fault_id" class="form-control" disabled/>
          <br />

          <label for="datereported"><?php echo $language_date_reported; ?></label>
          <input type="text" name="datereported" id="edit_fault_datereported" class="form-control" disabled/>
          <br />

          <label for="faultlocation"><?php echo $language_fault_location; ?></label>
          <input type="text" name="faultlocation" id="edit_fault_location" class="form-control" disabled/>
          <br />

          <label for="faultroom"><?php echo $language_fault_room; ?></label>
          <input type="text" name="faultroom" id="edit_fault_room" class="form-control" disabled/>
          <br />

          <label for="faultdes"><?php echo $language_description; ?></label>
          <input type="text" name="faultdes" id="edit_fault_des" class="form-control" disabled/>
          <br />

          <label for="faultstatus"><?php echo $language_fault_status; ?></label>
          <select name="faultstatus" id="edit_fault_status" class="form-control" />
          <option value="0">Not Fixed</option>
          <option value="1">Fixed</option>
          </select>
          <br />

        </div>
        <div class="modal-footer">
          <input type="hidden" name="std_id" id="std_id" />
          <input type="hidden" name="operation" id="operation" />
          <input type="button" name="action" id="btn_edit_fault" class="btn btn-success" value="Edit" />
          <button id="edit_close" type="button" class="btn btn-default" data-dismiss="modal"><?php echo $language_close; ?></button>
        </div>
      </div>
    </form>
  </div>
</div>

<script>
  var table = $('#lostDataTable').DataTable();
  var table = $('#dataTable').DataTable();

  // For edit button to display row results
  $('#dataTable').on('click', 'tbody #edit_button', function() {
    var data_row = table.row($(this).closest('tr')).data();
    $('#edit_fault_id').val(data_row[0]);
    $('#edit_fault_datereported').val(data_row[1]);
    $('#edit_fault_location').val(data_row[3]);
    $('#edit_fault_room').val(data_row[4]);
    $('#edit_fault_des').val(data_row[5]);
    $('#edit_fault_status').val(data_row[6]);
  });

  // Query result to API via ajax
  $('#btn_edit_fault').on('click', function() {
    var id = $('#edit_fault_id').val();
    var fixed = $('#edit_fault_status').val();

    $.ajax({
      url: url_no_port + 'model/faults_process.php?action=updateFaultDetail',
      type: 'post',
      dataType: 'json',
      data: {
        "id": id,
        "fixed": fixed
      },
      success: function(response) {
        alert(response.respond);
        $('#edit_close').trigger('click');
        location.reload();
      }
    })
  });
</script>