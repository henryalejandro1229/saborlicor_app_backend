<?php
require "../config/database.php";

class query extends Conexion {
    public function config() {
        $email = $_GET['email'];
        $name = $_GET['name'];
        $apellido = $_GET['apellido'];
        $edad = $_GET['edad'];
        $password = $_GET['password'];
        try {
            $conexion = parent::conectar();
            $query = new MongoDB\Driver\BulkWrite;
            $query->insert(['email'=>$email, 'name'=>$name, 'apellido'=>$apellido, 'edad'=>$edad, 'password'=>$password]);
            $conexion->executeBulkWrite($this->database_name.$this->col_users, $query);
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
$obj = new query();
echo json_encode($obj->config());
?>