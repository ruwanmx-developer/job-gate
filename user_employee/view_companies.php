<!DOCTYPE html>
<html lang="en">
<?php $__siteroot = "."; ?>

<head>
    <title>Active Companies</title>
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
            $admin_menu = "em_m_3";
            $admin_submenu = "em_m_3_1";
            ?>
            <?php include('./components/employee_menu_card.php'); ?>
        </div>

        <!-- middle bar -->
        <div class="col-lg-9 py-3 pe-3 ps-3 ps-lg-0">
            <div class="title-bar card-basic py-2 mb-3">
                ACTIVE COMPANIES
            </div>
            <div class="row gx-3">
                <div class="col-12">
                    <div class="card-basic mb-3">
                        <div class="input-group">
                            <input class="form-control" type="text" name="search_q" onkeyup="adminSearchCompany()"
                                id="search_q" placeholder="Search By Company Name">
                            <!-- <button class="btn btn-search"  type="button"><i class="bi bi-search"></i></button> -->
                        </div>
                    </div>
                    <script>
                    function adminSearchCompany() {
                        let op = document.getElementById('company_wrap');
                        let inp = document.getElementById('search_q').value;

                        let data = new FormData();
                        data.append('search_val', inp);
                        data.append('state', 1);
                        data.append('adminSearchCompany', 'true');

                        var xhttp = new XMLHttpRequest();
                        xhttp.onreadystatechange = function() {
                            if (this.readyState == 4 && this.status == 200) {
                                op.innerHTML = xhttp.responseText;
                            }
                        };
                        xhttp.open("POST", "../function/admin.php", true);
                        xhttp.send(data);
                    }

                    function viewCompanyDetails(x) {
                        window.location.href = './view_company_details.php?id=' + x +
                            "&ref=<?php echo $admin_submenu; ?>";
                    }
                    </script>
                </div>
            </div>
            <div id="company_wrap" class="row gx-3">
                <?php
                $sql = "SELECT a.name, a.logo, a.user_id, b.state, b.email FROM companies a INNER JOIN users b ON a.user_id = b.user_id INNER JOIN follows c ON c.company_id = a.user_id WHERE b.state=1 AND c.user_id='" . $_SESSION['ses_user_id'] . "'";
                $result = $__conn->query($sql);
                $count = 0;
                while ($row = $result->fetch_assoc()) {
                    $count++;
                ?>
                <div class="col-12 col-md-6 col-xl-4">
                    <?php include('components/admin_company_card.php'); ?>
                </div>
                <?php } ?>
                <?php if ($count == 0) { ?>
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
    <?php include($__siteroot . './components/footer.php'); ?>
</body>

</html>