<?php
    $login=false;
    $showError=false;
    include 'components/_dbconnect.php';
    if($_SERVER['REQUEST_METHOD']=='POST')
    {
        $user = $_POST['username'];
        $password = $_POST['password'];
        $sqlLogin="SELECT * FROM `user1` WHERE `username`='$user'";
        $result1 = mysqli_query($conn,$sqlLogin);
        $num = mysqli_num_rows($result1);
        if($num==1)
        {
            while($row=mysqli_fetch_assoc($result1))
            {
                if (password_verify($password, $row['password']))
                {
                    $login=true;
                    session_start();
                    $_SESSION['loggedin']=true;
                    $_SESSION['username']=$user;
                    header("location:home.php");
                }
                else{
                    $showError=true;
                }
            }
            
        }
        else{
            $showError=true;
        }

    }

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Login into Our Portal</title>
  </head>
  <body>
    <?php 
        include 'components/nav.php';
    ?>
    <h2 class="text-center">Login to proceed</h2>
    <div class="container my-2">
        <form action="/loginSystem/login.php" method="post" class="d-flex flex-column align-items-center">
            <div class="mb-3 col-md-6">
                <label for="username" class="form-label">Username</label>
                <input type="text" maxlength="15" class="form-control" id="username" name="username" aria-describedby="emailHelp">
            </div>
            <div class="mb-3 col-md-6">
                <label for="password" class="form-label">Password</label>
                <input type="password" maxlength="15" class="form-control" id="password" name="password">
                <?php
                    if($showError)
                    {
                        echo '<div class="form-text text-danger">Invalid username or password</div>';
                    }
                ?>
            </div>
            <div class="form-check col-md-6">
                <input class="form-check-input" type="checkbox"  id="flexCheckChecked" onclick="showPassword()">
                <label class="form-check-label" for="flexCheckChecked">Show Password
                    </label>
            </div>
            <div class="d-flex col-md-6">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="/loginSystem/forgot.php"role="button" type="submit" class="btn btn-primary ms-1">Forgot Password ?</a>
            </div>
        </form>
    </div>
  </body>
  <script>
      function showPassword() {
        let x = document.getElementById("password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
  </script>
</html>