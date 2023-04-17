<?php
require "../config/database.php";

class getUsuarios extends Conexion {

    public function mostrarDatos() {
        $txtSearch = $_GET['txtSearch'];
        $min = $_GET['min'];
        $max = $_GET['max'];
        $typeID = $_GET['typeID'];
        $category = $_GET['category'];
        $params = ['tags' => new \MongoDB\BSON\Regex($txtSearch)];
        if($typeID !== '0') {
            $params += ['typeID' => $typeID];
        }
        if($category !== '0') {
            $params += ['marca' => $category];
        }
        if($min >= 0 && $max >= 0) {
            $params += ['precio' => ['$gte' => intval($min), '$lte' => intval($max)]];
        }
        try {
            $conexion = parent::conectar();
            $query = new MongoDB\Driver\Query($params);
            // print_r($query);
            $cursor = $conexion->executeQuery($this->database_name.$this->col_products, $query);
            return json_decode(json_encode($cursor->toArray()),JSON_UNESCAPED_UNICODE);
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}

$obj = new getUsuarios();
echo json_encode($obj->mostrarDatos())
?>