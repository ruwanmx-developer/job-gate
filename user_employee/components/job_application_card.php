<div class="job-application-card card-basic over" onmouseup="viewCompanyDetails(<?php echo $row['user_id']; ?>)">
    <?php
    $sql5 = "SELECT title,user_id FROM jobs WHERE id=" . $row['job_id'];
    $result5 = $__conn->query($sql5);
    $row5 = $result5->fetch_assoc();
    $title = $row5['title'];
    $sql5 = "SELECT name FROM companies WHERE user_id=" . $row5['user_id'];
    $result5 = $__conn->query($sql5);
    $row5 = $result5->fetch_assoc();
    $company = $row5['name'];
    ?>
    <div class="row">
        <div class="col-12">
            <div class="name-wrap">
                <div class="name"><?php echo $title; ?></div>
            </div>
            <div class="li-desc"><span>Company : </span><?php echo $company; ?>
            </div>
            <div class="li-desc"><span>Applied Date : </span><?php echo $row['applied_date']; ?></div>
            <?php if ($row['message'] != "") { ?><div class="li-desc"><span>Message :
                </span><?php echo $row['message']; ?></div><?php } ?>
        </div>
    </div>
</div>