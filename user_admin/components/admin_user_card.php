<div class="admin-company-card card-basic over" onmouseup="viewUserDetails(<?php echo $row['user_id']; ?>)">

    <div class="row">
        <div class="col-8">
            <div class="name-wrap">
                <div class="name"><?php echo $row['first_name'] . " " . $row['last_name']; ?></div>
            </div>
            <div class="li-desc"><span>Email : </span><?php echo $row['email']; ?></div>
            <?php
$sql5 = "SELECT COUNT(*) as follow_count FROM follows WHERE user_id='"  . $row['user_id'] . "'";
$result5 = $__conn->query($sql5);
$row5 = $result5->fetch_assoc();
$follow = $row5['follow_count'];
$sql5 = "SELECT COUNT(*) as job_count FROM jobs WHERE user_id='"  . $row['user_id'] . "'";
$result5 = $__conn->query($sql5);
$row5 = $result5->fetch_assoc();
$jobs = $row5['job_count'];
?>
            <div class="li-desc"><span>Followings : </span><?php echo $follow;?> Followings</div>
            <div class="li-desc"><span>Applied Jobs : </span><?php echo $jobs;?> Applied Jobs</div>
        </div>
        <div class="col-4">
            <div class="logo-wrap d-flex justify-content-end">
                <div class="img">
                    <img src="<?php echo $__siteroot;?>./uploads/user/<?php echo $row['image']; ?>" alt="">
                </div>
            </div>
        </div>
    </div>
</div>