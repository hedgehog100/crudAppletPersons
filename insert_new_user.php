<?php
# This process inserts a new user in mes_person table

# 1. connect to database
require '../database/database.php';
$pdo = Database::connect();

# 2. assign user info to a variable
$username = $_POST['username'];
$password = $_POST['password'];
$username = htmlspecialchars($username);
$password = htmlspecialchars($password);
//$password_hash = MD5($password);

//Check to make syre username is not there
$sql1 = "SELECT id FROM mes_person WHERE username='$username'";
$result = $pdo->query($sql1);
if(!$result){
    echo "<p>Username $username already exists.</p><br>";
    echo "<a href='register.php'>Back to Register</a>";
}else{

# 3. assign MySQL query code to a variable
$sql = "INSERT INTO mes_person (username, password) VALUES (?, ?)";

$query=$pdo->prepare($sql);
$query->execute(Array($username, $password));
$result = $query->fetchAll(PDO::FETCH_ASSOC);

# 4. insert the message into the database
$pdo->query($sql); # execute the query
echo "<p>Your info has been added. You can now login</p><br>";
echo "<a href='login.php'>Back to login</a>";
}