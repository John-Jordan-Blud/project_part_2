<!DOCTYPE html>
<html lang = "en">
<head>
    <meta charset = "UTF-8">
    <meta name = "viewport" content = "width=device-width, initial-scale=1.0">
    <meta name = "description" content = "The home page of the Coal Miners Organisation">
    <meta name = "author" content = "Team Coal Miners">
    <meta name = "keywords" content = "Coal Miners">
    <title>Home | Team Coal Miners</title>
    <link rel = "stylesheet" href = "style/style.css">
    <link rel = "stylesheet" href = "style/index_style.css">
    <link rel="icon" type="images/x-icon" href="images/Logo.png">

    <!--The figcation would always be on the right side of the image rather than under it-->
        <!--/*This was fixed by using clear: both, which should also work on clear right, but remains untested*/-->
    <style>
        figcaption {
            clear: both;
            float: right;
        }
    </style>
        
</head>
<body>
    <header>
        <?php
            include('nav.inc')
        ?>

        <h2></h2>
    </header>

    <main>
        <form method = "post" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>">
            <!--PUT THE FORM TO GET THE INFO HERE-->
        </form>

        <?php
            session_start();
            require_once("settings.php");

            $conn = mysqli_connect($host, $user, $pwd, $sql_db);

            $username = trim($_POST['username']);
            $password = trim($_POST['password']);

            $query = "SELECT * FROM users WHERE Username = '$username' AND Password = '$password'";
            $result = mysqli_query($conn, $query);
            $user = mysqli_fetch_assoc($result);

            if ($user) 
            {
                $_SESSION['username'] = $user['username'];
                header("Location: manage.php");
                exit();
            }
            else 
            {
                echo "Invalid login. Enter The Valid Credentials";
            }

            // Change around with this as much as you want
        ?>
    </main>

    <footer style = "clear: both">
        <?php
            include('footer.inc')
        ?>
    </footer>
</body>
</html>
