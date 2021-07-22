<nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
  <div class="container-fluid">
    <a class="navbar-brand" href="/munna/login_sign/home.php">iSecure</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/munna/login_sign/home.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Services</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Contact</a>
        </li>
      </ul>
      <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-primary" type="submit">Search</button>
      </form>
      <?php
         if(!isset($_SESSION['loggedin'])||$_SESSION['loggedin']!=true)
         {
            echo '<form class="form-group">
                        <a class="btn btn-primary mx-2" href="/loginSystem/login.php" role="button">Login</a>
                        <a class="btn btn-primary" href="/loginSystem/signup.php" role="button">Sign Up</a>
                    </form>';
         }
         else{
            echo '<form class="form-group">
                        <a class="btn btn-primary mx-2" href="/loginSystem/logout.php" role="button">Logout</a>
                    </form>';
         }
            
      ?>
    </div>
  </div>
</nav>