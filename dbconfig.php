<?php
$connection=mysqli_connect('localhost','root','','myphp');
if(!$connection){
    die("Couldn't connect to DB".mysqli_connect_error());
}
   // $name=$row['1']
                /*
                foreach($sheetdata as $row)
                {
                if($count>0)
                {
                $empNo = $row['0'];
                if(is_numeric($empNo)){
                $response .= "Empno validation: Success; ";
                } else {
                $response .= "Empno validation: Failure; ";
                }
                $name = $row['1'];
                if(preg_match('/^[a-zA-Z\s\'-]+$/', $name)){
                $response .= "Name validation: Success; ";
                } else {
                $response .= "Name validation: Failure; ";
                }
                $joiningDate= $row['2'];
                $date = DateTime::createFromFormat('Y-m-d', $joiningDate);
                if($date && $date->format('Y-m-d') === $joiningDate){
                $response .= "Joining date validation: Success; ";
                } else {
                $response .= "Joining date validation: Failure; ";
                }
                $email= $row['3'];
                if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                $response .= "Email validation: Success; ";
                } else {
                $response .= "Email validation: Failure; ";
                }
                $department = $row['4'];
                if(preg_match('/^[a-zA-Z\s\'-]+$/', $department)){
                $response .= "Department validation: Success; ";
                } else {
                $response .= "Department validation: Failure; ";
                }
                $salary= $row['5'];
                $job_status=$row['6'];
                $query="INSERT INTO empexcel(Emp_No,Name,Joining_Date,Email_id,Department,Salary,job_status,Response) 
                VALUES('$empNo','$name','$joiningDate','$email','$department','$salary','$job_status','$response')";
                $result=mysqli_query($connection,$query);
                $msg=true;
                $response = ""; // reset response for the next row
                } else {
                $count="1";
                }
                }
                */
                //  $name = $row['1'];
                // $joiningDate= $row['2'];
                // $email= $row['3'];
                // $department = $row['4'];
                // $salary= $row['5'];
                // $job_status=$row['6'];
?>