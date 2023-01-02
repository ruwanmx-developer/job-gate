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
            <div class="btn-title">Companies</div>
            <?php include('./components/job_filter_card.php'); ?>
        </div>

        <!-- middle bar -->
        <div id="job-results" class="col-lg-9 py-3 pe-3 ps-3 ps-lg-0">
            <?php
            $sql = "SELECT * FROM companies";
            $result = $__conn->query($sql);
            $count = 0;
            while ($row = $result->fetch_assoc()) {
                $count++;
            ?>
            <?php include('./components/company_card.php'); ?>
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
        <script>
        function followCompany(x) {
            let data = new FormData();
            data.append('id', x);
            data.append('followChange', 'true');

            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    let x = JSON.parse(xhttp.responseText);
                    if (x.code === "code_1") {
                        Swal.fire("Unexpected Error", "Unexpected error occured");
                    } else if (x.code === "code_2") {
                        location.reload();
                    }
                }
            };
            xhttp.open("POST", "./function/company.php", true);
            xhttp.send(data);
        }
        </script>
    </div>
    <?php include('./components/footer.php'); ?>
</body>

</html>