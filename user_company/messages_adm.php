<!DOCTYPE html>
<html lang="en">
<?php $__siteroot = "."; ?>

<head>
    <title>Admin Dashboard</title>
    <!-- include header links -->
    <?php include('../components/header_links.php'); ?>
</head>

<body>
    <!-- include navigation -->
    <?php include('../components/navigation.php'); ?>
    <div class="row gx-0">

        <!-- left bar -->
        <div class="col-lg-3 px-3 py-3">
            <div class="btn-title">System Manage</div>
            <?php
            $admin_menu = "co_m_4";
            $admin_submenu = "co_m_4_2";
            ?>
            <?php include('./components/company_menu_card.php'); ?>
        </div>

        <!-- middle bar -->
        <div class="col-lg-9 py-3 pe-3 ps-3 ps-lg-0">
            <div class="title-bar card-basic py-2 mb-3">
                SEND MESSAGES
            </div>
            <div class="row gx-3">
                <?php
                $user_image = "../site_images/admin.png";
                $user_id = $_SESSION['ses_user_id'];
                $sql = "SELECT * FROM users WHERE role_id=1";
                $result = $__conn->query($sql);
                $name = "";
                $nid = "";
                while ($row = $result->fetch_assoc()) {
                    $name = $row['email'];
                    $nid = $row['user_id'];
                    $image = "../site_images/user.png";
                ?>
                    <div class="col-4">
                        <a class="no-link" href="send_adm_message.php?id=<?php echo $nid; ?>">
                            <div class="card-basic message_contact_card mb-3">
                                <div class="img-wrap">
                                    <img src="<?php echo $image ?>" alt="">
                                </div>
                                <div class="data">
                                    <div class="name"><?php echo $name; ?></div>
                                </div>

                            </div>
                        </a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <?php include('../components/footer.php'); ?>
</body>

</html>