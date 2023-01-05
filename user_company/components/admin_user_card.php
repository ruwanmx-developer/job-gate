<div class="admin-company-card card-basic over" onmouseup="viewEmployeeDetails(<?php echo $row['user_id']; ?>)">

    <div class="row">
        <div class="col-8">
            <div class="name-wrap">
                <div class="name"><?php echo $row['first_name'] . " " . $row['last_name']; ?></div>
            </div>
            <div class="li-desc"><span>Email : </span><?php echo $row['email']; ?></div>
        </div>
        <div class="col-4">
            <div class="logo-wrap d-flex justify-content-end">
                <div class="img">
                    <img src="<?php echo $__siteroot; ?>./uploads/user/<?php echo $row['image']; ?>" alt="">
                </div>
            </div>
        </div>
    </div>
</div>