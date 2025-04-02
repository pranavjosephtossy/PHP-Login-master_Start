<?php require_once('../template/headerlogin.php'); ?>
<?php require_once ('config.php');?>
    <title>Sign in</title>
</head>

<?php

        function sanit($data)
        {
            $data = htmlspecialchars($data, ENT_QUOTES | ENT_SUBSTITUTE, "UTF-8");
            $data = trim($data);
            $data = stripslashes($data);
            return($data);
        }

        if(isset($_POST['Submit']))
        {
            $loginUsername=sanit($_POST['Username']);
            $loginPassword= sanit($_POST['Password']);
            $db = new SQLite3(__DIR__ . '/../db.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);

            $user= getUserInfo($db,$loginUsername);
            var_dump($user['pass']);
            if($loginPassword== $user['pass'])
            {
                $_SESSION['user'] = $user['username'];
                $_SESSION['Active'] = true;
                header("location:index.php");
                exit; 
            }
            else
                echo 'Incorrect Username or Password';
        }
        //var_dump($_SESSION);
        function getUserinfo($db, $username)
        {
            $query = 'SELECT * FROM usersz WHERE username = ? LIMIT 1';
            $stmt = $db->prepare($query);
            $stmt->bindParam(1, $username, SQLITE3_TEXT);
            $result = $stmt->execute();
            return $result->fetchArray(SQLITE3_ASSOC);      
        }

    ?>
<body>
<div class="container">
    <form action="" method="post" name="Login_Form" class="form-signin">

    

        <h2 class="form-signin-heading">Please sign in</h2>
        <label for="inputUsername" >Username</label>
        <input name="Username" type="username" id="inputUsername" class="form-control" placeholder="Username" required autofocus>
        <label for="inputPassword">Password</label>
        <input name="Password" type="text" id="inputPassword" class="form-control" placeholder="Password" required>
        <div class="checkbox">
            <label>
                <input type="checkbox" value="remember-me"> Remember me
            </label>
        </div>
        <button name="Submit" value="Login" class="button" type="submit">Sign in</button>

        <a href="register.php" >Register page</a>

    </form>
</div>
</body>
</html>
