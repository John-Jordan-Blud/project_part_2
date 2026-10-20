<?php
session_start();

$search = trim($_GET['search'] ?? '');
$jobs = [];
$error = '';

try {
    $pdo = new PDO("mysql:host=localhost;dbname=coalminers_db", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($search !== '') {
        $stmt = $pdo->prepare("SELECT * FROM jobs WHERE job_title LIKE ? OR job_location LIKE ? OR job_reference_number LIKE ? OR job_description LIKE ? ORDER BY job_title ASC");
        $searchTerm = "%" . $search . "%";
        $stmt->execute([$searchTerm, $searchTerm, $searchTerm, $searchTerm]);
    } else {
        $stmt = $pdo->prepare("SELECT * FROM jobs ORDER BY job_title ASC");
        $stmt->execute();
    }

    $jobs = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    $error = "Database error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Team Coal Miners">
    <meta name="keywords" content="">
    <title>Job Opportunities | Team Coal Miners</title>
    <link rel="stylesheet" href="style/style.css">
    <link rel="icon" type="images/x-icon" href="images/Logo.png">
    <style>
        .reference-number {
            font-size: 1.1em;
            color: #22592D;
        }
    </style>
</head>
<body>
    <header>
        <?php
            include('nav.inc')
        ?>
    </header>
    <main>
        <h1>Job Opportunities</h1>
        <div id="opportunities">
            <aside style="  font-style:italic; 
                            background-color:#c8eaca;
                            border: solid 1px #93bc95; 
                            box-shadow: 5px 5px 15px #dae0db;">
                <p>We're always looking for passionate and talented individuals to join our growing organisation.</p>
                <p>We are committed in our promise in creating an inclusive and diverse workplace so we can provide the best support to the communities we serve, including Aboriginal and Torres Strait Islander communities. We encourage and welcome applications from people of all backgrounds, cultures, abilities, genders and identities. </p>
            </aside>
            

        </div>
    </main>     
</body>
</html>