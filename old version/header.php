<?php
/*if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
  $loggedin =true;
}
else{
  $loggedin =false;
}**/
session_start();
echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<div class="container-fluid">
  <a class="navbar-brand" href="index.php">S_Discuss</a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="about.php">About</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button"
          data-bs-toggle="dropdown" aria-expanded="false">
          Category
        </a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">';
         
        require 'dbconnect.php';
        $sql = "SELECT category_id, category_name FROM `s_discuse` ";
        $result = mysqli_query($conn,$sql);
        while($row = mysqli_fetch_assoc($result)){
          echo '<a class="dropdown-item" href="threadlist.php?ctid='.$row['category_id'].'">'.$row['category_name'].'</a>';
        }

        echo '</ul>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="contact.php">Contact</a>
      </li>
    </ul>
    <form class="d-flex" action="search.php" method="get">
        <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-success ml-2" type="submit">Search</button>
      </form>';
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
      echo '
      <p class="text-light my-0 my-sm-0"> Welcome '. $_SESSION['useremail'] .'</p>
      <a role = "button" class="btn btn-outline-success mx-2 my-0" href="logout.php">Logout</a>';
    }
    else{
      echo '
      
      <button class="btn btn-outline-success mx-2 " data-bs-toggle="modal" data-bs-target="#loginModel">Login</button>
      <button class="btn btn-outline-success ml-2" data-bs-toggle="modal" data-bs-target="#signupModel">SignUp</button>
      ';
    }

  echo'    
  </div>
</div>
</nav>';
include 'login.php';
include 'signup.php';
if(isset($_GET['signupsuccess']) && $_GET['signupsuccess']=="true"){
  echo "<div class='alert alert-success alert-dismissible fade show my-0' role='alert' >
        <strong>Succes!</strong>You has been signup successfully. You can login now.!
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
}

elseif(isset($_GET['signupsuccess']) && $_GET['signupsuccess']=="false"){
  echo "<div class='alert alert-danger alert-dismissible fade show my-0' role='alert' >
        <strong></strong>".$_GET['error']."
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
}
/*elseif(isset($_GET['loginsuccess']) && $_GET['loginsuccess']=="true"){
  echo "<div class='alert alert-success alert-dismissible fade show my-0' role='alert' >
        <strong>Wellcome!</strong>to S_Discuss.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
}*/
elseif(isset($_GET['loginsuccess']) && $_GET['loginsuccess']=="false"){
  echo "<div class='alert alert-danger alert-dismissible fade show my-0' role='alert' >
        <strong></strong>".$_GET['loginerror']."
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
}
?>
