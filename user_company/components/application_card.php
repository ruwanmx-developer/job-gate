<div class="admin-company-card card-basic over" onmouseup="viewCompanyDetails(<?php echo $row['user_id']; ?>)">
    <div class="row">
        <div class="col-12">
            <div class="name-wrap">
                <div class="name"><?php echo $row['title']; ?></div>
            </div>
            <div class="li-desc"><span>Applicant Name :
                </span><?php echo $row['first_name'] . " " . $row['last_name']; ?></div>
        </div>
    </div>
</div>