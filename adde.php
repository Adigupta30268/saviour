<?php
error_reporting(E_ALL ^ E_WARNING);
  
$dbhost = 'localhost';  
$dbuser = 'root';           
$dbpass = '';         

$conn = mysqli_connect($dbhost, $dbuser,$dbpass);
if (!$conn) {
    die('Could not connect: ' . mysqli_error());
}


if (isset($_POST['submit'])) {
    $image = mysqli_real_escape_string($conn, $_FILES["image"]["name"]);
    $tempname_img = $_FILES["image"]["tmp_name"];
    $target_position_image = "./uploads/images/" . $image;
    $aadhar_num = mysqli_real_escape_string($conn,$_POST['aadhar_num']);
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    $dbname = mysqli_real_escape_string($conn, $_POST['id']);
    $email=mysqli_real_escape_string($conn,$_POST['email']);
    $contact_no=mysqli_real_escape_string($conn,$_POST['contact_no']);
    $bloodgrp =  mysqli_real_escape_string($conn, $_POST['bloodgrp']);
    $dob = mysqli_real_escape_string($conn, $_POST['dob']);
    $symp = mysqli_real_escape_string($conn, $_POST['symp']);
    $diag = mysqli_real_escape_string($conn, $_POST['diag']);
    $ttm = mysqli_real_escape_string($conn, $_POST['ttm']);
    $adv = mysqli_real_escape_string($conn, $_POST['adv']);
    
    $create_db_query = "CREATE DATABASE `0.$aadhar_num`";
    mysqli_query($conn,$create_db_query);
    $dbname = "0.$aadhar_num";
    mysqli_select_db($conn,$dbname);

    $create_table = "CREATE TABLE `$aadhar_num.11`(
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        current_DayTime TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        Img VARCHAR(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
        First_Name VARCHAR(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
        Last_Name VARCHAR(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
        BloodGrp VARCHAR(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
        Email VARCHAR(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
        Contact_No TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
        DOB DATE NOT NULL,
        Passwordd VARCHAR(50) NOT NULL
        )";
        mysqli_query($conn,$create_table);

      $create_table_1 = "CREATE TABLE `MedicalInfo`(
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        current_DayTime TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        Img VARCHAR(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci  NULL,
        Pdf VARCHAR(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
        Diagnosis TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
        Treatment VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
        Symptoms TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
        Advice TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL
        )";
      mysqli_query($conn,$create_table_1);
       

    move_uploaded_file($image, $target_position_image);

    $lang=shell_exec("tesseract $target_position_image stk");
    $img_txt = readfile("stk.txt");
    echo $img_txt;
    
    
    
    $sql = "INSERT INTO `$aadhar_num.11` (Img,First_Name,Last_Name,Email,Contact_No,BloodGrp,DOB,Passwordd) VALUES ('$target_position_image','$first_name','$last_name','$email','$contact_no','$bloodgrp','$dob','$password')";
    $sql2 = "INSERT INTO `MedicalInfo` (Img,Diagnosis,Treatment,Symptoms,Advice) VALUES ('$target_position_image','$diag','$ttm','$symp','$adv')";
    
    if (mysqli_query($conn, $sql)) {
        echo "Record added successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_query($conn,$sql2);
    
   
}

mysqli_close($conn);
?>

<!---<html>
<head>
    <title>Insert Data</title>
</head>
<body>
    <form method="post" action=">
        First Name: <input type="text" name="first_name"><br><br>
        Last Name : <input type="text" name="last_name"><br><br>
        Age : <input type="text" name="age"><br><br>
        Blood Groop: <input type="text" name="bloodgrp"><br><br>
        <input type="submit" name="submit" value="Submit">
    </form>
</body>
</html>--->

<html lang="en">
  <head>
    <title>Title</title>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

  </head>
  <body>
    <div class="container">
    
     <form class="well form-horizontal"  method="post" enctype="multipart/form-data" id="contact_form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <fieldset>
    
    <legend><centre><h2><b>Add Patient</b></h2></centre></legend><br>
   <input type="hidden" name="id" value="<?php echo $id ?>">

    <div class="form-group">
      <label class="col-md-4 control-label">AADHAR NUMBER : </label>  
      <div class="col-md-4 inputGroupContainer">
      <div class="input-group">
      <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
      <input  name="aadhar_num" class="form-control"  type="text" required>
        </div>
      </div>
    </div>

    <div class="form-group">
      <label class="col-md-4 control-label">Image</label>  
      <div class="col-md-4 inputGroupContainer">
      <div class="input-group">
      <span class="input-group-addon"><i class="glyphicon glyphicon-picture"></i></span>
      <input name="image" placeholder="upload your image" class="form-control" type="file" >
        </div>
      </div>
    </div>
    
    <div class="form-group">
      <label class="col-md-4 control-label">First Name</label>  
      <div class="col-md-4 inputGroupContainer">
      <div class="input-group">
      <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
      <input  name="first_name" placeholder="First Name" class="form-control"  type="text" required>
        </div>
      </div>
    </div>
    
    <div class="form-group">
      <label class="col-md-4 control-label" >Last Name</label> 
        <div class="col-md-4 inputGroupContainer">
        <div class="input-group">
      <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
      <input name="last_name" placeholder="Last Name" class="form-control"  type="text" required>
        </div>
      </div>
    </div>

    <div class="form-group">
      <label class="col-md-4 control-label">E-Mail</label>  
        <div class="col-md-4 inputGroupContainer">
        <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
      <input name="email" placeholder="E-Mail Address" class="form-control"  type="text" required>
        </div>
      </div>
    </div>
           
    <div class="form-group">
      <label class="col-md-4 control-label">Contact No.</label>  
        <div class="col-md-4 inputGroupContainer">
        <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
      <input name="contact_no" placeholder="(639)" class="form-control" type="number" required>
        </div>
      </div>
    </div>

    <div class="form-group">
      <label class="col-md-4 control-label">Blood group</label>  
        <div class="col-md-4 inputGroupContainer">
        <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-tint"></i></span>
      <input name="bloodgrp" placeholder="O+ve" class="form-control" type="text" required>
        </div>
      </div>
    </div>
    

    <div class="form-group">
      <label class="col-md-4 control-label">Date of Birth</label>  
        <div class="col-md-4 inputGroupContainer">
        <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
      <input name="dob" placeholder="11-10-2004" class="form-control" type="date" required>
        </div>
      </div>
    </div>

    <div class="form-group">
      <label class="col-md-4 control-label">SET Password</label>  
        <div class="col-md-4 inputGroupContainer">
        <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-random"></i></span>
      <input name="password" class="form-control"  type="password">
        </div>
      </div>
    </div>

    <div class="form-group">
      <label class="col-md-4 control-label">Symptoms</label>  
        <div class="col-md-4 inputGroupContainer">
        <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-asterisk"></i></span>
      <input name="symp" placeholder="add symptoms" class="form-control"  type="text">
        </div>
      </div>
    </div>

    <div class="form-group">
      <label class="col-md-4 control-label">Diagnosis</label>  
        <div class="col-md-4 inputGroupContainer">
        <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-random"></i></span>
      <input name="diag" class="form-control"  type="text">
        </div>
      </div>
    </div>

    <div class="form-group">
      <label class="col-md-4 control-label">Treatment</label>  
        <div class="col-md-4 inputGroupContainer">
        <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-grain"></i></span>
      <input name="ttm"  class="form-control"  type="text">
        </div>
      </div>
    </div>

    <div class="form-group">
      <label class="col-md-4 control-label">Advice</label>  
        <div class="col-md-4 inputGroupContainer">
        <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-option-vertical"></i></span>
      <input name="adv"  class="form-control"  type="text" >
        </div>
      </div>
    </div>
    
    <div class="form-group">
      <label class="col-md-4 control-label"></label>
      <div class="col-md-4"><br>
        &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<button type="submit" class="btn btn-warning" name="submit" value="Submit">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspSUBMIT<span class="glyphicon glyphicon-send"></span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</button>
      </div>
    </div>
    
    </fieldset>
    </form>
    </div>
    </div>
      
  
    
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    

  </body>
</html>