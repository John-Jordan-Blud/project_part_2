<!DOCTYPE html>

<?php
session_start();

if (!isset($_SESSION['Username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['Username'];
$message = $_GET['message'] ?? '';

try {
    $pdo = new PDO("mysql:host=localhost;dbname=coalminers_db", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->prepare("SELECT Username FROM users WHERE Username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        session_destroy();
        header("Location: login.php");
        exit();
    }
} catch (PDOException $e) {


    die("Database error: " . $e->getMessage());
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

        <h2>Welcome <?php echo $_SESSION['Username'] ?>,</h2>
    </header>

    <main>
        <form method = "post" action = "manage.php">
            <label for = "sort_option">Sort Options: </label>
            <select name = "sort_option" id = "sort_option" required>
                <option value = "all">All</option>
                <option value = "first_names">First names</option>
                <option value = "last_names">Last names</option>
                <option value = "full_names">Full names</option>
                <option value = "job_references">Job References</option>
                <option value = "status">Status</option>
            </select>
            <button type = "submit">Filter</button>
        </form>

        <?php
            require_once "settings.php";

            $dbconn = @mysqli_connect($host, $user, $pwd, $sql_db);

            $sort = "";

            $query = "SELECT * FROM eoi";

            if ($_SERVER['REQUEST_METHOD'] == 'POST') 
            {
                $sort = $_POST['sort_option'];

                // Used a switch so that the sort goes through every possible scenario
                // And a break was needed to force a stop.
                switch ($sort)
                {
                    case "all":
                        $query = "SELECT * FROM eoi ORDER BY EOInumber";
                        break;
                    case "first_names":
                        $query = "SELECT * FROM eoi ORDER BY first_name ASC";
                        break;
                    case "last_names":
                        $query = "SELECT * FROM eoi ORDER BY last_name ASC";
                        break;
                    case "full_names":
                        $query = "SELECT * FROM eoi ORDER BY first_name ASC, last_name ASC";
                        break;
                    case "job_references":
                        $query = "SELECT * FROM eoi ORDER BY job_ref ASC";
                        break;
                    case "status":
                        $query = "SELECT * FROM eoi ORDER BY status ASC";
                        break;
                    default:
                        $query = "SELECT * FROM eoi ORDER BY EOInumber";
                        break;
                }
            }

            $result = mysqli_query($dbconn, $query);

            if ($result)
            {
                echo "<table>";
                echo "<thead>";
                echo "<tr>";
                echo "<th>EOI ID</th>";
                echo "<th>Job Reference</th>";
                echo "<th>First name</th>";
                echo "<th>Last name</th>";
                echo "<th>Date of Birth</th>";
                echo "<th>Gender</th>";
                echo "<th>Street Address</th>";
                echo "<th>Suburb</th>";
                echo "<th>State</th>";
                echo "<th>Postcode</th>";
                echo "<th>Email</th>";
                echo "<th>Phone</th>";
                echo "<th>Skills</th>";
                echo "<th>Other Skills</th>";
                echo "<th>Status</th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
                while ($row = mysqli_fetch_assoc($result)) 
                {
                    echo "<tr>";
                    echo "<th>" . $row['EOInumber'] . "</th>";
                    echo "<td>" . $row['job_ref'] . "</td>";
                    echo "<td>" . $row['first_name'] . "</td>";
                    echo "<td>" . $row['last_name'] . "</td>";
                    echo "<td>" . $row['dob'] . "</td>";
                    echo "<td>" . $row['gender'] . "</td>";
                    echo "<td>" . $row['street_address'] . "</td>";
                    echo "<td>" . $row['suburb'] . "</td>";
                    echo "<td>" . $row['state'] . "</td>";
                    echo "<td>" . $row['postcode'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $row['phone'] . "</td>";
                    echo "<td>" . $row['skills'] . "</td>";
                    echo "<td>" . $row['other_skills'] . "</td>";
                    echo "<td>" . $row['status'] . "</td>";
                    echo "</tr>";
                }
                echo "</tbody>";
                echo "</table>";
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
