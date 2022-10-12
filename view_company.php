<!DOCTYPE html>
<html lang="en">
<?php $__siteroot = ""; ?>

<head>
    <title>Job Gate</title>
    <?php include('./components/header_links.php');?>
    <script type="text/javascript" src="./js/md5.js"></script>
    <script type="text/javascript" src="./js/validationPatterns.js"></script>
</head>

<body>
    <?php include('./components/navigation.php');?>
    <div class="row gx-0">
        <!-- left bar -->
        <div class="col-lg-3 px-3 py-3">
            <div class="btn-title">Top Rated Companies</div>
            <?php 
            $sql = "SELECT * FROM companies LIMIT 5";
            $result = $__conn->query($sql);
            while($row = $result->fetch_assoc()) {
            ?>
            <a class="no-link" href="view_company.php?id=<?php echo $row['user_id']; ?>">
                <div class="mini-company-card card-basic over mb-2">
                    <div class="row">
                        <div class="col-12 d-flex">
                            <div class="img"><img src="./uploads/user/<?php echo $row['logo']; ?>" alt=""></div>
                            <div class="ms-3">
                                <div class="name"><?php echo $row['name']; ?></div>
                                <div class="address"><?php echo $row['address']; ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            <?php } ?>
        </div>
        <!-- middle bar -->
        <div class="col-lg-9 py-3 pe-3 ps-3 ps-lg-0">
            <?php 
            $id = $_GET['id'];
            $sql = "SELECT a.user_id, a.name, a.address, a.description, a.logo, a.website, a.linkedin, a.mobile, b.email FROM companies a INNER JOIN users b ON a.user_id = b.user_id WHERE a.user_id='$id'";
            $result = $__conn->query($sql);
            $row = $result->fetch_assoc();
            ?>
            <div class="row company-view pe-3">
                <div class="col-12 d-flex justify-content-center mb-3">
                    <div class="img"><img class="logo-shadow img-fluid"
                            src="<?php echo $__siteroot; ?>./uploads/user/<?php echo $row['logo']; ?>" alt=""></div>
                </div>
                <div class="col-12 text-center">
                    <div class="name"><?php echo $row['name']; ?></div>
                    <div class="address"><?php echo $row['address']; ?></div>
                    <div class="desc-1 mt-2 mb-3"><?php echo $row['description']; ?></div>
                    <div class="special mb-2">
                        Email : <span><?php echo $row['email']; ?></span>
                    </div>
                    <?php if(!empty($row['website'])){?>
                    <div class="special mb-2">
                        Website : <span><?php echo $row['website']; ?></span>
                    </div>
                    <?php } ?>
                    <?php if(!empty($row['linkedin'])){?>
                    <div class="special mb-2">
                        LinkedIn : <span><?php echo $row['linkedin']; ?></span>
                    </div>
                    <?php } ?>
                    <?php if(!empty($row['mobile'])){?>
                    <div class="special mb-2">
                        Mobile : <span><?php echo $row['mobile']; ?></span>
                    </div>
                    <?php } ?>
                    <div id="follow<?php echo $row['user_id']; ?>" class="btn-wrap mt-2">
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
                            onclick="followCompany(<?php echo $row['user_id']; ?>)"><?php echo $name;?></button>
                        <?php }?>
                    </div>
                </div>
                <script>
                function followCompany(x) {
                    let data = new FormData();
                    data.append('id', x);
                    data.append('followChange', 'true');

                    var xhttp = new XMLHttpRequest();
                    xhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            let x = JSON.parse(xhttp.responseText);
                            if (x.code === "code_1") {
                                swal("Unexpected Error", "Unexpected error occured");
                            } else if (x.code === "code_2") {
                                location.reload();
                            }
                        }
                    };
                    xhttp.open("POST", "./function/company.php", true);
                    xhttp.send(data);
                }
                </script>
                <div class="col-12">
                    <hr class="mt-4 mb-4">
                    <div class="title-1 mb-3">Jobs Listed By <?php echo $row['name']; ?></div>
                    <?php 
                    // $sql = "SELECT a.id, a.title, b.name AS category, a.description, a.salary, f.id AS company_id, f.name AS company, d.district, e.name FROM job a INNER JOIN job_category b ON a.category = b.id INNER JOIN district d ON a.district = d.id INNER JOIN job_type e ON a.type = e.id INNER JOIN company f ON a.company = f.id WHERE a.company = $id";
                    // $result = $__conn->query($sql);
                    // while($row = $result->fetch_assoc()) {
                    ?>
                    <?php //include('components/job/job-card.php');?>
                    <?php //}?>
                </div>
            </div>
        </div>
    </div>
    <?php include('./components/footer.php');?>
</body>

</html>