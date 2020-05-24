<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Sign In · TP n°10</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

</head>
<nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
    <a class="navbar-brand" href="../TP_n°10_langage_PHP/index.php">TP n°10 langage PHP & SQL</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
</nav>
<body>
<?php
session_start();

if(isset($_SESSION['adminId'])){
    header('Location: viewadmin.php');
    exit;
}
else {

   echo '<div class="container col-sm-8 jumbotron" >
    <h1 > Se Connecter </h1 ><hr >
    <form action = "controller.php?func=ConnectUser" method = "POST" >
        <input type = "text" name = "loginConnect" class="form-control" placeholder = "Login" required >
        <br >

        <input type = "password" name = "passwordConnect" class="form-control" placeholder = "Password" required >
        <br >

        <button class="btn btn-lg btn-primary btn-block" type = "submit" > Valider </button >
    </form >
</div >
</body >

<script src = "https://code.jquery.com/jquery-3.5.1.slim.min.js" ></script >
<script src = "https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" ></script >
<script src = "https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" ></script >
</html>';

    }

?>