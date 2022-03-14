<?php
$showerror= "false";
if ($_SERVER['REQUEST_METHOD']=='POST'){
    require 'dbconnect.php';

    $email = $_POST['loginemail'];
    $pass = $_POST['loginpassword'];
    
    
    //$sql = "Select * from usermy where username='$user' AND password='$pass'";
    $sql = "Select * from users where user_email='$email'";
    $result = mysqli_query($conn,$sql);
    $num=mysqli_num_rows($result);

    if($num== 1){
        $row=mysqli_fetch_assoc($result);
            if(password_verify($pass,$row['user_password'])){
                session_start();
                $_SESSION['loggedin']=true;
                $_SESSION['useremail']=$email;
                $_SESSION['user_id'] = $row['user_id'];
                header("Location: index.php?loginsuccess=true");
                exit();
            }
            else{
                $showerror= "Please check your password";
            }
            header("Location: index.php");
    }
    else{
        $showerror= "Invaild Credentials";
    }
    header("Location: index.php?loginsuccess=false&loginerror=$showerror");
}   
?>