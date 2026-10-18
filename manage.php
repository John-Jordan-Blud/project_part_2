<!DOCTYPE html>

<?php
session_start();

if (!isset($_SESSION['Username'])) {
    header("Location: login.php");
    exit();
}

?>


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

        <h2>Welcome <?php echo $_SESSION['username'] ?>,</h2>
    </header>

    <main>
        <form method = "post" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>">

        </form>

        <?php
            require_once "settings.php";

            $dbconn =  @mysqli_connect($host, $user, $pwd, $sql_db);
            $sort = $_POST['sort_option'];

            switch ($sort)
            {
                case "all":
                    $query = "SELECT * FROM eoi";
                case "": ;
            }

            if ($dbconn)
            {
                $query = "SELECT * FROM eoi";
                $result = mysqli_query($dbconn, $query);
                if ($result)
                {
                    echo "<table>";
                    echo "<thead>";
                    echo "<tr>";
                    echo "<th>EOI ID</th>";
                    echo "<th>First name</th>";
                    echo "<th>Last name</th>";
                    echo "<th>Job Reference Number</th>";
                    echo "<th>Status</th>";
                    echo "</tr>";
                    echo "</thead>";
                    echo "<tbody>";
                    while ($row = mysqli_fetch_assoc($result)) 
                    {
                        echo "<tr>";
                        echo "<th>" . $row['eoi_id'] . "</th>";
                        echo "<td>" . $row['first_name'] . "</td>";
                        echo "<td>" . $row['last_name'] . "</td>";
                        echo "<td>" . $row['job_reference_number'] . "</td>";
                        echo "<td>" . $row['status'] . "</td>";
                        echo "</tr>";
                    }
                    echo "</tbody>";
                    echo"</table>";
                }

                mysqli_close($dbconn);
            }
        ?>
    </main>

    <footer style = "clear: both">
        <?php
            include('footer.inc')
        ?>
    </footer>
</body>
</html>
