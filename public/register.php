<?php require_once('../template/headerany.php'); ?>

    <title>Sign Up</title>
</head>
<?php require_once ('config.php');?>

<?php 
function sanit($data)
{
    $data = htmlspecialchars($data, ENT_QUOTES | ENT_SUBSTITUTE, "UTF-8");
    $data = trim($data);
    $data = stripslashes($data);
    return($data);
}
if (isset($_POST['Submit'])) 
{
    $newFullName=$_POST['inputName'];
    error_log($newFullName);
    $newDOB=$_POST['inputDOB'];
    $newUsername=$_POST['inputUsername'];
    $newPassword=$_POST['inputPassword'];
    $userInfo= array(
        'name'=>$newFullName,
        'DOB'=>$newDOB,
        'username'=>$newUsername,
        'password'=>$newPassword
    );
    $_SESSION['userInfo']= $userInfo;
    $db = new SQLite3(__DIR__ . '/../db.sqlite', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
    makeTable($db);
    add($db,$userInfo);
    //$_SESSION['db']=$db;
    //var_dump($_SESSION);
    header('location:login.php');
}
function add($db,$userInfo)
    {
        $query =
            "INSERT INTO usersz (fullname, DOB, username, pass) VALUES (?, ?, ?, ?)";
        $stmt = $db->prepare($query);
        $stmt->bindValue(1, sanit($userInfo['name']), SQLITE3_TEXT);
        $stmt->bindValue(2, sanit($userInfo['DOB']), SQLITE3_TEXT);
        $stmt->bindValue(3, sanit($userInfo['username']), SQLITE3_TEXT);
        $stmt->bindValue(4, sanit($userInfo['password']), SQLITE3_TEXT);

        $stmt->execute();
    }
function makeTable($db)
{
    $query = 
        "CREATE TABLE IF NOT EXISTS usersz (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            fullname TEXT NOT NULL,
            DOB TEXT NOT NULL,
            username TEXT NOT NULL,
            pass TEXT NOT NULL
        )
    ";
        try
        {
            $db->exec($query);
        }
        catch (Exception $e)
        {
            error_log('probalbly an error with the cpmment beign too long?');
        }
}
?>

<body>
<div class="container">
    <form action="" method="post" name="Login_Form" class="form-signin">

        <h2 class="form-signin-heading">Please sign in</h2>
        <label for="inputName" >Fullname</label>
        <input name="inputName" type="username" id="inputName" class="form-control" placeholder="Full Name" required autofocus>
        <label for="inputDOB" >DOB</label>
        <input name="inputDOB" type="date" id="inputDOB" class="form-control" required autofocus>
        <label for="inputUsername" >Username</label>
        <input name="inputUsername" type="username" id="inputUsername" class="form-control" placeholder="Username" required autofocus>
        <label for="inputPassword">Password</label>
        <input name="inputPassword" type="password" id="inputPassword" class="form-control" placeholder="Password" required>
        <div class="checkbox">
            <label>
                <input type="checkbox" value="remember-me"> Remember me
            </label>
        </div>
        <button name="Submit" value="Login" class="button" type="submit">Sign in</button>

    </form>
</div>
</body>
</html>
