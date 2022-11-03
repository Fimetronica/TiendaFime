<?php 

class Database {

    private $hostname = "localhost";
    private $database = "id19562353_fimetronica";
    private $username = "id19562353_taller";
    private $password = "+NQ0D*5v{6-IfL0a";
    private $charset = "utf8";

    function conectar()
    {
        try {
        $conexion = "mysql:host=" . $this->hostname  . "; dbname=" . $this->database . "; charset=" . $this->charset;
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_EMULATE_PREPARES => false
        ];

        $pdo = new PDO($conexion, $this->username, $this->password, $options);

        return $pdo;
    } catch(PDOExpection $e){
        echo 'Error conexion: ' . $e->getMessage();
        exit;
    }
    }
}

?>