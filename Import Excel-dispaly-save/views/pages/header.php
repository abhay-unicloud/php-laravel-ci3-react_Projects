<!DOCTYPE html>
<html lang="en">
<head>
 
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"> 
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet"> 
</head>
<body>

<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">
        <img src=assets/images/user/swami.jpg id="#logo" height="50px" width="50px"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
        </button>
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav">
                    <?php if($name !=""){ ?>
                   <li class="nav-item">
                        <a class="nav-link" href="list.php">List</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><?php echo $name; ?></a>
                    </li>  
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>  
                    <?php } else{ ?>
                    <li class="nav-item">
                        <a class="nav-link" href="form.php">Registraion</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                    <?php } ?>  
                   
                </ul>
            </div>
        </div>
  <form class="d-flex">
        <input class="form-control me-3" type="text" placeholder="Search">
        <button class="btn btn-primary" type="button">Search</button>
  </form>
</nav>