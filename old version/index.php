
<?php
/*session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
  header("Location: index.php");
  exit;
}*/
?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <title>S_Discuss.!</title>
</head>

<body>
  <?php include 'header.php'; ?>
  <?php include 'dbconnect.php'; ?>

  <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
        aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
        aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
        aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="http://source.unsplash.com/2400x700/?apple,code" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="http://source.unsplash.com/2400x700/?programmers,microsoft" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="http://source.unsplash.com/2400x700/?coding,apple" class="d-block w-100" alt="...">
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
      data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
      data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>

  <!-- category cantainer start here-->
  <div class="container">
    <h2 class="text-center">S_Discuss - Browzer Categories</h2>
    <div class="row">
      <?php
        $sql = "SELECT * FROM `s_discuse`";
        $result = mysqli_query($conn,$sql);
        while($row=mysqli_fetch_assoc($result)){
          $ci = $row['category_id'];
          $cn = $row['category_name'];
          $cd = $row['category_description'];
          echo '
          <div class="col-md-3 my-3">
          <div class="card" style="width: 18rem;">
              <img src="http://source.unsplash.com/400x280/?'.$cn.',coding" class="card-img-top" alt="...">
              <div class="card-body">
                  <h5 class="card-title">'.$cn.'</h5>
                  <p class="card-text">'.substr($cd,0,50).'...</p>
                  <a href="threadlist.php?ctid='.$ci.'" class="btn btn-primary">View threadlist</a>
              </div>
          </div>
          </div>';
        }
        ?>
    </div>
  </div>
  <?php include 'footer.php'; ?>

  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>
