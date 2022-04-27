
<?php

class ordenTrabajo
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
        $sql = "SELECT o.*, c.razonSocial, e.descri as descriEstado FROM ordentrabajo o 
            INNER JOIN cliente c ON o.IDCliente = c.ID 
            INNER JOIN estado e ON o.IDEstado = e.ID WHERE o.IDLaboratorio = 7
            ORDER BY o.fechaAlta";
        $sentencia = $this->conn->prepare($sql);
        $sentencia->execute();
        $resultado = $sentencia->fetchAll();
        return $resultado;
    }

    public function insert(
        $nroOT,
        $nroPresu,
        $fechaAlta,
        $IDCliente,
        $descriTrabajo,
        $detalle,
        $importe,
        $IDEstado,
        $responsable
    ) {
        global $conn;

        $sql = "Insert into ordentrabajo (nroOT, nroPresu, fechaAlta, IDCliente, IDLaboratorio, descri, 
            detalle, importe, IDEstado, responsable) values (?,?,?,?,?,?,?,?,?,?)";
        $sentencia = $conn->prepare($sql);

        try {
            $sentencia->execute([
                $nroOT, $nroPresu, $fechaAlta, $IDCliente, 7, $descriTrabajo, $detalle,
                $importe, $IDEstado, $responsable
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
        $nroOT,
        $nroPresu,
        $fechaAlta,
        $IDCliente,
        $descriTrabajo,
        $detalle,
        $importe,
        $IDEstado,
        $responsable
    ) {

        /* Al igual que el insert, antes de actualizar tenemos que fijarnos si no existe 
       el nroOT por el que se quiere reemplazar */
        $sql = "SELECT * FROM ordentrabajo o where o.nroOT = " . $nroOT . " and o.ID <> " . $id;
        $sentencia = $this->conn->prepare($sql);
        $sentencia->execute();
        $resultado = $sentencia->fetchAll();

        if (count($resultado) > 0) {
            return 0;
        } else {

            $sql = "UPDATE ordentrabajo SET nroOT = " . $nroOT . ", nroPresu = '" . $nroPresu . "', " .
                "fechaAlta = '" . $fechaAlta . "', IDCliente = " . $IDCliente .
                ", descri = '" . $descriTrabajo . "', detalle = '" . $detalle . "', " .
                "importe = " . $importe . ", IDEstado = " . $IDEstado .
                ", responsable = '" . $responsable . "' WHERE ID = " . $id;

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
        $sql = "DELETE FROM ordentrabajo WHERE ID=$id";

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
        $sql = "SELECT * FROM ordentrabajo where ID='$id'";
        $sentencia = $this->conn->prepare($sql);
        $sentencia->execute();
        $resultado = $sentencia->fetch(PDO::FETCH_OBJ);

        return $resultado;
    }
}
?>