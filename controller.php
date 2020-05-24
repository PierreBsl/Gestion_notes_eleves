<?php

include 'database/connexpdo.php';

if($_GET['func'] == 'CreateUser'){
    CreateUser($_POST['login'], $_POST['password'], $_POST['mail'], $_POST['nom'], $_POST['prenom']);
}
if($_GET['func'] == 'CreateStudent'){
    CreateStudent($_POST['nomStudent'], $_POST['prenomStudent'], $_POST['note']);
}
if($_GET['func'] == 'ConnectUser'){
    ConnectUser($_POST['loginConnect'], $_POST['passwordConnect']);
}
if($_GET['func'] == 'UpdateStudent'){
    UpdateStudent($_POST['Update'], $_POST['nomUpdateStudent'], $_POST['prenomUpdateStudent'], $_POST['noteUpdateStudent'] );
}
if($_GET['func'] == 'DeleteStudent'){
    DeleteStudent($_POST['Delete']);
}
if($_GET['func'] == 'Disconnect'){
    Disconnect();
}

function CreateUser($login, $password, $mail, $nom, $prenom) {

    $db = connexpdo('pgsql:dbname=etudiants;host=localhost;port=5433','postgres','new_password');

    $nbr_users = 1;

    $q = "SELECT login FROM users ";
    $r = $db->query($q);
    foreach ($r as $data) {
        $nbr_users++;
    }

    $password1 = password_hash($password, PASSWORD_DEFAULT);

    $sql1 = "INSERT INTO users (id, login, password, mail, nom, prenom) VALUES (?, ?, ?, ?, ?, ?)";
    $sqlR1 = $db->prepare($sql1);
    $sqlR1->execute([$nbr_users, $login, $password1, $mail, $nom, $prenom]);

    header("Location: index.php");
}

function ConnectUser($login, $password) {
    session_start();

    $db = connexpdo('pgsql:dbname=etudiants;host=localhost;port=5433', 'postgres', 'new_password');

    $q = "SELECT id, nom, prenom, password FROM users WHERE login = '$login'";
    $sth = $db->prepare($q);
    $sth->execute();
    $r = $sth->fetchAll();

    if (password_verify($password, $r[0]['password'])) {
        $_SESSION["adminId"] = $r[0]['id'];
        $_SESSION["adminPrenom"] = $r[0]['prenom'];
        $_SESSION["adminNom"] = $r[0]['nom'];
        header("Location: viewadmin.php");
    } else {
        header("Location:index.php");
    }
}

function CreateStudent($nom, $prenom, $note) {

    $db = connexpdo('pgsql:dbname=etudiants;host=localhost;port=5433','postgres','new_password');

    $newid = 0;

    $q = "SELECT id FROM students ";
    $r = $db->query($q);
    foreach ($r as $data) {
        $currentid=$data['id'];
        if($currentid>$newid){
            $newid=$currentid;
        }
    }
    $newid+=1;

    $sql1 = "INSERT INTO students (id, user_id, nom, prenom, note) VALUES (?, ?, ?, ?, ?)";
    $sqlR1 = $db->prepare($sql1);
    $sqlR1->execute([$newid, $_SESSION["adminId"], $nom, $prenom, $note]);

    header("Location: viewadmin.php");
}

function ReadStudent() {
    $db = connexpdo('pgsql:dbname=etudiants;host=localhost;port=5433','postgres','new_password');

    $nbr_student=0;

    $query0 = "SELECT nom FROM students WHERE user_id =".$_SESSION["adminId"];
    $nbr = $db->query($query0);
    foreach ($nbr as $data) {
        $nbr_student++;
    }

    if($nbr_student>=1) {
        echo'<table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nom</th>
                <th scope="col">Prénom</th>
                <th scope="col">Note</th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>';
        $query1 = "SELECT id, nom, prenom, note FROM students WHERE user_id =".$_SESSION["adminId"];
        $sth = $db->prepare($query1);
        $sth->execute();
        $result=$sth->fetchAll();

        for ($k = 0; $k < $nbr_student; $k++) {
            $index=$k+1;
            echo '<tr>';
            echo '<th id="idStudent" scope="row">'.$index.'</th>';
            echo '<td>' . $result[$k]['nom'] . '</td>';
            echo '<td>' . $result[$k]['prenom'] . '</td>';
            echo '<td>' . $result[$k]['note'] . '</td>';
            echo '<td><form method="POST" action="vieweditstudent.php?id='.$result[$k]['id'].'"><button style="float: right" type="submit" class="btn btn-primary">Update</button></form></td>';
            echo '<td><form method="POST" action="controller.php?func=DeleteStudent"><button style="float: right" name="Delete" value="'.$result[$k]['id'].'" type="submit" class="btn btn-danger">Delete</button></form></td>';
            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';
    }else{
        return;
    }
}

function UpdateStudent($id, $nom, $prenom, $note) {
    $db = connexpdo('pgsql:dbname=etudiants;host=localhost;port=5433','postgres','new_password');

    $sql = "UPDATE students SET nom='".$nom."', prenom ='".$prenom."', note ='".$note."' WHERE id=".$id;
    $stmt = $db->prepare($sql);
    $stmt->execute();

    header("Location: viewadmin.php");
}

function DeleteStudent($id) {
    $db = connexpdo('pgsql:dbname=etudiants;host=localhost;port=5433','postgres','new_password');

    $q = "DELETE FROM students WHERE id=".$id;
    $db->exec($q);

    header("Location: viewadmin.php");
}

function NotesAverage(){
    $db = connexpdo('pgsql:dbname=etudiants;host=localhost;port=5433','postgres','new_password');

    $sommeNotes = 0;
    $nbr_students = 0;

    $q = "SELECT note FROM students WHERE user_id=".$_SESSION['adminId'];
    $r = $db->query($q);
    foreach ($r as $data) {
        $sommeNotes+=$data['note'];
        $nbr_students++;
    }
    if ($nbr_students>0){

        echo'<br>
    <h3>Moyenne des étudiants</h3><hr>';
        echo'<h2>';
        $moyenne=$sommeNotes/$nbr_students;
        echo $moyenne."</h2>";
    }else {
        return;
    }
}

function Disconnect(){
    session_start();
    session_destroy();
    header('Location: index.php');
    exit;
}