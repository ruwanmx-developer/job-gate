<div id="ad_m_0" onclick="setMenu('ad_m_0_wrap')" class="menu-item mb-2 company-prim">
    <div class="activebar <?php if($admin_menu == "ad_m_0"){ echo "active"; }?>"></div>
    <div class="ms-4 name active">DASHBOARD</div>
</div>
<div id="ad_m_0_wrap" class="<?php if($admin_menu == "ad_m_0"){ echo "no-fade-jq"; }?>">
    <a href="dashboard.php" class="no-link">
        <div id="ad_m_0_1" class="menu-item mb-2 ms-4 company-sec">
            <div class="activebar <?php if($admin_submenu == "ad_m_0_1"){ echo "active"; }?>"></div>
            <div class="ms-4 name active">SUMMARY</div>
        </div>
    </a>
</div>

<div id="ad_m_1" onclick="setMenu('ad_m_1_wrap')" class="menu-item mb-2 company-prim">
    <div class="activebar <?php if($admin_menu == "ad_m_1"){ echo "active"; }?>"></div>
    <div class="ms-4 name active">MANAGE COMPANIES</div>
</div>
<div id="ad_m_1_wrap" class="<?php if($admin_menu == "ad_m_1"){ echo "no-fade-jq"; }?>">
    <a href="view_companies.php" class="no-link">
        <div id="ad_m_1_1" class="menu-item mb-2 ms-4 company-sec">
            <div class="activebar <?php if($admin_submenu == "ad_m_1_1"){ echo "active"; }?>"></div>
            <div class="ms-4 name active">ACTIVE COMPANIES</div>
        </div>
    </a>
    <a href="company_requests.php" class="no-link">
        <div id="ad_m_1_2" class="menu-item mb-2 ms-4 company-sec">
            <div class="activebar <?php if($admin_submenu == "ad_m_1_2"){ echo "active"; }?>"></div>
            <div class="ms-4 name active">COMPANIES SIGN REQUESTS</div>
        </div>
    </a>
    <a href="blocked_companies.php" class="no-link">
        <div id="ad_m_1_3" class="menu-item mb-2 ms-4 company-sec">
            <div class="activebar <?php if($admin_submenu == "ad_m_1_3"){ echo "active"; }?>"></div>
            <div class="ms-4 name active">BLOCKED COMPANIES</div>
        </div>
    </a>
</div>

<div id="ad_m_2" onclick="setMenu('ad_m_2_wrap')" class="menu-item mb-2 company-prim">
    <div class="activebar <?php if($admin_menu == "ad_m_2"){ echo "active"; }?>"></div>
    <div class=" ms-4 name active">MANAGE USERS</div>
</div>
<div id="ad_m_2_wrap" class="<?php if($admin_menu == "ad_m_2"){ echo "no-fade-jq"; }?>">
    <a href="view_users.php" class="no-link">
        <div id="ad_m_2_1" class="menu-item mb-2 ms-4 company-sec">
            <div class="activebar <?php if($admin_submenu == "ad_m_2_1"){ echo "active"; }?>"></div>
            <div class="ms-4 name active">VIEW EMPLOYEES</div>
        </div>
    </a>
</div>



<div id="ad_m_3" onclick="setMenu('ad_m_3_wrap')" class="menu-item mb-2 company-prim">
    <div class="activebar <?php if($admin_menu == "ad_m_3"){ echo "active"; }?>"></div>
    <div class=" ms-4 name active">SITE ADMINISTRATION</div>
</div>

<div id="ad_m_3_wrap" class="<?php if($admin_menu == "ad_m_3"){ echo "no-fade-jq"; }?>">
    <a href="job_configarations.php" class="no-link">
        <div id="ad_m_3_1" class="menu-item mb-2 ms-4 company-sec">
            <div class="activebar <?php if($admin_submenu == "ad_m_3_1"){ echo "active"; }?>"></div>
            <div class="ms-4 name active">JOB CONFIGARATIONS</div>
        </div>
    </a>
</div>
<div id="ad_m_4" onclick="setMenu('ad_m_4_wrap')" class="menu-item mb-2 company-prim">
    <div class="activebar <?php if($admin_menu == "ad_m_4"){ echo "active"; }?>"></div>
    <div class=" ms-4 name active">MESSAGES</div>
</div>
<div id="ad_m_4_wrap" class="<?php if($admin_menu == "ad_m_4"){ echo "no-fade-jq"; }?>">
    <a href="messages_emp.php" class="no-link">
        <div id="ad_m_4_1" class="menu-item mb-2 ms-4 company-sec">
            <div class="activebar <?php if($admin_submenu == "ad_m_4_1"){ echo "active"; }?>"></div>
            <div class="ms-4 name active">SEND EMPLOYEE MESSAGE</div>
        </div>
    </a>
    <a href="messages_cmp.php" class="no-link">
        <div id="ad_m_4_2" class="menu-item mb-2 ms-4 company-sec">
            <div class="activebar <?php if($admin_submenu == "ad_m_4_2"){ echo "active"; }?>"></div>
            <div class="ms-4 name active">SEND COMPANY MESSAGE</div>
        </div>
    </a>
</div>

<script>
const a0 = document.getElementById("ad_m_0_wrap");
const a1 = document.getElementById("ad_m_1_wrap");
const a2 = document.getElementById("ad_m_2_wrap");
const a3 = document.getElementById("ad_m_3_wrap");
const a4 = document.getElementById("ad_m_4_wrap");

if (!$(a0).is('.no-fade-jq')) {
    $(a0).hide();
}
if (!$(a1).is('.no-fade-jq')) {
    $(a1).hide();
}
if (!$(a2).is('.no-fade-jq')) {
    $(a2).hide();
}
if (!$(a3).is('.no-fade-jq')) {
    $(a3).hide();
}
if (!$(a4).is('.no-fade-jq')) {
    $(a4).hide();
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