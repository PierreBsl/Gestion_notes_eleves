<!doctype html>
<html lang="fr">
<head>
    <title>Sign In · TP n°10</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

</head>
<nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
    <a class="navbar-brand" href="index.php">TP n°10 langage PHP & SQL</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
    </button>

</nav>
<?php

session_start();

if (isset($_SESSION['adminId'])){
    header('Location: viewadmin.php');
    exit;
}
else {

    include 'controller.php';

    echo '<body>
    <div class="container col-sm-8 jumbotron">
    <h1>S\'inscrire</h1><hr>
        <form action="controller.php?func=CreateUser" method="POST">
            <div class="form-group">
                <label>Login</label>
                <input name="login" type="text" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input name="password" type="password" class="form-control" required >
            </div>
            <div class="form-group">
                <label>Nom</label>
                <input name="nom" type="text" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Prénom</label>
                <input name="prenom" type="text" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Mail</label>
                <input name="mail" type="text" class="form-control" required>
            </div>
            <br>
            <button name = "validation" type="submit" class="btn btn-primary">Valider</button>
        </form>
    </div>
</body>
</html>';

}
?>
