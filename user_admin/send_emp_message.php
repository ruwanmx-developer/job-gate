<!DOCTYPE html>
<html lang="en">
<?php $__siteroot = "."; ?>

<head>
    <title>Admin Dashboard</title>
    <!-- include header links -->
    <?php include('../components/header_links.php');?>
</head>

<body>
    <!-- include navigation -->
    <?php include('../components/navigation.php');?>
    <div class="row gx-0">

        <!-- left bar -->
        <div class="col-lg-3 px-3 py-3">
            <div class="btn-title">System Manage</div>
            <?php 
            $admin_menu = "ad_m_4";
            $admin_submenu = "ad_m_4_1"; 
            ?>
            <?php include('./components/admin_menu_card.php');?>
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
            $sql = "SELECT a.message, DATE_FORMAT(a.send_date,'%H:%i %Y-%m-%e') AS send_date, a.states, a.sender_id,b.first_name,b.last_name,b.image FROM messages a INNER JOIN employies b ON a.sender_id = b.user_id OR a.reciver_id = b.user_id WHERE (a.reciver_id = '$ouser_id' AND a.sender_id = '$user_id') OR (a.reciver_id = '$user_id' AND a.sender_id = '$ouser_id')";
            $result = $__conn->query($sql);
            while($row = $result->fetch_assoc()) {
                if($user_id != $row['sender_id']){
                    ?>
                    <div class="col-10 ">
                        <div class="card-basic chat_message_card non-user new marg-b">
                            <div class="img-wrap">
                                <img src="../uploads/user/<?php echo $row['image'];?>" alt="">
                            </div>
                            <div class="data">
                                <div class="time">
                                    <?php echo $row['send_date'] . " - " . $row['first_name'] . " " . $row['last_name'];?>
                                </div>
                                <div class="message new"><?php echo $row['message'];?></div>
                            </div>
                        </div>
                    </div>
                    <?php   
                    } else {
                    $read = ($row['states'] == 1) ? "Unread" : "Read";
                    $style = ($row['states'] == 1) ? "unread" : "read";
                    ?>

                    <div class="offset-2 col-10 ">
                        <div class="card-basic chat_message_card user new marg-b">
                            <div class="data">
                                <div class="time"><span class="<?php echo $style;?>"><?php echo $read;?></span>
                                    <?php echo $row['send_date'];?></div>
                                <div class="message new"><?php echo $row['message'];?></div>
                            </div>
                            <div class="img-wrap">
                                <img src="../uploads/user/user_1.png" alt="">
                            </div>
                        </div>
                    </div>
                    <?php }} ?>



                    <!-- <div class="offset-2 col-10">
                    <div class="card-basic chat_message_card user new marg-b">
                        <div class="data">
                            <div class="message new">Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro id
                                hic
                                totam fugit, expedita est dolor nihil facere pariatur quisquam? Maxime odio sunt
                                mollitia sit quis est molestias, error facilis. Lorem ipsum dolor sit amet consectetur
                                adipisicing elit. Iure, libero est debitis exercitationem laudantium totam laboriosam
                                aliquid magnam quo! Sint explicabo ipsam autem quisquam praesentium quis nobis voluptas,
                                illo similique.</div>
                            <div class="time">23:11 2000-10-27 <span class="unread">Unread</span></div>
                        </div>
                        <div class="img-wrap">
                            <img src="../uploads/user/user_1.png" alt="">
                        </div>
                    </div>
                </div> -->

                </div>
            </div>
            <div class="row gx-3">
                <div class="col-12">
                    <div class="card-basic ">
                        <div class="input-group">
                            <input type="text" id="message" class="form-control" placeholder="Send New Message"
                                value="">
                            <button class="btn btn-outline-update" onclick="sendMessage()">SEND</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include('../components/footer.php');?>
        <script>
        function sendMessage() {

            var message = document.getElementById('message').value;
            var reciver = <?php echo $_GET['id'];?>

            let data = new FormData();
            data.append('reciver', reciver);
            data.append('message', message);
            data.append('sendMessage', 'true');

            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    let x = JSON.parse(xhttp.responseText);
                    if (x.code === "code_2") {
                        swal("Unexpected Error", "Unexpected error caused when sending the money", "error");
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