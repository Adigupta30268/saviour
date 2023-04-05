<?php

$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "patient";
$conn = mysqli_connect($servername, $username, $password, $dbname);
$text = '';
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

require('class.pdf2text.php');

extract($_POST);
 

if(isset($readpdf)){

     

    if($_FILES['file']['type']=="application/pdf") {

        $a = new PDF2Text();

        $a->setFilename($_FILES['file']['tmp_name']); 

        $a->decodePDF();

        echo $a->output(); 
        
        $text = $a->output();

    }

      

    else {

        echo "<p style='color:red; text-align:center'>

            Wrong file format</p>
";

    }
}   


// Store processed text in database
$sql = "INSERT INTO f_22 (pdf) VALUES ('$text')";
if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// Close database connection
mysqli_close($conn);
?>

 
<html>
 
<head>

    <title>Read pdf php</title>
</head>
 
<body>

    <form method="post" enctype="multipart/form-data">

        Choose Your File

        <input type="file" name="file" />

        <br>

        <input type="submit" value="Read PDF" name="readpdf" />

    </form>
</body>
 
</html>
 