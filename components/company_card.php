<div class="company-card card-basic mb-3">
    <div class="row">
        <div class="col-12 d-flex">
            <div class="img"><img class="logo-shadow" src="uploads/user/<?php echo $row['logo']; ?>" alt=""></div>
            <div class="ms-3">
                <div class="name"><?php echo $row['name']; ?></div>
                <div class="address"><?php echo $row['address']; ?></div>
            </div>
        </div>
        <div class="col-12">
            <div class="desc mt-2"><?php echo $row['description']; ?></div>
            <div class="btn-wrap-right mt-2">
                <?php 
                if(array_key_exists('ses_user_id', $_SESSION)){
                    $sql1 = "SELECT * FROM follows WHERE user_id=" . $_SESSION['ses_user_id'] . " AND company_id='".$row['user_id']."'";
                    $result1 = $__conn->query($sql1);
                    $color = $name = "";
                    if ($result1->num_rows == 1) {
                        $name = "UNFOLLOW";
                        $color = "red";
                    } else {
                        $name = "FOLLOW";
                        $color = "blue";
                    }
                    ?>
                <button class="btn-<?php echo $color;?> marg-r"
                    onclick="followCompany(<?php echo $row['user_id']; ?>)"><?php echo $name;?></button><?php }?><a
                    class="no-link" href="view_company.php?id=<?php echo $row['user_id']; ?>"><button
                        class="btn-green">View Company</button></a>
            </div>
        </div>
    </div>
</div>