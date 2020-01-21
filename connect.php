<?php
$conn=mysqli_connect("localhost","root","dia1");
if(!$conn)
{
    die(" opps Database connection Failed!!!".mysqli_connect_errno());
}
$select_db=mysqli_select_db($conn,"onlineattendance");
if(!$select_db)
{
    die("Database selection failed!!");
    mysqli_connect_errno();
    
}
else{
	echo "successfull";
}
?>