<div class="job-card card-basic mb-3">
    <div class="row">
        <div class="col-12">
            <div class="title"><?php echo $row['title']; ?></div>
        </div>
        <div class="col-12 col-md-7">
            <div class="category"><?php echo $row['category']; ?></div>
            <div class="desc"><?php echo $row['description']; ?></div>
        </div>
        <div class="col-12 col-md-5">
            <div class="li-points"> <?php echo $row['salary'] ."$ " . $row['salary_type']; ?> <i
                    class="bi bi-currency-dollar"></i></div>
            <a class="no-link" href="./view_company.php?id=<?php echo $row['company_id']; ?>">
                <div class="li-points"> <?php echo $row['company']; ?> <i class="bi bi-building"></i></div>
            </a>
            <div class="li-points"> <?php echo $row['district']; ?> <i class="bi bi-geo-alt"></i></div>
            <div class="li-points"> <?php echo $row['name']; ?> <i class="bi bi-clock"></i></div>
            <div class="btn-wrap-right mt-2">
                <button class="btn-green" onclick="check_auth(<?php echo $row['id']; ?>)">APPLY FOR JOB</button>
            </div>
        </div>
    </div>
</div>