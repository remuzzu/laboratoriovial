
<?php

class descargaFile
{
    /* DATOS PARA TRABAJAR CON EL SERVIDOR */
    /*private $conn;
    private $servername = '127.0.0.1';
    private $user = 'laboratoriovial';  //'root';
    private $pass = 'ViaLab4521';       //'';
    private $dataBaseName = 'laboratoriovial';  //'laboratorioweb';*/
    

    /* DATOS PARA TRABAJAR DESDE EL LOCALHOST */
    private $conn;
    private $servername = '127.0.0.1';
    private $user = 'root';
    private $pass = '';
    private $dataBaseName = 'laboratorioweb';


    function __construct()
    {
        $this->connect_db();
    }

    public function connect_db()
    {
        try {
            $this->conn = new PDO(
                'mysql:host=' . $this->servername . ';dbname=' . $this->dataBaseName,
                $this->user,
                $this->pass,
                array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            echo "ERROR: " . $e->getMessage();
        }
    }

    public function read()
    {
        $sql = "SELECT d.fecha, l.email, f.descri, p.nombre, p.organismo, p.pais 
            FROM descargas d INNER JOIN login l ON l.id=d.idlogin 
            INNER JOIN  file f ON f.id=d.idFile
            INNER JOIN persona p ON p.id=l.idpersona
            ORDER BY fecha";
        $sentencia = $this->conn->prepare($sql);
        $sentencia->execute();
        $resultado = $sentencia->fetchAll();
        return $resultado;
    }
}
?>