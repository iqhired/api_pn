<?php
    include("./db.php");
    include('./urls.php');

    $synced = 0;
    foreach ($urls as $url => $subDomain){
        $query = "SELECT cu.users_id AS user_id, cu.firstname AS name, cu.user_name AS username, cu.email
        FROM cam_users cu
        WHERE cu.users_id NOT IN (
            SELECT su.user_id
            FROM synced_users su
            WHERE su.domain = ?
        )";

        // Prepare the statement
        $stmt = $mysqli->prepare($query);

        // Bind the parameter
        $stmt->bind_param("s", $subDomain);

        // Execute the statement
        $stmt->execute();

        // Get the result
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            sendUsers($result, $mysqli, $url, $subDomain);
            $synced += 1;
        }

    }

    if($synced === 0){
        echo "Nothing to sync. All users have been synced with <b>". implode(', ', array_values($urls))."</b>";
    }



function sendUsers($result, $mysqli, $url, $subDomain){
    $users = array();
        
    while ($row = $result->fetch_assoc()) {
        $row['password'] = '$2y$10$DrEGnsZHc4CwseHVxRqCw.CP9K3JbeQufsEqS2ALNbD.IrM81lRA2';
        $users[] = $row;
    }

    $result->close();

    $json_data = json_encode($users);
    
    $curl_post_data = array(
        'data' => $json_data
    );

    $curl = curl_init($url);
    
    $headers = array(
        "Accept: application/x-www-form-urlencoded"
    );
    
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_post_data);
    
    $response = curl_exec($curl);

    if (curl_errno($curl)) {
        echo 'Error: ' . curl_error($curl);
    } else {
        saveSyncedIds($response, $subDomain, $mysqli);
    }
}

function saveSyncedIds($response, $subDomain, $mysqli){
    $response = json_decode($response);
    $values = $response[0];

    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli->connect_error;
        exit();
    }
    // Prepare the SQL statement
    $sql = "INSERT INTO synced_users (user_id, domain) VALUES (?, ?)";
    $stmt = $mysqli->prepare($sql);
    
    // Check if the statement was prepared successfully
    if ($stmt === false) {
        die("Prepare failed: " . $mysqli->error);
    }
    
    // Insert each value into the table
    foreach ($values as $value) {
        // Bind the value and execute the statement
        $stmt->bind_param("is", $value, $subDomain);
        $stmt->execute();
    }
    
    // Close the statement and connection
    $stmt->close();

    $failed = count($response[1]);

    echo "<h2>Synced users details for $subDomain</h2>";
    echo "<table border='1' cellpadding='10' cellspacing='0' style='border-collapse: collapse; width: 50%; margin: 20px 0;'>";
    echo "<tr style='background-color: #f2f2f2;'>";
    echo "<th>Type</th>";
    echo "<th>Count</th>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>Success</td>";
    echo "<td style='color: green;'>" . count($values) . "</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>Failed</td>";
    echo "<td style='color: red;'>" . $failed . "</td>";
    echo "</tr>";
    echo "</table>";
    
    if ($failed > 0) {
        echo "<h3>These are users that failed to sync with $subDomain</h3>";
        echo "<table border='1' cellpadding='10' cellspacing='0' style='border-collapse: collapse; width: 50%; margin: 20px 0;'>";
        echo "<thead>";
        echo "<tr style='background-color: #f2f2f2;'>";
        echo "<th>Usernames</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        foreach ($response[1] as $failedUser) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($failedUser) . "</td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
    }
}

$mysqli->close();