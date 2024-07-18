<?php
    // Database connection parameters
//    $host = 'localhost';
//    $username = 'root';
//    $password = '1221';
//    $database = 'saargummi';
//
    include "database_config.php";
    $mysqli = new mysqli($host, $username, $password, $database);
    
    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli->connect_error;
        exit();
    }
    
    $query = "SELECT cu.users_id AS user_id, cu.firstname AS name, cu.user_name AS username, cu.email
          FROM cam_users cu
          LEFT JOIN synced_users su ON cu.users_id = su.user_id
          WHERE su.user_id IS NULL";
    
    $result = $mysqli->query($query);
    
    if ($result->num_rows > 0) {
        $users = array();
        
        while ($row = $result->fetch_assoc()) {
            $row['password'] = '$2y$10$DrEGnsZHc4CwseHVxRqCw.CP9K3JbeQufsEqS2ALNbD.IrM81lRA2';
            $users[] = $row;
        }
        
        $result->close();
        
        $mysqli->close();
        
        $json_data = json_encode($users);
        
        $curl_post_data = array(
            'data' => $json_data
        );
        
//        $post_url = 'http://127.0.0.1:8000/store-external-users';
        $urls =  array("https://avinya.iotcise.com/store-external-users", "https://saargummi.iotcise.com/store-external-users", "https://sense.plantnavigator.com/store-external-users", "https://supplier.plantnavigator.com/store-external-users");
        foreach ($urls as $url) {
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
                
                $values = json_decode($response);
                
                $mysqli = new mysqli($host, $username, $password, $database);
                
                if ($mysqli->connect_errno) {
                    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
                    exit();
                }
                // Prepare the SQL statement
                $sql = "INSERT INTO synced_users (user_id) VALUES (?)";
                $stmt = $mysqli->prepare($sql);
                
                // Check if the statement was prepared successfully
                if ($stmt === false) {
                    die("Prepare failed: " . $mysqli->error);
                }
                
                // Insert each value into the table
                foreach ($values as $value) {
                    // Bind the value and execute the statement
                    $stmt->bind_param("i", $value);
                    $stmt->execute();
                }
                
                // Close the statement and connection
                $stmt->close();
                $mysqli->close();
                
                echo "Users Synced Successfully";
            }
            
            curl_close($curl);
        }
    } else {
        echo "No users found.";
    }

?>
