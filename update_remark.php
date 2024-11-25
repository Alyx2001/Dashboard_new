<?php
$servername = "localhost"; 
$username = "root";         
$password = "";            
$dbname = "laundry_db";  

// Database connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $customer_id = $_POST['customer_id'];
    $remark = $_POST['remark'];
    $type = $_POST['type']; 

    if (in_array($remark, ['Pending', 'Undelivered', 'Unclaimed'])) { 
        // Update request date to the next day
        $new_date = date('Y-m-d', strtotime('tomorrow'));  // Get tomorrow's date
        $sql = "UPDATE service_request SET request_date = '$new_date' WHERE customer_id = $customer_id";

        if ($conn->query($sql) === TRUE) {
            echo "Success";
        } else {
            echo "Error updating record: " . $conn->error;
        }
    } else {
        // Handle other remarks as usual (e.g., 'Claimed', 'Delivered', etc.)
        $sql = "UPDATE service_request SET remarks = '$remark' WHERE customer_id = $customer_id";
        
        if ($conn->query($sql) === TRUE) {
            echo "Success";
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }
}
$conn->close();
?>
