<a class="no-link" href="./view_company.php?id=<?php echo $row['user_id']; ?>">
    <div class="mini-company-card card-basic mb-2">
        <div class="row">
            <div class="col-12 d-flex">
                <div class="img"><img src="uploads/user/<?php echo $row['logo']; ?>" alt=""></div>
                <div class="ms-3">
                    <div class="name"><?php echo $row['name']; ?></div>
                    <div class="address"><?php echo $row['address']; ?></div>
                </div>
            </div>
        </div>
    </div>
</a>