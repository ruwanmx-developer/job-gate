<nav class="navbar navbar-expand-md">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php"><img src="<?php echo $__siteroot; ?>./site_images/logo.png" alt=""></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto marg-b mb-lg-0">
                <?php if (array_key_exists("ses_role_id", $_SESSION)) {
                    if ($_SESSION['ses_role_id'] === '2') { ?>
                <li class="nav-item">
                    <a class="nav-link " href="<?php echo $__siteroot; ?>./jobs.php">Jobssdsad</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $__siteroot; ?>./companies.php">Companies</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Services</a>
                </li>
                <?php }
                } else { ?>
                <li class="nav-item">
                    <a class="nav-link " href="<?php echo $__siteroot; ?>./jobs.php">Jobs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $__siteroot; ?>./companies.php">Companies</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Services</a>
                </li>
                <?php } ?>
            </ul>
            <div class="d-flex">
                <?php if (array_key_exists('ses_email', $_SESSION)) { ?>
                <?php
                    $dashboard = "";
                    $user = "";
                    if ($_SESSION['ses_role_id'] == 1) {
                        $dashboard = "$__siteroot./user_admin/dashboard.php";
                        $user = "Administrator";
                    } else if ($_SESSION['ses_role_id'] == 2) {
                        $dashboard = "$__siteroot./user_employee/dashboard.php";
                        $user = $_SESSION['ses_full_name'];
                    } else if ($_SESSION['ses_role_id'] == 3) {
                        $dashboard = "$__siteroot./user_company/dashboard.php";
                        $user = $_SESSION['ses_company_name'];
                    }
                    ?>
                <a href="<?php echo $dashboard; ?>" class="logout no-link"><?php echo $user; ?></a>
                <a href="<?php echo $__siteroot; ?>./function/authentication.php?logout=true" class="logout no-link">Log
                    Out</a>
                <?php } else { ?>
                <a href="login.php" class="login no-link">Login</a>
                <?php } ?>
            </div>
        </div>
    </div>
</nav>