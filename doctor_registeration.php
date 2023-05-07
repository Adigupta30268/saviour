<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'doctors';

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

if(isset($_POST['submit'])){
    $table_name = mysqli_real_escape_string($conn, $_POST['table_name']);
    $full_name=mysqli_real_escape_string($conn,$_POST['full_name']);
    $email=mysqli_real_escape_string($conn,$_POST['email']);  
    $num=mysqli_real_escape_string($conn,$_POST['num']);
    $dob=mysqli_real_escape_string($conn,$_POST['dob']);
    $password = mysqli_escape_string($conn,$_POST['password']);
    $uni = mysqli_real_escape_string($conn,$_POST['university']);
    $address=mysqli_real_escape_string($conn,$_POST['address']);
    $image = $_FILES["image"]["tmp_name"];
   $image_target_dir = "image/";
   $image_name = basename($_FILES["image"]["name"]);
   $image_target_path = $image_target_dir . $image_name;


   
    move_uploaded_file($image,$image_target_path);

    $sql = "CREATE TABLE `$table_name` (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        Img VARCHAR(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
        Full_Name VARCHAR(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
        Email VARCHAR(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
        University VARCHAR(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
        Addres TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
        Phone_Number VARCHAR(100) NOT NULL,
        DOB DATE NOT NULL,
        Passwordd VARCHAR(50) NOT NULL 
    )";
   
   mysqli_query($conn, $sql);
  
   $sql1 = "INSERT INTO `$table_name` (Img,Full_Name, Email,University, Phone_Number,Addres, DOB,Passwordd) VALUES ('$image_target_path','$full_name', '$email','$uni', '$num','$address', '$dob','$password')";

   move_uploaded_file($image,$image_target_path);
    
    if (mysqli_query($conn, $sql1)) {
         echo "Table created successfully";
    } else {
        echo "Error creating table: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>
            Doctor's Registration
</title>

<style>
    .gradient-custom-3 {
/* fallback for old browsers */
background: lightgrey;

/* Chrome 10-25, Safari 5.1-6 */
background: -webkit-linear-gradient(to right, lightgrey, lightgrey);

/* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
background: linear-gradient(to right)
}
.gradient-custom-4 {
/* fallback for old browsers */
background: #84fab0;

/* Chrome 10-25, Safari 5.1-6 */
background: -webkit-linear-gradient(to right);

/* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
background: linear-gradient(to right, rgba(132, 250, 176, 1), rgba(143, 211, 244, 1))
}
</style>
<link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
</head>
<body>
<section class="vh-100 bg-image"
  style="background-image: url('https://mdbcdn.b-cdn.net/img/Photos/new-templates/search-box/img4.webp');">
  <div class="mask d-flex align-items-center h-100 gradient-custom-3">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
          <div class="card" style="border-radius: 15px;">
            <div class="card-body p-5">
              <h2 class="text-uppercase text-center mb-5">Doctor's Registration</h2>
<form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

<div class="form-outline mb-4">Profile Picture :
    <input type="file" name="image" id="form3Example1cg" class="form-control form-control-lg" />
  </div>
                                               
<div class="form-outline mb-4">Enter Your Medical ID :
    <input type="text" name="table_name" id="form3Example1cg" class="form-control form-control-lg" />
  </div>

  <div class="form-outline mb-4">Enter your Full Name :
    <input type="text" name="full_name" id="form3Example1cg" class="form-control form-control-lg" />
  </div>

  <div class="form-outline mb-4">University :
    <input type="text" name="university" id="form3Example1cg" class="form-control form-control-lg" />
  </div>

  <div class="form-outline mb-4">Email :
    <input type="email" name="email" id="form3Example1cg" class="form-control form-control-lg" />
  </div>

  <div class="form-outline mb-4">Contact no. :
    <input type="number" name="num" id="form3Example3cg" class="form-control form-control-lg" />
  </div>

  <div class="form-outline mb-4">Enter your Address :
    <input type="text" name="address" id="form3Example1cg" class="form-control form-control-lg" />
  </div>

  <div class="form-outline mb-4">Date of Birth:
    <input type="date" name="dob" id="form3Example4cg" class="form-control form-control-lg" />
  </div>

  <div class="form-outline mb-4">Set Password :
    <input type="password" name="password" id="form3Example4cdg" class="form-control form-control-lg" />
  </div>

  <div class="form-check d-flex justify-content-center mb-5">
    <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3cg" />
    <label class="form-check-label" for="form2Example3g">
      I agree that all the imformation i have given is completely true , and <br>i am aware that if
      the information is further turns out to be frawd legal actions will be taken<br></a>
    </label>
  </div>

  <div class="d-flex justify-content-center">
    <button type="submit" onclick="myFUNC()"
      class="btn btn-success btn-block btn-lg gradient-custom-4 text-body"  name="submit">Submit</button>
  </div>
  <script>
    function myFUNC(){
      alert("Thankyou for Registering in SAVIOUR, WE WILL CONTACT YOU SHORTY!!");
    }
    </script>
  </form>

  </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
  </body>