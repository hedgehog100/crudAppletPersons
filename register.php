<h1>Register New User</h1>
<form method='post' action='insert_new_user.php'>
    username: <input name='username' type='text' ><br />
    password: <input name='password' type='text' ><br />
    <input type="submit" value="Submit">
    <button onClick="window.location.href = 'login.php';";
            type="button" name="cancel">cancel</button>
</form>