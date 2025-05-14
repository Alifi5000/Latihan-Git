<?php
// Database configuration
$host = 'localhost';
$dbname = 'landrover_db';
$username = 'root';
$password = '';

try {
    // Create connection
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Get form data
    $vehicleModel = $_POST['vehicle_model'];
    $fullName = $_POST['full_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $paymentMethod = $_POST['payment_method'];
    $notes = $_POST['notes'];
    $orderDate = date('Y-m-d H:i:s');

    // Prepare SQL statement
    $stmt = $conn->prepare("INSERT INTO orders 
        (vehicle_model, customer_name, email, phone, address, payment_method, notes, order_date) 
        VALUES 
        (:vehicle_model, :customer_name, :email, :phone, :address, :payment_method, :notes, :order_date)");

    // Bind parameters
    $stmt->bindParam(':vehicle_model', $vehicleModel);
    $stmt->bindParam(':customer_name', $fullName);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':address', $address);
    $stmt->bindParam(':payment_method', $paymentMethod);
    $stmt->bindParam(':notes', $notes);
    $stmt->bindParam(':order_date', $orderDate);

    // Execute the statement
    $stmt->execute();

    // Redirect to thank you page
    header("Location: thank_you.html");
    exit();

} catch(PDOException $e) {
    // Handle errors
    echo "Error: " . $e->getMessage();
}

$conn = null;
?>