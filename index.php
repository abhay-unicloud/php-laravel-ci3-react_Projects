<!DOCTYPE html>
<html lang="en">
<head>
 
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"> 

</head>
<body>
<?php
include("header.php")?>
<!-- <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"></a>
        <img src="assets/images/bridal-makeup-unique-makeover-by-nethra-rajesh-party-makeup-1_15_384894-163300128143425.jpeg" id="#logo" height="50px" width="50px">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
        </button>
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="list.php">List</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="form.php">Registration</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>  
                </ul>
            </div>
        </div> -->
  <!-- <form class="d-flex">
        <input class="form-control me-3" type="text" placeholder="Search">
        <button class="btn btn-primary" type="button">Search</button>
  </form>
</nav> -->
<!-- Carousel -->
<div id="demo" class="carousel slide carousel-fade" data-bs-ride="carousel" height="100px" width="100px">

    <!-- Indicators/dots -->
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
      <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
      <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
    </div>
    
    <!-- The slideshow/carousel -->
    <div class="carousel-inner">
      <div class="carousel-item active">
            <img src="assets/images/user/swami.jpg" alt="Los Angeles" class="d-block" style="width:100%">
      </div>
      <div class="carousel-item">
            <img src="assets/images/user/swami 2.jpg" alt="Chicago" class="d-block" style="width:100%">
      </div>
      <div class="carousel-item">
            <img src="assets/images/user/swa3.jpg" alt="New York" class="d-block" style="width:100%">
      </div>
      
    </div>
    
    <!-- Left and right controls/icons -->
    <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
    <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
      <span class="carousel-control-next-icon"></span>
    </button>
</div>
  
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
 
<?php
include("footer.php")?>
</body>
</html>