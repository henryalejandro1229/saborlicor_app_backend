<?php
require "../config/database.php";

class query extends Conexion {
    public function config() {
        $title = $_GET['title'];
        $description = $_GET['description'];
        $typeID = $_GET['typeID'];
        $marca = $_GET['marca'];
        $precio = $_GET['precio'];
        $image = $_GET['imageUrl'];
        $tags = strtolower($description);
        try {
            $conexion = parent::conectar();
            $query = new MongoDB\Driver\BulkWrite;
            $query->insert(['title'=>$title, 'description'=>$description, 'marca'=>$marca, 'precio'=>floatval($precio), 'imageUrl'=>$image, 'typeID'=>$typeID, 'tags' => $tags]);
            $conexion->executeBulkWrite($this->database_name.$this->col_products, $query);
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
$obj = new query();
echo json_encode($obj->config());
?>