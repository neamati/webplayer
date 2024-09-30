<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the values from the form
    $newXCStreamHostUrl = $_POST["XCStreamHostUrl"];
    $newXCStreamHostUrl_2 = $_POST["XCStreamHostUrl_2"];
    $newXCStreamHostUrl_3 = $_POST["XCStreamHostUrl_3"];
    $newXCStreamHostUrl_4 = $_POST["XCStreamHostUrl_4"];
    $newXCStreamHostUrl_5 = $_POST["XCStreamHostUrl_5"];

    // Load the configuration1.php file
    require_once('configuration1.php');

    // Create an array to store the configuration
    $configArray = [
        'XCStreamHostUrl' => $newXCStreamHostUrl,
        'XCStreamHostUrl_2' => $newXCStreamHostUrl_2,
        'XCStreamHostUrl_3' => $newXCStreamHostUrl_3,
        'XCStreamHostUrl_4' => $newXCStreamHostUrl_4,
        'XCStreamHostUrl_5' => $newXCStreamHostUrl_5,
    ];

    // Read the original configuration and update the values
    $originalConfig = file('configuration1.php');
    foreach ($originalConfig as $line) {
        // Check if the line corresponds to one of the variables to update
        foreach ($configArray as $key => $value) {
            if (strpos($line, "\$$key =") === 0) {
                // Update the line if a new value is provided, or comment it out if it's empty
                if (!empty($value)) {
                    $line = "\$$key = \"$value\";\n";
                } else {
                    $line = "//" . $line;
                }
                break;
            }
        }
        echo $line; // Output the line (you can change this as needed)
    }
}

// Load the configuration1.php file to get the existing values
require_once('configuration1.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Configuration Editor</title>
</head>
<body>
<h1>Configuration Editor</h1>
<form method="post">
    <label for="XCStreamHostUrl">XCStreamHostUrl:</label>
    <input type="text" name="XCStreamHostUrl" value="<?php echo $XCStreamHostUrl; ?>"><br>

    <label for="XCStreamHostUrl_2">XCStreamHostUrl_2:</label>
    <input type="text" name="XCStreamHostUrl_2" value="<?php echo $XCStreamHostUrl_2; ?>"><br>

    <label for="XCStreamHostUrl_3">XCStreamHostUrl_3:</label>
    <input type="text" name="XCStreamHostUrl_3" value="<?php echo $XCStreamHostUrl_3; ?>"><br>

    <label for="XCStreamHostUrl_4">XCStreamHostUrl_4:</label>
    <input type="text" name="XCStreamHostUrl_4" value="<?php echo $XCStreamHostUrl_4; ?>"><br>

    <label for="XCStreamHostUrl_5">XCStreamHostUrl_5:</label>
    <input type="text" name="XCStreamHostUrl_5" value="<?php echo $XCStreamHostUrl_5; ?>"><br>

    <input type="submit" value="Update Configuration">
</form>
</body>
</html>
