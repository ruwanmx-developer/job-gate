<div class="job-filter-form card-basic">
    <div class="input-group mb-3">
        <input class="form-control" type="text" name="search_q" id="search_q" placeholder="Search By Title">
        <!-- <button class="btn btn-search" type="button" onclick="searchByAll()"><i class="bi bi-search"></i></button> -->
    </div>
    <div class="input-group mb-3">
        <input class="form-control" type="text" name="min_sal" id="min_sal" placeholder="Min Salary">
        <input class="form-control" type="text" name="max_sal" id="max_sal" placeholder="Max Salary">
    </div>
    <select id="job_cat" class="form-select mb-3">
        <option value="" selected>All Categories</option>
        <?php
        $sql = "SELECT * FROM job_categories";
        $result = $__conn->query($sql);
        while ($row = $result->fetch_assoc()) {
        ?>
        <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
        <?php } ?>
    </select>
    <select id="job_type" class="form-select mb-3">
        <option value="" selected>All Job Types</option>
        <?php
        $sql = "SELECT * FROM job_types";
        $result = $__conn->query($sql);
        while ($row = $result->fetch_assoc()) {
        ?>
        <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
        <?php } ?>
    </select>
    <select id="dist" class="form-select mb-3">
        <option value="" selected>All Districts</option>
        <?php
        $sql = "SELECT * FROM districts";
        $result = $__conn->query($sql);
        while ($row = $result->fetch_assoc()) {
        ?>
        <option value="<?php echo $row['id'] ?>"><?php echo $row['district'] ?></option>
        <?php } ?>
    </select>
    <div class="btn-wrap-right">
        <button class="btn-red me-2" onclick="resetFilters()">RESET</button>
        <button class="btn-green" onclick="filterJobByAll()">SEARCH</button>
    </div>
</div>
<script>
function resetFilters() {
    document.getElementById("search_q").value = "";
    document.getElementById("min_sal").value = "";
    document.getElementById("max_sal").value = "";
    document.getElementById("job_cat").value = "";
    document.getElementById("job_type").value = "";
    document.getElementById("dist").value = "";
}

function filterJobByAll() {
    let search_val = document.getElementById("search_q").value;
    let min_salary = document.getElementById("min_sal").value;
    let max_salary = document.getElementById("max_sal").value;
    let job_cat = document.getElementById("job_cat").value;
    let job_type = document.getElementById("job_type").value;
    let dist = document.getElementById("dist").value;

    let data = new FormData();
    data.append('search_val', search_val);
    data.append('min_salary', min_salary);
    data.append('max_salary', max_salary);
    data.append('job_cat', job_cat);
    data.append('job_type', job_type);
    data.append('dist', dist);
    data.append('filterJobByAll', 'true');

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("job-results").innerHTML = xhttp.responseText;
        }
    };
    xhttp.open("POST", "./function/job.php", true);
    xhttp.send(data);
}
</script>