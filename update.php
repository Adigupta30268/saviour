<?php

$dbhost = 'localhost';  // Change this to your database host
$dbuser = 'root';       // Change this to your database user      
$dbpass = '';         // Change this to your database password
$dbname = 'patient'; // Ch  ange this to your database name

$conn = mysqli_connect($dbhost, $dbuser,$dbpass,$dbname);

// retrieve the primary key value from the form input

if(isset($_POST['submit'])){
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $filename = mysqli_real_escape_string($conn, $_FILES["uploadfile"]["name"]);
    $tempname = $_FILES["uploadfile"]["tmp_name"];
    $folder = "./image/" . $filename;
    $symp = mysqli_real_escape_string($conn, $_POST['symp']);
    $diag = mysqli_real_escape_string($conn, $_POST['diag']);
    $ttm = mysqli_real_escape_string($conn, $_POST['ttm']);
    $adv = mysqli_real_escape_string($conn, $_POST['adv']);

$sql = "INSERT INTO entries (prescription,symptoms,diagnosis,treatment,advice) VALUES ('$filename','$symp','$diag','$ttm','$adv') WHERE 'entryID' = $id";
if (mysqli_query($conn, $sql)) {
  echo "Record added successfully.";
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
move_uploaded_file($tempname,$folder);
}
?>
<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body>

  <div class="container">

     <form class="well form-horizontal"  method="post" enctype="multipart/form-data" id="contact_form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <fieldset>
    
    <div class="form-group">
      <label class="col-md-4 control-label">ID</label>  
        <div class="col-md-4 inputGroupContainer">
        <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-asterisk"></i></span>
      <input name="id" placeholder="add symptoms" class="form-control"  type="number">
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
      <label class="col-md-4 control-label">Image</label>  
      <div class="col-md-4 inputGroupContainer">
      <div class="input-group">
      <span class="input-group-addon"><i class="glyphicon glyphicon-picture"></i></span>
      <input name="uploadfile" placeholder="upload your image" class="form-control" type="file">
        </div>
      </div>
    </div>
    

    
    
    <!-- Button -->
    <div class="form-group">
      <label class="col-md-4 control-label"></label>
      <div class="col-md-4"><br>
        &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<button type="submit" class="btn btn-warning" name="submit" value="Submit">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspSUBMIT <span class="glyphicon glyphicon-send"></span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</button>
      </div>
    </div>
    
    </fieldset>
    </form>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>