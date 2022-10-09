<div class="admin-company-card card-basic over" onmouseup="viewCompanyDetails(<?php echo $row['user_id']; ?>)">
    <div class="row">
        <div class="col-12">
            <div class="name-wrap">
                <div class="name"><?php echo $row['title']; ?></div>
            </div>
            <div class="li-desc"><span>Category : </span><?php echo $row['category']; ?></div>
            <div class="li-desc"><span>Salary : </span><?php echo $row['salary'] ."$ ".$row['salary_type'];?></div>
            <!-- <div class="li-desc"><span>Description : </span><?php echo $row['description'] ."$ ".$row['salary_type'];?>
            </div> -->
            <div class="li-desc"><span>Posted On : </span><?php echo $row['created_at'] ?>
            </div>
            <div class="li-desc"><span>Application Count : </span>dummy data 30
            </div>
        </div>
    </div>
</div>