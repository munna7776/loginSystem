<?php 
        $updateAlert=false;
        $available=false;
        if($_SERVER['REQUEST_METHOD']=="POST")
        {
            include 'components/_dbconnect.php';
            $user = $_POST['username'];
            $password = $_POST['password'];
            $cpassword = $_POST['cpassword'];
            $sql1 = "SELECT * FROM user1 WHERE username = '$user'";
            $result=mysqli_query($conn,$sql1);
            $num1 = mysqli_num_rows($result);
            if($num1==1)
            {
                if($password==$cpassword)
                {
                    $pass = password_hash($password,PASSWORD_DEFAULT);
                    $cpass = password_hash($cpassword,PASSWORD_DEFAULT);
                    $sql = "UPDATE `user1` SET `password` = '$pass',`cpassword`='$cpass' WHERE username = '$user'";
                    $update = mysqli_query($conn,$sql);
                    if($update)
                    {
                        $updateAlert=true;
                    }
                }
            }
            else{
                $available=true;
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

    <title>Forgot Password</title>
  </head>
  <body>
    <?php 
        include 'components/nav.php';
        if($updateAlert==true)
        {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success !</strong> Your password has been updated. 
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
        }
    ?>
    <div class="container">
        <h2 class="text-center">Reset Your password</h2>
        <form action="/loginSystem/forgot.php" method="post" class="d-flex flex-column align-items-center">
            <div class="mb-3 col-md-6">
                <label for="username" class="form-label">Username</label>
                <input type="text" maxlength="15" class="form-control" id="username" name="username" aria-describedby="emailHelp">
                <?php
                    if($available)
                    {
                        echo '<div class="form-text text-danger"> ! username not registered</div>';
                    }
                ?>
            </div>
            <div class="mb-3 col-md-6">
                <label for="password" class="form-label">New Password</label>
                <input type="password" maxlength="15" class="form-control" id="password" name="password">
            </div>
            <div class="mb-3 col-md-6">
                <label for="cpassword" class="form-label">Confirm Password</label>
                <input type="password" maxlength="15" class="form-control" id="cpassword" name="cpassword">
                <div id="emailHelp" class="form-text">Make sure to enter the same password !</div>
            </div>
            <div class="form-check col-md-6">
                <input class="form-check-input" type="checkbox"  id="flexCheckChecked" onclick="showPassword()">
                <label class="form-check-label" for="flexCheckChecked">Show Password
                    </label>
            </div>
            <div class="col-md-6">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
  <script>
      function showPassword() {
        let x = document.getElementById("password");
        let y = document.getElementById("cpassword");
        if (x.type === "password" || y.type === "password") {
            x.type = "text";
            y.type = "text";
        } else {
            x.type = "password";
            y.type = "password";
        }
    }
  </script>
</html>