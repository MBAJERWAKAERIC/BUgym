<?php
include('../constant/connect.php');

$msgid = $_GET['id'];
if (strlen($msgid) > 0) {
    mysqli_query($con, "update plan set active ='no' WHERE pid='$msgid'");
    echo "<html><head><script>alert('Member Deleted');</script></head></html>";
    echo "<meta http-equiv='refresh' content='0; url=view_plan.php'>";
} else {
    echo "<html><head><script>alert('ERROR! Delete Opertaion Unsucessfull');</script></head></html>";
   echo "error".mysqli_error($con);
}

?>