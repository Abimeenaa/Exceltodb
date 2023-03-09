<?php
include 'dbconfig.php';
require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
//use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
if (isset($_POST['save_excel_data'])) {
    $filename = $_FILES['import_file']['name']; 
    //sampleexcel.xls
    /*
    echo "Filename: " . $_FILES['file']['name']."<br>";
    echo "Type : " . $_FILES['file']['type'] ."<br>";
    echo "Size : " . $_FILES['file']['size'] ."<br>";
    echo "Temp name: " . $_FILES['file']['tmp_name'] ."<br>";
    echo "Error : " . $_FILES['file']['error'] . "<br>";
    */

    $file_extension = pathinfo($filename, PATHINFO_EXTENSION);
   // $file_extension = xls
    $allowed_ext = ['xls', 'csv', 'xlsx'];

    if (in_array($file_extension, $allowed_ext)) { //it will check if the given file is in this array
        $inputFileName = $_FILES['import_file']['tmp_name'];

        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileName);
        $sheetdata = $spreadsheet->getActiveSheet()->toArray();
        // var_dump($sheetdata); //by using the above \phpSpreadsheet\Spreadsheet we are calling the class Spreadsheet() and using the function in spreadsheet getActiveSheet()
        $count = 0;
        foreach ($sheetdata as $row) {
            if ($count > 0) {
                $flag = true;
                $empNo = $row['0'];
                $name = $row['1'];
                $joiningDate = $row['2'];
                $email = $row['3'];
                $department = $row['4'];
                $salary = $row['5'];
                $job_status = $row['6'];
                $response = "";

                if (!is_numeric($empNo)) {
                    $response .= "Invalid Emp.No, ";
                    $flag = false;
                }
                if (!preg_match('/^[A-Z][a-z\s]{2,20}+$/', $name)) {
                    $response .= "Invalid name, ";
                    $flag = false;
                }
                if (!preg_match("/^(19|20)\d{2}-(0[1-9]|1[012])-(0[1-9]|[12][0-9]|3[01])$/", $joiningDate)) {
                    $response .= "Invalid joining date, ";
                    $flag = false;
                }
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $response .= "Invalid email address, ";
                    $flag = false;
                }
               if (!preg_match('/^[a-zA-Z\s\'-]+$/', $department)) {
                    $response .= "Invalid department name, ";
                    $flag = false;
                }
               if (!is_numeric($salary)) {
                    $response .= "Invalid salary, ";
                    $flag = false;
                }
               if (!preg_match('/^[a-zA-Z\s\'-]+$/', $job_status)) {
                    $response .= "Invalid job status, ";
                    $flag = false;
                }

                if ($flag == true) {
                    $response = "Success";
                    $query = "INSERT INTO empexcel(Emp_No,Name,Joining_Date,Email_id,Department,Salary,job_status,Response) 
                         VALUES('$empNo','$name','$joiningDate','$email','$department','$salary','$job_status','$response')";
                    $result = mysqli_query($connection, $query);

                } else {
                    $response .= "Failed";
                    $query = "INSERT INTO empexcel(Emp_No,Name,Joining_Date,Email_id,Department,Salary,job_status,Response) 
        VALUES('$empNo','$name','$joiningDate','$email','$department','$salary','$job_status','$response')";
                    $result = mysqli_query($connection, $query);

                }
                $msg = true;
            } else {
                $count = 1;
            }
        }
        if (isset($msg)) {
            echo '<script language="javascript">alert("Imported successfully!");</script>';
            echo '<script language="javascript">window.location = "index.php";</script>';
            exit;
        } else {

            echo '<script language="javascript">alert("File not imported!");</script>';
            echo '<script language="javascript">window.location = "index.php";</script>';

            exit;
        }
    } else {
        echo '<script language="javascript">alert("Invalid file format!");</script>';
        echo '<script language="javascript">window.location = "index.php";</script>';

        exit;
    }
}

?>