<!DOCTYPE html>
<html lang="en">
<?php $__siteroot = "."; ?>

<head>
    <title>Job Configarations</title>
    <!-- include header links -->
    <?php include($__siteroot . './components/header_links.php');?>
</head>

<body>
    <!-- include navigation -->
    <?php include($__siteroot . './components/navigation.php');?>
    <div class="row gx-0">

        <!-- left bar -->
        <div class="col-lg-3 px-3 py-3">
            <div class="btn-title">System Manage</div>
            <?php 
            $admin_menu = "ad_m_3";
            $admin_submenu = "ad_m_3_1"; 
            ?>
            <?php include('./components/admin_menu_card.php');?>
        </div>

        <!-- middle bar -->
        <div class="col-lg-9 py-3 pe-3 ps-3 ps-lg-0">
            <div class="title-bar card-basic py-2 mb-3">
                JOB CONFIGARATIONS
            </div>
            <div class="co-profile-edit-wrap card-basic mb-3 pad-b-0">
                <div class="form-area">
                    <div class="sep-link mb-1">Manage Job Categories</div>
                    <label class="form-label">Add New Job Category</label>
                    <div class="input-group marg-b">
                        <input type="text" id="update_category__1" class="form-control" placeholder="New Job Category"
                            value="">
                        <button class="btn btn-outline-update" onclick="updateJobCategory('_1')">Add</button>
                    </div>
                    <label class="form-label">Edit Existing Category</label>
                    <div class="row gx-2">
                        <?php
                        $sql = "SELECT * FROM job_categories";
                        $result = $__conn->query($sql);
                        while($row = $result->fetch_assoc()) {
                        ?><div class="col-lg-3">
                            <div class="input-group marg-b">
                                <input type="text" id="update_category_<?php echo $row['id']; ?>" class="form-control"
                                    placeholder="Update Job Category" value="<?php echo $row['name']; ?>">
                                <button class="btn btn-outline-update"
                                    onclick="updateJobCategory(<?php echo $row['id']; ?>)">Update</button>
                            </div>
                        </div>
                        <?php }?>
                    </div>
                </div>
                <script>
                function updateJobCategory(x) {
                    let category = document.getElementById('update_category_' + x).value;
                    if (category === "") {
                        Swal.fire("Empty Field", "Please enter data to continue", "warning");
                        return;
                    }
                    if (!(job_category_pattern.test(category))) {
                        Swal.fire("Invalid field", category +
                            " is not an valid job category. Enter a valid job category", "error");
                        return;
                    }
                    let data = new FormData();
                    data.append('category', category);
                    data.append('id', x);
                    let text = (x == '_1') ? "add" : "update";
                    data.append('updateJobCategory', 'true');
                    Swal.fire("Update Field", "Do you want to " + text + " the job category", "warning").then((value) => {
                        if (value) {
                            var xhttp = new XMLHttpRequest();
                            xhttp.onreadystatechange = function() {
                                if (this.readyState == 4 && this.status == 200) {
                                    let x = JSON.parse(xhttp.responseText);
                                    if (x.code === "code_1") {
                                        Swal.fire("Unexpected Error",
                                            "Unexpected error caused when updating the category",
                                            "error");
                                    } else if (x.code === "code_2") {
                                        location.reload();
                                    }
                                }
                            };
                            xhttp.open("POST", "../function/admin.php", true);
                            xhttp.send(data);
                        }
                    });
                }
                </script>
            </div>
            <div class="co-profile-edit-wrap card-basic mb-3 pad-b-0">
                <div class="form-area">
                    <div class="sep-link mb-1">Manage Job Types</div>
                    <label class="form-label">Add New Job Type</label>
                    <div class="input-group marg-b">
                        <input type="text" id="update_type__1" class="form-control" placeholder="New Job Type" value="">
                        <button class="btn btn-outline-update" onclick="updateJobType('_1')">Add</button>
                    </div>
                    <label class="form-label">Edit Existing Type</label>
                    <div class="row gx-2">
                        <?php
                        $sql = "SELECT * FROM job_types";
                        $result = $__conn->query($sql);
                        while($row = $result->fetch_assoc()) {
                        ?><div class="col-lg-3">
                            <div class="input-group marg-b">
                                <input type="text" id="update_type_<?php echo $row['id']; ?>" class="form-control"
                                    placeholder="Update Job Type" value="<?php echo $row['name']; ?>">
                                <button class="btn btn-outline-update"
                                    onclick="updateJobType(<?php echo $row['id']; ?>)">Update</button>
                            </div>
                        </div>
                        <?php }?>
                    </div>
                </div>
                <script>
                function updateJobType(x) {
                    let type = document.getElementById('update_type_' + x).value;
                    if (type === "") {
                        Swal.fire("Empty Field", "Please enter data to continue", "warning");
                        return;
                    }
                    if (!(job_category_pattern.test(type))) {
                        Swal.fire("Invalid field", type +
                            " is not an valid job type. Enter a valid job type", "error");
                        return;
                    }
                    let data = new FormData();
                    data.append('type', type);
                    data.append('id', x);
                    let text = (x == '_1') ? "add" : "update";
                    data.append('updateJobType', 'true');
                    Swal.fire("Update Field", "Do you want to " + text + " the job category", "warning").then((value) => {
                        if (value) {
                            var xhttp = new XMLHttpRequest();
                            xhttp.onreadystatechange = function() {
                                if (this.readyState == 4 && this.status == 200) {
                                    let x = JSON.parse(xhttp.responseText);
                                    if (x.code === "code_1") {
                                        Swal.fire("Unexpected Error",
                                            "Unexpected error caused when updating the type",
                                            "error");
                                    } else if (x.code === "code_2") {
                                        location.reload();
                                    }
                                }
                            };
                            xhttp.open("POST", "../function/admin.php", true);
                            xhttp.send(data);
                        }
                    });
                }
                </script>
            </div>
            <div class="co-profile-edit-wrap card-basic mb-3 pad-b-0">
                <div class="form-area">
                    <div class="sep-link mb-1">Manage Salary Types</div>
                    <label class="form-label">Add New Salary Type</label>
                    <div class="input-group marg-b">
                        <input type="text" id="update_salary__1" class="form-control" placeholder="New Salary Type" value="">
                        <button class="btn btn-outline-update" onclick="updateSalaryType('_1')">Add</button>
                    </div>
                    <label class="form-label">Edit Existing Type</label>
                    <div class="row gx-2">
                        <?php
                        $sql = "SELECT * FROM salary_types";
                        $result = $__conn->query($sql);
                        while($row = $result->fetch_assoc()) {
                        ?><div class="col-lg-3">
                            <div class="input-group marg-b">
                                <input type="text" id="update_salary_<?php echo $row['id']; ?>" class="form-control"
                                    placeholder="Update Salary Type" value="<?php echo $row['name']; ?>">
                                <button class="btn btn-outline-update"
                                    onclick="updateSalaryType(<?php echo $row['id']; ?>)">Update</button>
                            </div>
                        </div>
                        <?php }?>
                    </div>
                </div>
                <script>
                function updateSalaryType(x) {
                    let type = document.getElementById('update_salary_' + x).value;
                    if (type === "") {
                        Swal.fire("Empty Field", "Please enter data to continue", "warning");
                        return;
                    }
                    if (!(job_category_pattern.test(type))) {
                        Swal.fire("Invalid field", type +
                            " is not an valid job type. Enter a valid salary type", "error");
                        return;
                    }
                    let data = new FormData();
                    data.append('type', type);
                    data.append('id', x);
                    let text = (x == '_1') ? "add" : "update";
                    data.append('updateSalaryType', 'true');
                    Swal.fire("Update Field", "Do you want to " + text + " the salary type", "warning").then((value) => {
                        if (value) {
                            var xhttp = new XMLHttpRequest();
                            xhttp.onreadystatechange = function() {
                                if (this.readyState == 4 && this.status == 200) {
                                    let x = JSON.parse(xhttp.responseText);
                                    if (x.code === "code_1") {
                                        Swal.fire("Unexpected Error",
                                            "Unexpected error caused when updating the salary type",
                                            "error");
                                    } else if (x.code === "code_2") {
                                        location.reload();
                                    }
                                }
                            };
                            xhttp.open("POST", "../function/admin.php", true);
                            xhttp.send(data);
                        }
                    });
                }
                </script>
            </div>
        </div>
    </div>
    <?php include($__siteroot.'./components/footer.php');?>
</body>

</html>