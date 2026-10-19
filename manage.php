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
            </select>
            <button type = "submit">Filter</button>

            <!--Float used to make the delete EOI section appear on the right.-->
            <div style = "float: right">
                <label for = "deleted_eoi">Delete EOIs</label>
                <select name = "deleted_eoi" id = "deleted_eoi" required>
                    <option value = "none">None</option>
                    <?php
                        // Although this is harder to do than doing the above select form
                        // this is more scalable incase the number of EOIs increases.
                        require_once "settings.php";

                        $dbconn = @mysqli_connect($host, $user, $pwd, $sql_db);

                        $query = "SELECT job_ref FROM eoi";
                        $result = mysqli_query($dbconn, $query);

                        // I was not familiar with how this while loop worked,
                        // Googling "mysqli_fetch_assoc" exactly gave me better,
                        // although not complete understanding of it.
                        while ($row = mysqli_fetch_assoc($result)) 
                        {
                            echo "<option value = '" . $row['job_ref'] . "'>" . $row['job_ref'] . "</option>";
                        }
                    ?>
                </select>
                <button type = "submit">Delete</button>
            </div>
            
        </form>

        <?php
            require_once "settings.php";

            $dbconn = @mysqli_connect($host, $user, $pwd, $sql_db);
            
            // REALM OF DELETING EOIs
            $deleted_eoi = $_POST['deleted_eoi'];

            // A lot of the functions that I'm using, switchs and while loops
            // are how I would do things in C#, so aside from the occassional google search,
            // I didn't need to look up how to do them in PHP.
            switch ($deleted_eoi)
            {
                case "none":
                    break;
                default:
                    // Had to google how to delete EOIs as I wasn't sure how to do it,
                    // Exact google search: delete all values that have a specific id
                    $query = "DELETE FROM eoi WHERE job_ref = '$deleted_eoi'";
                    $result = mysqli_query($dbconn, $query);
                    break;
            }
            
            $query = "SELECT * FROM eoi";

            $result = mysqli_query($dbconn, $query);

            // REALM OF STATUS UPDATE
            $status = [];

            $index = 1;

            while ($index <= mysqli_num_rows($result))
            {
                $status[] = $_POST['status_'. $index];
                $index++;
            }

            $index = 0;
            $dbindex = 1;

            // Didn't know that it would be count() instead of
            // array.length or array.size
            while ($index < count($status) && $status[$index] != null)
            {
                // Had to google how to Update, the slides on canvas wasn't very clear on how to do it
                // Exact google search: update query sql
                $query = "UPDATE eoi SET eoi_status = '$status[$index]' WHERE EOInumber = '$dbindex'";
                $result = mysqli_query($dbconn, $query);
                $index++;
                $dbindex++;
            }

            // REALM OF SORTING
            $sort = $_POST['sort_option'];

            // Used a switch so that the sort goes through every possible scenario
            // And a break was needed to force a stop.
            switch ($sort)
            {
                case "all":
                    $query = "SELECT * FROM eoi ORDER BY EOInumber";
                    echo $sort;
                    break;
                case "first_names":
                    $query = "SELECT * FROM eoi ORDER BY first_name ASC";
                    echo $sort;
                    break;
                case "last_names":
                    $query = "SELECT * FROM eoi ORDER BY last_name ASC";
                    echo $sort;
                    break;
                case "full_names":
                    $query = "SELECT * FROM eoi ORDER BY first_name ASC, last_name ASC";
                    echo $sort;
                    break;
                case "job_references":
                    $query = "SELECT * FROM eoi ORDER BY job_ref ASC";
                    echo $sort;
                    break;
                default:
                    $query = "SELECT * FROM eoi ORDER BY EOInumber";
                    echo $sort;
                    break;
            }

            $result = mysqli_query($dbconn, $query);

            // REALM OF TABLE MAKING
            if ($result)
            {
                echo "<form method = 'post' action = 'manage.php'>";
                echo "</select>";
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
                    echo "<td>";

                    echo "<select name = 'status_" . $row['EOInumber'] . "' required>";

                    switch ($row['eoi_status'])
                    {
                        case "New":
                            echo "<option value = 'New'>" . $row['eoi_status'] . "</option>";
                            echo "<option value = 'Current'>Current</option>";
                            echo "<option value = 'Final'>Final</option>";
                            break;
                        case "Current":
                            echo "<option value = 'Current'>" . $row['eoi_status'] . "</option>";
                            echo "<option value = 'New'>New</option>";
                            echo "<option value = 'Final'>Final</option>";
                            break;
                        case "Final":
                            echo "<option value = 'Final'>" . $row['eoi_status'] . "</option>";
                            echo "<option value = 'New'>New</option>";
                            echo "<option value = 'Current'>Current</option>";
                            break;
                    }

                    echo "</td>";
                    echo "</tr>";
                }
                echo "</tbody>";
                echo "</table>";
                echo "<button type = 'submit'>Update</button>";
                echo "</form>";
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
