<?php
$servername = "localhost";  
$password = "";             
$dbname = "laundry_db";  

// Database connection
$conn = new mysqli('localhost', 'root', '', 'laundry_db');

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

if (isset($_POST['customer_id'], $_POST['remark'], $_POST['type'])) {
    $customer_id = $_POST['customer_id'];
    $remark = $_POST['remark'];
    $type = $_POST['type'];

    error_log("Customer ID: $customer_id, Remark: $remark, Type: $type");

    if ($type === 'pickup') {
        $sql = "UPDATE service_request SET remarks = ? WHERE customer_id = ?";
    } else {
        $sql = "UPDATE service_request SET remarks = ? WHERE customer_id = ?";
    }

  // execute the update query
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param('si', $remark, $customer_id);
        if ($stmt->execute()) {
            echo "Success";  
        } else {
            error_log("Error: " . $stmt->error);
            echo "Error updating record: " . $stmt->error;
        }
        $stmt->close();
    } else {
        error_log("Error preparing the query: " . $conn->error);
        echo "Error preparing the query: " . $conn->error;
    }
} else {
    error_log("Required data is missing.");
    echo "Required data is missing.";
}
?>
