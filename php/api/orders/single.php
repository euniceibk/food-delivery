<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Resources
include_once '../../config/Database.php';
include_once '../../model/Orders.php';

// Instantiate Database to get a connection
$database_connection = new Database();
$a_database_connection = $database_connection->connect();

// Instantiate green homes orders object
$order = new Orders($a_database_connection);

// Get ID [& set order id if id available]
$order_id = isset($_GET['id']) ? $_GET['id'] : die(); // die? or appropriate msg

// Get the order [details]
$result = $order->getSingleOrderByID($order_id);

// Get total number
$total_number = $result->rowCount();

$order_details_arr = array();

if ($total_number > 0) {
    $order_details_arr['message'] = 'good request, no errors';  
    $order_details_arr['response_code'] = http_response_code(200);

    // returns an array, $row is an array
    $row = $result->fetch(PDO::FETCH_ASSOC);

    extract($row);

    // Create array
    $order_details_arr['data'] = array(
        'id' => $id,
        'customer_name' => $customer_name,
        'quantity' => $quantity,
        'address' => $address,
        'name_of_food' => $name_of_food,
        'time_of_order' => $time_of_order,
        'price' => $price
    );
} else {
    $order_details_arr['message'] = 'bad request, errors';
    $order_details_arr['response_code'] = http_response_code();
}


// Make json and output
print_r(json_encode($order_details_arr));
