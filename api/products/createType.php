<?php
require "../config/database.php";

class query extends Conexion {
    public function config() {
        $name = $_GET['name'];
        $description = $_GET['description'];
        $image = $_GET['imageUrl'];
        try {
            $conexion = parent::conectar();
            $query = new MongoDB\Driver\BulkWrite;
            $query->insert(['name'=>$name, 'description'=>$description, 'imageUrl'=>$image]);
            $conexion->executeBulkWrite($this->database_name.$this->col_types, $query);
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
$obj = new query();
echo json_encode($obj->config());
?>