<!DOCTYPE html>
<html lang="en">
<?php $__siteroot = "."; ?>
<?php include_once($__siteroot . "./database/database_config.php"); ?>
<?php
$id = $_GET['id'];
$sql = "SELECT a.user_id, b.state, a.name, a.address, a.description, a.logo, a.website, a.linkedin, a.mobile, b.email FROM companies a INNER JOIN users b ON a.user_id = b.user_id WHERE a.user_id='$id'";
$result = $__conn->query($sql);
$row = $result->fetch_assoc();
?>

<head>
    <title>View Company</title>
    <!-- include header links -->
    <?php include($__siteroot . './components/header_links.php'); ?>
</head>

<body onload="window.print()">
    <!-- middle bar -->
    <div class=" py-3 pe-3 ps-3 ps-lg-0" id="content_report">

        <div class="card-basic">
            <div class="row company-view gx-3">
                <div class="col-12 d-flex justify-content-center mb-3">
                    <div class="img"><img class="logo-shadow img-fluid"
                            src="<?php echo $__siteroot; ?>./uploads/user/<?php echo $row['logo']; ?>" alt=""></div>
                </div>
                <div class="col-12 text-center">
                    <div class="name"><?php echo $row['name']; ?></div>
                    <div class="address"><?php echo $row['address']; ?></div>
                    <div class="desc-1 mt-2 mb-3"><?php echo $row['description']; ?></div>

                    <div class="special mb-2">
                        Email : <span><?php echo $row['email']; ?></span>
                    </div>
                    <?php if (!empty($row['website'])) { ?>
                    <div class="special mb-2">
                        Website : <span><?php echo $row['website']; ?></span>
                    </div>
                    <?php } ?>
                    <?php if (!empty($row['linkedin'])) { ?>
                    <div class="special mb-2">
                        LinkedIn : <span><?php echo $row['linkedin']; ?></span>
                    </div>
                    <?php } ?>
                    <?php if (!empty($row['mobile'])) { ?>
                    <div class="special mb-2">
                        Mobile : <span><?php echo $row['mobile']; ?></span>
                    </div>
                    <?php } ?>
                </div>
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
            </div>
            <div class="col-3">
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
    <script>
    function changeCompanyState(x, y) {

        let data = new FormData();
        data.append('id', x);
        data.append('state', y);
        data.append('change_company_state', 'true');

        Swal.fire({
            title: "Sending Email...",
            text: "Please wait",
            icon: "./site_images/loading.gif",
            showCloseButton: false,
            showCancelButton: false,
            showConfirmButton: false,
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: false
        });

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                let x = JSON.parse(xhttp.responseText);
                if (x.code === "code_1") {
                    Swal.fire("Unexpected Error", "Unexpected error caused when blocking the company", "error");

                } else if (x.code === "code_2") {
                    Swal.fire("Email Sent", "The state change notification has sent to the company.",
                        "success").then((value) => {
                        location.reload();
                    });

                }
            }
        };
        xhttp.open("POST", "../function/admin.php", true);
        xhttp.send(data);
    }
    </script>
</body>

</html>