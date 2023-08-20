<?php
class Conexion
{
    public $conn;
    public $database_name = "licores_de_sabor.";
    public $col_users = "users";
    public $col_types = "sabores";
    public $col_products = "products";
    public $col_addresses = "addresses";


    public function conectar()
    {
        try {
            $cadenaConexion ="mongodb+srv://desaborlicor:WtCRF0MBIHB6xjEW@licores.m34ei4r.mongodb.net/?retryWrites=true&w=majority";
            $cliente = new MongoDB\Driver\Manager($cadenaConexion);
            return $cliente;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
?>