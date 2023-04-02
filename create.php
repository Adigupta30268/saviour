<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'patient';

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

if(isset($_POST['submit'])){
    $table_name = mysqli_real_escape_string($conn, $_POST['table_name']);
    $fields = mysqli_real_escape_string($conn, $_POST['fields']);

    $sql = "CREATE TABLE $table_name (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,";
    foreach ($fields as $field) {
        $sql .= "$field VARCHAR(30) NOT NULL,";
    }
    $sql .= "reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP)";

    if (mysqli_query($conn, $sql)) {
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
            Safari
</title> 
</head>
<body>
<form method="post" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  <label for="table_name">Table Name:</label>
  <input type="text" id="table_name" name="table_name"><br><br>

  <label for="field1">Field 1:</label>
  <input type="text" id="field1" name="fields[]"><br><br>

  <label for="field2">Field 2:</label>
  <input type="text" id="field2" name="fields[]"><br><br>

  <button type="submit" name="submit" value="Submit">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspSUBMIT <span class="glyphicon glyphicon-send"></span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</button>
</form>
</body>
</html>

