<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->

     <link rel="stylesheet" href="http://localhost/ci4-blog/public/css/bootstrap.min.css" type="text/css" media="all" />

    <title>News Blog! ci4</title>
  </head>
  <body>

<nav class="navbar navbar-expand-lg navbar-light

 bg-light fixed-nav" style="overflow: hidden;
  position: fixed;
  top: 0;
  width: 100%; z-index: 100;">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">News Blog</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/ci4/public/news/index">News</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/ci4/public/news/world">World</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/ci4/public/news/business">Business</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/ci4/public/news/sport">Sport</a>
        </li>   
        <li class="nav-item">
          <a class="nav-link" href="/ci4/public/news/science">Science</a>
        </li>
        <?php 
       if(session()->get('isLoggedIn')){
        ?>
        <li class="nav-item">
          <a class="nav-link" href="create">Create News</a>
        </li>
        <?php
      } 

      ?>               

      </ul>
      <?php

      if(session()->get('isLoggedIn')){
        ?>
         <a href="" class="btn p-2 text-info"><?= session()->get('name');?></a>
         <a href="logout" class="btn pr-2 border" style="margin-right: 10px;">Logout</a>
        <?php

      
      }else{

      ?>
        <button class="btn btn-secondary mx-3" id="toggle" onclick="toggle=!toggle;loginwindow.style.display = toggle?'block':'none'" name="login" type="submit">Login</button>
      <?php 
      }

      ?>

      <form method="post" action="/ci4/public/news/search"  class="d-flex">
        <?= csrf_field() ?>
        <input class="form-control me-2" name="news_search" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" name="search_news" type="submit">News</button>
      </form>
    </div>
  </div>
</nav>


<div class="container w-25 shadow border p-3" style="z-index: 99;
    position: absolute;
    right: 20%;
    top: 10%;
    opacity: 1;display: none; border-radius: 10px; background: #95a5a6; color: white;" id="loginWindow">

  <form method="post" action="login">

    <?= csrf_field() ?>

    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">Email</label>
      <input type="email" name="email" class="form-control" required id="exampleInputEmail1" aria-describedby="emailHelp">
    </div>
    <div class="mb-3">
      <label for="exampleInputPassword1" class="form-label">Password</label>
      <input type="password" name="password" required class="form-control" id="exampleInputPassword1">
    </div>
    <button type="submit" class="btn btn-primary" name="login">Submit</button>
  </form>
</div>

<script type="text/javascript">
  var toggle=true,
    loginwindow = document.getElementById('loginWindow');
</script>
