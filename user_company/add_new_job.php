<!DOCTYPE html>
<html lang="en">
<?php $__siteroot = "."; ?>

<head>
    <title>Add Job</title>
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

            $admin_menu = "co_m_2";
            $admin_submenu = "co_m_2_1"; 
            ?>
            <?php include('./components/company_menu_card.php');?>
        </div>

        <!-- middle bar -->
        <div class="col-lg-9 py-3 pe-3 ps-3 ps-lg-0">
            <div class="title-bar card-basic py-2 mb-3">
                CREATE NEW JOB
            </div>
            <div class="co-form-wrap card-basic">
                <div class="mb-2">
                    <label for="title" class="form-label">Job Title</label>
                    <input type="text" class="form-control" id="title"
                        placeholder="Enter a title to undestand job role">
                </div>
                <div class="mb-2">
                    <label for="desc" class="form-label">Job Description</label>
                    <input type="text" class="form-control" id="desc"
                        placeholder="Describe the job. Include all details">
                </div>
                <div class="mb-2">
                    <label for="category" class="form-label">Job Category</label>
                    <select id="category" class="form-select">
                        <option value="" selected>Select A Category</option>
                        <?php
                        $sql = "SELECT * FROM job_categories";
                        $result = $__conn->query($sql);
                        while($row = $result->fetch_assoc()) {
                        ?>
                        <option value="<?php echo $row['id']?>"><?php echo $row['name']?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="mb-2">
                    <label for="job_type" class="form-label">Job Type</label>
                    <select id="job_type" class="form-select">
                        <option value="" selected>Select A Job Type</option>
                        <?php
                        $sql = "SELECT * FROM job_types";
                        $result = $__conn->query($sql);
                        while($row = $result->fetch_assoc()) {
                        ?>
                        <option value="<?php echo $row['id']?>"><?php echo $row['name']?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="mb-2">
                    <label for="salary_type" class="form-label">Salary Type</label>
                    <select id="salary_type" class="form-select">
                        <option value="" selected>Select A Salaray Type</option>
                        <?php
                        $sql = "SELECT * FROM salary_types";
                        $result = $__conn->query($sql);
                        while($row = $result->fetch_assoc()) {
                        ?>
                        <option value="<?php echo $row['id']?>"><?php echo $row['name']?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="mb-2">
                    <label for="salary" class="form-label">Salary</label>
                    <input type="text" class="form-control" id="salary"
                        placeholder="Enter your salary for this job (USD)">
                </div>
                
                <div class="mb-2">
                    <label for="company1" class="form-label">Company</label>
                    <input type="text" disabled class="form-control" id="company1"
                        value="<?php echo $_SESSION['ses_company_name'];?>">
                    <?php
                        $sql = "SELECT * FROM companies WHERE user_id='".$_SESSION['ses_user_id']."'";
                        $result = $__conn->query($sql);
                        $row = $result->fetch_assoc();
                        ?>
                    <input type="hidden" id="company" value="<?php echo $row['id']; ?>">
                </div>
                <div class="mb-2">
                    <label for="district" class="form-label">District</label>
                    <select id="district" class="form-select">
                        <option value="" selected>Select The District</option>
                        <?php
                        $sql = "SELECT * FROM districts";
                        $result = $__conn->query($sql);
                        while($row = $result->fetch_assoc()) {
                        ?>
                        <option value="<?php echo $row['id']?>"><?php echo $row['district']?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="btn-wrap-right mt-3">
                    <button class="btn btn-green" onclick="addNewJob()" type="button">SAVE</button>
                </div>
            </div>
        </div>
        <script>
        function addNewJob() {
            let title = document.getElementById("title").value;
            let desc = document.getElementById("desc").value;
            let category = document.getElementById("category").value;
            let jtype = document.getElementById("job_type").value;
            let stype = document.getElementById("salary_type").value;
            let salary = document.getElementById("salary").value;
            let company = document.getElementById("company").value;
            let district = document.getElementById("district").value;

            const title_pattern = /^[A-Z a-z]+$/;
            const description_pattern = /^[A-Z a-z 0-9 , . / - ' " ( ) ]+$/;
            const salary_pattern = /^[0-9]+$/;

            if (title === "") {
                swal("Empty Field", "Please enter your job title to continue", "warning");
                return;
            }
            if (!(title_pattern.test(title))) {
                swal("Invalid field", title + " is not an valid job title. Enter a valid job title", "error");
                return;
            }
            if (desc === "") {
                swal("Empty Field", "Please enter your job description to continue", "warning");
                return;
            }
            if (!(description_pattern.test(desc))) {
                swal("Invalid field", "Your description is not a valid job description. Enter a valid job description",
                    "error");
                return;
            }
            if (category === "") {
                swal("Empty Field", "Please select a job category from the list to continue", "warning");
                return;
            }
            if (jtype === "") {
                swal("Empty Field", "Please select a job type from the list to continue", "warning");
                return;
            }
            if (stype === "") {
                swal("Empty Field", "Please select a salary type from the list to continue", "warning");
                return;
            }
            if (salary === "") {
                swal("Empty Field", "Please enter your offering salary to continue", "warning");
                return;
            }
            if (!(salary_pattern.test(salary))) {
                swal("Invalid field", salary + " is not a valid salary. Enter a valid salary", "error");
                return;
            }
            if (company === "") {
                swal("Empty Field", "You have to reload the page. Page not fully loaded", "warning").then((value) => {
                    window.location.reload();
                });
                return;
            }
            if (district === "") {
                swal("Empty Field", "Please select a district from the list to continue", "warning");
                return;
            }

            let data = new FormData();
            data.append('title', title);
            data.append('desc', desc);
            data.append('category', category);
            data.append('jtype', jtype);
            data.append('stype', stype);
            data.append('salary', salary);
            data.append('company', company);
            data.append('district', district);
            data.append('addNewJob', 'true');

            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    let x = JSON.parse(xhttp.responseText);
                    if (x.code === "code_1") {
                        swal("Success", "Your job added to database and set to public", "success").then((value) => {
                            document.location.href = "co_manage_active_jobs.php";
                        });
                    } else if (x.code === "code_2") {
                        swal("Unexpected Error", "Unexpected error caused when creating the job", "error");
                    }
                }
            };
            xhttp.open("POST", "../function/job.php", true);
            xhttp.send(data);
        }
        </script>
    </div>
    <?php include($__siteroot.'./components/footer.php');?>
</body>

</html>