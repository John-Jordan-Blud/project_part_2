<?php
session_start();

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (empty($username) || empty($password)) {
        $error = "Please enter both username and password.";
    } else {
        try {
            $pdo = new PDO("mysql:host=localhost;dbname=coalminers_db", "root", "");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare("SELECT * FROM users WHERE Username = ?");
            $stmt->execute([$username]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && $password === $user['Password']) {
                $_SESSION['Username'] = $user['Username'];
                header('Location: manage.php');
                exit();
            } else {
                $error = "Invalid username or password.";
            }
        } catch (PDOException $e) {
            $error = "Database error: " . $e->getMessage();
        }
    }
}
?>

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
        fieldset{
            display: block; 
            grid-column: 2; 
            justify-self: center; width: 100%; 
            max-width: 350px;
            padding: 20px; 
            border: 4px solid darkgreen; 
            background-color: #F9FDED; 
            box-sizing: border-box; margin: 0;
        }

    </style>
        
</head>
<body>
    <header>
        <?php
            include('nav.inc')
        ?>

        <h2><h2>
    </header>
    <h2>Login<h2>
<div class="container">
    <fieldset >
        <?php if (!empty($error)): ?>
            <p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>
        <form method="POST" action="login.php">
            <label>Username:</label><br>
            <input type="text" name="username" required><br><br>
        
            <label>Password:</label><br>
            <input type="password" name="password" required><br><br>
            
            <button type="submit">Login</button>
        </form>
        </fieldset>
    </div>
</main>

    <?php
        include('footer.inc')
    ?>
</body>
</html>
