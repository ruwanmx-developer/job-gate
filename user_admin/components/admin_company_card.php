<div class="admin-company-card card-basic">
    <div class="name-wrap">
        <div class="name"><?php echo $row['name']; ?></div>
    </div>
    <div class="li-desc"><span>Email : </span><?php echo $row['email']; ?></div>
    <div class="li-desc"><span>Followers : </span>36 Followers</div>
    <div class="li-desc"><span>Postings : </span>36 Job Postings</div>
    <div class="li-desc"><span>Joined On : </span>2010 / 03 / 25 </div>
    <div class="row align-items-end">
        <div class="col-4">
            <div class="logo-wrap">
                <div class="img">
                    <img src="<?php echo $__siteroot;?>./uploads/user/<?php echo $row['logo']; ?>" alt="">
                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="btn-wrap-right">
                <a class="no-link marg-r" href="view_company.php?id=<?php echo $row['user_id']; ?>"><button
                        class="btn-green">View</button></a><button class=" btn-red"
                    onclick="blockCompany(<?php echo $row['user_id']; ?>,<?php echo ($row['state'] == 0) ? '1' : '0'; ?>)">
                    <?php 
                if($row['state'] == 0){
                    echo "Block";
                }else {
                    echo "Unblock";
                }?>
                </button>
            </div>
        </div>
    </div>
</div>
<script>
function blockCompany(x, y) {

    let data = new FormData();
    data.append('id', x);
    data.append('state', y);
    data.append('blockCompany', 'true');

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