<?php 
    $success=false;
    $showAlert=false;
    $user_not_available=false;
    if($_SERVER['REQUEST_METHOD']=='POST')
    {
        include 'components/_dbconnect.php';
        $user = $_POST['username'];
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];
        $existUser = "SELECT * FROM user1 WHERE username = '$user'";
        $existresult1 = mysqli_query($conn,$existUser);
        $existRows = mysqli_num_rows($existresult1);
        if($existRows>0)
        {
            $user_not_available=true;
        }
        else{
            if($password==$cpassword)
            {
                $pass_hash=password_hash($password, PASSWORD_DEFAULT);
                $cpass_hash = password_hash($cpassword, PASSWORD_DEFAULT);
                $sql = "INSERT INTO `user1` (`username`, `password`, `cpassword`, `date`) VALUES ('$user', '$pass_hash', '$cpass_hash', current_timestamp())";
                $result = mysqli_query($conn,$sql);
                if($result)
                {
                    $success=true;
                }
            }
            else{
                $showAlert=true;
            }
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

    <title>Sign Up</title>
  </head>
  <body>
    <?php include 'components/nav.php';
    if($success)
        {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success !</strong> You have been registered.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
    ?>
    <h2 class="text-center">Sign Up to proceed Further</h2>
    <div class="container my-2">
        <form action="/loginSystem/signup.php" method="post" class="d-flex flex-column align-items-center">
            <div class="mb-3 col-md-6">
                <label for="username" class="form-label">Username</label>
                <input type="text" maxlength="15" class="form-control" id="username" name="username" aria-describedby="emailHelp">
                <?php 
                    if($user_not_available)
                    {
                        echo '<div class="form-text text-danger">Username not available</div>';
                    }
                ?>
            </div>
            <div class="mb-3 col-md-6">
                <label for="password" class="form-label">Password</label>
                <input type="password" maxlength="15" class="form-control" id="password" name="password">
            </div>
            <div class="mb-3 col-md-6">
                <label for="cpassword" class="form-label">Confirm Password</label>
                <input type="password" maxlength="15" class="form-control" id="cpassword" name="cpassword">
                <div id="emailHelp" class="form-text">Make sure to enter the same password !</div>
            </div>
            <?php   
                if($showAlert)
                {
                    echo       ' <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong> !Passwords do not match.</strong> You should check in on some of those fields below.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
                }
            ?>
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