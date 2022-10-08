    <div class="admin-company-card card-basic over" onmouseup="viewCompanyDetails(<?php echo $row['user_id']; ?>)">

        <div class="row">
            <div class="col-8">
                <div class="name-wrap">
                    <div class="name"><?php echo $row['name']; ?></div>
                </div>
                <div class="li-desc"><span>Email : </span><?php echo $row['email']; ?></div>
                <?php
    $sql5 = "SELECT COUNT(*) as follow_count FROM follows WHERE company_id='"  . $row['user_id'] . "'";
    $result5 = $__conn->query($sql5);
    $row5 = $result5->fetch_assoc();
    $follow = $row5['follow_count'];
    $sql5 = "SELECT COUNT(*) as job_count FROM jobs WHERE user_id='"  . $row['user_id'] . "'";
    $result5 = $__conn->query($sql5);
    $row5 = $result5->fetch_assoc();
    $jobs = $row5['job_count'];
    ?>
                <div class="li-desc"><span>Followers : </span><?php echo $follow;?> Followers</div>
                <div class="li-desc"><span>Postings : </span><?php echo $jobs;?> Job Postings</div>
            </div>
            <div class="col-4">
                <div class="logo-wrap d-flex justify-content-end">
                    <div class="img">
                        <img src="<?php echo $__siteroot;?>./uploads/user/<?php echo $row['logo']; ?>" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
function changeCompanyState(x, y) {

    let data = new FormData();
    data.append('id', x);
    data.append('state', y);
    data.append('change_company_state', 'true');

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            let x = JSON.parse(xhttp.responseText);
            if (x.code === "code_1") {
                swal("Unexpected Error", "Unexpected error caused when blocking the company", "error");
            } else if (x.code === "code_2") {
                // location.reload();
            }
        }
    };
    xhttp.open("POST", "database/admin/functions.php", true);
    xhttp.send(data);
}
    </script>