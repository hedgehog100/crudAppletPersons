<?php
    session_start();
    
    $errMsg='';
    
    //if login.php is called using submit button, check user input
    if(isset($_POST['login'])
        && !empty($_POST['username'])
        && !empty($_POST['password'])){
            
        $_POST['username'] = htmlspecialchars($_POST['username']);
        $_POST['password'] = htmlspecialchars($_POST['password']);
            
        //check 'back door' login
        if($_POST['username'] == 'admin@admin.com'
           && $_POST['password'] == 'admin'){
                $_SESSION['username'] ='admin@admin.com';
                
                header("Location: display_list.php");
        }else{
            #check database
            require '../database/database.php';
            $pdo = Database::connect();
            $sql = "SELECT * FROM mes_person "
			. " WHERE username= ?"
			. " AND password= ?"
			. " LIMIT 1";
			
			$query=$pdo->prepare($sql);
			$query->execute(Array($_POST['username'], $_POST['password']));
			$result = $query->fetch(PDO::FETCH_ASSOC);
            
            if($result){
                $_SESSION['username'] = $result['username'];
                header('location: display_list.php');  //redirect
            }else{
               // echo "wrong username and password";
               $errMsg = 'Login failure: wrong username or password';
            }
        }
    }
    //else just display the input form
    
    //print_r($_SESSION);
?>

<!DOCTYPE html>
<html lang="en-US">
    <head>
        <title>Crud Applet with login</title>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    </head>
    
    <body>
        <div class = "container">
        <h1>Crud Applet with login</h1>
        <h2>Login</h2>
        
        <form acion="" method="post">
            
            <input type="text" class="form-control"
                name="username" placeholder="admin@admin.com"
                required autofocus /> <br/>
            <input type="password" class="form-control"
                name="password" placeholder="admin" required /><br/>
            <button class="btn btn-lg btn-primary btn-block"
                type="submit" name="login">Login</button>
            <button class="btn btn-lg btn-secondary btn-block"
                onClick="window.location.href = 'register.php';";
                type="button" name="join">join</button>
            
                
                 <p style="color: red;"><?php echo $errMsg; ?></p>
                 
        </form>
        </div>
    </body>
    
</html>