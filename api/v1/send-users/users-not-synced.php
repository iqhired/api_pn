<?php

include("./urls.php");
include("./db.php");

foreach ($urls as $url => $subDomain) {
    $query = "SELECT cu.user_name AS username, users_id AS id
              FROM cam_users cu
              WHERE cu.users_id NOT IN (
                  SELECT su.user_id
                  FROM synced_users su
                  WHERE su.domain = ? )";

    // Prepare the statement

    $stmt = $mysqli->prepare($query);

    // Check if the statement was prepared successfully
    if ($stmt === false) {
        die("Prepare failed: " . $mysqli->error);
    }

    // Bind the parameter
    $stmt->bind_param("s", $subDomain);

    // Execute the statement
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Check if there are any rows
    if ($result->num_rows > 0) {
        // Initialize an array to store usernames for the current subdomain
        $usernames = [];

        // Fetch each row and collect usernames
        while ($row = $result->fetch_assoc()) {
            $usernames[] = $row['username'];
        }
        // Store the usernames in the result array for the current subdomain
        $usersBySubdomain[$subDomain] = $usernames;
    } else {
        // If no users found, handle this case accordingly (e.g., log a message)
        error_log("No Users Found for subdomain: $subDomain");
    }

    // Close the statement
    $stmt->close();
}
    // Get all subdomains
    $subdomains = array_keys($usersBySubdomain);

    // Start HTML table
    echo '<table border="1">';
    echo '<thead><tr>';

    // Output headers for each subdomain
    foreach ($subdomains as $subdomain) {
        echo '<th>' . htmlspecialchars($subdomain) . '</th>';
    }
    echo '</tr></thead>';

    // Calculate maximum number of rows needed
    $maxRows = max(array_map('count', $usersBySubdomain));

    // Start tbody
    echo '<tbody>';

    // Output rows for each user
    for ($row = 0; $row < $maxRows; $row++) {
        echo '<tr>';
        foreach ($subdomains as $subdomain) {
            echo '<td>';
            if (isset($usersBySubdomain[$subdomain][$row])) {
                echo htmlspecialchars($usersBySubdomain[$subdomain][$row]);
            }
            echo '</td>';
        }
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';
    ?>