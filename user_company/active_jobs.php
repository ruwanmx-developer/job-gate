<!DOCTYPE html>
<html lang="en">
<?php $__siteroot = "."; ?>

<head>
    <title>Active Jobs</title>
    <!-- include header links -->
    <?php include($__siteroot . './components/header_links.php'); ?>
</head>

<body>
    <!-- include navigation -->
    <?php include($__siteroot . './components/navigation.php'); ?>
    <div class="row gx-0">

        <!-- left bar -->
        <div class="col-lg-3 px-3 py-3">
            <div class="btn-title">System Manage</div>
            <?php
            $admin_menu = "co_m_2";
            $admin_submenu = "co_m_2_2";
            ?>
            <?php include('./components/company_menu_card.php'); ?>
        </div>

        <!-- middle bar -->
        <div class="col-lg-9 py-3 pe-3 ps-3 ps-lg-0">
            <div class="title-bar card-basic py-2 mb-3">
                MANAGE CURRENT ACTIVE JOBS
            </div>
            <div class="row gx-3">
                <div class="col-12">
                    <div class="card-basic mb-3">
                        <div class="input-group">
                            <input class="form-control" type="text" name="search_q" onkeyup="companySearchJobs()"
                                id="search_q" placeholder="Search By Job Title">
                            <!-- <button class="btn btn-search"  type="button"><i class="bi bi-search"></i></button> -->
                        </div>
                    </div>
                    <script>
                    function companySearchJobs() {
                        let op = document.getElementById('company_wrap');
                        let inp = document.getElementById('search_q').value;

                        let data = new FormData();
                        data.append('search_val', inp);
                        data.append('state', 1);
                        data.append('companySearchJobs', 'true');

                        var xhttp = new XMLHttpRequest();
                        xhttp.onreadystatechange = function() {
                            if (this.readyState == 4 && this.status == 200) {
                                op.innerHTML = xhttp.responseText;
                            }
                        };
                        xhttp.open("POST", "../function/company.php", true);
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
                $sql = "SELECT a.id, a.title, b.name AS category, a.description,a.created_at, c.name AS salary_type, a.salary FROM jobs a INNER JOIN job_categories b ON a.job_category_id = b.id INNER JOIN salary_types c ON a.salary_type_id = c.id WHERE state=1 AND user_id='" . $_SESSION['ses_user_id'] . "'";
                $result = $__conn->query($sql);
                $count = 0;
                while ($row = $result->fetch_assoc()) {
                    $count++;
                ?>
                <div class="col-12 col-md-6 col-xl-4">
                    <?php include('components/job_card.php'); ?>
                </div>
                <?php } ?>
                <?php if ($count == 0) { ?>
                <div class="d-flex justify-content-center">
                    <div class="empty pt-5">
                        <div class="empty-img">
                            <img src="https://cdn-icons-png.flaticon.com/512/4076/4076402.png" alt="">
                        </div>
                        <div class="empty-message b">
                            We didn't find any results
                        </div>
                        <div class="empty-message r">
                            Make sure that everything is spelt correctly or try different keywords.
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