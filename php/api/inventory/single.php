<?php

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Resources
include_once '../../config/Database.php';
include_once '../../model/Inventory.php';

// Instantiate Database to get a connection
$database_connection = new Database();
$a_database_connection = $database_connection->connect();

// Instantiate food delivery Inventory object
$inventory = new Inventory($a_database_connection);

// Get ID [& set inventory id if id available]
$inventory_id = isset($_GET['id']) ? $_GET['id'] : die(); // die? or appropriate msg

// Get the inventory [details]
$result = $inventory->getSingleInventoryByID($inventory_id);

// Get total number
$total_number = $result->rowCount();

$inventory_details_arr = array();

if ($total_number > 0) {
    $inventory_details_arr['message'] = 'good request, no errors';  
    $inventory_details_arr['response_code'] = http_response_code(200);

    // returns an array, $row is an array
    $row = $result->fetch(PDO::FETCH_ASSOC);

    extract($row);

    // Create array
    $inventory_details_arr['data'] = array(
        'id' => $id,
        'name' => $name,
        'available' => $available,
        'category' => $category,
        'price' => $price
    );
} else {
    $inventory_details_arr['message'] = 'bad request, errors';
    $inventory_details_arr['response_code'] = http_response_code();
}


// Make json and output
print_r(json_encode($inventory_details_arr));
