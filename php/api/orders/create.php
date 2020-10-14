<?php

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Content-Control-Allow-Methods: POST');
header('Content-Control-Allow-Headers: Content-Control-Allow-Methods, Content-Type, Content-Control-Allow-Headers, Authorization, X-Requested-With');

// Resources
include_once '../../config/Database.php';
include_once '../../model/Orders.php';

// Instantiate Database to get a connection
$database_connection = new Database();
$a_database_connection = $database_connection->connect();

// Instantiate green homes clients object
$order = new Orders($a_database_connection);

// get data
$data = json_decode(file_get_contents('php://input'));

if (isset($data->customer_name, $data->quantity, $data->address, $data->name_of_food, $data->price)
    &&
    !empty($data->customer_name)
    &&
    !empty($data->quantity)
    &&
    !empty($data->address)
    &&
    !empty($data->name_of_food)
    &&
    !empty($data->price) 
) { // if good data was provided
    // Create the order [details]
    $result = $order->createOrder($data->customer_name, $data->quantity, $data->address, $data->name_of_food, $data->price);
    if ($result) { 
        echo json_encode(
            array(
                'message' => 'Order created',
                'response' => 'OK',
                'response_code' => http_response_code(),
                'row_id' => $result
            )
        );
    } else {
        echo json_encode(
            array(
                'message' => 'Order not created',
                'response' => 'OK',
                'response_code' => http_response_code()
            )
        );
    }
} else { // if bad or empty data was provided
    echo json_encode(
        array(
            'message' => 'Bad data provided',
            'response' => 'NOT OK',
            'response_code' => http_response_code()
        )
    );
}

?>
