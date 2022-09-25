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
        <div class="col-12 col-lg-6 login-form">
            <div class="form">
                <h3 class="mb-4">Reset Your Password</h3>
                <div class="form-area">
                    <div class="row">
                        <div class="col-12 mb-2">
                            <input type="password" id="password" class="form-control" autocomplete="new-password"
                                placeholder="New Password">
                        </div>
                        <div class="col-12 mb-2">
                            <input type="password" id="cpassword" class="form-control"
                                placeholder="Confirm New Password">
                        </div>
                        <div class="col-12 mb-2">
                            <button onclick="resetPassword()" class="btn btn-primary" name="user_login">Reset Password<i
                                    class="bi bi-box-arrow-right"></i></button>
                        </div>
                        <!-- <div class="sep-link">Remember your password ? <a class="no-link"
                                href="login.php">Log In here</a></a>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
        <?php include('components/common/footer.php');?>
        <script>
        var query = window.location.search.substring(1);
        var qs = parse_query_string(query);

        function parse_query_string(query) {
            var vars = query.split("&");
            var query_string = {};
            for (var i = 0; i < vars.length; i++) {
                var pair = vars[i].split("=");
                var key = decodeURIComponent(pair.shift());
                var value = decodeURIComponent(pair.join("="));
                if (typeof query_string[key] === "undefined") {
                    query_string[key] = value;
                } else if (typeof query_string[key] === "string") {
                    var arr = [query_string[key], value];
                    query_string[key] = arr;
                } else {
                    query_string[key].push(value);
                }
            }
            return query_string;
        }

        function resetPassword() {
            let password = document.getElementById("password").value;
            let cpassword = document.getElementById("cpassword").value;
            let token = qs.token;

            if (password === "") {
                swal("Empty Field", "Please enter your new password to continue", "warning");
                return;
            }
            if (cpassword === "") {
                swal("Empty Field", "Please confirm your new password to continue", "warning");
                return;
            }
            if (cpassword !== password) {
                swal("Invalid Field", "Passwords doesn't match", "error");
                return;
            }

            let data = new FormData();
            data.append('password', md5(password));
            data.append('token', token);
            data.append('resetPassword', 'true');

            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    let x = JSON.parse(xhttp.responseText);
                    if (x.code === "code_1") {
                        swal("Success", "Your password has reset successfully", "success").then((value) => {
                            document.location.href = "login.php";
                        });
                    } else if (x.code === "code_2") {
                        swal("Unexpected Error", "Unexpected error caused when sending the email, Try Again",
                            "error");
                    } else if (x.code === "code_3") {
                        swal("Reset Link Expired", "Reset link expired or invalid reset link", "error");
                    }
                }
            };
            xhttp.open("POST", "./function/authentication.php", true);
            xhttp.send(data);
        }
        </script>
    </div>
</body>

</html>