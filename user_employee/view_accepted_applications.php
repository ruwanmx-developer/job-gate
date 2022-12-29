<!DOCTYPE html>
<html lang="en">
<?php $__siteroot = "."; ?>

<head>
    <title>View Company</title>
    <!-- include header links -->
    <?php include($__siteroot . './components/header_links.php');?>
</head>

<body>
    <!-- include navigation -->
    <?php include($__siteroot . './components/navigation.php');?>
    <div class="row gx-0">

        <!-- left bar -->
        <div class="col-lg-3 px-3 py-3">
            <div class="btn-title">Employee Manage</div>
            <?php 
            $admin_menu = "em_m_2";
            $admin_submenu = "em_m_2_2"; 
            ?>
            <?php include('./components/employee_menu_card.php');?>
        </div>

        <!-- middle bar -->
        <div class="col-lg-9 py-3 pe-3 ps-3 ps-lg-0">

            <div class="title-bar card-basic py-2 mb-3">
                ACCEPTED APPLICATIONS
            </div>
            <div class="row gx-3">

                <?php 
            $uid = $_SESSION['ses_user_id'];
            $sql = "SELECT * FROM job_applications WHERE user_id='$uid' AND status=2";
            $result = $__conn->query($sql);
            while($row = $result->fetch_assoc()) {
            ?>
                <div class="col-12 col-md-6 col-xl-4">
                    <?php include('components/job_application_card.php');?>
                </div>
                <?php } ?>

            </div>
        </div>
    </div>
    <?php include($__siteroot.'./components/footer.php');?>
</body>

</html>