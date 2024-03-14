
<?php

require_once "conexion.php";

class ModeloUsuarios
{

    // ====================================================== //
    // ================== MOSTRAR USUARIOS ================== //
    // ====================================================== //
    static public function mdlMostrarUsuarios($tabla, $item, $valor)
    {
        if ($item != null) {


            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }


        $stmt = null;
    }





    // ====================================================== //
    // ================== MOSTRAR USUARIOS ================== //
    // ====================================================== //
    public static function mdlComparaPass($tabla, $item, $valor, $item2, $valor2)
    {
        try {
            $sql = "SELECT * FROM $tabla WHERE $item = :$item AND $item2 = :$item2 LIMIT 1";

            $stmt = Conexion::conectar()->prepare($sql);

            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
            $stmt->bindParam(":" . $item2, $valor2, PDO::PARAM_STR);

            if ($stmt->execute()) {
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } else {
                // Manejar el error según tus necesidades
                return false;
            }
        } catch (PDOException $e) {
            // Manejar la excepción según tus necesidades
            return false;
        } finally {
            // Si es necesario, realiza alguna limpieza
            $stmt = null;
        }
    }


    // ====================================================== //
    // ================= REGISTRO DE USUARIO ================ //
    // ====================================================== //
    static public function mdlIngresarUSuario($tabla, $datos)
    {
        $stmt = Conexion::conectar()->prepare(
            "INSERT INTO $tabla(id ,nombre, usuario, password, perfil, foto, estado)
            VALUES (:id, :nombre, :usuario, :password, :perfil, :ruta, :estado)"
        );

        $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
        $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
        $stmt->bindParam(":password", $datos["password"], PDO::PARAM_STR);
        $stmt->bindParam(":perfil", $datos["perfil"], PDO::PARAM_STR);
        $stmt->bindParam(":ruta", $datos["foto"], PDO::PARAM_STR);
        $stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_INT);

        if ($stmt->execute()) {
            return 'ok';
        } else {
            return 'error';
        };

        $stmt = null;
    }


    // ====================================================== //
    // =================== EDITAR USUARIO =================== //
    // ====================================================== //
    static public function mdlEditarUsuario($tabla, $datos)
    {
        $stmt = Conexion::conectar()->prepare(
            "UPDATE $tabla
            SET 
                nombre= :nombre,
                password= :password, 
                perfil= :perfil, 
                foto= :ruta
            WHERE usuario = :usuario"
        );

        $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
        $stmt->bindParam(":password", $datos["password"], PDO::PARAM_STR);
        $stmt->bindParam(":perfil", $datos["perfil"], PDO::PARAM_STR);
        $stmt->bindParam(":ruta", $datos["foto"], PDO::PARAM_STR);

        if ($stmt->execute()) {
            return 'ok';
        } else {
            return 'error';
        };

        $stmt = null;
    }


    // ====================================================== //
    // ==================== EDITAR IMAGEN =================== //
    // ====================================================== //
    static public function mdlEditarImagen($tabla, $datos)
    {
        $sql= "UPDATE $tabla
        SET  
            foto= :ruta
        WHERE id = :id";

        $stmt = Conexion::conectar()->prepare($sql);

        $stmt->bindParam(":id", $datos["id"], PDO::PARAM_STR);
        $stmt->bindParam(":ruta", $datos["foto"], PDO::PARAM_STR);

        if ($stmt->execute()) {
            return 'ok';
        } else {
            return 'error';
        };

        $stmt = null;
    }

    // ====================================================== //
    // ================= ACTUALIZAR USUARIO ================= //
    // ====================================================== //
    static public function mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2)
    {

        $stmt = Conexion::conectar()->prepare(
            "UPDATE $tabla
            SET 
                $item1= :item1 
            WHERE $item2 = :item2"
        );


        $stmt->bindParam(":item1", $valor1, PDO::PARAM_STR);
        $stmt->bindParam(":item2", $valor2, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return 'ok';
        } else {
            return 'error';
        };

        $stmt = null;
    }

    // ====================================================== //
    // ================= ELIMINAR   USUARIO ================ //
    // ====================================================== //
    static public function mdlBorrarUSuario($tabla, $datos)
    {
        $stmt = Conexion::conectar()->prepare(
            "DELETE FROM $tabla WHERE id=:id"
        );

        $stmt->bindParam(":id", $datos, PDO::PARAM_INT);


        if ($stmt->execute()) {
            return 'ok';
        } else {
            return 'error';
        };

        $stmt = null;
    }



    // ====================================================== //
    // ================ CAMBIAR PASS USUARIO ================ //
    // ====================================================== //
    public static function mdlEditarPassword($tabla, $datos)
    {
        try {

            $sql = "UPDATE $tabla
            SET  
                password= :password
            WHERE id = :id";

            $stmt = Conexion::conectar()->prepare($sql);

            $stmt->bindParam(":id", $datos["id"], PDO::PARAM_STR);
            $stmt->bindParam(":password", $datos["password"], PDO::PARAM_STR);

            if ($stmt->execute()) {
                return  "ok";
            } else {
                // Manejar el error según tus necesidades
                return false;
            }
        } catch (PDOException $e) {
            // Manejar la excepción según tus necesidades
            return false;
        } finally {
            // Si es necesario, realiza alguna limpieza
            $stmt = null;
        }
    } // /.fin 
}
