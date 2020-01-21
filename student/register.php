<?php
        include ("connect.php");
            $stdid=$_POST['id'];
            if(!preg_match("/^[0-9]*$/",$stdid))
                {
                    echo "<p>plese enter valid registration ID number</p>";
                }
                echo $stdid;
            $fullname=$_POST['fullname'];
            if(!preg_match("/^[a-zA-Z ]*$/",$fullname)){
                echo "<p>Name should contain only alphabet</p>";
            }
            echo $fullname;
            $department=$_POST['dept'];
            echo "$department";
            $course=$_POST['course'];
            if(empty($course)){
                echo "<p>Please Select atleast one course</p>";
            }
            echo $course;
            $gender=$_POST['gender'];
            if(empty($gender)){
                echo "<p>select your gender</p>";
            }
            echo $gender;
            $date=$_POST['date'];
            if(empty($date)){
                echo "<p>select your date</p>";
            }
            echo $date;
            $start=$_POST['start'];
            $end=$_POST['end'];
            if(!$start>1000 && !$end<2100){
                echo "<p>Please Enter correct year</p>";

            }
            else{
               $batch= $start."".$end;
               echo $batch;

            if(empty($date)){
                echo "<p>Select Date Of Birth</p>";
            }
           else {

            $sql="INSERT INTO student_info(std_id,std_name,std_dept,std_course,std_batch,std_gender,std_dob)VALUES($stdid,'$fullname',$department,$course,$batch,'$gender','$date')";
            $query=mysqli_query($conn, $sql);
            if($query){
                session_start();
                $_SESSION['regid']=$stdid;

                header("Location:qrcode.php");
                
            }
            else{
                echo "error";
            }
           }
            }
?>
