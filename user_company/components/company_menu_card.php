<div id="co_m_1" onclick="setMenu('co_m_1_wrap')" class="menu-item mb-2 company-prim">
    <div class="activebar <?php if ($admin_menu == "co_m_1") {
                                echo "active";
                            } ?>"></div>
    <div class=" ms-4 name active">MANAGE DASHBOARD</div>
</div>
<div id="co_m_1_wrap" class="<?php if ($admin_menu == "co_m_1") {
                                    echo "no-fade-jq";
                                } ?>">
    <a href="view_company_details.php" class="no-link ">
        <div id="co_m_1_1" class="menu-item mb-2 ms-4 company-sec">
            <div class="activebar <?php if ($admin_submenu == "co_m_1_1") {
                                        echo "active";
                                    } ?>"></div>
            <div class="ms-4 name active">COMPANY PROFILE</div>
        </div>
    </a>
    <a href="edit_company_details.php" class="no-link ">
        <div id="co_m_1_2" class="menu-item mb-2 ms-4 company-sec">
            <div class="activebar <?php if ($admin_submenu == "co_m_1_2") {
                                        echo "active";
                                    } ?>"></div>
            <div class="ms-4 name active">EDIT COMPANY PROFILE</div>
        </div>
    </a>
</div>

<div id="co_m_2" onclick="setMenu('co_m_2_wrap')" class="menu-item mb-2 company-prim">
    <div class="activebar <?php if ($admin_menu == "co_m_2") {
                                echo "active";
                            } ?>"></div>
    <div class=" ms-4 name active">MANAGE JOBS</div>
</div>
<div id="co_m_2_wrap" class="<?php if ($admin_menu == "co_m_2") {
                                    echo "no-fade-jq";
                                } ?>">
    <a href="add_new_job.php" class="no-link ">
        <div id="co_m_2_1" class="menu-item mb-2 ms-4 company-sec">
            <div class="activebar <?php if ($admin_submenu == "co_m_2_1") {
                                        echo "active";
                                    } ?>"></div>
            <div class=" ms-4 name active">CREATE NEW JOB</div>
        </div>
    </a>
    <a href="active_jobs.php" class="no-link ">
        <div id="co_m_2_2" class="menu-item mb-2 ms-4 company-sec">
            <div class="activebar <?php if ($admin_submenu == "co_m_2_2") {
                                        echo "active";
                                    } ?>"></div>
            <div class=" ms-4 name active">MANAGE CURRENT ACTIVE JOBS</div>
        </div>
    </a>
    <a href="closed_jobs.php" class="no-link ">
        <div id="co_m_2_3" class="menu-item mb-2 ms-4 company-sec">
            <div class="activebar <?php if ($admin_submenu == "co_m_2_3") {
                                        echo "active";
                                    } ?>"></div>
            <div class=" ms-4 name active">CLOSED JOBS</div>
        </div>
    </a>
</div>

<div id="co_m_3" onclick="setMenu('co_m_3_wrap')" class="menu-item mb-2 company-prim">
    <div class="activebar <?php if ($admin_menu == "co_m_3") {
                                echo "active";
                            } ?>"></div>
    <div class=" ms-4 name active">MANAGE USERS</div>
</div>
<div id="co_m_3_wrap" class="<?php if ($admin_menu == "co_m_3") {
                                    echo "no-fade-jq";
                                } ?>">
    <a href="view_applications.php" class="no-link ">
        <div id="co_m_3_1" class="menu-item mb-2 ms-4 company-sec">
            <div class="activebar <?php if ($admin_submenu == "co_m_3_1") {
                                        echo "active";
                                    } ?>"></div>
            <div class=" ms-4 name active">VIEW APPLICATIONS</div>
        </div>
    </a>
    <a href="" class="no-link ">
        <div id="co_m_3_2" class="menu-item mb-2 ms-4 company-sec">
            <div class="activebar <?php if ($admin_submenu == "co_m_3_2") {
                                        echo "active";
                                    } ?>"></div>
            <div class=" ms-4 name active">SEARCH EMPLOYEES</div>
        </div>
    </a>
    <a href="" class="no-link ">
        <div id="co_m_3_3" class="menu-item mb-2 ms-4 company-sec">
            <div class="activebar <?php if ($admin_submenu == "co_m_3_3") {
                                        echo "active";
                                    } ?>"></div>
            <div class=" ms-4 name active">APPROVED APPLICATIONS</div>
        </div>
    </a>
</div>
<script>
const m1 = document.getElementById("co_m_1_wrap");
const m2 = document.getElementById("co_m_2_wrap");
const m3 = document.getElementById("co_m_3_wrap");

if (!$(m1).is('.no-fade-jq')) {
    $(m1).hide();
}
if (!$(m2).is('.no-fade-jq')) {
    $(m2).hide();
}
if (!$(m3).is('.no-fade-jq')) {
    $(m3).hide();
}

function setMenu(x) {
    let set = document.getElementById(x);
    if (set.offsetParent === null) {
        $(set).fadeIn();
    } else {
        $(set).fadeOut();
    }
}
</script>