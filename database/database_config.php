<?php
$__servername = "localhost";
$__username = "root";
$__password = "";
$__dbname = "jobgatev2";
$__page_error = "";
$__site_url = "https://localhost/Websites/Mini%20Project%20V2/";

try {
  $__conn = new mysqli($__servername, $__username, $__password, $__dbname);
}
catch (mysqli_sql_exception $__e) {
    $_redtitle = 'Database Not Connected'; 
    $_redmsg = 'This happend sometime when server is down or database is not operational.'; 
    header("location:./redirect.php?title=$_redtitle&msg=$_redmsg");
    return;
}
?>