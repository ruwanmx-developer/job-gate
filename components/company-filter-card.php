<div class="job-filter-form card-basic">
    <div class="input-group mb-3">
        <input class="form-control" type="text" name="search_q" id="search_q" placeholder="Search By Company">
        <!-- <button class="btn btn-search" type="button"><i class="bi bi-search"></i></button> -->
    </div>
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
        <button class="btn-green" onclick="filterCompanyByAll()">SEARCH</button>
    </div>
</div>
<script>
function resetFilters() {
    document.getElementById("search_q").value = "";
    document.getElementById("dist").value = "";
}

function filterCompanyByAll() {
    let search_val = document.getElementById("search_q").value;
    let dist = document.getElementById("dist").value;

    let data = new FormData();
    data.append('search_val', search_val);
    data.append('dist', dist);
    data.append('filterCompanyByAll', 'true');

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("company-results").innerHTML = xhttp.responseText;
        }
    };
    xhttp.open("POST", "./function/company.php", true);
    xhttp.send(data);
}
</script>