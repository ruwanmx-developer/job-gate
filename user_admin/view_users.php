<!DOCTYPE html>
<html lang="en">
<?php $__siteroot = "."; ?>

<head>
    <title>View Users</title>
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
            $admin_menu = "ad_m_2";
            $admin_submenu = "ad_m_2_1"; 
            ?>
            <?php include('./components/admin_menu_card.php');?>
        </div>

        <!-- middle bar -->
        <div class="col-lg-9 py-3 pe-3 ps-3 ps-lg-0">
            <div class="title-bar card-basic py-2 mb-3">
                VIEW EMPLOYEES
            </div>
            <div class="row gx-3">
                <div class="col-12">
                    <div class="card-basic mb-3">
                        <div class="input-group">
                            <input class="form-control" type="text" name="search_q" onkeyup="adminSearchCompany()"
                                id="search_q" placeholder="Search By Employee Name or Email">
                            <!-- <button class="btn btn-search"  type="button"><i class="bi bi-search"></i></button> -->
                        </div>
                    </div>
                    <script>
                    function adminSearchUser() {
                        let op = document.getElementById('company_wrap');
                        let inp = document.getElementById('search_q').value;

                        let data = new FormData();
                        data.append('search_val', inp);
                        data.append('adminSearchUser', 'true');

                        var xhttp = new XMLHttpRequest();
                        xhttp.onreadystatechange = function() {
                            if (this.readyState == 4 && this.status == 200) {
                                op.innerHTML = xhttp.responseText;
                            }
                        };
                        xhttp.open("POST", "../function/admin.php", true);
                        xhttp.send(data);
                    }

                    function viewUserDetails(x) {
                        window.location.href = './view_user_details.php?id=' + x +
                            "&ref=<?php echo $admin_submenu; ?>";
                    }
                    </script>
                </div>
            </div>
            <div id="company_wrap" class="row gx-3">
                <?php 
                $sql = "SELECT a.first_name, a.image, a.user_id, b.state, b.email FROM employies a INNER JOIN users b ON a.user_id = b.user_id";
                $result = $__conn->query($sql);
                $count = 0;
                while($row = $result->fetch_assoc()) {
                    $count++;
                ?>
                <div class="col-12 col-md-6 col-xl-4">
                    <?php include('components/admin_user_card.php');?>
                </div>
                <?php }?>
                <?php if($count == 0){ ?>
                <div class="d-flex justify-content-center">
                    <div class="empty pt-5">
                        <div class="empty-img">
                            <img src="./img/empty.png" alt="">
                        </div>
                        <div class="empty-message b">
                            Oops! There are no companies to view.
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <?php include($__siteroot.'./components/footer.php');?>
</body>

</html>