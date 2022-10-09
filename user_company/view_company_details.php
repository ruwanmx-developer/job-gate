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
            <div class="btn-title">System Manage</div>
            <?php 

            $admin_menu = "co_m_1";
            $admin_submenu = "co_m_1_1"; 
            ?>
            <?php include('./components/company_menu_card.php');?>
        </div>

        <!-- middle bar -->
        <div class="col-lg-9 py-3 pe-3 ps-3 ps-lg-0">
            <?php 
            $id = $_SESSION['ses_user_id'];
            $sql = "SELECT a.user_id, b.state, a.name, a.address, a.description, a.logo, a.website, a.linkedin, a.mobile, b.email FROM companies a INNER JOIN users b ON a.user_id = b.user_id WHERE a.user_id='$id'";
            $result = $__conn->query($sql);
            $row = $result->fetch_assoc();
            ?>
            <div class="card-basic">
                <div class="row company-view pe-3">
                    <div class="col-12 d-flex justify-content-center mb-3">
                        <div class="img"><img class="logo-shadow img-fluid"
                                src="<?php echo $__siteroot; ?>./uploads/user/<?php echo $row['logo']; ?>" alt=""></div>
                    </div>
                    <div class="col-12 text-center">
                        <div class="name"><?php echo $row['name']; ?></div>
                        <div class="address"><?php echo $row['address']; ?></div>
                        <div class="desc-1 marg-b"><?php
                if($row['state'] == 1){
                    echo "Active";
                }else if($row['state'] == 2){
                    echo "Blocked";
                } else if($row['state'] == 3){
                    echo "Submitted for Verify";
                }?></div>
                        <div class="desc-1 mb-3"><?php echo $row['description']; ?></div>
                        <div class="special mb-2">
                            Email : <span><?php echo $row['email']; ?></span>
                        </div>
                        <?php if(!empty($row['website'])){?>
                        <div class="special mb-2">
                            Website : <span><?php echo $row['website']; ?></span>
                        </div>
                        <?php } ?>
                        <?php if(!empty($row['linkedin'])){?>
                        <div class="special mb-2">
                            LinkedIn : <span><?php echo $row['linkedin']; ?></span>
                        </div>
                        <?php } ?>
                        <?php if(!empty($row['mobile'])){?>
                        <div class="special mb-2">
                            Mobile : <span><?php echo $row['mobile']; ?></span>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <hr>
                    </div>
                </div>
                <div class="row gx-3 gy-3">
                    <div class="col-3">
                        <div class="card-basic dashboard-card">
                            <div class="li-desc">Posted Jobs Count</div>
                            <div class="result">
                                <?php 
                            $sql = "SELECT COUNT(*) AS count FROM jobs WHERE user_id='$id'";
                            $result = $__conn->query($sql);
                            $row = $result->fetch_assoc();
                            echo $row['count'];
                            ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-3">
                        <a href="active_jobs.php" class="no-link">
                            <div class="card-basic dashboard-card">
                                <div class="li-desc">Active Jobs Count</div>
                                <div class="result">
                                    <?php 
                            $sql = "SELECT COUNT(*) AS count FROM jobs WHERE user_id='$id' AND state=1";
                            $result = $__conn->query($sql);
                            $row = $result->fetch_assoc();
                            echo $row['count'];
                            ?>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-3">
                        <a href="closed_jobs.php" class="no-link">
                            <div class="card-basic dashboard-card">
                                <div class="li-desc">Closed Jobs Count</div>
                                <div class="result">
                                    <?php 
                            $sql = "SELECT COUNT(*) AS count FROM jobs WHERE user_id='$id' AND state=2";
                            $result = $__conn->query($sql);
                            $row = $result->fetch_assoc();
                            echo $row['count'];
                            ?>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-3">
                        <div class="card-basic dashboard-card">
                            <div class="li-desc">Followers</div>
                            <div class="result">
                                <?php 
                            $sql = "SELECT COUNT(*) AS count FROM follows WHERE company_id='$id'";
                            $result = $__conn->query($sql);
                            $row = $result->fetch_assoc();
                            echo $row['count'];
                            ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include($__siteroot.'./components/footer.php');?>
</body>

</html>