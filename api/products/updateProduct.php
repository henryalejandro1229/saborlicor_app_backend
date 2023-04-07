<?php
require "../config/database.php";

class query extends Conexion {
    public function config() {
        $id = $_GET['id'];
        $title = $_GET['title'];
        $typeID = $_GET['typeID'];
        $description = $_GET['description'];
        $marca = $_GET['marca'];
        $precio = $_GET['precio'];
        $image = $_GET['imageUrl'];
        try {
            $conexion = parent::conectar();
            $query = new MongoDB\Driver\BulkWrite;
            $query->update(['_id' => new MongoDB\BSON\ObjectID($id)], ['$set' => ['title'=>$title, 'description'=>$description, 'marca'=>$marca, 'precio'=>$precio, 'typeID'=>$typeID, 'imageUrl'=>$image]]);
            $conexion->executeBulkWrite($this->database_name.$this->col_products, $query);
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
$obj = new query();
echo json_encode($obj->config());
?>