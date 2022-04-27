
<?php

class superficie
{
    /* DATOS PARA TRABAJAR CON EL SERVIDOR 
    private $conn;
    private $servername = '127.0.0.1';
    private $user = 'laboratoriovial';  //'root';
    private $pass = 'ViaLab4521';       //'';
    private $dataBaseName = 'laboratoriovial';  //'laboratorioweb';
    

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
        $sql = "SELECT s.* FROM superficie s 
            ORDER BY s.descripcion";
        $sentencia = $this->conn->prepare($sql);
        $sentencia->execute();
        $resultado = $sentencia->fetchAll();
        return $resultado;
    }

    public function insert(
        $descricion
    ) {
        global $conn;

        $sql = "Insert into superficie (descricion) values (?)";
        $sentencia = $conn->prepare($sql);

        try {
            $sentencia->execute([
                $descricion
            ]);

            if ($sentencia) {
                return $conn->lastInsertId();
            } else {
                return 0;
            }
        } catch (PDOException $err) {
            // Mostramos un mensaje genérico de error.
            echo $err;
        }
    }

    public function update(
        $id,
        $descricion
    ) {

        /* Al igual que el insert, antes de actualizar tenemos que fijarnos si no existe 
        la descipcion por la que se quiere reemplazar */
        $sql = "SELECT * FROM superficie s where s.descricion = " . $descricion . " and p.ID <> " . $id;
        $sentencia = $this->conn->prepare($sql);
        $sentencia->execute();
        $resultado = $sentencia->fetchAll();

        if (count($resultado) > 0) {
            return 0;
        } else {

            $sql = "UPDATE superficie SET descricion = '" . $descricion . "'" .
                "WHERE ID = " . $id;

            try {
                $resultado = $this->conn->query($sql);

                if ($resultado) {
                    return 1;
                } else {
                    return 2;
                }
            } catch (PDOException $err) {
                // Mostramos un mensaje genérico de error.
                echo $err;
            }
        }
    }

    public function delete($id)
    {
        //EN REALIAD NO VALE LA PENA ELIMINAR LA SUPERFICIE
        $sql = "DELETE FROM superficie WHERE ID=$id";

        try {
            $resultado = $this->conn->query($sql);

            if ($resultado) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $err) {
            // Mostramos un mensaje genérico de error.
            echo $err;
        }
    }

    public function single_record($id)
    {
        $sql = "SELECT * FROM superficie where ID='$id'";
        $sentencia = $this->conn->prepare($sql);
        $sentencia->execute();
        $resultado = $sentencia->fetch(PDO::FETCH_OBJ);

        return $resultado;
    }
}
?>