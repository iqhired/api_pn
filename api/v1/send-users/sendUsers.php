<?php
// Database connection parameters
$host = 'localhost';
$username = 'root';
$password = '1221';
$database = 'industry5';

$mysqli = new mysqli($host, $username, $password, $database);

if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}

$query = "SELECT firstname, user_name, email, password_pin FROM cam_users LIMIT 2";
$result = $mysqli->query($query);

if ($result->num_rows > 0) {
    $users = array();
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }

    $result->close();

    $mysqli->close();

    $json_data = json_encode($users);

    $post_url = 'http://127.0.0.1:8000/store-external-users';

    $curl = curl_init($post_url);

    $headers = array(
        "Accept: application/json"
    );
    
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $json_data);

    $response = curl_exec($curl);

    if (curl_errno($curl)) {
        echo 'Error: ' . curl_error($curl);
    } else {
        echo 'Response from server: ' . $response;
    }

    curl_close($curl);
} else {
    echo "No users found.";
}

?>
