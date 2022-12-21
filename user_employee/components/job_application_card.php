<div class="job-application-card card-basic over" onmouseup="viewCompanyDetails(<?php echo $row['user_id']; ?>)">
    <?php
$sql5 = "SELECT title FROM jobs WHERE id=".$row['job_id'];
$result5 = $__conn->query($sql5);
$row5 = $result5->fetch_assoc();
$title = $row5['title'];
?>
    <div class="row">
        <div class="col-8">
            <div class="name-wrap">
                <div class="name"><?php echo $title; ?></div>
            </div>
            <div class="li-desc"><span>Status : </span><?php echo ($row['status'] == 1) ? "Pending" : "asdasd"; ?></div>
            <div class="li-desc"><span>Applied Date : </span><?php echo $row['applied_date'];?></div>
        </div>
    </div>
</div>