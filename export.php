<?php  
include 'connect.php';
session_start();

$id= $_SESSION['id'] ;

 $name=$_SESSION['name'];
 $dept=$_SESSION['dept'];
 $s=$_SESSION['sid'];
 echo "FACULTY:".$name;?></b></td>
<td >DEPARTMENT:<?php 
   $q = "SELECT * FROM department where dept_id=$dept ";
           $qu = mysqli_query($conn, $q);
           $row = mysqli_fetch_assoc($qu);
           $deptname=$row['dept_name'];
           echo $deptname;
           ?>
 </b>
 </td>
<?php


$output = '';
if(isset($_POST["export"]))
{
 $s=$_SESSION['sid'];

 $query = "SELECT attendance_info.std_id,log_book.std_batch,attendance_info.attended,log_book.total_class,log_book.sub_id,log_book.course_id FROM attendance_info,log_book where log_book.logbook_id=attendance_info.logbook_id  and attendance_info.std_id=$s and log_book.faculty_id=$id";
 $result = mysqli_query($conn, $query);
 if(mysqli_num_rows($result) > 0)
 {
  $output .= '
   <table class="table" bordered="1">
     <tr>
<th>Student ID</th>
<th>Course</th>
<th>Subject</th>
<th>Batch</th>
<th>Total class</th>  
<th>Total Attended</th>
<th>Percentage</th>  


</tr>
  ';
  while($row = mysqli_fetch_array($result))
  {
      $row["attended"];
      $row["total_class"];
      $percent=($row["attended"]/$row["total_class"])*100;
   $output .= '
    <tr> 

        <td>'.$row["std_id"].'</td>
         <td>'.$row["course_id"].'</td>
         <td>'.$row["sub_id"].'</td>
         <td>'.$row["std_batch"].'</td>
         <td>'.$row["total_class"].'</td>
         <td>'.$row["attended"].'</td>

        <td>'.$percent.'</td>  

     </tr>
   ';
  }
  $output .= '</table>';
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename=download.xls');
  echo $output;
 }
}

?>

