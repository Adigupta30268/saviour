<?php

$dbhost = 'localhost';  // Change this to your database host
$dbuser = 'root';       // Change this to your database user      
$dbpass = '';         // Change this to your database password
$dbname = 'patient'; // Change this to your database name

$conn = mysqli_connect($dbhost, $dbuser,$dbpass,$dbname);

// retrieve the primary key value from the form input
$id = $_GET['entryID'];

// retrieve the record from the database using the primary key
$sql = "SELECT * FROM entries WHERE entryID = $id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result)

?>

<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <style>
    #zoomedImage {
      position: absolute;
      z-index: 9999;
      display: none;
    }
    #lol{
      border :2px outset #D6EEEE;
    }


    
  </style>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
   
  </head>
  <body>
      <div >
      <button style="background-color: #4CAF50; color: white; padding: 10px; text-align: center; text-decoration: none; display: inline-block; border-radius: 5px; border: none;margin : 5px 5px;float:right;">
  <a href="update.php?id=<?php echo $id; ?>" style="color: white; text-decoration: none;">Update Data</a>
</button>
  </div>
      <div class="table-responsive">
      <table class="table table-responsive table-borderless" id="lol">
        <thead>
            <tr>
                <th >#</th>
                <th>Details</th>
                
            </tr>
        </thead>
        <tbody>
          <?php
           
            
            foreach ($row as $column => $value) {
              if ($column == 'prescription') { // Replace 'image_url' with your actual image column name
                echo "<tr><td>$column <b>:</b> </td><td><img src=./image/{$value} height=100px width=100px onclick=zoomImage(this)></td></tr>";
                echo "<img id=zoomedImage src=./image/{$value}>";
            } else {
                echo "<tr><td>$column <b>:</b> </td><td> $value</td></tr>";
            }
            
        }
      
            ?>
            </tbody>
            </table>
      </div>

      <script>
    function zoomImage(img) {
      var zoomedImage = document.getElementById("zoomedImage");
      zoomedImage.src = img.src;
      zoomedImage.style.display = "block";
      zoomedImage.style.top = img.offsetTop + "px";
      zoomedImage.style.left = img.offsetLeft + img.offsetWidth + "px";
    }
    
    document.getElementById("zoomedImage").onclick = function() {
      this.style.display = "none";
    };
  </script>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>