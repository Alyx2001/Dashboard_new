<?php
$servername = "localhost"; 
$username = "root";         
$password = "";            
$dbname = "laundry_db";  

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $customer_id = $_POST['customer_id'];
    $remark = $_POST['remark'];
    $type = $_POST['type']; // 'pickup' or 'delivery'

    if ($remark == 'Undelivered') {
        // Handle "Undelivered" remark: update the request date to tomorrow
        $new_date = date('Y-m-d', strtotime('tomorrow'));  // Get tomorrow's date
        $sql = "UPDATE service_request SET request_date = '$new_date', remarks = '$remark' WHERE customer_id = $customer_id";

        if ($conn->query($sql) === TRUE) {
            echo "Undelivered status updated successfully.";
        } else {
            echo "Error updating record: " . $conn->error;
        }
    } 
    else if ($remark == 'Unclaimed') {
        $new_date = date('Y-m-d', strtotime('tomorrow'));  // Get tomorrow's date
        $sql = "UPDATE service_request SET request_date = '$new_date', remarks = '$remark' WHERE customer_id = $customer_id";


        if ($conn->query($sql) === TRUE) {
            echo "Unclaimed status updated successfully.";
        } else {
            echo "Error updating record: " . $conn->error;
        }
    } 
    else if ($remark == 'Pending') {
        $new_date = date('Y-m-d', strtotime('tomorrow'));  // Get tomorrow's date
        $sql = "UPDATE service_request SET request_date = '$new_date', remarks = '$remark' WHERE customer_id = $customer_id";

        if ($conn->query($sql) === TRUE) {
            echo "Pending status updated successfully.";
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }
  
    else {
        //for deliverd and claimed
        if ($type == 'pickup') {
            $sql = "UPDATE service_request SET remarks = '$remark' WHERE customer_id = $customer_id";
        } elseif ($type == 'delivery') {
            $sql = "UPDATE service_request SET remarks = '$remark' WHERE customer_id = $customer_id";
        }

        if ($conn->query($sql) === TRUE) {
            echo "Success";
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }
}


$conn->close();
?>
