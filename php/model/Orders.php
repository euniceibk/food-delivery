<?php
class Orders {
    // DB stuff
    public $database_connection;
    private $table = 'orders';

    // Client properties
    /* public $first_name;
    public $last_name;
    public $last_seen;
    public $middle_name;
    public $id;
    public $phone_numbers; */

    /**
     * Constructor taking db as params
     */
    public function __construct($a_database_connection)
    {
        $this->database_connection = $a_database_connection;
    }

    // Create new client, an entry
    public function createOrder($cus_name, $qty, $addr, $food_name, $prc) {
        $query = 'INSERT INTO ' . $this->table . '
            SET
            customer_name = :cus_name,
            quantity = :qty,
            address = :addr,
            name_of_food = :food_name,
            price = :prc
        ';

        $stmt = $this->database_connection->prepare($query);

        // Ensure safe data
        $cn = htmlspecialchars(strip_tags($cus_name));
        $q = htmlspecialchars(strip_tags($qty));
        $a = htmlspecialchars(strip_tags($addr));
        $fn = htmlspecialchars(strip_tags($food_name));
        $p = htmlspecialchars(strip_tags($prc));

        // Bind parameters to prepared stmt
        $stmt->bindParam(':customer_name', $cn);
        $stmt->bindParam(':quantity', $q);
        $stmt->bindParam(':address', $a);
        $stmt->bindParam(':name_of_food', $fn);
        $stmt->bindParam(':price', $p);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getSingleOrderByID($id)
    {
        // Create query
        $query = 'SELECT * FROM ' . $this->table . ' WHERE id = ?';

        // Prepare statement
        $query_statement = $this->database_connection->prepare($query);

        // Execute query statement
        $query_statement->bindParam(1, $id);

        // Execute query statement
        $query_statement->execute();

        return $query_statement;

    }

    // Verify new client, an entry
    public function verifyOrder($id) {
        $query = 'SELECT * FROM ' . $this->table . '
            WHERE
            id = ?
        ';

        $stmt = $this->database_connection->prepare($query);

        // Ensure safe data
        $i = htmlspecialchars(strip_tags($id));

        // Bind parameters to prepared stmt
        $stmt->bindParam(1, $i);

        if ($stmt->execute() && $stmt->rowCount() == 1) {

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            extract($row);

            // Create array
            return array(
                'id' => $id,
                'customer_name' => $customer_name,
                'quantity' => $quantity,
                'address' => $address,
                'name_of_food' => $name_of_food,
                'time_of_order' => $time_of_order,
                'price' => $price,
            ); // SHOULD RETURN AN OBJECT OF THE agent data
        } else {
            return array();
        }
    }

}