<!DOCTYPE html>
<html lang="en">

<head>
    <title>Job Gate</title>
    <?php include('./components/header_links.php');?>
    <script type="text/javascript" src="./js/md5.js"></script>
    <script type="text/javascript" src="./js/validationPatterns.js"></script>
</head>

<body>
    <?php include('./components/navigation.php');?>
    <div class="row gx-0">
        <div class="col-12 col-lg-6">
            <div class="jumb-wrap d-flex align-items-center">
                <div class="jumb">
                    <div class="title">
                        Find your dream job within seconds
                    </div>
                    <div class="desc">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque accusamus eligendi
                        nam dolor alias harum consequatur ullam enim veritatis! Harum, accusamus doloribus! Vitae, ullam
                        eaque vero debitis nihil exercitationem? Consequuntur? Lorem ipsum dolor sit amet, consectetur
                        adipisicing elit. Laboriosam tempora non voluptatibus accusamus vero praesentium voluptate
                        recusandae similique distinctio fugiat ullam iste aspernatur, voluptatum, harum ducimus
                        excepturi minima eligendi saepe?</div>
                    <div class="desc">Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptate hic dolorem
                        optio odit nobis facere quam natus rem eius eaque sunt adipisci, quaerat dolorum repellendus
                        asperiores reiciendis inventore in est!</div>
                    <div class="btn-wrap-left">
                        <a type="button" class="btn btn-green">How It Works</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6 signup-form">
            <div class="form">
                <h3 class="mb-4">Company Sign Up</h3>
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
                        <div class="sep-link marg-b">Company Details</div>
                        <!-- image upload start -->
                        <div class="col-12  marg-b d-flex justify-content-center">
                            <label for="upload_image">
                                <div class="form-control upload text-center">
                                    <img class="upload-img" src="site_images/home.png" alt="">
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
                            <input type="text" id="cname" class="form-control" placeholder="Company Name">
                        </div>
                        <div class="col-12 marg-b">
                            <input type="text" id="caddress" class="form-control" placeholder="Company Address">
                        </div>
                        <div class="col-12 marg-b">
                            <input type="text" id="description" class="form-control" placeholder="Description">
                        </div>

                        <div class="col-12 marg-b">
                            <button onclick="emp_signup()" class="btn btn-primary" name="user_login">Sign Up <i
                                    class="bi bi-box-arrow-right"></i>
                            </button>
                        </div>
                        <div class="sep-link marg-t">Already have an account ? <a class="no-link" href="login.php">Login
                                here</a>
                        </div>
                        <div class="sep-link">Switch account type to employee <a class="no-link"
                                href="signing_e.php">Click here</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include('./components/footer.php');?>
    <script>
    function emp_signup() {
        let email = document.getElementById("email").value;
        let password = document.getElementById("password").value;
        let cpassword = document.getElementById("cpassword").value;
        let cname = document.getElementById("cname").value;
        let caddress = document.getElementById("caddress").value;
        let description = document.getElementById("description").value;
        let enc_pass = md5(password);

        if (email === "") {
            swal("Empty Field", "Please enter your email address to continue", "warning");
            return;
        }
        if (!(email_pattern.test(email))) {
            swal("Invalid field", email + " is not an valid email address. Enter a valid email address", "error");
            return;
        }
        if (password === "") {
            swal("Empty Field", "Please enter your password to continue", "warning");
            return;
        }
        if (cpassword === "") {
            swal("Empty Field", "Please confirm your password to continue", "warning");
            return;
        }
        if (cpassword !== password) {
            swal("Invalid Field", "Passwords doesn't match", "error");
            return;
        }
        if (cname === "") {
            swal("Empty Field", "Please enter your company name to continue", "warning");
            return;
        }
        if (!(cname_pattern.test(cname))) {
            swal("Invalid field", cname + " is not a valid company name. Enter a valid company name", "error");
            return;
        }
        if (caddress === "") {
            swal("Empty Field", "Please enter your company address to continue", "warning");
            return;
        }
        if (!(address_pattern.test(caddress))) {
            swal("Invalid field", caddress + " is not a valid company address. Enter a valid company address",
                "error");
            return;
        }
        if (description === "") {
            swal("Empty Field", "Please enter your company description to continue", "warning");
            return;
        }
        if (uploaded_image === "") {
            swal("Empty Field", "Please enter your company logo to continue", "warning");
            return;
        }
        // if (!(description_pattern.test(description))) {
        //     swal("Invalid field", " Your company description isn't valid. Enter a valid company description",
        //         "error");
        //     return;
        // }

        let data = new FormData();
        data.append('email', email);
        data.append('cname', cname);
        data.append('caddress', caddress);
        data.append('description', description);
        data.append('password', enc_pass);
        data.append('logo', uploaded_image);
        data.append('com_signup', 'true');

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                let x = JSON.parse(xhttp.responseText);
                if (x.code === "code_1") {
                    swal("Existing Email", email + " address is already registerd in our database", "error");
                } else if (x.code === "code_2") {
                    swal("Unexpected Error", "Unexpected error caused when creating the users", "error");
                } else if (x.code === "code_3") {
                    swal("Sign Up Successfull", "Successfull", "success").then((value) => {
                        if (x.role == 1) {
                            document.location.href = "ad_dashboard.php";
                        }
                        if (x.role == 2) {
                            document.location.href = "em_dashboard.php";
                        }
                        if (x.role == 3) {
                            document.location.href = "co_dashboard.php";
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