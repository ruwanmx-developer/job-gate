<!DOCTYPE html>
<html lang="en">
<?php $__siteroot = "."; ?>

<head>
    <title>Admin Dashboard</title>
    <!-- include header links -->
    <?php include('../components/header_links.php');?>
</head>

<body>
    <!-- include navigation -->
    <?php include('../components/navigation.php');?>
    <div class="row gx-0">

        <!-- left bar -->
        <div class="col-lg-3 px-3 py-3">
            <div class="btn-title">System Manage</div>
            <?php 
            $admin_menu = "ad_m_0";
            $admin_submenu = "ad_m_0_1"; 
            ?>
            <?php include('./components/admin_menu_card.php');?>
        </div>

        <!-- middle bar -->
        <div class="col-lg-9 py-3 pe-3 ps-3 ps-lg-0">
            <div class="title-bar card-basic py-2 mb-3">
                SUMMARY
            </div>
            <div class="row gx-3">
                <div class="col-3">
                    <div>
                        <div class="title-bar-2 card-basic py-2">
                            USER RATIO
                            <canvas id="c1"></canvas>
                        </div>
                    </div>
                    <script>
                    const c1_data = {
                        labels: [
                            'Admins',
                            'Companies',
                            'Employies'
                        ],
                        datasets: [{
                            label: 'My First Dataset',
                            data: [
                                <?php 
                        $sql = "SELECT role_id, count(*) AS count FROM users GROUP BY role_id ORDER BY role_id";
                        $result = $__conn->query($sql);
                        while($row = $result->fetch_assoc()) {
                            echo $row['count'] . ",";
                        }
                        ?>
                            ],
                            backgroundColor: [
                                'rgb(255, 99, 132)',
                                'rgb(54, 162, 235)',
                                'rgb(255, 205, 86)'
                            ],
                            hoverOffset: 4
                        }]
                    };

                    const c1_config = {
                        type: 'doughnut',
                        data: c1_data,
                    };

                    const c1 = new Chart(
                        document.getElementById('c1'),
                        c1_config
                    );
                    </script>
                </div>
                <div class="col-3">
                    <div>
                        <div class="title-bar-2 card-basic py-2">
                            JOB COUNT
                            <canvas id="c2"></canvas>
                        </div>
                    </div>
                    <script>
                    const c2_data = {
                        labels: [
                            'Active',
                            'Closed',
                        ],
                        datasets: [{
                            label: 'My First Dataset',
                            data: [
                                <?php 
                        $sql = "SELECT count(*) AS count FROM jobs GROUP BY state ORDER BY state";
                        $result = $__conn->query($sql);
                        while($row = $result->fetch_assoc()) {
                            echo $row['count'] . ",";
                        }
                        ?>
                            ],
                            backgroundColor: [
                                'rgb(75, 192, 192)',
                                'rgb(255, 99, 132)',
                            ],
                            hoverOffset: 4
                        }]
                    };

                    const c2_config = {
                        type: 'doughnut',
                        data: c2_data,
                    };

                    const c2 = new Chart(
                        document.getElementById('c2'),
                        c2_config
                    );
                    </script>
                </div>

            </div>
        </div>
    </div>
    <?php include('../components/footer.php');?>
</body>

</html>