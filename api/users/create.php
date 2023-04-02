<?php
require "../config/database.php";

class query extends Conexion {
    public function config() {
        $email = $_GET['email'];
        try {
            $conexion = parent::conectar();
            $query = new MongoDB\Driver\BulkWrite;
            $query->insert(['email'=>$email]);
            $conexion->executeBulkWrite($this->database_name.$this->col_users, $query);
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
$obj = new query();
echo json_encode($obj->config());
?>