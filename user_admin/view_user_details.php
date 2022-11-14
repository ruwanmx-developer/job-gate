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

            $admin_menu = "ad_m_1";
            $admin_submenu = $_GET['ref']; 
            ?>
            <?php include('./components/admin_menu_card.php');?>
        </div>

        <!-- middle bar -->
        <div class="col-lg-9 py-3 pe-3 ps-3 ps-lg-0">
            <?php 
            $id = $_GET['id'];
            $sql = "SELECT a.user_id, b.state, a.first_name,a.last_name, a.address, a.image, a.website, a.linkedin, a.mobile, b.email FROM employies a INNER JOIN users b ON a.user_id = b.user_id WHERE a.user_id='$id'";
            $result = $__conn->query($sql);
            $row = $result->fetch_assoc();
            ?>
            <div class="card-basic">
                <div class="row company-view pe-3">
                    <div class="col-12 d-flex justify-content-center mb-3">
                        <div class="img"><img class="logo-shadow img-fluid"
                                src="<?php echo $__siteroot; ?>./uploads/user/<?php echo $row['image']; ?>" alt="">
                        </div>
                    </div>
                    <div class="col-12 text-center">
                        <div class="name"><?php echo $row['first_name'] . " " . $row['last_name'] ; ?></div>
                        <div class="address"><?php echo $row['address']; ?></div>
                        <div class="btn-wrap marg-b">
                            <button class="<?php
                if($row['state'] == 1){
                    echo "btn-red";
                }else if($row['state'] == 2){
                    echo "btn-green";
                } else if($row['state'] == 3){
                    echo "btn-green";
                }?>" onmousedown="changeCompanyState(<?php echo $row['user_id']; ?>,<?php echo ($row['state'] == 1) ? '2' : '1'; ?>)">
                                <?php
                if($row['state'] == 1){
                    echo "Block";
                }else if($row['state'] == 2){
                    echo "Unblock";
                } else if($row['state'] == 3){
                    echo "Verify";
                }?>
                            </button>
                            <button class="btn-green">Message</button>
                        </div>
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
                    <div class="col-12">
                        <hr class="mt-4 mb-4">
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

            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    let x = JSON.parse(xhttp.responseText);
                    if (x.code === "code_1") {
                        swal("Unexpected Error", "Unexpected error caused when blocking the company", "error");
                    } else if (x.code === "code_2") {
                        location.reload();
                    }
                }
            };
            xhttp.open("POST", "../function/admin.php", true);
            xhttp.send(data);
        }
        </script>
    </div>
    <?php include($__siteroot.'./components/footer.php');?>
</body>

</html>