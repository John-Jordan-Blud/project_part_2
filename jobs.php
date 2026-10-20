<?php
session_start();

$search = trim($_GET['search'] ?? '');
$jobs = [];
$error = '';

try {
    $pdo = new PDO("mysql:host=localhost;dbname=coalminers_db", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($search !== '') {
        $stmt = $pdo->prepare("SELECT * FROM jobs WHERE job_title LIKE ? OR job_location LIKE ? OR job_reference_number LIKE ? OR job_description LIKE ? ORDER BY job_title ASC");        $searchTerm = "%" . $search . "%";
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
                            box-shadow: 5px 5px 15px #dae0db;
                            padding: 15px; 
                            border-radius: 6px; 
                            margin-bottom: 20px;">
                <p>We're always looking for passionate and talented individuals to join our growing organisation.</p>
                <p>We are committed in our promise in creating an inclusive and diverse workplace so we can provide the best support to the communities we serve, including Aboriginal and Torres Strait Islander communities. We encourage and welcome applications from people of all backgrounds, cultures, abilities, genders and identities. </p>
            </aside>
        <div class="search-container" style="margin-bottom: 25px;">
            <form method="GET" action="" style="display: flex; gap: 10px; align-items: center; flex-wrap: wrap;">
            <input type="text" name="search" placeholder="Search by title, location, ref..." value="<?php echo htmlspecialchars($search); ?>" style="padding: 8px; width: 300px; max-width: 100%;">
            <button type="submit" style="padding: 8px 15px;">Search</button>
            <?php if ($search !== ''): ?>
                <a href="jobs.php" style="margin-left: 10px; text-decoration: none;">Reset</a>
            <?php endif; ?>
        </form>
        <?php if (!empty($error)): ?>
            <p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>

        <!-- Dynamic Job Listings Container -->
        <div id="job-list">
            <?php if (count($jobs) > 0): ?>
                <?php foreach ($jobs as $job): ?>
                    <details class="job-item" style="margin-bottom: 20px; border: 1px solid #84bd87; padding: 20px; border-radius: 8px; background: #fff;">
                        <summary style="font-weight: bold; cursor: pointer; color: #0d5836; font-size: 1.2em;">
                            <?php echo htmlspecialchars($job['job_title']); ?> 
                            <span style="font-size: 0.8em; color: #7a4096; font-weight: normal;">(Ref: <?php echo htmlspecialchars($job['job_reference_number']); ?>)</span>
                        </summary>
                        
                        <div style="margin-top: 15px; line-height: 1.6;">
                            <p><strong>Location:</strong> <?php echo htmlspecialchars($job['job_location']); ?></p>
                            <p><strong>Salary:</strong> <?php echo htmlspecialchars($job['job_salary']); ?></p>
                            <p><strong>Reporting Line:</strong> <?php echo htmlspecialchars($job['job_reporting_line']); ?></p>
                            
                            <p style="margin-top: 10px;"><?php echo htmlspecialchars($job['job_description']); ?></p>
                            
                            <h4 style="color: #0d5836; margin-top: 15px;">Key Responsibilities</h4>
                            <pre style="font-family: inherit; white-space: pre-wrap; margin: 0;"><?php echo htmlspecialchars($job['job_responsibilities']); ?></pre>
                            
                            <h4 style="color: #0d5836; margin-top: 15px;">Essential Requirements</h4>
                            <pre style="font-family: inherit; white-space: pre-wrap; margin: 0;"><?php echo htmlspecialchars($job['job_essential_reqs']); ?></pre>
                            
                            <h4 style="color: #0d5836; margin-top: 15px;">Preferable Requirements</h4>
                            <pre style="font-family: inherit; white-space: pre-wrap; margin: 0;"><?php echo htmlspecialchars($job['job_preferable_reqs']); ?></pre>
                            
                            <div style="margin-top: 20px;">
                                <a href="apply.php?job_ref=<?php echo urlencode($job['job_reference_number']); ?>" style="display: inline-block; padding: 10px 16px; background-color: #0d5836; color: #fff; text-decoration: none; border-radius: 4px; font-weight: bold;">Apply Here (Ref: <?php echo htmlspecialchars($job['job_reference_number']); ?>)</a>
                            </div>
                        </div>
                    </details>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No job opportunities found matching your search criteria.</p>
            <?php endif; ?>
        </div>
    </main>

    <footer>
        <?php include('footer.inc'); ?>
    </footer>
 
</body>
</html>