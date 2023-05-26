<?php
$servername="localhost";
$username="root";
$password="";
$db_name = "0.0981";

$conn = mysqli_connect($servername,$username,$password,$db_name);

if($conn->connect_error){
  die("connection failed:" . connect_error);
}else{
  echo "conected successfully:";
}
 $sql= "SELECT * FROM `medicalinfo` ";
 if($result=mysqli_query($conn,$sql)){
  echo "CONNETED SUCCESSFULLY";
 }
 else {
    echo "ERROR " . mysqli_error() . "";
 }
 

?>
 
<!DOCTYPE html>
<html>
    <head>
        <title>
            View Medical Records
</title>
<link href = "assets\css\view_meds.css" rel = "stylesheet">
</head>
<body>
<form action="search2.php">
            <div class="position-relative" style="display:flex">
                <span class="position-absolute search" ><i class="fa fa-search"></i></span>
                <input name="entryID" type="text" class="form-control w-100" placeholder="Search by order#, name...">
                <button type="submit" class="btn btn-warning" id="id">View Record</button>
            </div>
            </form>
<div class="container">
  <h2> Your Patients </h2>
  <ul class="responsive-table">
    <li class="table-header">
      <div class="col col-1">id</div>
      <div class="col col-2">current_DayTime</div>
      <div class="col col-3">Img_Text</div>
      <div class="col col-4">Pdf</div>
      <div class="col col-5">Treatment</div>
      <div class="col col-6">Symptoms</div>
      <div class="col col-7">Advice</div>

    </li>
    <?php 
    while($row= mysqli_fetch_assoc($result)) {echo "
    <li class='table-row'>
      <div class='col col-1' data-label='id'>" . $row['id'] . " </div>
      <div class='col col-2'  data-label='current_DayTime'>" . $row['current_DayTime'] . "</div>
      <div class='col col-3'  data-label='Img_Text'>" . $row['Img_Text'] . "</div>
      <div class='col col-4'  data-label='Pdf'>" . $row['Pdf'] . "</div>
      <div class='col col-5' data-label='Treatment'>" . $row['Treatment'] . "</div>
      <div class='col col-6'  data-label='Symptons'>" . $row['Symptoms'] . "</div>
      <div class='col col-7'  data-label='Advice'>" . $row['Advice'] . " </div>
    </li>
    ";
  }


    ?>
    
  </ul>
</div>
</body>
</html>
