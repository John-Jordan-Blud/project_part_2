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
            <label for = "sort_option">Sort Options: </label>
            <select name = "sort_option" id = "sort_option" required>
                <option value = "all">All</option>
                <option value = "first_names">First names</option>
                <option value = "last_names">Last names</option>
                <option value = "full_names">Full names</option>
                <option value = "job_references">Job References</option>
            </select>
        </form>

        <?php
            require_once "settings.php";

            $dbconn =  @mysqli_connect($host, $user, $pwd, $sql_db);
            $sort = $_POST['sort_option'];
            $query = "SELECT * FROM eoi";

            switch ($sort)
            {
                case "all" || "first_names" || "last_names" || "full_names" || "job_references":
                    $query = "SELECT * FROM eoi";
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
                echo"</table>";
            }

            mysqli_close($dbconn);
        ?>
    </main>

    <footer style = "clear: both">
        <?php
            include('footer.inc')
        ?>
    </footer>
</body>
</html>
