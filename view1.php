<?php
// Step 1: Connect to the database
$dbhost = 'localhost';  // Change this to your database host
$dbuser = 'root';       // Change this to your database user      
$dbpass = '';         // Change this to your database password
$dbname = 'patient'; // Change this to your database name

$conn = mysqli_connect($dbhost, $dbuser,$dbpass,$dbname);
if (!$conn) {
    die('Could not connect: ' . mysqli_error());
}

$sql = "SELECT * FROM entries";
$request = mysqli_query($conn, $sql);



?>
<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <style>
      #id{
        background-color : white;
        width:300px;
      }
    </style>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
    <div class="container mt-5 px-2">
    
        <div class="mb-2 d-flex justify-content-between align-items-center">
            <form action="search2.php">
            <div class="position-relative" style="display:flex">
                <span class="position-absolute search" ><i class="fa fa-search"></i></span>
                <input name="entryID" type="text" class="form-control w-100" placeholder="Search by order#, name...">
                <button type="submit" class="btn btn-warning" id="id">View Record</button>
            </div>
            </form>
            
            <div class="px-2">
                
                <span>Filters <i class="fa fa-angle-down"></i></span>
                <i class="fa fa-ellipsis-h ms-3"></i>
            </div>
            
        </div>
        <div class="table-responsive">
        <table class="table table-responsive table-borderless">
            
          <thead>
            <tr class="bg-light">
              <th scope="col" width="5%">#</th>
              <!--<th scope="col" width="20%">Image</th>-->
              <th scope="col" width="10%">First Name</th>
              <th scope="col" width="20%">Last Name</th>
              <th scope="col" width="20%">E-mail</th>
              <th scope="col"  width="20%">Contact No.</th>
              <th scope="col"  width="20%">Age</th>
            </tr>
          </thead>
      <tbody>
          
      <?php
            while ($row = mysqli_fetch_assoc($request)) {
              echo
              "
              <tr>
              <td>{$row['entryID']}</td>"     
                ?>
              
                <!--<td><img src="./image/[(php code )echo $row['prescription'];] " height="100px" width="100px"></td>-->
                <?php
                echo
                "
          <td>{$row['first_name']}</td>
          <td>{$row['last_name']}</td>
          <td>{$row['email']}</td>
          <td>{$row['contact_no']}</td>
          <td>{$row['age']}</td>
        </tr>";
            }
            ?>
       
      </tbody>
    </table>
      
      </div>
        
    </div>
      
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>