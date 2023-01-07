<div id="em_m_1" onclick="setMenu('em_m_1_wrap')" class="menu-item mb-2 company-prim">
    <div class="activebar <?php if ($admin_menu == "em_m_1") {
                                echo "active";
                            } ?>"></div>
    <div class=" ms-4 name active">MANAGE DASHBOARD</div>
</div>
<div id="em_m_1_wrap" class="<?php if ($admin_menu == "em_m_1") {
                                    echo "no-fade-jq";
                                } ?>">
    <a href="view_employee_details.php" class="no-link ">
        <div id="em_m_1_1" class="menu-item mb-2 ms-4 company-sec">
            <div class="activebar <?php if ($admin_submenu == "em_m_1_1") {
                                        echo "active";
                                    } ?>"></div>
            <div class="ms-4 name active">EMPLOYEE PROFILE</div>
        </div>
    </a>
    <a href="edit_employee_details.php" class="no-link ">
        <div id="em_m_1_2" class="menu-item mb-2 ms-4 company-sec">
            <div class="activebar <?php if ($admin_submenu == "em_m_1_2") {
                                        echo "active";
                                    } ?>"></div>
            <div class="ms-4 name active">EDIT EMPLOYEE PROFILE</div>
        </div>
    </a>
</div>

<div id="em_m_2" onclick="setMenu('em_m_2_wrap')" class="menu-item mb-2 company-prim">
    <div class="activebar <?php if ($admin_menu == "em_m_2") {
                                echo "active";
                            } ?>"></div>
    <div class=" ms-4 name active">MANAGE JOBS APPLICATIONS</div>
</div>
<div id="em_m_2_wrap" class="<?php if ($admin_menu == "em_m_2") {
                                    echo "no-fade-jq";
                                } ?>">
    <a href="view_pending_applications.php" class="no-link ">
        <div id="em_m_2_1" class="menu-item mb-2 ms-4 company-sec">
            <div class="activebar <?php if ($admin_submenu == "em_m_2_1") {
                                        echo "active";
                                    } ?>"></div>
            <div class=" ms-4 name active">PENDING APPLICATIONS</div>
        </div>
    </a>
    <!-- <a href="view_accepted_applications.php" class="no-link ">
        <div id="em_m_2_2" class="menu-item mb-2 ms-4 company-sec">
            <div class="activebar <?php if ($admin_submenu == "em_m_2_2") {
                                        echo "active";
                                    } ?>"></div>
            <div class=" ms-4 name active">ACCEPTED APPLICATIONS</div>
        </div>
    </a>
    <a href="view_rejected_applications.php" class="no-link ">
        <div id="em_m_2_3" class="menu-item mb-2 ms-4 company-sec">
            <div class="activebar <?php if ($admin_submenu == "em_m_2_3") {
                                        echo "active";
                                    } ?>"></div>
            <div class=" ms-4 name active">REJECTED APPLICATIONS</div>
        </div>
    </a> -->
    <a href="" class="no-link ">
        <div id="em_m_2_2" class="menu-item mb-2 ms-4 company-sec">
            <div class="activebar <?php if ($admin_submenu == "em_m_2_2") {
                                        echo "active";
                                    } ?>"></div>
            <div class=" ms-4 name active">INVITATIONS</div>
        </div>
    </a>
</div>

<div id="em_m_3" onclick="setMenu('em_m_3_wrap')" class="menu-item mb-2 company-prim">
    <div class="activebar <?php if ($admin_menu == "em_m_3") {
                                echo "active";
                            } ?>"></div>
    <div class=" ms-4 name active">MANAGE SAVINGS</div>
</div>
<div id="em_m_3_wrap" class="<?php if ($admin_menu == "em_m_3") {
                                    echo "no-fade-jq";
                                } ?>">
    <a href="view_companies.php" class="no-link ">
        <div id="em_m_3_1" class="menu-item mb-2 ms-4 company-sec">
            <div class="activebar <?php if ($admin_submenu == "em_m_3_1") {
                                        echo "active";
                                    } ?>"></div>
            <div class=" ms-4 name active">FOLLOWING COMPANIES</div>
        </div>
    </a>
</div>
<div id="em_m_4" onclick="setMenu('em_m_4_wrap')" class="menu-item mb-2 company-prim">
    <div class="activebar <?php if ($admin_menu == "em_m_4") {
                                echo "active";
                            } ?>"></div>
    <div class=" ms-4 name active">MESSAGES</div>
</div>
<div id="em_m_4_wrap" class="<?php if ($admin_menu == "em_m_4") {
                                    echo "no-fade-jq";
                                } ?>">
    <a href="messages_emp.php" class="no-link">
        <div id="em_m_4_1" class="menu-item mb-2 ms-4 company-sec">
            <div class="activebar <?php if ($admin_submenu == "em_m_4_1") {
                                        echo "active";
                                    } ?>"></div>
            <div class="ms-4 name active">SEND EMPLOYEE MESSAGE</div>
        </div>
    </a>
    <a href="messages_adm.php" class="no-link">
        <div id="em_m_4_2" class="menu-item mb-2 ms-4 company-sec">
            <div class="activebar <?php if ($admin_submenu == "em_m_4_2") {
                                        echo "active";
                                    } ?>"></div>
            <div class="ms-4 name active">SEND ADMIN MESSAGE</div>
        </div>
    </a>
</div>

<script>
    const m1 = document.getElementById("em_m_1_wrap");
    const m2 = document.getElementById("em_m_2_wrap");
    const m3 = document.getElementById("em_m_3_wrap");
    const m4 = document.getElementById("em_m_4_wrap");

    if (!$(m1).is('.no-fade-jq')) {
        $(m1).hide();
    }
    if (!$(m2).is('.no-fade-jq')) {
        $(m2).hide();
    }
    if (!$(m3).is('.no-fade-jq')) {
        $(m3).hide();
    }
    if (!$(m4).is('.no-fade-jq')) {
        $(m4).hide();
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