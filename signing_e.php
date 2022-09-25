<!DOCTYPE html>
<html lang="en">

<head>
    <title>Job Gate</title>
    <?php include('./components/header_links.php');?>
    <script type="text/javascript" src="./js/md5.js"></script>
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
    <?php include('./components/footer.php');?>
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
        if (fname === "") {
            swal("Empty Field", "Please enter your first name to continue", "warning");
            return;
        }
        if (!(name_pattern.test(fname))) {
            swal("Invalid field", fname + " is not a valid name. Enter a valid name", "error");
            return;
        }
        if (lname === "") {
            swal("Empty Field", "Please enter your last name to continue", "warning");
            return;
        }
        if (!(name_pattern.test(lname))) {
            swal("Invalid field", fname + " is not a valid name. Enter a valid name", "error");
            return;
        }

        let data = new FormData();
        data.append('email', email);
        data.append('fname', fname);
        data.append('lname', lname);
        data.append('password', enc_pass);
        data.append('emp_signup', 'true');

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
        xhttp.open("POST", "database/common/functions.php", true);
        xhttp.send(data);
    }
    </script>
</body>

</html>