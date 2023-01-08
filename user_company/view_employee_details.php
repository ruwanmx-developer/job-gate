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
            <div class="btn-title">System Manage</div>
            <?php
            $admin_menu = "co_m_3";
            $admin_submenu = $_GET['ref'];
            ?>
            <?php include('./components/company_menu_card.php'); ?>
        </div>

        <!-- middle bar -->
        <div class="col-lg-9 py-3 pe-3 ps-3 ps-lg-0" id="content_report">
            <?php
            $id = $_GET['id'];
            $sql = "SELECT a.*, b.* FROM employies a INNER JOIN users b ON a.user_id=b.user_id WHERE a.user_id='$id'";
            $result = $__conn->query($sql);
            $row = $result->fetch_assoc();
            ?>
            <div class="row gx-3">
                <div class="col-12 marg-b">
                    <div class="card-basic">
                        <div class="row company-view pe-3">
                            <div class="col-12 d-flex justify-content-center marg-b">
                                <div class="img"><img class="logo-shadow img-fluid"
                                        src="<?php echo $__siteroot; ?>./uploads/user/<?php echo $row['image']; ?>"
                                        alt="">
                                </div>
                            </div>
                            <div class="col-12 text-center">
                                <div class="name"><?php echo $row['first_name'] . " " . $row['last_name']; ?></div>
                                <div class="special marg-b">
                                    <span><?php echo $row['email']; ?></span>
                                </div>

                                <div class="desc-1 marg-b"><?php echo $row['description']; ?></div>
                                <div class="btn-wrap marg-b">
                                    <button class="btn-blue" onclick="inviteUser()"> Invite
                                    </button>
                                    <a href="send_emp_message.php?id=<?php echo $row['user_id']; ?>"> <button
                                            class="btn-green">Message</button></a>
                                    <a href="user_report.php?id=<?php echo $row['user_id']; ?>"><button
                                            class="btn-green">Print Details</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 marg-b">
                    <div class="card-basic">
                        <div class="profile-title marg-b marg-t-0">Personal Details</div>
                        <div class="row company-view pe-3">
                            <div class="col-12 text-center">
                                <div class="special marg-b">
                                    First Name : <span><?php echo $row['first_name']; ?></span>
                                </div>
                                <div class="special marg-b">
                                    Last Name : <span><?php echo $row['last_name']; ?></span>
                                </div>
                                <div class="special marg-b">
                                    Gender : <span><?php echo $row['gender']; ?></span>
                                </div>
                                <div class="special marg-b">
                                    Home Address : <span><?php echo $row['address']; ?></span>
                                </div>
                                <div class="special">
                                    Birthday : <span><?php echo $row['birthday']; ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 marg-b">
                    <div class="card-basic">
                        <div class="profile-title marg-b marg-t-0">Contact Details</div>
                        <div class="row company-view pe-3">
                            <div class="col-12 text-center">
                                <?php if (!empty($row['website'])) { ?>
                                <div class="special marg-b">
                                    Website : <span><?php echo $row['website']; ?></span>
                                </div>
                                <?php } ?>
                                <?php if (!empty($row['linkedin'])) { ?>
                                <div class="special marg-b">
                                    LinkedIn : <span><?php echo $row['linkedin']; ?></span>
                                </div>
                                <?php } ?>
                                <?php if (!empty($row['github'])) { ?>
                                <div class="special marg-b">
                                    Github : <span><?php echo $row['github']; ?></span>
                                </div>
                                <?php } ?>
                                <?php if (!empty($row['mobile'])) { ?>
                                <div class="special">
                                    Mobile : <span><?php echo $row['mobile']; ?></span>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 marg-b">
                    <div class="card-basic pad-b-0">
                        <div class="profile-title marg-b marg-t-0">Skills</div>
                        <div class="row company-view">
                            <div class="col-12 text-center">
                                <?php if (!empty($row['skills'])) { ?>
                                <div class="special d-flex justify-content-center">
                                    <?php
                                        $str_arr = explode(",", $row['skills']);
                                        foreach ($str_arr as $x) {
                                            echo "<div class=\"skill-tag\">$x</div>";
                                        }
                                        ?>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 marg-b">
                    <div class="card-basic pad-b-0">
                        <div class="profile-title marg-b marg-t-0">Educational Qualifications</div>
                        <div class="row company-view ">
                            <div class="col-12 text-center">
                                <?php if (!empty($row['education'])) { ?>
                                <div class="special marg-b">
                                    <?php echo $row['education']; ?>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 marg-b">
                    <div class="card-basic marg-b pad-b-0">
                        <div class="profile-title marg-b marg-t-0">Work Experience</div>
                        <div class="row company-view ">
                            <div class="col-12 text-center">
                                <?php if (!empty($row['work'])) { ?>
                                <div class="special marg-b">
                                    <?php echo $row['work']; ?>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include($__siteroot . './components/footer.php'); ?>
    <script>
    function inviteUser() {
        let company_id = <?php echo $_SESSION['ses_user_id']; ?>;

        const pattern = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

        let data = new FormData();
        data.append('user_id', <?php echo $id; ?>);
        data.append('company_id', company_id);
        data.append('inviteUser', 'true');

        Swal.fire({
            title: "Sending Email...",
            text: "Please wait",
            iconHtml: "<img src='../site_images/loading.gif'>",
            showCloseButton: false,
            showCancelButton: false,
            showConfirmButton: false,
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: false
        });

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                let x = JSON.parse(xhttp.responseText);
                if (x.code === "code_1") {
                    Swal.fire("Unexpected Error", "Unexpected error caused when sending the email, Try Again",
                        "error");
                } else if (x.code === "code_2") {
                    Swal.fire("Email Sent", "The email notification has sent to the user",
                        "success").then((value) => {});
                }
            }
        };
        xhttp.open("POST", "../function/company.php", true);
        xhttp.send(data);
    }


    // function downloadReport() {
    //     window.html2canvas = html2canvas;
    //     window.jsPDF = window.jspdf.jsPDF;

    //     var doc = new jsPDF();

    //     // Source HTMLElement or a string containing HTML.
    //     var elementHTML = document.getElementById("content_report");

    //     doc.html(elementHTML, {
    //         callback: function(doc) {
    //             // Save the PDF
    //             doc.save('sample-document.pdf');
    //         },
    //         x: 15,
    //         y: 15,
    //         width: 200, //target width in the PDF document
    //         windowWidth: 700 //window width in CSS pixels
    //     });
    // }
    </script>
</body>

</html>