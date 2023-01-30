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
        <div class="col-12 col-lg-6 signup-form">
            <div class="form">
                <h3 class="mb-4">Employee Sign Up</h3>
                <div class="form-area">
                    <div class="row">
                        <div class="sep-link my-1">Authentication Details</div>
                        <div class="col-12 marg-b">
                            <input type="text" id="email" class="form-control" autocomplete="new-password"
                                placeholder="Email Address">
                        </div>
                        <div class="col-12 marg-b">
                            <input type="password" id="password" autocomplete="new-password" class="form-control"
                                placeholder="Password">
                        </div>
                        <div class="col-12 marg-b">
                            <input type="password" id="cpassword" class="form-control" placeholder="Confirm Password">
                        </div>
                        <hr class="mt-3">
                        <div class="sep-link marg-b">Employee Details</div>
                        <!-- image upload start -->
                        <div class="col-12  marg-b d-flex justify-content-center">
                            <label for="upload_image">
                                <div class="form-control upload text-center">
                                    <img class="upload-img" src="site_images/user.png" alt="">
                                </div>
                                <input type="file" name="upload_image" id="upload_image" class="d-none">
                            </label>
                        </div>
                        <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title crop-title">Crop Image Before Upload</h5>
                                    </div>
                                    <div class="modal-body">
                                        <div class="img-container">
                                            <div class="row">
                                                <div class="col-12">
                                                    <img src="" id="sample_image" />
                                                </div>
                                                <div class="col-12 mt-3 d-flex justify-content-center">
                                                    <div class="preview marg-r"></div>
                                                    <div class="preview r marg-l"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" id="crop" class="btn btn-crop">Crop</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script>
                        var uploaded_image = "";
                        $(document).ready(function() {
                            var $modal = $('#modal');
                            var image = document.getElementById('sample_image');
                            var cropper;
                            $('#upload_image').change(function(event) {
                                var files = event.target.files;
                                var done = function(url) {
                                    image.src = url;
                                    $modal.modal('show');
                                };
                                if (files && files.length > 0) {
                                    reader = new FileReader();
                                    reader.onload = function(event) {
                                        done(reader.result);
                                    };
                                    reader.readAsDataURL(files[0]);
                                }
                            });
                            $modal.on('shown.bs.modal', function() {
                                cropper = new Cropper(image, {
                                    aspectRatio: 1,
                                    viewMode: 3,
                                    dragMode: 'move',
                                    preview: '.preview'
                                });
                            }).on('hidden.bs.modal', function() {
                                cropper.destroy();
                                cropper = null;
                            });
                            $('#crop').click(function() {
                                canvas = cropper.getCroppedCanvas({
                                    width: 200,
                                    height: 200
                                });
                                var dataURL = canvas.toDataURL("image/png");
                                console.log(dataURL);
                                uploaded_image = dataURL;
                                $('.upload-img').attr('src', dataURL);
                                $modal.modal('hide');
                            });

                        });
                        </script>
                        <!-- image upload end -->
                        <div class="col-12 marg-b">
                            <input type="text" id="fname" class="form-control" placeholder="First Name">
                        </div>
                        <div class="col-12 marg-b">
                            <input type="text" id="lname" class="form-control" placeholder="Last Name">
                        </div>

                        <div class="col-12 marg-b">
                            <button onclick="emp_signup()" class="btn btn-primary" name="user_login">Sign Up <i
                                    class="bi bi-box-arrow-right"></i>
                            </button>
                        </div>
                        <div class="sep-link marg-t">Already have an account ? <a class="no-link" href="login.php">Login
                                here</a></div>
                        <div class="sep-link">Switch account type to company <a class="no-link"
                                href="signing_c.php">Click here</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include('./components/footer.php'); ?>
    <script>
    function emp_signup() {
        let email = document.getElementById("email").value;
        let password = document.getElementById("password").value;
        let cpassword = document.getElementById("cpassword").value;
        let fname = document.getElementById("fname").value;
        let lname = document.getElementById("lname").value;
        let enc_pass = md5(password);

        const name_pattern = /^[A-Z a-z]+$/;
        const email_pattern = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

        if (email === "") {
            Swal.fire("Empty Field", "Please enter your email address to continue", "warning");
            return;
        }
        if (!(email_pattern.test(email))) {
            Swal.fire("Invalid field", email + " is not an valid email address. Enter a valid email address", "error");
            return;
        }
        if (password === "") {
            Swal.fire("Empty Field", "Please enter your password to continue", "warning");
            return;
        }
        if (!(password_pattern.test(password))) {
            Swal.fire("Invalid field",
                "Entered password is week(Add at least one symbol, one capital letter, one number)", "error");
            return;
        }
        if (cpassword === "") {
            Swal.fire("Empty Field", "Please confirm your password to continue", "warning");
            return;
        }
        if (cpassword !== password) {
            Swal.fire("Invalid Field", "Passwords doesn't match", "error");
            return;
        }
        if (fname === "") {
            Swal.fire("Empty Field", "Please enter your first name to continue", "warning");
            return;
        }
        if (!(name_pattern.test(fname))) {
            Swal.fire("Invalid field", fname + " is not a valid name. Enter a valid name", "error");
            return;
        }
        if (lname === "") {
            Swal.fire("Empty Field", "Please enter your last name to continue", "warning");
            return;
        }
        if (!(name_pattern.test(lname))) {
            Swal.fire("Invalid field", fname + " is not a valid name. Enter a valid name", "error");
            return;
        }
        if (uploaded_image === "") {
            Swal.fire("Empty Field", "Please enter your profle image to continue", "warning");
            return;
        }

        let data = new FormData();
        data.append('email', email);
        data.append('fname', fname);
        data.append('lname', lname);
        data.append('password', enc_pass);
        data.append('image', uploaded_image);
        data.append('emp_signup', 'true');

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                let x = JSON.parse(xhttp.responseText);
                if (x.code === "code_1") {
                    Swal.fire("Existing Email", email + " address is already registerd in our database", "error");
                } else if (x.code === "code_2") {
                    Swal.fire("Unexpected Error", "Unexpected error caused when creating the users", "error");
                } else if (x.code === "code_3") {
                    Swal.fire("Sign Up Successfull", "Successfull", "success").then((value) => {
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