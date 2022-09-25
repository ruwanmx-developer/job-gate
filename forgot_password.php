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
                        <a type="button" class="btn btn-success">How It Works</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6 login-form">
            <div class="form">
                <h3 class="mb-4">Reset Your Password</h3>
                <div class="form-area">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <input type="text" id="email" class="form-control" placeholder="Email Address">
                        </div>
                        <div class="col-12 mb-2">
                            <button onclick="userForgotPassword()" class="btn btn-primary" name="user_login">Send
                                Password Reset Link <i class="bi bi-box-arrow-right"></i></button>
                        </div>
                        <div class="sep-link">Remember your password ? <a class="no-link" href="login.php">Log In
                                here</a></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include('./components/footer.php');?>
        <script>
        function userForgotPassword() {
            let email = document.getElementById("email").value;

            const pattern = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

            if (email === "") {
                swal("Empty Field", "Please enter your email address to continue", "warning");
                return;
            }
            if (!(pattern.test(email))) {
                swal("Invalid field", email + " is not an valid email address. Enter a valid email address", "error");
                return false;
            }

            let data = new FormData();
            data.append('email', email);
            data.append('userForgotPassword', 'true');

            swal({
                title: "Sending Email...",
                text: "Please wait",
                icon: "site_images/loading.gif",
                buttons: false,
                closeOnClickOutside: false
            });

            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    let x = JSON.parse(xhttp.responseText);
                    if (x.code === "code_1") {
                        swal("Unregisterd Email", email + " address in not registerd in our database", "error");
                    } else if (x.code === "code_2") {
                        swal("Email Sent", "The password reset link has send to the " + email + " address",
                            "success").then((value) => {
                            document.location.href = "login.php";
                        });
                    } else if (x.code === "code_3") {
                        swal("Unexpected Error", "Unexpected error caused when sending the email, Try Again",
                            "error");
                    } else if (x.code === "code_4") {
                        swal("Reset Link", "One password reset link has already send to the " + email +
                            " address", "warning");
                    }
                }
            };
            xhttp.open("POST", "./function/authentication.php", true);
            xhttp.send(data);
        }
        </script>
</body>

</html>