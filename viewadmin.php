<!DOCTYPE html>
<html lang="fr">

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <title>Admin Panel</title>
</head>
<nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
    <a class="navbar-brand" href="index.php">TP n°10 langage PHP & SQL</a>
    </button>

</nav>
<main>
<!-- Contact -->
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

    echo '
<div class="container col-sm-9 jumbotron" id="contact">
    <h2 style="display: inline;">Menu Administrateur de ' . $user_prenom . ' ' . $user_nom . '</h2>
        <a style="float: right;" href="controller.php?func=Disconnect">
            <button class="btn btn-info">Deconnexion</button>
        </a>
    <hr>';

    echo '<br>
    <h3>Liste des étudiants</h3>';
    ReadStudent();
    echo '<br>
    <div>
        <a href="viewnewstudent.php" class="button-pe-connect is-blue" data-toggle="tooltip" data-placement="bottom" title="">
            <button class="btn btn-info">Ajouter un étudiant</button>
        </a>
    </div>';

    NotesAverage();
    echo '</div></main></html>';

}
