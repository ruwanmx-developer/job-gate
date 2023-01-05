<!DOCTYPE html>
<html lang="en">
<?php $__siteroot = "."; ?>

<head>
    <title>View Company</title>
    <!-- include header links -->
    <?php include($__siteroot . './components/header_links.php'); ?>
</head>

<body>
    <!-- include navigation -->
    <?php include($__siteroot . './components/navigation.php'); ?>
    <div class="row gx-0">

        <!-- left bar -->
        <div class="col-lg-3 px-3 py-3">
            <div class="btn-title">Employee Manage</div>
            <?php

            $admin_menu = "em_m_1";
            $admin_submenu = "em_m_1_1";
            ?>
            <?php include('./components/employee_menu_card.php'); ?>
        </div>

        <!-- middle bar -->
        <div class="col-lg-9 py-3 pe-3 ps-3 ps-lg-0">
            <?php
            $id = $_SESSION['ses_user_id'];
            $sql = "SELECT a.*, b.* FROM employies a INNER JOIN users b ON a.user_id=b.user_id WHERE a.user_id='$id'";
            $result = $__conn->query($sql);
            $row = $result->fetch_assoc();
            ?>
            <div class="row gx-3">
                <div class="col-12 marg-b">
                    <div class="card-basic">
                        <div class="row company-view pe-3">
                            <div class="col-12 d-flex justify-content-center marg-b">
                                <div class="img"><img class="logo-shadow img-fluid"
                                        src="<?php echo $__siteroot; ?>./uploads/user/<?php echo $row['image']; ?>"
                                        alt="">
                                </div>
                            </div>
                            <div class="col-12 text-center">
                                <div class="name"><?php echo $row['first_name'] . " " . $row['last_name']; ?></div>
                                <div class="special marg-b">
                                    <span><?php echo $row['email']; ?></span>
                                </div>

                                <div class="desc-1"><?php echo $row['description']; ?></div>
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
                                <?php if ($row['gender'] != "") { ?>
                                <div class="special marg-b">
                                    Gender : <span><?php echo $row['gender']; ?></span>
                                </div><?php } ?>
                                <?php if ($row['address'] != "") { ?>
                                <div class="special marg-b">
                                    Home Address : <span><?php echo $row['address']; ?></span>
                                </div><?php } ?>
                                <?php if ($row['birthday'] != "") { ?>
                                <div class="special">
                                    Birthday : <span><?php echo $row['birthday']; ?></span>
                                </div><?php } ?>
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
                                <?php
                                $sql = "SELECT * FROM educations WHERE user_id='$id'";
                                $result = $__conn->query($sql);
                                while ($row = $result->fetch_assoc()) {
                                    include('./components/education_card.php');
                                } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 marg-b">
                    <div class="card-basic marg-b pad-b-0">
                        <div class="profile-title marg-b marg-t-0">Work Experience</div>
                        <div class="row company-view ">
                            <div class="col-12 text-center">
                                <?php
                                $sql = "SELECT * FROM educations WHERE user_id='$id'";
                                $result = $__conn->query($sql);
                                while ($row = $result->fetch_assoc()) {
                                    include('./components/education_card.php');
                                } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include($__siteroot . './components/footer.php'); ?>
</body>

</html>