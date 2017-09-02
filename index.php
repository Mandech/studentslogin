<?php 
require("connection.php");
 ?>
<?php
  if(isset($_POST['btn_student'])){
  	// form variables
  	$fname=$_POST['fname'];
  	$lname=$_POST['lname'];
     $fname=ucfirst(mysqli_real_escape_string($connection,$_POST['fname'])); 
     $lname=ucfirst(mysqli_real_escape_string($connection,$_POST['lname'])); 
  	// sql statements
  	$query="INSERT INTO students_tbl(firstname,lastname) VALUES('{$fname}','{$lname}')";
  	// connecting sql
  	$result=mysqli_query($connection,$query) or die("query failed".mysqli_error($connection));
  	header("Location:index.php");
  	  }
    if (isset($_GET['deleteid'])) {
      $id=$_GET['deleteid'];
      $query="DELETE FROM students_tbl WHERE id=$id";
      $result=mysqli_query($connection,$query);
      header("Location:index.php");
      # code...
    }
  


?>
<!DOCTYPE html>
<html>
<head>
	<title>NAIROBits</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<link rel="stylesheet" type="text/css" href="css/bootstrap-theme.min.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body>
<div class="container">
<div class="col-md-6">

<form action="index.php" method="POST" name="student_form" onsubmit="return validate()">

  <input type="text" name="fname" placeholder="first name" class="form-control" ><br><br>
  <input type="text" name="lname" placeholder="last name"  class="form-control"><br><br>
  <input type="submit" name="btn_student" class="btn btn-danger">
	
</form>

<table class="table">
  <thead>
    <tr>
      <th>id</th>
      <th>First Name</th>
      <th>Last Name</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $query="SELECT* FROM students_tbl";
    $result=mysqli_query($connection, $query);
    while ($row=mysqli_fetch_array($result)) {
      echo '<tr>
             <td>'.$row['id'].'</td>
             <td>'.$row['firstname'].'</td>
             <td>'.$row['lastname'].'</td>
             <td><a href="index.php?deleteid='.$row['id'].'" class="btn btn-danger btn-xs" onclick="return confirm(\'Do you want to delete?\')">DELETE</a></td>
             <td><a href="student-edit.php?editid='.$row['id'].'" class="btn btn-primary btn-xs" >EDIT</a></td>
              </tr>';
    }
    ?>
  </tbody>
</table>




<script>
  function validate(){
    var Fname=document.student_form.fname.value;
    var Lname=document.student_form.lname.value;
    if (Fname=="") {
      alert('Please Enter First Name');
      return false;
    }
    if (Lname=="") {
      alert('Please Enter Last Name');
    }
          return true;
     
         

  }
</script>
	
</div>
</div>

<!-- script -->
<script type="text/javascript" src="js/jquery-3.2.1.slim.min.js"></script>
<script type="text/javascript" src="js/bootsrap.min.js"></script>
</body>
</html>