<!-- Modal -->

<?php
//$showerror1= "false";
/*f($_SERVER["REQUEST_METHOD"]=="POST"){
    require 'dbconnect.php';

    $email = $_POST['loginemail'];
    $pass = $_POST['loginpassword'];
    $sql = "Select * from users where user_email='$email'";
    //$sql = "Select * from usermy where username='$user'";
    $result = mysqli_query($conn,$sql);
    $num = mysqli_num_rows($result);
    if($num==1){
        $row = mysqli_fetch_assoc($result);
        if(password_verify($pass,$row['user_password'])){
            session_start();
            $_SESSION['loggedin']=true;
            $_SESSION['username']=$email;
            echo "login" ;
            //header("Location: /phpt/forum_project/index.php?loginsuccess=true");
            //exit();
        }
        else{
            //$showerror1= "check password";
            echo "check password";
        }
    }
    else{
        //$showerror1 ="please enter right email";
        echo "please enter right email";
    }
    //header("location: /phpt/forum_project/index.php?login=false?loginerror='$showerror1'");
}*/
?>
<div class="modal fade" id="loginModel" tabindex="-1" aria-labelledby="loginModelLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModelLabel">Login to S_Discuss</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/phpt/forum_project/loginheader.php" method="post">
                    <div class="mb-3">
                        <label for="loginemail" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="loginemail" name="loginemail" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="loginpassword" class="form-label">Password</label>
                        <input type="password" class="form-control" id="loginpassword" name="loginpassword">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </form>
            </div>
        </div>
    </div>
</div>
