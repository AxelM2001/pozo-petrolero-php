<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Insertar datos</title>
</head>
<body>


    <form action="index.php" method="POST">
        Fecha de registro: <input type="date" name="fecha" id="fecha"><br><br>
        Nivel de presion (1000 kPa - 50000 kPa): 
        <label for="presion"></label>
        <input type="number" id="presion" name="presion" min="1000" max="50000"><br>
        <p>Pozo registrado: <br>
            <input type="radio" name="radio" value="maracaibo"> Maracaibo
            <input type="radio" name="radio" value="delta amacuro"> Delta Amacuro
            <input type="radio" name="radio" value="barinas"> Barinas
            <input type="radio" name="radio" value="cariaco"> Cariaco
            <input type="radio" name="radio" value="monagas"> Monagas
        </p>
        <input type="submit" value="Añadir">
    </form>

    <div id="todolist">
        <?php
            $servidor = "localhost";
            $nombreusuario = "root";
            $password = "";
            $db = "pozo petrolero";
            $fecha = "";
            $radio = "";
            $campos = array();


            $conexion = new mysqli($servidor, $nombreusuario, $password, $db);
        
            if($conexion->connect_error){
                die("Conexión fallida: " . $conexion->connect_error);
            }

            //conexion con presion
            if(isset($_POST['presion']) && isset($_POST['fecha']) && isset($_POST['radio']) ){

                $presion = $_POST['presion'];
                $fecha = $_POST['fecha'];
                $radio = $_POST['radio'];
                
                $fecha = date ('Y-m-d', strtotime($_POST['fecha']));

                $sql = "INSERT INTO registros (Pozo, Fecha_registro, Presion_medida)
                VALUES('$radio','$fecha', '$presion')";

                if($conexion->query($sql) === true){
                    echo "<br><br>";
                    echo $presion . " kPa es la presion registrada <br>";
                    echo "la fecha registrada es: " . $fecha . "<br>";
                    echo $radio . " es el pozo seleccionado";
                }else{
                    die("Error al insertar datos: " . $conexion->error);
                }

            } else {
                echo "<br><br>";
                array_push($campos, "Selecciona una fecha de registro");
                array_push($campos, "Indica la presion");
                array_push($campos, "Indica el pozo a medir");

            }


            if(count($campos) > 0){
                echo "<div class='error'>";
                for ($i=0; $i<count($campos);$i++){  
                    echo "<li>" . $campos[$i] . "</div>";
                }
            }

            require("grafico1.php");
              
        ?>
    </div>
</body>


</html>