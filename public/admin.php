<?php require_once '../template/headerany.php';?>
    <title>Can see only if logged in</title>
  </head>
  
  
  <body>
    <div class="container">
      <div class="header clearfix">
        <nav>
          <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="contacts.php">Contact</a></li>
            <li><a href='register.php'>Register</a></li>
          </ul>
        </nav>
        <h3 class="text-muted">PHP can only see this page if logged in</h3>
      </div>

        <div class="mainarea">
            <h1>Title </h1>
            <p class="lead">This is where we will put the logout button</p>

            <form action="logout.php" method="post" name="Logout_Form" class="form-signin">
                <button name="Submit" value="Logout" class="button" type="submit">Log out</button>
            </form>
        </div>

<?php require_once '../template/footer.php';?>