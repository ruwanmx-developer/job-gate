<!DOCTYPE html>
<html lang="en">
<?php $__siteroot = "."; ?>
<?php include_once($__siteroot . "./database/database_config.php"); ?>
<?php

$id = $_GET['id'];
$sql = "SELECT a.*, b.* FROM employies a INNER JOIN users b ON a.user_id=b.user_id WHERE a.user_id='$id'";
$result = $__conn->query($sql);
$row = $result->fetch_assoc();
?>

<head>
    <title><?php echo $row['first_name'] . " " . $row['last_name']; ?></title>
    <!-- include header links -->
    <?php include($__siteroot . './components/header_links.php'); ?>
</head>

<body onload="window.print()">

    <!-- middle bar -->
    <div class=" py-3 pe-3 ps-3 ps-lg-0" id="content_report">

        <div class="row gx-3">
            <div class="col-12 marg-b">
                <div class="card-basic">
                    <div class="row company-view pe-3">
                        <div class="col-12 d-flex justify-content-center marg-b">
                            <div class="img"><img class="logo-shadow img-fluid"
                                    src="<?php echo $__siteroot; ?>./uploads/user/<?php echo $row['image']; ?>" alt="">
                            </div>
                        </div>
                        <div class="col-12 text-center">
                            <div class="name"><?php echo $row['first_name'] . " " . $row['last_name']; ?></div>
                            <div class="special marg-b">
                                <span><?php echo $row['email']; ?></span>
                            </div>

                            <div class="desc-1 marg-b"><?php echo $row['description']; ?></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 marg-b">
                <div class="card-basic">
                    <div class="profile-title marg-b marg-t-0">Personal Details</div>
                    <div class="row company-view pe-3">
                        <div class="col-12 text-center">
                            <div class="special marg-b">
                                First Name : <span><?php echo $row['first_name']; ?></span>
                            </div>
                            <div class="special marg-b">
                                Last Name : <span><?php echo $row['last_name']; ?></span>
                            </div>
                            <div class="special marg-b">
                                Gender : <span><?php echo $row['gender']; ?></span>
                            </div>
                            <div class="special marg-b">
                                Home Address : <span><?php echo $row['address']; ?></span>
                            </div>
                            <div class="special">
                                Birthday : <span><?php echo $row['birthday']; ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 marg-b">
                <div class="card-basic">
                    <div class="profile-title marg-b marg-t-0">Contact Details</div>
                    <div class="row company-view pe-3">
                        <div class="col-12 text-center">
                            <?php if (!empty($row['website'])) { ?>
                            <div class="special marg-b">
                                Website : <span><?php echo $row['website']; ?></span>
                            </div>
                            <?php } ?>
                            <?php if (!empty($row['linkedin'])) { ?>
                            <div class="special marg-b">
                                LinkedIn : <span><?php echo $row['linkedin']; ?></span>
                            </div>
                            <?php } ?>
                            <?php if (!empty($row['github'])) { ?>
                            <div class="special marg-b">
                                Github : <span><?php echo $row['github']; ?></span>
                            </div>
                            <?php } ?>
                            <?php if (!empty($row['mobile'])) { ?>
                            <div class="special">
                                Mobile : <span><?php echo $row['mobile']; ?></span>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 marg-b">
                <div class="card-basic pad-b-0">
                    <div class="profile-title marg-b marg-t-0">Skills</div>
                    <div class="row company-view">
                        <div class="col-12 text-center">
                            <?php if (!empty($row['skills'])) { ?>
                            <div class="special d-flex justify-content-center">
                                <?php
                                    $str_arr = explode(",", $row['skills']);
                                    foreach ($str_arr as $x) {
                                        echo "<div class=\"skill-tag\">$x</div>";
                                    }
                                    ?>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 marg-b">
                <div class="card-basic pad-b-0">
                    <div class="profile-title marg-b marg-t-0">Educational Qualifications</div>
                    <div class="row company-view ">
                        <div class="col-12 text-center">
                            <?php if (!empty($row['education'])) { ?>
                            <div class="special marg-b">
                                <?php echo $row['education']; ?>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 marg-b">
                <div class="card-basic marg-b pad-b-0">
                    <div class="profile-title marg-b marg-t-0">Work Experience</div>
                    <div class="row company-view ">
                        <div class="col-12 text-center">
                            <?php if (!empty($row['work'])) { ?>
                            <div class="special marg-b">
                                <?php echo $row['work']; ?>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>