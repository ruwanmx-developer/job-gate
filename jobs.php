<!DOCTYPE html>
<html lang="en">
<?php $__siteroot = ""; ?>

<head>
    <title>Job Gate</title>
    <!-- include header links -->
    <?php include('./components/header_links.php'); ?>
</head>

<body>
    <!-- include navigation -->
    <?php include('./components/navigation.php'); ?>
    <div class="row gx-0">

        <!-- left bar -->
        <div class="col-lg-3 px-3 py-3">

            <div class="btn-title">Filter Jobs</div>
            <?php include('./components/job_filter_card.php'); ?>



        </div>

        <!-- middle bar -->
        <div id="job-results" class="col-lg-9 py-3 pe-3 ps-3 ps-lg-0">
            <?php
            $sql = "SELECT a.id, a.title, b.name AS category, a.description, a.salary, g.name AS salary_type, f.user_id AS company_id, f.name AS company, d.district, e.name FROM jobs a INNER JOIN job_categories b ON a.job_category_id = b.id INNER JOIN districts d ON a.district_id = d.id INNER JOIN job_types e ON a.job_type_id = e.id INNER JOIN companies f ON a.user_id = f.user_id INNER JOIN salary_types g ON a.salary_type_id = g.id";
            $result = $__conn->query($sql);
            $count = 0;
            while ($row = $result->fetch_assoc()) {
                $count++;
            ?>
            <?php include('./components/job_card.php'); ?>
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
    <?php include('./components/footer.php'); ?>
    <script>
    function check_auth(y) {
        let data = new FormData();
        data.append('check_auth', 'true');

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                let x = JSON.parse(xhttp.responseText);
                if (x.code === "code_1") {
                    apply_job(y);
                } else if (x.code === "code_2") {
                    Swal.fire("Login Required",
                        "You have to logged to the system to apply for jobs", "warning");
                }
            }
        };
        xhttp.open("POST", "./function/authentication.php", true);
        xhttp.send(data);
    }

    function apply_job(x) {
        let data = new FormData();
        data.append('id', x);
        data.append('apply_job', 'true');

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                let x = JSON.parse(xhttp.responseText);
                if (x.code === "code_1") {
                    Swal.fire("Job Applied Already",
                        "You have applied this job already. Wait until company responds.",
                        "warning");
                } else if (x.code === "code_2") {
                    Swal.fire("Job Applied",
                        "You have applied for the job. Usually it takes 2 business days to take actions.",
                        "success");
                } else if (x.code === "code_3") {
                    Swal.fire("Unexpected Error", "Unexpected error caused when applying the job", "error");
                }
            }
        };
        xhttp.open("POST", "./function/job.php", true);
        xhttp.send(data);
    }
    </script>
</body>

</html>