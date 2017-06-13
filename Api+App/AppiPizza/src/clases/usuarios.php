<?php
class Usuario 
    {
        public $idUsuario;
        public $nomApell;
        public $sexo;
        public $email;
        public $clave;
        public $direccion;
        public $localidad;
        public $provincia;
        public $foto;
        public $estado;
        public $telefono;
        public $tipo;

        //Traer Usuarios 
        public static function TraerTodosLosUsuarios($tipo){
            
            $consulta = "SELECT * FROM usuario ORDER BY nomApell";

            if($tipo != "Todos")
                $consulta = "SELECT * FROM usuario WHERE tipo = '$tipo' ORDER BY nomApell";
             
            try{
                //Instanciamos Base de datos
                $db = new db();

                //conexion
                $db = $db->conectar();
                $ejecutar = $db->query($consulta);
                $usuario = $ejecutar->fetchAll(PDO::FETCH_OBJ);
                $db = null;

                //Exportar y mostrar en JSON
                if($usuario != NULL)
                    echo json_encode($usuario);

                else
                    echo('null');


            }catch(PDOException $e){
                echo '{"error": {"text": '.$e->getMessage().'}';
            }
        }

        //Traer un Usuario
        public static function TraerUnUsuario($id){

            $consulta = "SELECT * FROM usuario WHERE idUsuario=$id";

            try{
                //Instanciamos Base de datos
                $db = new db();

                //conexion
                $db = $db->conectar();
                $ejecutar = $db->query($consulta);
                $usuario = $ejecutar->fetchAll(PDO::FETCH_OBJ);
                $db = null;

                //Exportar y mostrar en JSON
                if($usuario != NULL)
                    echo json_encode($usuario);

                else
                    echo "null";

            }catch(PDOException $e){
                echo '{"error": {"text": '.$e->getMessage().'}';
            }

        }

        //Ingresar un Usuario
        public static function IngresarUsuario($usuario){

                $consulta = "INSERT INTO usuario (nomApell, telefono, email, clave, 
                sexo, fecIngreso, foto, direccion, localidad, estado, tipo) VALUES (:nomApell,
                 :telefono, :email, :clave, :sexo, :fecIngreso, :foto, :direccion,
                  :localidad, :estado, :tipo)";

                try{
                    //Instanciamos Base de datos
                    $db = new db();

                    //conexion
                    $db = $db->conectar();
                    $inserta = $db->prepare($consulta);
                    $inserta->bindParam(':nomApell', $usuario->nomApell);
                    $inserta->bindParam(':telefono', $usuario->telefono);
                    $inserta->bindParam(':email', $usuario->email);
                    $inserta->bindParam(':clave', $usuario->clave);
                    $inserta->bindParam(':sexo', $usuario->sexo);
                    $inserta->bindParam(':fecIngreso', $usuario->fecIngreso);
                    $inserta->bindParam(':foto', $usuario->foto);
                    $inserta->bindParam(':direccion', $usuario->direccion);
                    $inserta->bindParam(':localidad', $usuario->localidad);
                    $inserta->bindParam(':estado', $usuario->estado);
                    $inserta->bindParam(':tipo', $usuario->tipo);
                    $inserta->execute();

                    echo '{"Notificacion": {"text": "Usuario agregado"}';
                    

                }catch(PDOException $e){
                    echo '{"error": {"text": '.$e->getMessage().'}';
                }
        }

        //Modifica Usuario
        public static function ModificaUsuario($usuario, $id){

            $consulta = "UPDATE usuario SET 
                nomApell = :nomApell,
                telefono = :telefono,
                email = :email,
                clave = :clave,
                sexo = :sexo,
                direccion = :direccion,
                localidad = :localidad,
                tipo = :tipo   
                WHERE idUsuario = $id";
            try{
                //Instanciamos Base de datos
                $db = new db();

                //conexion
                $db = $db->conectar();
                        $inserta = $db->prepare($consulta);
                        $inserta->bindParam(':nomApell', $usuario->nomApell);
                        $inserta->bindParam(':telefono', $usuario->telefono);
                        $inserta->bindParam(':email', $usuario->email);
                        $inserta->bindParam(':clave', $usuario->clave);
                        $inserta->bindParam(':sexo', $usuario->sexo);
                        // $inserta->bindParam(':fecIngreso', $usuario->fecIngreso);
                        // $inserta->bindParam(':foto', $usuario->foto);
                        $inserta->bindParam(':direccion', $usuario->direccion);
                        $inserta->bindParam(':localidad', $usuario->localidad);
                        // $inserta->bindParam(':estado', $usuario->estado);
                        $inserta->bindParam(':tipo', $usuario->tipo);
                        $inserta->execute();

                echo '{"Notificacion": {"text": "Usuario Actualizado"}';
                

            }catch(PDOException $e){
                echo '{"error": {"text": '.$e->getMessage().'}';
            }

        }


        //Elimina Usuario
        public static function EliminaUsuario($id){

            $consulta = "UPDATE usuario SET estado='Baja' WHERE idUsuario=$id";

            try{
                //Instanciamos Base de datos
                $db = new db();

                //conexion
                $db = $db->conectar();
                $ejecutar = $db->prepare($consulta);
                $ejecutar->execute();
                $db = null;

                echo '{"Notificacion": {"text": "Usuario Borrado"}';

            }catch(PDOException $e){
                echo '{"error": {"text": '.$e->getMessage().'}';
            }
        }



    }//Fin de Usuarios 


?>