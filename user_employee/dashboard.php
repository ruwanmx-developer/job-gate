<!DOCTYPE html>
<html lang="en">
<?php $__siteroot = "."; ?>

<head>
    <title>Company Dashboard</title>
    <!-- include header links -->
    <?php include('../components/header_links.php');?>
</head>

<body>
    <!-- include navigation -->
    <?php include('../components/navigation.php');?>
    <div class="row gx-0">

        <!-- left bar -->
        <div class="col-lg-3 px-3 py-3">
            <div class="btn-title">Employee Manage</div>
            <?php $admin_menu = $admin_submenu = ""; ?>
            <?php include('components/employee_menu_card.php');?>
        </div>

        <!-- middle bar -->
        <div class="col-lg-9 py-3 pe-3 ps-3 ps-lg-0">
            <div class="row gx-3">

            </div>
        </div>
    </div>
    <?php include('../components/footer.php');?>
</body>

</html>