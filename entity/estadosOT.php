
<?php

class Estado
{
    /* DATOS PARA TRABAJAR CON EL SERVIDOR 
    private $conn;
    private $servername = '127.0.0.1';
    private $user = 'laboratoriovial';  //'root';
    private $pass = 'ViaLab4521';       //'';
    private $dataBaseName = 'laboratoriovial';  //'laboratorioweb';
    */

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
        $sql = "SELECT * FROM estado e where e.activo = 'SI ' ORDER BY descri";
        $sentencia = $this->conn->prepare($sql);
        $sentencia->execute();
        $resultado = $sentencia->fetchAll();
        return $resultado;
    }

    public function insert($descri)
    {
        //Antes de insertar nos fijamos si existe el estado que se pretende insertar
        $sql = "SELECT e.activo FROM estado e where e.descri = '" . $descri . "'";
        $sentencia = $this->conn->prepare($sql);
        $sentencia->execute();
        $resultado = $sentencia->fetchAll();
        
        if (count($resultado) > 0) {
            /* Puede pasar que existe, pero que no aparece en el listado porque estado.activo=NO */
            foreach ($resultado as $reg) {
                if ($reg['activo'] == 'SI') {
                    return 0;
                } else {
                    $sql = "Update estado set activo = 'SI' where descri = '" . $descri . "'";
                    $resultado = $this->conn->query($sql);

                    return 1;
                }
            }
        } else {
            $sql = "Insert into estado (descri) values (?)";
            $sentencia = $this->conn->prepare($sql);

            try{
                $sentencia->execute([$descri]);

                if ($sentencia) {
                    return 1;
                } else {
                    return 2;
                }
            }
            catch(PDOException $err)
            {
               // Mostramos un mensaje genérico de error.
               echo $err;
            }
        }
    }

    public function delete($id)
    {
        /* Antes de eliminar un estado de OT debemos fijarnos si está asociado a alguna OT */
        $sql = "SELECT * FROM ordentrabajo o where o.IDEstado = " . $id;
        $sentencia = $this->conn->prepare($sql);
        $sentencia->execute();
        $resultado = $sentencia->fetchAll();

        if (count($resultado) > 0) {
            /* Si existe simplemente pasamos el estado.activo a NO */
            $sql = "Update estado set activo = 'NO' where ID = " . $id;
            $resultado = $this->conn->query($sql);

            if ($resultado) {
                return true;
            } else {
                return false;
            }
        } else {
            $sql = "DELETE FROM estado WHERE ID=$id";
            $resultado = $this->conn->query($sql);

            if ($resultado) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function single_record($id)
    {
        $sql = "SELECT * FROM estado where ID='$id'";
        $sentencia = $this->conn->prepare($sql);
        $sentencia->execute();
        $resultado = $sentencia->fetch(PDO::FETCH_OBJ);

        return $resultado;
    }

    public function update($descri, $id)
    {
        $sql = "UPDATE estado SET descri='$descri' WHERE ID=$id";
        $resultado = $this->conn->query($sql);

        if ($resultado) {
            return true;
        } else {
            return false;
        }
    }
}
?>