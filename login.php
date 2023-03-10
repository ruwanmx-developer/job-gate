<!DOCTYPE html>
<html lang="en">
<?php $__siteroot = ""; ?>

<head>
    <title>Job Gate</title>
    <?php include('./components/header_links.php'); ?>
    <script type="text/javascript" src="./js/md5.js"></script>
</head>

<body>
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
        <div class="col-12 col-lg-6 login-form">
            <div class="form">
                <h3 class="mb-4">Log In</h3>
                <div class="form-area">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <input type="text" id="email" class="form-control" placeholder="Email Address">
                        </div>
                        <div class="col-12 mb-3">
                            <input type="password" id="password" class="form-control" placeholder="Password">
                        </div>
                        <div class="col-12 marg-b">
                            <button onclick="user_login()" class="btn btn-primary" name="user_login">Login <i
                                    class="bi bi-box-arrow-right"></i></button>
                        </div>
                        <div class="sep-link marg-t">Forgot your password ? <a class="no-link"
                                href="forgot_password.php">Click
                                here</a>
                        </div>
                        <div class="sep-link">Don't have an account ? <a class="no-link" href="signing_e.php">Sign Up
                                here</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include('./components/footer.php'); ?>
        <script>
        function user_login() {
            let email = document.getElementById("email").value;
            let password = document.getElementById("password").value;
            let enc_pass = md5(password);

            const pattern = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

            if (email === "") {
                Swal.fire("Empty Field", "Please enter your email address to continue", "warning");
                return;
            }
            if (!(pattern.test(email))) {
                Swal.fire("Invalid field", email + " is not an valid email address. Enter a valid email address",
                    "error");
                return false;
            }
            if (password === "") {
                Swal.fire("Empty Field", "Please enter your password to continue", "warning");
                return;
            }

            let data = new FormData();
            data.append('email', email);
            data.append('password', enc_pass);
            data.append('user_login', 'true');

            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    let x = JSON.parse(xhttp.responseText);
                    if (x.code === "code_1") {
                        Swal.fire({
                            title: 'Unregisterd Email',
                            icon: 'error',
                            html: '<b>' + email + '</b> address in not registerd in our database',
                        })
                    } else if (x.code === "code_2") {
                        Swal.fire({
                            title: 'Wrong Password',
                            icon: 'error',
                            html: 'The password you enter is not the valid password',
                        })
                    } else if (x.code === "code_3") {
                        Swal.fire({
                            title: 'Login Successfull',
                            icon: 'success',
                            html: 'Successfull',
                        }).then((value) => {
                            if (x.role == 1) {
                                document.location.href = "./user_admin/dashboard.php";
                            }
                            if (x.role == 2) {
                                document.location.href = "./user_employee/dashboard.php";
                            }
                            if (x.role == 3) {
                                document.location.href = "./user_company/dashboard.php";
                            }
                        });
                    }
                }
            };
            xhttp.open("POST", "./function/authentication.php", true);
            xhttp.send(data);
        }
        </script>
</body>

</html>