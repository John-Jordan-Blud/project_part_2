<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Meet the team behind Team Coal Miners.">
    <meta name="author" content="Team Coal Miners">
    <meta name="keywords" content="about us, team, recruitment, coal miners">
    <title>About Us | Team Coal Miners</title>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/about.css">
    <link rel="icon" type="image/png" href="images/Logo.png">
    <style>
        .quote-original {
            font-style: italic;
        }
    </style>
</head>

<body>
    <header>
    <?php
        include ('nav.inc');
    ?>
    </header>
    <main>
        <h1>About Us</h1>
        <section aria-labelledby="group-info-heading">
            <h2 id="group-info-heading">Our Group</h2>
            <ul>
                <li>Team Coal Miners
                    <ul>
                        <li>Tutorial Day: Wednesday, every week</li>
                        <li>Tutorial Time: 2:30pm to 4:30pm</li>
                    </ul>
                </li>
            </ul>
        </section>
        <section aria-labelledby="photo-heading">
            <h2 id="photo-heading">Group Photo</h2>
            <figure class="team-photo">
                <img src="images/group-photo.jpg" alt="The Team Coal Miners group standing together"
                    style="border: 2px solid #444444;">
                <figcaption>L-R: Ryan, Minh, Chloe, Koktriv</figcaption>
            </figure>
        </section>
        <section aria-labelledby="members-heading">
            <h2 id="members-heading">Individual Members</h2>
            <div class="team-showcase">
            <?php
            require_once('settings.php');
            $dbconn = @mysqli_connect($host,$user,$pwd,$sql_db);
            if ($dbconn) {
                $quoteQuery = "SELECT members.member_id, members.first_name, quote.quote, quote.translation FROM members INNER JOIN quote ON members.member_id = quote.member_id;";
                $result = mysqli_query($dbconn,$quoteQuery);
                // List quotes
                if($result){
                    while ($quote = mysqli_fetch_assoc($result)) {
                        $member = $quote['member_id'];
                        $contributionQuery = "SELECT contributions.contribution, projects.project_name FROM contributions INNER JOIN projects ON contributions.project_id = projects.project_id WHERE member_id = $member;";
                        $contrib = mysqli_query($dbconn,$contributionQuery);
                        echo "<section class=\"member-slide\" aria-labelledby=\"".strtolower($quote['first_name'])."-heading\">";
                        echo "<h3>".$quote['first_name']."</h3>";
                        echo "<blockquote>";
                        echo "<p class=\"quote-original\">".$quote['quote']."</p>";
                        echo "<p>".$quote['translation']."</p>";
                        echo "</blockquote>";
                        // List member contributions
                        if($contrib){
                            echo "<dl>";
                            echo "<dt>Contributions</dt>";
                            echo "<dd>";
                            echo "<ul>";
                            while ($contribution = mysqli_fetch_assoc($contrib)) {
                                echo "<li>[".$contribution['project_name']."] ".$contribution['contribution']."</li>";
                            }
                            echo "</ul>";
                            echo "</dd>";
                            echo "</dl>";
                        }
                        else {
                            echo "No contributions";
                        }
                        echo "</section>";
                    }
                }
                else {
                    echo "<p>No working. You suck.</p>";
                }
                mysqli_close($dbconn);
            }
            else {
                echo "<p>Unable to connect to the db</p>";
            }
            ?>
            </div>
            <section>
            <h3 id="funfacts-heading">Fun Facts</h3>
                <caption>A few things you might not know about us!</caption>
            <?php
                require_once('settings.php');
                $dbconn = @mysqli_connect($host,$user,$pwd,$sql_db);
                if ($dbconn) {
                    $query = "SELECT members.first_name, fun_facts.fact FROM members LEFT JOIN fun_facts ON members.member_id = fun_facts.member_id;";
                            $result = mysqli_query($dbconn,$query);
                            if($result){
                                echo '<table class="team-table">';
                                echo "<thead>";
                                echo "<tr>";
                                echo '<th scope="col">Member</th>';
                                echo '<th scope="col">Fact</th>';
                                echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    echo "<td>" . $row['first_name'] . "</td>";
                                    echo "<td>" . $row['fact'] . "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";
                                echo "</table>";
                            }
                            else {
                                echo "<p>No fun facts. We're no fun.</p>";
                            }
                            mysqli_close($dbconn);
                        }
                        else {
                            echo "<p>Unable to connect to the db</p>";
                }
            ?>
        </section>
        </section>
    </main>
    <footer>
        <?php
            include('footer.inc')
        ?>
    </footer>
</body>
</html>
