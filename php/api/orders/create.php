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

if (isset($data->cus_name, $data->qty, $data->addr, $data->food_name, $data->prc)
    &&
    !empty($data->cus_name)
    &&
    !empty($data->qty)
    &&
    !empty($data->addr)
    &&
    !empty($data->food_name)
    &&
    !empty($data->prc) 
) { // if good data was provided
    // Create the order [details]
    $result = $order->createOrder($data->cus_name, $data->qty, $data->addr, $data->food_name, $data->prc);
    if ($result) { 
        echo json_encode(
            array(
                'message' => 'Order created',
                'response' => 'OK',
                'response_code' => http_response_code()
            )
        );
    } else {
        echo json_encode(
            array(
                'message' => 'Order not created',
                'response' => 'NOT OK',
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
