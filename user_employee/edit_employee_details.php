<!DOCTYPE html>
<html lang="en">
<?php $__siteroot = "."; ?>

<head>
    <title>View Company</title>
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
            $admin_menu = "em_m_1";
            $admin_submenu = "em_m_1_2";
            ?>
            <?php include('./components/employee_menu_card.php'); ?>
        </div>

        <!-- middle bar -->
        <div class="col-lg-9 py-3 pe-3 ps-3 ps-lg-0">
            <div class="title-bar card-basic py-2 mb-3">
                EDIT EMPLOYEE PROFILE
            </div>
            <?php
            $id = $_SESSION['ses_user_id'];
            $sql = "SELECT a.*, b.* FROM employies a INNER JOIN users b ON a.user_id = b.user_id WHERE a.user_id='$id'";
            $result = $__conn->query($sql);
            if ($result->num_rows == 0) {
            }
            $row = $result->fetch_assoc();
            ?>
            <div class="co-profile-edit-wrap card-basic mb-3">
                <div class="form-area">
                    <div class="row">
                        <div class="sep-link mb-1">Change Profile Image</div>
                        <!-- image upload start -->
                        <div class="col-12">
                            <label for="upload_image">
                                <div class="form-control upload text-center">
                                    <?php $image = ($row['image'] == NULL) ? "site_images/home.png" : "uploads/user/" . $row['image'] ?>
                                    <img class="upload-img" src="<?php echo $__siteroot . "./" . $image; ?>" alt="">
                                </div>
                                <input type="file" name="upload_image" id="upload_image" class="d-none">
                            </label>
                            <button class="btn btn-outline-update" onclick="updateLogo()">Update</button>
                            <script>
                            var uploaded_image = "";

                            function updateLogo() {
                                if (uploaded_image === "") {
                                    Swal.fire("Empty Field", "Please select an image for your company logo to continue",
                                        "warning");
                                    return;
                                }
                                let data = new FormData();
                                data.append('logo', uploaded_image);
                                data.append('id', <?php echo $_SESSION['ses_user_id']; ?>);
                                data.append('updateLogo', 'true');

                                var xhttp = new XMLHttpRequest();
                                xhttp.onreadystatechange = function() {
                                    if (this.readyState == 4 && this.status == 200) {
                                        let x = JSON.parse(xhttp.responseText);
                                        if (x.code === "code_1") {
                                            Swal.fire("Update Success", "Company logo is updated", "success");
                                            //location.reload();
                                            uploaded_image = "";
                                        } else if (x.code === "code_2") {
                                            Swal.fire("Unexpected Error",
                                                "Unexpected error caused when updating the logo", "error");
                                        }
                                    }
                                };
                                xhttp.open("POST", "../function/employee.php", true);
                                xhttp.send(data);
                            }
                            </script>
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
                                                    <div class="preview"></div>
                                                    <div class="preview ms-3"></div>
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
                                    width: 400,
                                    height: 400
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
                    </div>
                </div>
            </div>
            <div class="co-profile-edit-wrap card-basic mb-3">
                <div class="form-area">
                    <div class="row">
                        <div class="sep-link mb-1">Change Email Address</div>
                        <label class="form-label">Email Address</label>
                        <div class="input-group">
                            <input type="text" id="email" class="form-control" placeholder="Email Address"
                                value="<?php echo $row['email']; ?>">
                            <button class="btn btn-outline-update" onclick="updateEmail()">Update</button>
                            <script>
                            function updateEmail() {
                                let email = document.getElementById('email').value;
                                if (email === "") {
                                    Swal.fire("Empty Field", "Please enter your email address to continue", "warning");
                                    return;
                                }
                                if (!(email_pattern.test(email))) {
                                    Swal.fire("Invalid field", email +
                                        " is not an valid email address. Enter a valid email address", "error");
                                    return;
                                }
                                let data = new FormData();
                                data.append('email', email);
                                data.append('id', <?php echo $_SESSION['ses_user_id']; ?>);
                                data.append('updateEmail', 'true');

                                var xhttp = new XMLHttpRequest();
                                xhttp.onreadystatechange = function() {
                                    if (this.readyState == 4 && this.status == 200) {
                                        let x = JSON.parse(xhttp.responseText);
                                        if (x.code === "code_1") {
                                            Swal.fire("Update Success", email + " is updated", "success");
                                        } else if (x.code === "code_2") {
                                            Swal.fire("Unexpected Error",
                                                "Unexpected error caused when updating the email", "error");
                                        }
                                    }
                                };
                                xhttp.open("POST", "../function/company.php", true);
                                xhttp.send(data);
                            }
                            </script>
                        </div>
                    </div>
                </div>
            </div>
            <div class="co-profile-edit-wrap card-basic mb-3">
                <div class="form-area">
                    <div class="row">
                        <div class="sep-link mb-1">Change Password</div>
                        <label class="form-label">Current Password</label>
                        <div class="input-group mb-2">
                            <input type="password" id="cr_password" class="form-control" placeholder="Current Password"
                                autocomplete="new-password">
                        </div>
                        <label class="form-label">New Password</label>
                        <div class="input-group mb-2">
                            <input type="password" id="new_password" class="form-control" placeholder="New Password"
                                autocomplete="new-password">
                        </div>
                        <label class="form-label">Confirm New Password</label>
                        <div class="input-group">
                            <input type="password" id="cpassword" class="form-control"
                                placeholder="Confirm New Password" autocomplete="new-password">
                            <button class="btn btn-outline-update" onclick="updatePassword()">Update</button>
                            <script>
                            function updatePassword() {
                                let cr_password = document.getElementById('cr_password').value;
                                let new_password = document.getElementById('new_password').value;
                                let cpassword = document.getElementById('cpassword').value;
                                if (cr_password === "") {
                                    Swal.fire("Empty Field", "Please enter your current password to continue",
                                        "warning");
                                    return;
                                }
                                if (new_password === "") {
                                    Swal.fire("Empty Field", "Please enter a new password to continue", "warning");
                                    return;
                                }
                                if (cpassword === "") {
                                    Swal.fire("Empty Field", "Please confirm your password to continue", "warning");
                                    return;
                                }
                                if (cpassword !== new_password) {
                                    Swal.fire("Invalid Field", "Passwords doesn't match", "error");
                                    return;
                                }

                                let enc_cr_pass = md5(cr_password);
                                let enc_pass = md5(new_password);

                                let data = new FormData();
                                data.append('cr_password', enc_cr_pass);
                                data.append('new_password', enc_pass);
                                data.append('id', <?php echo $_SESSION['ses_user_id']; ?>);
                                data.append('updatePassword', 'true');

                                var xhttp = new XMLHttpRequest();
                                xhttp.onreadystatechange = function() {
                                    if (this.readyState == 4 && this.status == 200) {
                                        let x = JSON.parse(xhttp.responseText);
                                        if (x.code === "code_1") {
                                            Swal.fire("Update Success", "Your password is updated", "success");
                                            document.getElementById('cr_password').value = "";
                                            document.getElementById('new_password').value = "";
                                            document.getElementById('cpassword').value = "";
                                        } else if (x.code === "code_2") {
                                            Swal.fire("Unexpected Error",
                                                "Unexpected error caused when updating the email", "error");
                                        } else if (x.code === "code_3") {
                                            Swal.fire("Invalid Password",
                                                "Enter the correct current password to continue", "error");
                                        }
                                    }
                                };
                                xhttp.open("POST", "../function/company.php", true);
                                xhttp.send(data);
                            }
                            </script>
                        </div>
                    </div>
                </div>
            </div>
            <div class="co-profile-edit-wrap card-basic mb-3">
                <div class="form-area">
                    <div class="row">
                        <div class="sep-link mb-1">Change Employee Infomation</div>
                        <label class="form-label">Employee First Name</label>
                        <div class="input-group mb-2">
                            <input type="text" id="fname" class="form-control" placeholder="Employee First Name"
                                value="<?php echo $row['first_name']; ?>">
                            <button class="btn btn-outline-update" onclick="updateFirstName()">Update</button>
                            <script>
                            function updateFirstName() {
                                let cname = document.getElementById('fname').value;
                                if (cname === "") {
                                    Swal.fire("Empty Field", "Please enter your first name to continue", "warning");
                                    return;
                                }
                                if (!(cname_pattern.test(cname))) {
                                    Swal.fire("Invalid field", cname +
                                        " is not a valid employee name. Enter a valid first name", "error");
                                    return;
                                }
                                let data = new FormData();
                                data.append('cname', cname);
                                data.append('id', <?php echo $_SESSION['ses_user_id']; ?>);
                                data.append('updateFirstName', 'true');

                                var xhttp = new XMLHttpRequest();
                                xhttp.onreadystatechange = function() {
                                    if (this.readyState == 4 && this.status == 200) {
                                        let x = JSON.parse(xhttp.responseText);
                                        if (x.code === "code_1") {
                                            Swal.fire("Update Success", "Employee name is updated", "success");
                                            document.getElementById('fname').value = cname;
                                        } else if (x.code === "code_2") {
                                            Swal.fire("Unexpected Error",
                                                "Unexpected error caused when updating the name", "error");
                                        }
                                    }
                                };
                                xhttp.open("POST", "../function/employee.php", true);
                                xhttp.send(data);
                            }
                            </script>
                        </div>
                        <label class="form-label">Employee Last Name</label>
                        <div class="input-group mb-2">
                            <input type="text" id="lname" class="form-control" placeholder="Employee Last Name"
                                value="<?php echo $row['last_name']; ?>">
                            <button class="btn btn-outline-update" onclick="updateLastName()">Update</button>
                            <script>
                            function updateLastName() {
                                let cname = document.getElementById('lname').value;
                                if (cname === "") {
                                    Swal.fire("Empty Field", "Please enter your last name to continue", "warning");
                                    return;
                                }
                                if (!(cname_pattern.test(cname))) {
                                    Swal.fire("Invalid field", cname +
                                        " is not a valid company name. Enter a valid last name", "error");
                                    return;
                                }
                                let data = new FormData();
                                data.append('cname', cname);
                                data.append('id', <?php echo $_SESSION['ses_user_id']; ?>);
                                data.append('updateLastName', 'true');

                                var xhttp = new XMLHttpRequest();
                                xhttp.onreadystatechange = function() {
                                    if (this.readyState == 4 && this.status == 200) {
                                        let x = JSON.parse(xhttp.responseText);
                                        if (x.code === "code_1") {
                                            Swal.fire("Update Success", "Employee name is updated", "success");
                                            document.getElementById('lname').value = cname;
                                        } else if (x.code === "code_2") {
                                            Swal.fire("Unexpected Error",
                                                "Unexpected error caused when updating the name", "error");
                                        }
                                    }
                                };
                                xhttp.open("POST", "../function/employee.php", true);
                                xhttp.send(data);
                            }
                            </script>
                        </div>
                        <label class="form-label">Employee Gender</label>
                        <div class="input-group mb-2">
                            <input type="text" id="gender" class="form-control" placeholder="Gender"
                                value="<?php echo $row['gender']; ?>">
                            <button class="btn btn-outline-update" onclick="updateGender()">Update</button>
                            <script>
                            function updateGender() {
                                let cname = document.getElementById('gender').value;
                                if (cname === "") {
                                    Swal.fire("Empty Field", "Please enter your gender to continue", "warning");
                                    return;
                                }
                                if (!(cname_pattern.test(cname))) {
                                    Swal.fire("Invalid field", cname +
                                        " is not a valid company name. Enter a valid gender", "error");
                                    return;
                                }
                                let data = new FormData();
                                data.append('cname', cname);
                                data.append('id', <?php echo $_SESSION['ses_user_id']; ?>);
                                data.append('updateGender', 'true');

                                var xhttp = new XMLHttpRequest();
                                xhttp.onreadystatechange = function() {
                                    if (this.readyState == 4 && this.status == 200) {
                                        let x = JSON.parse(xhttp.responseText);
                                        if (x.code === "code_1") {
                                            Swal.fire("Update Success", "Gender is updated", "success");
                                            document.getElementById('gender').value = cname;
                                        } else if (x.code === "code_2") {
                                            Swal.fire("Unexpected Error",
                                                "Unexpected error caused when updating the name", "error");
                                        }
                                    }
                                };
                                xhttp.open("POST", "../function/employee.php", true);
                                xhttp.send(data);
                            }
                            </script>
                        </div>
                        <label class="form-label">Employee Birthday</label>
                        <div class="input-group mb-2">
                            <input type="date" id="cname" class="form-control" placeholder="Company Name"
                                value="<?php echo $row['birthday']; ?>">
                            <button class="btn btn-outline-update" onclick="updateBirthday()">Update</button>
                            <script>
                            function updateBirthday() {
                                let cname = document.getElementById('cname').value;
                                if (cname === "") {
                                    Swal.fire("Empty Field", "Please enter your company name to continue", "warning");
                                    return;
                                }
                                // if (!(cname_pattern.test(cname))) {
                                //     Swal.fire("Invalid field", cname +
                                //         " is not a valid company name. Enter a valid company name", "error");
                                //     return;
                                // }
                                let data = new FormData();
                                data.append('cname', cname);
                                data.append('id', <?php echo $_SESSION['ses_user_id']; ?>);
                                data.append('updateBirthday', 'true');

                                var xhttp = new XMLHttpRequest();
                                xhttp.onreadystatechange = function() {
                                    if (this.readyState == 4 && this.status == 200) {
                                        let x = JSON.parse(xhttp.responseText);
                                        if (x.code === "code_1") {
                                            Swal.fire("Update Success", "Employee Birthday is updated", "success");
                                            document.getElementById('cname').value = cname;
                                        } else if (x.code === "code_2") {
                                            Swal.fire("Unexpected Error",
                                                "Unexpected error caused when updating the name", "error");
                                        }
                                    }
                                };
                                xhttp.open("POST", "../function/employee.php", true);
                                xhttp.send(data);
                            }
                            </script>
                        </div>
                        <label class="form-label">Employee Description</label>
                        <div class="input-group mb-2">
                            <input type="text" id="description" class="form-control" placeholder="Description"
                                value="<?php echo $row['description']; ?>">
                            <button class="btn btn-outline-update" onclick="updateDescription()">Update</button>
                            <script>
                            function updateDescription() {
                                let description = document.getElementById('description').value;
                                if (description === "") {
                                    Swal.fire("Empty Field", "Please enter your company description to continue",
                                        "warning");
                                    return;
                                }

                                let data = new FormData();
                                data.append('description', description);
                                data.append('id', <?php echo $_SESSION['ses_user_id']; ?>);
                                data.append('updateDescription', 'true');

                                var xhttp = new XMLHttpRequest();
                                xhttp.onreadystatechange = function() {
                                    if (this.readyState == 4 && this.status == 200) {
                                        let x = JSON.parse(xhttp.responseText);
                                        if (x.code === "code_1") {
                                            Swal.fire("Update Success", "Employee description is updated",
                                                "success");
                                            document.getElementById('description').value = description;
                                        } else if (x.code === "code_2") {
                                            Swal.fire("Unexpected Error",
                                                "Unexpected error caused when updating the description", "error"
                                            );
                                        }
                                    }
                                };
                                xhttp.open("POST", "../function/employee.php", true);
                                xhttp.send(data);
                            }
                            </script>
                        </div>
                        <label class="form-label">Employee Address</label>
                        <div class="input-group mb-2">
                            <input type="text" id="caddress" class="form-control" placeholder="Employee Address"
                                value="<?php echo $row['address']; ?>">
                            <button class="btn btn-outline-update" onclick="updateAddress()">Update</button>
                            <script>
                            function updateAddress() {
                                let caddress = document.getElementById('caddress').value;
                                if (caddress === "") {
                                    Swal.fire("Empty Field", "Please enter your address to continue",
                                        "warning");
                                    return;
                                }
                                if (!(address_pattern.test(caddress))) {
                                    Swal.fire("Invalid field", caddress +
                                        " is not a valid company address. Enter a valid address",
                                        "error");
                                    return;
                                }

                                let data = new FormData();
                                data.append('caddress', caddress);
                                data.append('id', <?php echo $_SESSION['ses_user_id']; ?>);
                                data.append('updateAddress', 'true');

                                var xhttp = new XMLHttpRequest();
                                xhttp.onreadystatechange = function() {
                                    if (this.readyState == 4 && this.status == 200) {
                                        let x = JSON.parse(xhttp.responseText);
                                        if (x.code === "code_1") {
                                            Swal.fire("Update Success", "Employee address is updated", "success");
                                            document.getElementById('caddress').value = caddress;
                                        } else if (x.code === "code_2") {
                                            Swal.fire("Unexpected Error",
                                                "Unexpected error caused when updating the address", "error");
                                        }
                                    }
                                };
                                xhttp.open("POST", "../function/employee.php", true);
                                xhttp.send(data);
                            }
                            </script>
                        </div>

                        <label class="form-label">Employee Website</label>
                        <div class="input-group mb-2">
                            <input type="text" id="website" class="form-control" placeholder="Employee Website"
                                value="<?php echo $row['website']; ?>">
                            <button class="btn btn-outline-update" onclick="updateWebsite()">Update</button>
                            <script>
                            function updateWebsite() {
                                let website = document.getElementById('website').value;
                                if (website === "") {
                                    Swal.fire("Empty Field", "Please enter your website to continue",
                                        "warning");
                                    return;
                                }

                                let data = new FormData();
                                data.append('website', website);
                                data.append('id', <?php echo $_SESSION['ses_user_id']; ?>);
                                data.append('updateWebsite', 'true');

                                var xhttp = new XMLHttpRequest();
                                xhttp.onreadystatechange = function() {
                                    if (this.readyState == 4 && this.status == 200) {
                                        let x = JSON.parse(xhttp.responseText);
                                        if (x.code === "code_1") {
                                            Swal.fire("Update Success", "Employee website is updated", "success");
                                            document.getElementById('website').value = website;
                                        } else if (x.code === "code_2") {
                                            Swal.fire("Unexpected Error",
                                                "Unexpected error caused when updating the website", "error");
                                        }
                                    }
                                };
                                xhttp.open("POST", "../function/employee.php", true);
                                xhttp.send(data);
                            }
                            </script>
                        </div>
                        <label class="form-label">Employee LinkedIn</label>
                        <div class="input-group mb-2">
                            <input type="text" id="linkedin" class="form-control" placeholder="Employee LinkedIn"
                                value="<?php echo $row['linkedin']; ?>">
                            <button class="btn btn-outline-update" onclick="updateLinkedIn()">Update</button>
                            <script>
                            function updateLinkedIn() {
                                let linkedin = document.getElementById('linkedin').value;
                                if (linkedin === "") {
                                    Swal.fire("Empty Field", "Please enter your linkedin to continue",
                                        "warning");
                                    return;
                                }

                                let data = new FormData();
                                data.append('linkedin', linkedin);
                                data.append('id', <?php echo $_SESSION['ses_user_id']; ?>);
                                data.append('updateLinkedIn', 'true');

                                var xhttp = new XMLHttpRequest();
                                xhttp.onreadystatechange = function() {
                                    if (this.readyState == 4 && this.status == 200) {
                                        let x = JSON.parse(xhttp.responseText);
                                        if (x.code === "code_1") {
                                            Swal.fire("Update Success", "Employee linkedin is updated", "success");
                                            document.getElementById('linkedin').value = linkedin;
                                        } else if (x.code === "code_2") {
                                            Swal.fire("Unexpected Error",
                                                "Unexpected error caused when updating the linkedin", "error");
                                        }
                                    }
                                };
                                xhttp.open("POST", "../function/employee.php", true);
                                xhttp.send(data);
                            }
                            </script>
                        </div>
                        <label class="form-label">Employee Github</label>
                        <div class="input-group mb-2">
                            <input type="text" id="github" class="form-control" placeholder="Employee Github"
                                value="<?php echo $row['github']; ?>">
                            <button class="btn btn-outline-update" onclick="updateGithub()">Update</button>
                            <script>
                            function updateGithub() {
                                let github = document.getElementById('github').value;
                                if (github === "") {
                                    Swal.fire("Empty Field", "Please enter your linkedin to continue",
                                        "warning");
                                    return;
                                }

                                let data = new FormData();
                                data.append('github', github);
                                data.append('id', <?php echo $_SESSION['ses_user_id']; ?>);
                                data.append('updateGithub', 'true');

                                var xhttp = new XMLHttpRequest();
                                xhttp.onreadystatechange = function() {
                                    if (this.readyState == 4 && this.status == 200) {
                                        let x = JSON.parse(xhttp.responseText);
                                        if (x.code === "code_1") {
                                            Swal.fire("Update Success", "Employee github is updated", "success");
                                            document.getElementById('github').value = github;
                                        } else if (x.code === "code_2") {
                                            Swal.fire("Unexpected Error",
                                                "Unexpected error caused when updating the github", "error");
                                        }
                                    }
                                };
                                xhttp.open("POST", "../function/employee.php", true);
                                xhttp.send(data);
                            }
                            </script>
                        </div>
                        <label class="form-label">Employee Mobile No</label>
                        <div class="input-group">
                            <input type="text" id="mobile" class="form-control" placeholder="Employee Mobile No"
                                value="<?php echo $row['mobile']; ?>">
                            <button class="btn btn-outline-update" onclick="updateMobile()">Update</button>
                            <script>
                            function updateMobile() {
                                let mobile = document.getElementById('mobile').value;
                                if (mobile === "") {
                                    Swal.fire("Empty Field", "Please enter your mobile to continue", "warning");
                                    return;
                                }

                                let data = new FormData();
                                data.append('mobile', mobile);
                                data.append('id', <?php echo $_SESSION['ses_user_id']; ?>);
                                data.append('updateMobile', 'true');

                                var xhttp = new XMLHttpRequest();
                                xhttp.onreadystatechange = function() {
                                    if (this.readyState == 4 && this.status == 200) {
                                        let x = JSON.parse(xhttp.responseText);
                                        if (x.code === "code_1") {
                                            Swal.fire("Update Success", "Employee mobile is updated", "success");
                                            document.getElementById('mobile').value = mobile;
                                        } else if (x.code === "code_2") {
                                            Swal.fire("Unexpected Error",
                                                "Unexpected error caused when updating the mobile", "error");
                                        }
                                    }
                                };
                                xhttp.open("POST", "../function/employee.php", true);
                                xhttp.send(data);
                            }
                            </script>
                        </div>
                    </div>
                </div>
            </div>


            <div class="co-profile-edit-wrap card-basic mb-3">
                <div class="form-area">
                    <div class="row">
                        <div class="sep-link mb-1">Educational Qualifications</div>
                        <label class="form-label">Education</label>
                        <div class="input-group">
                            <input type="text" id="education" class="form-control" placeholder="Work Experince"
                                value="<?php echo $row['education']; ?>">
                            <button class="btn btn-outline-update" onclick="updateEducation()">Update</button>
                            <script>
                            function updateEducation() {
                                let education = document.getElementById('education').value;
                                if (education === "") {
                                    Swal.fire("Empty Field", "Please enter your education to continue", "warning");
                                    return;
                                }
                                // if (!(email_pattern.test(education))) {
                                //     Swal.fire("Invalid field", education +
                                //         " is not an valid email address. Enter a valid education", "error");
                                //     return;
                                // }
                                let data = new FormData();
                                data.append('education', education);
                                data.append('id', <?php echo $_SESSION['ses_user_id']; ?>);
                                data.append('updateEducation', 'true');

                                var xhttp = new XMLHttpRequest();
                                xhttp.onreadystatechange = function() {
                                    if (this.readyState == 4 && this.status == 200) {
                                        let x = JSON.parse(xhttp.responseText);
                                        if (x.code === "code_1") {
                                            Swal.fire("Update Success", "Employee education is updated", "success");
                                        } else if (x.code === "code_2") {
                                            Swal.fire("Unexpected Error",
                                                "Unexpected error caused when updating the education", "error");
                                        }
                                    }
                                };
                                xhttp.open("POST", "../function/employee.php", true);
                                xhttp.send(data);
                            }
                            </script>
                        </div>
                    </div>
                </div>
            </div>
            <div class="co-profile-edit-wrap card-basic mb-3">
                <div class="form-area">
                    <div class="row">
                        <div class="sep-link mb-1">Professional Qualifications</div>
                        <label class="form-label">Work Experience</label>
                        <div class="input-group">
                            <input type="text" id="work" class="form-control" placeholder="Work Experince"
                                value="<?php echo $row['work']; ?>">
                            <button class="btn btn-outline-update" onclick="updateWork()">Update</button>
                            <script>
                            function updateWork() {
                                let work = document.getElementById('work').value;
                                if (work === "") {
                                    Swal.fire("Empty Field", "Please enter your email address to continue", "warning");
                                    return;
                                }
                                // if (!(email_pattern.test(work))) {
                                //     Swal.fire("Invalid field", work +
                                //         " is not an valid email address. Enter a valid email address", "error");
                                //     return;
                                // }
                                let data = new FormData();
                                data.append('work', work);
                                data.append('id', <?php echo $_SESSION['ses_user_id']; ?>);
                                data.append('updateWork', 'true');

                                var xhttp = new XMLHttpRequest();
                                xhttp.onreadystatechange = function() {
                                    if (this.readyState == 4 && this.status == 200) {
                                        let x = JSON.parse(xhttp.responseText);
                                        if (x.code === "code_1") {
                                            Swal.fire("Update Success", "Employee work is updated", "success");
                                        } else if (x.code === "code_2") {
                                            Swal.fire("Unexpected Error",
                                                "Unexpected error caused when updating the work", "error");
                                        }
                                    }
                                };
                                xhttp.open("POST", "../function/employee.php", true);
                                xhttp.send(data);
                            }
                            </script>
                        </div>
                    </div>
                </div>
            </div>
            <div class="co-profile-edit-wrap card-basic mb-3">
                <div class="form-area">
                    <div class="row">
                        <div class="sep-link mb-1">Other Skills</div>
                        <label class="form-label">Education</label>
                        <div class="input-group">
                            <input type="text" id="skills" class="form-control" placeholder="Work Experince"
                                value="<?php echo $row['skills']; ?>">
                            <button class="btn btn-outline-update" onclick="updateSkills()">Update</button>
                            <script>
                            function updateSkills() {
                                let skills = document.getElementById('skills').value;
                                if (skills === "") {
                                    Swal.fire("Empty Field", "Please enter your education to continue", "warning");
                                    return;
                                }
                                // if (!(email_pattern.test(education))) {
                                //     Swal.fire("Invalid field", education +
                                //         " is not an valid email address. Enter a valid education", "error");
                                //     return;
                                // }
                                let data = new FormData();
                                data.append('skills', skills);
                                data.append('id', <?php echo $_SESSION['ses_user_id']; ?>);
                                data.append('updateSkills', 'true');

                                var xhttp = new XMLHttpRequest();
                                xhttp.onreadystatechange = function() {
                                    if (this.readyState == 4 && this.status == 200) {
                                        let x = JSON.parse(xhttp.responseText);
                                        if (x.code === "code_1") {
                                            Swal.fire("Update Success", "Employee skills is updated", "success");
                                        } else if (x.code === "code_2") {
                                            Swal.fire("Unexpected Error",
                                                "Unexpected error caused when updating the skills", "error");
                                        }
                                    }
                                };
                                xhttp.open("POST", "../function/employee.php", true);
                                xhttp.send(data);
                            }
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include($__siteroot . './components/footer.php'); ?>
</body>

</html>