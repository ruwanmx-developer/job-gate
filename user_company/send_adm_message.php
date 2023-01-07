<!DOCTYPE html>
<html lang="en">
<?php $__siteroot = "."; ?>

<head>
    <title>Admin Dashboard</title>
    <!-- include header links -->
    <?php include('../components/header_links.php'); ?>
</head>

<body>
    <!-- include navigation -->
    <?php include('../components/navigation.php'); ?>
    <div class="row gx-0">

        <!-- left bar -->
        <div class="col-lg-3 px-3 py-3">
            <div class="btn-title">System Manage</div>
            <?php
            $admin_menu = "co_m_4";
            $admin_submenu = "co_m_4_2";
            ?>
            <?php include('./components/company_menu_card.php'); ?>
        </div>

        <!-- middle bar -->
        <div class="col-lg-9 py-3 pe-3 ps-3 ps-lg-0">
            <div class="title-bar card-basic py-2 mb-3">
                SEND MESSAGES
            </div>
            <div class="msg-wrap  marg-b">
                <div class="row gx-3">

                    <?php
                    $user_image = "../site_images/admin.png";
                    $user_id = $_SESSION['ses_user_id'];
                    $ouser_id = $_GET['id'];
                    $sql = "SELECT a.id,a.message, DATE_FORMAT(a.send_date,'%H:%i %Y-%m-%e') AS send_date, a.states, a.sender_id, b.email FROM messages a INNER JOIN users b ON a.sender_id = b.user_id OR a.reciver_id = b.user_id WHERE (a.reciver_id = '$ouser_id' AND a.sender_id = '$user_id') OR (a.reciver_id = '$user_id' AND a.sender_id = '$ouser_id') GROUP BY a.id";
                    $result = $__conn->query($sql);
                    while ($row = $result->fetch_assoc()) {
                        if ($user_id != $row['sender_id']) {
                    ?>
                            <div class="col-10">
                                <div class="card-basic chat_message_card non-user new marg-b">
                                    <div class="img-wrap">
                                        <img src="../site_images/user.png" alt="">
                                    </div>
                                    <div class="data">
                                        <div class="time">
                                            <?php echo $row['send_date'] . " - " . $row['email']; ?>
                                        </div>
                                        <div class="message new" id="msg_<?php echo $row['id']; ?>">
                                            <?php echo $row['message']; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        } else {
                            $read = ($row['states'] == 1) ? "Unread" : "Read";
                            $style = ($row['states'] == 1) ? "unread" : "read";
                        ?>

                            <div class="offset-2 col-10 ">
                                <div class="card-basic chat_message_card user new marg-b" onclick="openMessage(<?php echo $row['id']; ?>)">
                                    <div class="data">
                                        <div class="time"><span class="<?php echo $style; ?>"><?php echo $read; ?></span>
                                            <?php echo $row['send_date']; ?></div>
                                        <div class="message new" id="msg_<?php echo $row['id']; ?>">
                                            <?php echo $row['message']; ?>
                                        </div>
                                    </div>
                                    <div class="img-wrap">
                                        <img src="../uploads/user/<?php echo $_SESSION['ses_user_image']; ?>" alt="">
                                    </div>
                                </div>
                            </div>
                    <?php }
                    } ?>
                </div>
            </div>
            <div class="row gx-3">
                <div class="col-12">
                    <div class="card-basic ">
                        <div class="input-group">
                            <input type="text" id="message" class="form-control" placeholder="Send New Message" value="">
                            <button class="btn btn-outline-update" onclick="sendMessage()">SEND</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include('../components/footer.php'); ?>
        <script>
            function openMessage(x) {
                var msg = document.getElementById('msg_' + x).innerHTML;
                Swal.fire({
                    icon: 'question',
                    html: 'Do you want to delete this message?<br><b>' + msg + '<br>',
                    showCancelButton: true,
                    focusConfirm: false,
                    cancelButtonText: 'Cancel',
                    confirmButtonText: 'Delete',
                    reverseButtons: true,
                }).then((result) => {
                    if (result.isConfirmed) {
                        let data = new FormData();
                        data.append('id', x);
                        data.append('deleteMessage', 'true');
                        var xhttp = new XMLHttpRequest();
                        xhttp.onreadystatechange = function() {
                            if (this.readyState == 4 && this.status == 200) {
                                let x = JSON.parse(xhttp.responseText);
                                if (x.code === "code_2") {
                                    Swal.fire("Unexpected Error",
                                        "Unexpected error caused when deleting the message",
                                        "error");
                                } else if (x.code === "code_1") {
                                    location.reload();
                                }
                            }
                        };
                        xhttp.open("POST", "../function/authentication.php", true);
                        xhttp.send(data);
                    }
                })
            }

            function sendMessage() {

                var message = document.getElementById('message').value;
                var reciver = <?php echo $_GET['id']; ?>

                let data = new FormData();
                data.append('reciver', reciver);
                data.append('message', message);
                data.append('sendMessage', 'true');

                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        let x = JSON.parse(xhttp.responseText);
                        if (x.code === "code_2") {
                            Swal.fire("Unexpected Error", "Unexpected error caused when sending the message", "error");
                        } else if (x.code === "code_1") {
                            location.reload();
                        }
                    }
                };
                xhttp.open("POST", "../function/authentication.php", true);
                xhttp.send(data);
            }
        </script>
</body>

</html>