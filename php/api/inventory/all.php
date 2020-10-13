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

// Instantiate food delivery inventory object
$inventory = new Inventory($a_database_connection);

// food delivery inventory query
$results = $inventory->getAllInventory();

// Get total number
$total_number = $results->rowCount();

// Check the number of inventory gotten
if ($total_number > 0) {
    $inventory_array = array();
    $inventory_array['response_code'] = http_response_code(200);
    $inventory_array['message'] = 'good request, no errors';
    $inventory_array['response']= 'OK';
    $inventory_array['data'] = array();
    
    while ($row = $results->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $an_item = array(
            'price' => $price,
            'category' => $category,
            'id' => $id,
            'available' => $available,
            'name' => $name // will change to contact_id
        );

        // Push to data index
        array_push($inventory_array['data'], $an_item);
    }

    // Turn to JSON & output
    echo json_encode($inventory_array);
    
} else {
    // No inventory
    echo json_encode(
        array(
            'message' => 'No inventory available',
            'response' => 'OK',
            'response_code' => http_response_code()
        )
    );

}

?>
