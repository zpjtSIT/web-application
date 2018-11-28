<?php include 'base/authentication.php';
      include 'language/dashboard.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'head.php'; ?>
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
                    <a href="#">
                        <?php echo $language_dashboard; ?></a>
                </li>
                <li class="breadcrumb-item active">
                    <?php echo $language_overview; ?>
                </li>
            </ol>
        </section>
    </article>
    <article class="row container-fluid card-deck justify-content-center align-self-center">
        <!--      Attendance KIV      -->
        <!--             <section class="card col-xl-3 col-sm-6 mb-3" style="width: 18rem;">
                <img class="card-img-top" src="image/attendance.jpg" alt="Card image cap" style="height: 170px !important;">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $language_attendance; ?></h5>
                    <p class="card-text"><?php echo $language_attendance_description; ?></p>
                    <a href="#" class="btn btn-primary"><?php echo $language_button; ?></a>
                </div>
            </section> -->
        <section class="card col-xl-3 col-sm-6 mb-3" style="width: 18rem;">
            <img class="card-img-top" src="image/account.jpg" alt="Card image cap" style="height: 170px !important;">
            <div class="card-body">
                <h5 class="card-title">
                    <?php echo $language_account; ?>
                </h5>
                <p class="card-text">
                    <?php echo $language_account_description; ?>
                </p>
                
                <a href="studentaccount.php" class="btn btn-primary" style="width:100%">
                    <?php echo $language_button; ?> Student Account</a> &nbsp;
                <a href="adminaccount.php" class="btn btn-primary" style="width:100%">
                    <?php echo $language_button; ?> Admin Account</a>
                
            </div>
        </section>
        <section class="card col-xl-3 col-sm-6 mb-3" style="width: 18rem;">
            <img class="card-img-top" src="image/clinic.jpg" alt="Card image cap" style="height: 170px !important;">
            <div class="card-body">
                <h5 class="card-title">
                    <?php echo $language_clinic; ?>
                </h5>
                <p class="card-text">
                    <?php echo $language_clinic_description; ?>
                </p>
                <a href="clinic.php" class="btn btn-primary" style="width:100%">
                    <?php echo $language_button; ?></a>
            </div>
        </section>
        <section class="card col-xl-3 col-sm-6 mb-3" style="width: 18rem;">
            <img class="card-img-top" src="image/events.jpg" alt="Card image cap" style="height: 170px !important;">
            <div class="card-body">
                <h5 class="card-title">
                    <?php echo $language_events; ?>
                </h5>
                <p class="card-text">
                    <?php echo $language_events_description; ?>
                </p>
                <a href="event.php" class="btn btn-primary" style="width:100%">
                    <?php echo $language_button; ?></a>
            </div>
        </section>
        <!--      Library KIV      -->
        <!--             <section class="card col-xl-3 col-sm-6 mb-3" style="width: 18rem;">
                <img class="card-img-top" src="image/library.jpg" alt="Card image cap" style="height: 170px !important;">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $language_library; ?></h5>
                    <p class="card-text"><?php echo $language_library_description; ?></p>
                    <a href="#" class="btn btn-primary"><?php echo $language_button; ?></a>
                </div>
            </section> -->
    </article>
    <article class="row container-fluid card-deck justify-content-center align-self-center">
        <section class="card col-xl-3 col-sm-6 mb-3" style="width: 18rem;">
            <img class="card-img-top" src="image/report.jpg" alt="Card image cap" style="height: 170px !important;">
            <div class="card-body">
                <h5 class="card-title">
                    <?php echo $language_reports; ?>
                </h5>
                <p class="card-text">
                    <?php echo $language_reports_description; ?>
                </p>
                <a href="faults.php" class="btn btn-primary" style="width:100%">
                    <?php echo $language_button; ?></a>
            </div>
        </section>
        <!--      Staff KIV      -->
        <!--             <section class="card col-xl-3 col-sm-6 mb-3" style="width: 18rem;">
                <img class="card-img-top" src="image/staff.jpg" alt="Card image cap" style="height: 170px !important;">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $language_staff; ?></h5>
                    <p class="card-text"><?php echo $language_staff_description; ?></p>
                    <a href="#" class="btn btn-primary"><?php echo $language_button; ?></a>
                </div>
            </section> -->
        <section class="card col-xl-3 col-sm-6 mb-3" style="width: 18rem;">
            <img class="card-img-top" src="image/student.jpg" alt="Card image cap" style="height: 170px !important;">
            <div class="card-body">
                <h5 class="card-title">
                    <?php echo $language_student; ?>
                </h5>
                <p class="card-text">
                    <?php echo $language_student_description; ?>
                </p>
                <a href="student.php" class="btn btn-primary" style="width:100%">
                    <?php echo $language_button; ?></a>
            </div>
        </section>
        <section class="card col-xl-3 col-sm-6 mb-3" style="width: 18rem;">
            <img class="card-img-top" src="image/location.jpg" alt="Card image cap" style="height: 170px !important;">
            <div class="card-body">
                <h5 class="card-title">
                    <?php echo $language_location; ?>
                </h5>
                <p class="card-text">
                    <?php echo $language_location_description; ?>
                </p>
                <a href="location.php" class="btn btn-primary" style="width:100%">
                    <?php echo $language_button; ?></a>
            </div>
        </section>
    </article>
    <article id="content-wrapper">
        <?php include 'footer.php' ?>
    </article>
</body>

</html>