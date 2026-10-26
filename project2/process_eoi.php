

<?php


// Stop people opening this page directly without submitting the form
if ($_SERVER["REQUEST_METHOD"] != "POST" || !isset($_POST["JobRefNumber"])) {
    header("Location: apply.php");
    exit();
}

require_once("settings.php");

// Clean up user input
function clean_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Get the form values
$job_ref      = clean_input($_POST["JobRefNumber"]);
$first_name   = clean_input($_POST["First_Name"] ?? "");
$last_name    = clean_input($_POST["Last_Name"] ?? "");
$dob          = clean_input($_POST["DOB"] ?? "");
$gender       = clean_input($_POST["gender"] ?? "");
$street       = clean_input($_POST["Street_Address"] ?? "");
$suburb       = clean_input($_POST["Suburb"] ?? "");
$state        = clean_input($_POST["State"] ?? "");
$postcode     = clean_input($_POST["Postcode"] ?? "");
$email        = clean_input($_POST["Email"] ?? "");
$phone        = clean_input($_POST["Phone_Number"] ?? "");
$other_skills = clean_input($_POST["Other_Skills"] ?? "");

$skills = [];
if (isset($_POST["category"]) && is_array($_POST["category"])) {
    foreach ($_POST["category"] as $skill) {
        $skills[] = clean_input($skill);
    }
}

// Validate each field and store any error messages
$errors = [];

// Job reference number
if ($job_ref == "") {
    $errors[] = "Job reference number is required.";
} else if (!preg_match("/^[A-Za-z0-9]{6}$/", $job_ref)) {
    $errors[] = "Job reference number must be 6 letters or numbers.";
}

// First name and last name
if ($first_name == "") {
    $errors[] = "First name is required.";
} else if (!preg_match("/^[A-Za-z ]{1,20}$/", $first_name)) {
    $errors[] = "First name can only have letters and spaces (max 20).";
}

if ($last_name == "") {
    $errors[] = "Last name is required.";
} else if (!preg_match("/^[A-Za-z ]{1,20}$/", $last_name)) {
    $errors[] = "Last name can only have letters and spaces (max 20).";
}

// Date of birth (the date input sends it as yyyy-mm-dd)
if ($dob == "") {
    $errors[] = "Date of birth is required.";
} else if (!preg_match("/^\d{4}-\d{2}-\d{2}$/", $dob)) {
    $errors[] = "Date of birth is not a valid date.";
} else {
    $parts = explode("-", $dob);
    if (!checkdate($parts[1], $parts[2], $parts[0])) {
        $errors[] = "Date of birth is not a valid date.";
    } else {
        $age = date_diff(date_create($dob), date_create("today"))->y;
        if ($age < 15 || $age > 80) {
            $errors[] = "You must be between 15 and 80 years old to apply.";
        }
    }
}

// Gender
if (!in_array($gender, ["male", "female", "other", "prefer_not_to_say"])) {
    $errors[] = "Please select a gender.";
}

// Street address and suburb
if ($street == "" || strlen($street) > 40) {
    $errors[] = "Street address is required (max 40 characters).";
}
if ($suburb == "" || strlen($suburb) > 40) {
    $errors[] = "Suburb/town is required (max 40 characters).";
}

// State
if (!in_array($state, ["VIC", "NSW", "QLD", "NT", "WA", "SA", "TAS", "ACT"])) {
    $errors[] = "Please select a state.";
}

// Postcode must be 4 digits and match the state
if (!preg_match("/^\d{4}$/", $postcode)) {
    $errors[] = "Postcode must be exactly 4 digits.";
} else {
    $first_digit = $postcode[0];
    $postcode_ok = false;

    if ($state == "VIC" && ($first_digit == "3" || $first_digit == "8")) $postcode_ok = true;
    if ($state == "NSW" && ($first_digit == "1" || $first_digit == "2")) $postcode_ok = true;
    if ($state == "QLD" && ($first_digit == "4" || $first_digit == "9")) $postcode_ok = true;
    if ($state == "NT"  && $first_digit == "0") $postcode_ok = true;
    if ($state == "WA"  && $first_digit == "6") $postcode_ok = true;
    if ($state == "SA"  && $first_digit == "5") $postcode_ok = true;
    if ($state == "TAS" && $first_digit == "7") $postcode_ok = true;
    if ($state == "ACT" && ($first_digit == "0" || $first_digit == "2")) $postcode_ok = true;

    if (!$postcode_ok) {
        $errors[] = "Postcode does not match the selected state.";
    }
}

// Email
if (!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($email) > 80) {
    $errors[] = "Please enter a valid email address.";
}

// Phone number
if (!preg_match("/^[0-9 ]{8,12}$/", $phone)) {
    $errors[] = "Phone number must be 8 to 12 digits or spaces.";
}

// Skills must be one of the checkboxes on the form
$allowed_skills = ["Smart", "Strong", "Adaptable", "Positive_Attitude",
                   "Computing", "Leadership", "Teamwork", "Driving"];
foreach ($skills as $skill) {
    if (!in_array($skill, $allowed_skills)) {
        $errors[] = "Invalid skill selected.";
        break;
    }
}

// If everything is valid, save it to the database
$eoi_number = 0;
$db_error = false;

if (count($errors) == 0) {
    mysqli_report(MYSQLI_REPORT_OFF);
    $dbconn = @mysqli_connect($host, $user, $pwd, $sql_db);

    if (!$dbconn) {
        $db_error = true;
    } else {
        // Create the eoi table if it does not exist yet
        $create_table = "CREATE TABLE IF NOT EXISTS eoi (
            EOInumber INT AUTO_INCREMENT PRIMARY KEY,
            job_ref VARCHAR(6) NOT NULL,
            first_name VARCHAR(20) NOT NULL,
            last_name VARCHAR(20) NOT NULL,
            dob DATE NOT NULL,
            gender VARCHAR(20) NOT NULL,
            street_address VARCHAR(40) NOT NULL,
            suburb VARCHAR(40) NOT NULL,
            state VARCHAR(3) NOT NULL,
            postcode CHAR(4) NOT NULL,
            email VARCHAR(80) NOT NULL,
            phone VARCHAR(12) NOT NULL,
            skills VARCHAR(255),
            other_skills TEXT,
            status ENUM('New', 'Current', 'Final') NOT NULL DEFAULT 'New'
        )";
        mysqli_query($dbconn, $create_table);

        // Insert the application
        $job_ref = strtoupper($job_ref);
        $skills_list = implode(", ", $skills);

        $sql = "INSERT INTO eoi (job_ref, first_name, last_name, dob, gender, street_address,
                                 suburb, state, postcode, email, phone, skills, other_skills)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($dbconn, $sql);
        mysqli_stmt_bind_param($stmt, "sssssssssssss",
            $job_ref, $first_name, $last_name, $dob, $gender, $street,
            $suburb, $state, $postcode, $email, $phone, $skills_list, $other_skills);

        if (mysqli_stmt_execute($stmt)) {
            $eoi_number = mysqli_insert_id($dbconn);
        } else {
            $db_error = true;
        }
        mysqli_stmt_close($stmt);

        mysqli_close($dbconn);
    }
}
?>
<!DOCTYPE html>
<html lang = "en">
<head>
    <meta charset = "UTF-8">
    <meta name = "viewport" content = "width=device-width, initial-scale=1.0">
    <meta name = "description" content = "The application result page of the Coal Miners Organisation">
    <meta name = "author" content = "Team Coal Miners">
    <meta name = "keywords" content = "Coal Miners, apply">
    <title>Application | Team Coal Miners</title>
    <link rel = "stylesheet" href = "style/style.css">
    <link rel="icon" type="images/x-icon" href="images/Logo.png">
</head>
<body>
    <header>
        <?php
            include('nav.inc')
        ?>
    </header>

    <main>
        <!--Show the errors if the form was not filled in correctly-->
        <?php if (count($errors) > 0): ?>
            <h1>Your application could not be submitted</h1>

            <p>Please fix the following problems:</p>

            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?php echo $error; ?></li>
                <?php endforeach; ?>
            </ul>

            <p><a href = "apply.php">Go back to the application form</a></p>

        <!--Show this if the database could not save the application-->
        <?php elseif ($db_error): ?>
            <h1>Something went wrong</h1>

            <p>Sorry, we could not save your application. Please try again later.</p>

            <p><a href = "apply.php">Go back to the application form</a></p>

        <!--Show the EOI number if the application was saved-->
        <?php else: ?>
            <h1>Application received</h1>

            <p>
                Thank you <?php echo $first_name; ?>, your application for 
                job <?php echo $job_ref; ?> has been submitted.
            </p>

            <p>Your Expression of Interest number is <strong><?php echo $eoi_number; ?></strong>.</p>

            <p><a href = "jobs.php">Back to Job Opportunities</a></p>
        <?php endif; ?>
    </main>


    <?php
        include('footer.inc')
    ?>

</body>
</html>
