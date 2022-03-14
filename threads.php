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
    <?php include 'dbconnect.php'; ?>
    <?php include 'header.php'; ?>
    <?php 
        $id = $_GET['t_id'];
        $sql = "SELECT * FROM `threads` WHERE threads_id=$id";
        $result = mysqli_query($conn,$sql);

        $noresult = true;
        while($row=mysqli_fetch_assoc($result)){
            $noresult = false;
            $ti = $row['threads_id'];
            $tt = $row['threads_title'];
            $td = $row['threads_desc'];
            $tdt = $row['timestemp'];
        }
    ?>

    <!-- for comment insert-->
    <?php 
    $insert = false;
    $id = $_GET['t_id'];
    if ($_SERVER['REQUEST_METHOD']=='POST'){
        $comment = $_POST['comment'];
        $comment = str_replace("<","&lt;",$comment);
        $comment = str_replace(">","&gt;",$comment);
        $user_id = $_POST['user_id'];
        
        $sql = "INSERT INTO `comments` (`comment_content`, `thread_id`, `comment_by`, `comment_dt`) VALUES ('$comment', '$id', '$user_id', current_timestamp())";

        $result = mysqli_query($conn,$sql);
        if($result){
            //echo "Database created successfully...!";
            $insert = true;
        }
    }
    ?>
    <?php
    if($insert){
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong>Succes!</strong>Your comment has been added...!
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
    }
    ?>

    <div class="container my-4">
        <div class="alert alert-secondary">
            <h1 class="display-4"><?php echo $tt;?></h1>
            <p class="lead"><?php echo $td;?></p>
            <hr class="my-4">
            <p>this is a perr to peer forum. No Spam / Advertising / Self-promote in the forum is not allowed. Do not
                post copyright-infringing Material. Do not post "offensive" posts, links or images.
                Do not post cross questions. Remain respectful of the other membera at all time.
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
                        <label for="exampleInputPassword1" class="form-label">Type your comment</label>
                        <textarea class="form-control" id="desc" name="comment" row="3"></textarea>
                        <input type="hidden" name="user_id" value = '.$_SESSION['user_id'].'>
                    </div>
                    <button type="submit" class="btn btn-success">Post Comment</button>
                </form>';
        }
        else{
            echo 'You are not logged in. Please login to be able to post comment';
        }
        ?>

    </div>

    <div class="container">
        <h1 class="py-2">Discussions</h1>

        <?php 
        $id = $_GET['t_id'];
        $sql = "SELECT * FROM `comments` WHERE thread_id=$id";
        $result = mysqli_query($conn,$sql);
        $noresult=true;
        while($row=mysqli_fetch_assoc($result)){
            $noresult=false;
            $ci = $row['comment_id'];   
            $cc = $row['comment_content'];
            $comment_user = $row['comment_by'];
            $date_time = $row['comment_dt'];

            $sql2 = "SELECT user_email FROM `users` WHERE user_id='$comment_user' ";
            $result2 = mysqli_query($conn,$sql2);
            $row2 = mysqli_fetch_assoc($result2);
        
            echo'
                <div class="d-flex my-3">
                    <img src="aaa.png" alt="John Doe" class="me-3 rounded-circle" style="width: 60px; height: 60px;" />
                    <div>
                    <h5 class="fw-bold my-0">'.$row2['user_email'].'</h5>
                        <p>
                            '.$cc.'
                        </p>
                    </div>              
                </div>';
        }
        if($noresult){
            echo' 
            <div class="container my-4">
            <div class="alert alert-secondary">
                <p class="display-6">No Result Found...</p>
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