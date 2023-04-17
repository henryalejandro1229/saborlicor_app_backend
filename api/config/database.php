<?php
class Conexion
{
    public $conn;
    public $database_name = "licores_de_sabor.";
    public $col_users = "users";
    public $col_types = "sabores";
    public $col_products = "products";

    public function conectar()
    {
        try {
            $cadenaConexion = "mongodb+srv://saborlicorde:KVxPy7qGTtMq959m@clusterlicores.z2oeuas.mongodb.net/?retryWrites=true&w=majority";
            $cliente = new MongoDB\Driver\Manager($cadenaConexion);
            return $cliente;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
?>