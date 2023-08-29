<?php
$conn=mysqli_connect("localhost","root","","php_ajax_crud");


if(isset($_POST['checking_add']))
{
     $fname = $_POST['fname'];
     $lname = $_POST['lname']; 
     $class = $_POST['class'];
     $section = $_POST['section'];

     $query = "INSERT INTO `students`(fname,lname,class, section )VALUES('$fname','$lname','$class','$section')";
     $query_run = mysqli_query($conn,$query);

     If($query_run)
     {
        echo $return = "successfully stored";
     }
     else
     {
        echo $return = "something went wrong";

     }
}
?>