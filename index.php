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
        <div class="col-12 col-lg-6">
            <div class="jumb-wrap d-flex align-items-center">
                <div class="jumb">
                    <div class="title">
                        Find your dream job within seconds
                    </div>
                    <div class="desc">Welcome to our job portal! We are excited to connect talented job seekers with top
                        companies around the globe. Our job portal is designed to make the job search process easy and
                        efficient for both job seekers and employers.

                        Job seekers can search for job opportunities based on location, job title, and industry, and can
                        easily apply for jobs with just a few clicks. Our platform also allows job seekers to upload
                        their resumes, cover letters, and other documents to help make their applications stand out.

                    </div>
                    <div class="desc">Employers can use our job portal to post job openings and search for qualified
                        candidates. Our
                        platform makes it easy for employers to manage job postings, review applications, and
                        communicate with potential hires.</div>
                    <div class="btn-wrap-left">
                        <a type="button" class="btn btn-green">How It Works</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="login-select-wrap d-flex align-items-center justify-content-center">
                <div class="login">
                    <a class="no-link" href="signing_e.php">
                        <div class="login-card d-flex">
                            <div class="text">Employee Sign Up</div>
                            <div class="icon">
                                <i class="bi bi-chevron-double-right"></i>
                            </div>
                        </div>
                    </a>
                    <a class="no-link" href="signing_c.php">
                        <div class="login-card d-flex">
                            <div class="text">Company Sign Up</div>
                            <div class="icon">
                                <i class="bi bi-chevron-double-right"></i>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <?php include('./components/footer.php'); ?>
</body>

</html>