
<?php 


class ejmplo_clase
{
    public static function mdl_NOMBRE_FUN($valor)
    {
        try {
    
            $sql = "";
            
            $stmt = Conexion::conectar()->prepare($sql);

            $stmt->bindParam(":valor", $valor, PDO::PARAM_STR);

            if ($stmt->execute()) {
                return  $stmt->fetchAll(PDO::FETCH_ASSOC);
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



}// /. fin clase


?>