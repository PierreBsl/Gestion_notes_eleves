<!doctype html>
<html lang="fr">
<head>
    <title>Create Student · TP n°10</title>

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
if(!isset($_SESSION['adminId'])){
    header('Location: index.php');
}else {
    $user_id = $_SESSION["adminId"];
    $user_nom = $_SESSION["adminNom"];
    $user_prenom = $_SESSION["adminPrenom"];
    include "controller.php";

    $db = connexpdo('pgsql:dbname=etudiants;host=localhost;port=5433', 'postgres', 'new_password');


    echo '<body>
    <div class="container col-sm-8 jumbotron">
    <h1>Créer un nouvel Étudiant</h1><hr>
        <form action="controller.php?func=CreateStudent" method="POST">
            <div class="form-group">
                <label>Nom</label>
                <input name="nomStudent" type="text" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Prénom</label>
                <input name="prenomStudent" type="text" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Note</label>
                <input name="note" type="number" class="form-control" min="0" max="20"required>
            </div>
            <br>
            <button name = "validation" type="submit" class="btn btn-primary">Valider</button>
        </form>
    </div>
</body>
</html>';
}
?>
