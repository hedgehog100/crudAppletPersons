<?php
session_start();
if(!isset($_SESSION['username'])){
    header("Location: login.php");
}

# connect
require '../database/database.php';
$pdo = Database::connect();

# put the information for the chosen record into variable $results 
$id = $_GET['id'];
$sql = "DELETE FROM messages WHERE id=" . $id;
$query=$pdo->prepare($sql);
$query->execute();
$result = $query->fetch();

?>
<h1>message was deleted</h1>
<form method='post' action='display_list.php'>
    <input type="submit" value="Submit">
</form>
