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
    <style>
    div.absolute {
        text-align: right;
    }
    </style>
</head>

<body>
    <?php include 'dbconnect.php'; ?>
    <?php include 'header.php'; ?>

    <?php 
    $id = $_GET['ctid'];
    $sql = "SELECT * FROM `s_discuse` WHERE category_id=$id";
    $result = mysqli_query($conn,$sql);
    while($row=mysqli_fetch_assoc($result)){
        $cn = $row['category_name'];
        $cd = $row['category_description'];
    }
    ?>

    <!-- threadlist question-->
    <?php 
    $insert = false;
    if ($_SERVER['REQUEST_METHOD']=='POST'){
        $pblm_t = $_POST['title'];
        $pblm_desc = $_POST['desc'];

        $pblm_t = str_replace("<","&lt", $pblm_t);
        $pblm_t = str_replace(">","&gt", $pblm_t);
        
        $pblm_desc = str_replace("<","&lt;", $pblm_desc);
        $pblm_desc = str_replace(">","&gt;", $pblm_desc);

        $user_id = $_POST['user_id'];
        
        $sql = "INSERT INTO `threads` (`threads_title`, `threads_desc`, `threads_cat_id`, `threads_user_id`, `timestemp`) VALUES ('$pblm_t', '$pblm_desc ', '$id', '$user_id', current_timestamp());";

        $result = mysqli_query($conn,$sql);
        if($result){
            //echo "Database created successfully...!";
            $insert = true;
            if($insert){
                echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                <strong>Succes!</strong>Your query has been added..!
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
            }
        }
    }
    ?>
    <?php
    /*if($insert){
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong>Succes!</strong>Your query has been added..!
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
    }*/
    ?>

    <div class="container my-4">
        <div class="alert alert-secondary">
            <h1 class="display-4">welcome to <?php echo $cn;?> forums</h1>
            <p class="lead"><?php echo $cd;?></p>
            <hr class="my-4">
            <p>this is a perr to peer forum. No Spam / Advertising / Self-promote in the forum is not allowed. Do not
                post copyright-infringing Material. Do not post "offensive" posts, links or images.
                Do not post cross questions. Remain respectful of the other membera at all time.
            </p>
            </p>
            <a href="#" class="btn btn-success btn-lg" role="button"> learn more</a>
        </div>
    </div>


    <div class="container">
        <h1 class="py-2">Post a Comment</h1>

        <?php
        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
            echo'
                <form action="'.$_SERVER['REQUEST_URI'].'" method="post">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Problem Title</label>
                        <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
                        <div id="emailHelp" class="form-text">keep your title as short and crisp as possible</div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Elloborate Your Concorn</label>
                        <textarea class="form-control" id="desc" name="desc" row="3"></textarea>
                    </div>
                    <input type="hidden" name="user_id" value = '.$_SESSION['user_id'].'>
                    <button type="submit" class="btn btn-success">Submit</button>
                </form>';
        }
        else{
            echo 'You are not logged in. Please login to be able to post comment';
        }
        ?>
    </div>

    <div class="container">
        <h1 class="py-2">Browse Questions</h1>

        <?php 
        $id = $_GET['ctid'];
        $sql = "SELECT * FROM `threads` WHERE threads_cat_id=$id";
        $result = mysqli_query($conn,$sql);

        $noresult= true;
        while($row=mysqli_fetch_assoc($result)){
            $noresult= false;
            $ti = $row['threads_id'];
            $tt = $row['threads_title'];
            $td = $row['threads_desc'];
            $tdt = $row['timestemp'];
            $thread_user_id = $row['threads_user_id'];

            $sql2 = "SELECT user_email FROM `users` WHERE user_id='$thread_user_id' ";
            $result2 = mysqli_query($conn,$sql2);
            $row2 = mysqli_fetch_assoc($result2);

            echo'
            
                <div class="row">
                <img src="aaa.png" alt="John Doe" class="rounded-circle" style="width: 60px; height: 60px;" />
                    <div class = "col-md-5">
                        <h5 class="fw-bold"><a href="threads.php?t_id='.$ti.'" class="text-dark">'.$tt.'</a></h5>
                        <p>
                            '.$td.'
                        </p>
                    </div>    
                    <div class="col-md-5">
                        <p class="fw-bold my-0 text-end" >Ask by :'.$row2['user_email'].'at '.$tdt.'</p>
                    </div>
                </div>
            ';
        }
        if($noresult){
            echo' 
            <div class="container my-4">
            <div class="alert alert-secondary">
                <p class="display-6">No Threads Found...</p>
                <p>Be the first person to ask a question.</p>
                </div>
            </div>';
        }
        ?>
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