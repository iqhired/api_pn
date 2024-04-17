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

$query = "SELECT DISTINCT email, username FROM (SELECT firstname AS name, user_name AS username, email FROM cam_users) AS unique_users";
$result = $mysqli->query($query);

if ($result->num_rows > 0) {
    $users = array();

    while ($row = $result->fetch_assoc()) {
        $row['password'] = '$2y$12$YfnWJERpwDktxaNMt7u/eeDpTqj5aAEQi2NDw.1.H7/vMVzdaNgwy';
        $users[] = $row;
    }

    $result->close();

    $mysqli->close();

    $json_data = json_encode($users);

    $curl_post_data = array(
        'data' => $json_data
    );

    $post_url = 'http://127.0.0.1:8000/store-external-users';

    $curl = curl_init($post_url);

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
        echo 'Response from server: ' . $response;
    }

    curl_close($curl);
} else {
    echo "No users found.";
}

?>
