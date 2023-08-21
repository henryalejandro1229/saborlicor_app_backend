<?php
require "../config/database.php";

class query extends Conexion {
    public function config() {
        $email = $_GET['email'];
        $name = $_GET['name'];
        $apellido = $_GET['apellido'];
        $edad = $_GET['edad'];
        $password = $_GET['password'];
        $sessionGoogle = $_GET['sessionGoogle']; 
        $bool_val = ($sessionGoogle === "true" || $sessionGoogle === true);
        try {
            $conexion = parent::conectar();
            $query = new MongoDB\Driver\BulkWrite;
            $query->insert(['email'=>$email, 'name'=>$name, 'apellido'=>$apellido, 'edad'=>$edad, 'password'=>$password, 'sessionGoogle'=>$bool_val]);
            $conexion->executeBulkWrite($this->database_name.$this->col_users, $query);

            $conn = parent::conectar();
            $query = new MongoDB\Driver\Query(['email' => $email]);
            $cursor = $conn->executeQuery($this->database_name.$this->col_users, $query);
            return json_decode(json_encode($cursor->toArray()),JSON_UNESCAPED_UNICODE);
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
$obj = new query();
echo json_encode($obj->config());
?>