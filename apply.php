<!DOCTYPE html>
<html lang = "en">
<head>
    <meta charset = "UTF-8">
    <meta name = "viewport" content = "width=device-width, initial-scale=1.0">
    <meta name = "description" content = "The application page of the Coal Miners Organisation">
    <meta name = "author" content = "Team Coal Miners">
    <meta name = "keywords" content = "Coal Miners, apply, jobs">
    <title>Apply for Position | Team Coal Miners</title>
    <link rel = "stylesheet" href = "style/style.css">
    <link rel="icon" type="images/x-icon" href="images/Logo.png">

    <style>
        .quote-original {
            font-style: italic;
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
        <h1>Apply for a Position</h1>

        <div class = "container">
            <fieldset>
                <legend class = "quote-original">Job Application Form</legend>

                <!--The form is sent to process_eoi.php to be checked and saved in the database-->
                <form action = "process_eoi.php" method = "post">

                    <p>
                        <label for = "JobRefNumber">Job Reference Number</label>
                        <input type = "text" name = "JobRefNumber" id = "JobRefNumber" maxlength = "6" size = "10"
                            required pattern = "[A-Za-z0-9]{6}" placeholder = "GRADEV">
                    </p>

                    <fieldset class = "a">
                        <legend>Personal Details</legend>

                        <p>
                            <label for = "First_Name">First Name</label>
                            <input type = "text" name = "First_Name" id = "First_Name" maxlength = "20" size = "10"
                                required pattern = "[A-Za-z ]+" placeholder = "First Name">
                        </p>

                        <p>
                            <label for = "Last_Name">Last Name</label>
                            <input type = "text" name = "Last_Name" id = "Last_Name" maxlength = "20" size = "10"
                                required pattern = "[A-Za-z ]+" placeholder = "Last Name">
                        </p>

                        <p>
                            <label for = "DOB">Date of Birth</label>
                            <input type = "date" name = "DOB" id = "DOB" required>
                        </p>

                        <fieldset class = "a">
                            <legend>Gender</legend>

                            <p>
                                <input type = "radio" name = "gender" id = "Male" value = "male" required>
                                <label for = "Male">Male</label>

                                <input type = "radio" name = "gender" id = "Female" value = "female">
                                <label for = "Female">Female</label>

                                <input type = "radio" name = "gender" id = "Other" value = "other">
                                <label for = "Other">Other</label>

                                <input type = "radio" name = "gender" id = "Prefer_not_to_say" value = "prefer_not_to_say">
                                <label for = "Prefer_not_to_say">Prefer not to say</label>
                            </p>
                        </fieldset>
                    </fieldset>

                    <fieldset class = "a">
                        <legend>Residential Address</legend>

                        <p>
                            <label for = "Street_Address">Street Address</label>
                            <input type = "text" name = "Street_Address" id = "Street_Address" maxlength = "40" size = "10"
                                required placeholder = "Street Address">
                        </p>

                        <p>
                            <label for = "Suburb">Suburb/Town</label>
                            <input type = "text" name = "Suburb" id = "Suburb" maxlength = "40" size = "10"
                                required placeholder = "Suburb/Town">
                        </p>

                        <p>
                            <label for = "State">State</label>
                            <select name = "State" id = "State" required>
                                <option value = "">Select State</option>
                                <option value = "NSW">New South Wales</option>
                                <option value = "VIC">Victoria</option>
                                <option value = "QLD">Queensland</option>
                                <option value = "SA">South Australia</option>
                                <option value = "WA">Western Australia</option>
                                <option value = "TAS">Tasmania</option>
                                <option value = "ACT">Australian Capital Territory</option>
                                <option value = "NT">Northern Territory</option>
                            </select>
                        </p>

                        <p>
                            <label for = "Postcode">Postcode</label>
                            <input type = "text" name = "Postcode" id = "Postcode" maxlength = "4" size = "4"
                                required pattern = "[0-9]{4}" placeholder = "0000">
                        </p>
                    </fieldset>

                    <fieldset class = "a">
                        <legend>Contact Details</legend>

                        <p>
                            <label for = "Email">Email</label>
                            <input type = "email" name = "Email" id = "Email" maxlength = "80" size = "10"
                                required placeholder = "Email">
                        </p>

                        <p>
                            <label for = "Phone_Number">Phone Number</label>
                            <input type = "text" name = "Phone_Number" id = "Phone_Number" maxlength = "12" size = "10"
                                required pattern = "[0-9 ]{8,12}" placeholder = "Phone Number">
                        </p>
                    </fieldset>

                    <fieldset class = "a">
                        <legend>Skill List</legend>

                        <!--category[] sends all the ticked skills to PHP as an array-->
                        <p>
                            <label for = "Smart">Smart</label>
                            <input type = "checkbox" id = "Smart" name = "category[]" value = "Smart">

                            <label for = "Strong">Strong</label>
                            <input type = "checkbox" id = "Strong" name = "category[]" value = "Strong">

                            <label for = "Adaptable">Adaptable</label>
                            <input type = "checkbox" id = "Adaptable" name = "category[]" value = "Adaptable">

                            <label for = "Positive_Attitude">Positive Attitude</label>
                            <input type = "checkbox" id = "Positive_Attitude" name = "category[]" value = "Positive_Attitude">
                        </p>

                        <p>
                            <label for = "Computing">Computing</label>
                            <input type = "checkbox" id = "Computing" name = "category[]" value = "Computing">

                            <label for = "Leadership">Leadership</label>
                            <input type = "checkbox" id = "Leadership" name = "category[]" value = "Leadership">

                            <label for = "Teamwork">Teamwork</label>
                            <input type = "checkbox" id = "Teamwork" name = "category[]" value = "Teamwork">

                            <label for = "Driving">Ability to Drive (Has licence)</label>
                            <input type = "checkbox" id = "Driving" name = "category[]" value = "Driving">
                        </p>

                        <p style = "font-weight: bold;"><label for = "Other_Skills">Other Skills</label></p>

                        <p>
                            <textarea id = "Other_Skills" name = "Other_Skills" rows = "4" cols = "30"
                                placeholder = "Please specify any other relevant skills..."></textarea>
                        </p>
                    </fieldset>

                    <input type = "submit" value = "Submit Form">
                    <input type = "reset" value = "Reset Form">
                </form>
            </fieldset>
        </div>
    </main>


        <?php
            include('footer.inc')
        ?>

</body>
</html>

