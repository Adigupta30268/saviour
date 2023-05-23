<?php

$host = 'localhost';
$username = 'root';
$password = '';
$db_name = 'saviour';

$conn = mysqli_connect($host, $username,$password,$db_name);
if (!$conn) {
    die('Could not connect: ' . mysqli_error());
}

if(isset($_POST['submit'])){
    $aadhar_no = mysqli_real_escape_string($conn,$_POST['aadhar_no']);
    $full_name = mysqli_real_escape_string($conn,$_POST['full_name']);
    $address = mysqli_real_escape_string($conn,$_POST['address']);
    $profile_image = mysqli_real_escape_string($conn,$_FILES['prof_pic']['name']);
    $profile_image_target_position = "./uploads/images/profile/" . $profile_image;
    $dob = mysqli_real_escape_string($conn,$_POST['dob']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $password = mysqli_real_escape_string($conn,$_POST['pass_code']);
    $contact_no = mysqli_real_escape_string($conn,$_POST['contact_no']);
    $emergency_no1 = mysqli_real_escape_string($conn,$_POST['emergency_no1']);
    $emergency_no2 = mysqli_real_escape_string($conn,$_POST['emergency_no2']);
    $emergency_no3 = mysqli_real_escape_string($conn,$_POST['emergency_no3']);


    $sql = "INSERT INTO `personal_info` (unique_id,aadhar_no,full_name,Images,email,date_of_birth,addresss,passwordd,contact_no,emergency_no1,emergency_no2,emergency_no3)
                 VALUES ('0.$aadhar_no','$aadhar_no','$fullname','$profile_image_target_position','$email','$dob','$address','$password','$contact','$emergency_no1','$emergency_no2','$emergency_no3')";

if (mysqli_query($conn, $sql)) {
    header("Location: ../thanks.html"); // Corrected redirect using header()
    exit(); // It's a good practice to exit after redirecting
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

    mysqli_close($conn);
}