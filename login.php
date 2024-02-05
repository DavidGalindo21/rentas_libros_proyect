

<!-- session_start();

if (isset($_SESSION['usuario'])) {
    header('location: ./index.php');
} -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="img/icono.ico" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="./style.css">
    <title>Inicio de sesión</title>
    <style>
        select{
            margin-left: 1rem;
        }
    </style>
</head>

<body>
    <?php
   
    include('./rentas_php/Conexion.php');
    $NOMBRE = $CORREO = $PASSWORD = $EDAD = $GENERO = $FECHA= $NIVEL = "";
    $db = new Database();
    $query = $db->connect()->prepare('select max(ID) as ID from registros');
    $query->execute();
    $row = $query->fetch();
    $numero = $row['ID'];
    $numero++;


    ?>

    <div class="container-form register">
        <div class="information">
            <div class="info-childs">
                <h2>Bienvenido</h2>
                <p>Para poder ingresar a la página por favor Inicia sesión con tus datos</p>
                <input type="button" id="sing-in" value="Iniciar Sesión">
            </div>
        </div>
        <div class="form-information">
            <div class="form-information-childs">
                <h2>Crear una cuenta</h2>
                <p>O usa tu email para registrarte </p>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" class="form">
                    <label for="">
                        <i class='bx bx-user'></i>
                        <input type="text" id="form2Example22" required name="NOMBRE" placeholder="Nombre">
                    </label>
                    <label for="">
                        <i class='bx bx-calendar'></i>
                        <input type="text" id="form2Example22" required name="EDAD" placeholder="Edad">
                    </label>
                    <label for="" style="padding: 10px 10px;">
                        <i class='bx bx-user'></i>
                        Femenino
                        <input type="radio" id="form2Example22" name="GENERO" value="F">
                        Maculino
                        <input type="radio" id="form2Example22" name="GENERO" value="M">
                    </label>
                    <label for="">
                        <i class='bx bx-envelope'></i>
                        <input type="email" id="form2Example22" required name="CORREO" placeholder="Correo electrónico">
                    </label>
                    <label for="">
                        <i class='bx bx-lock-alt'></i>
                        <input type="password" id="form2Example22" required name="PASSWORD"
                            placeholder="Contraseña (Al menos 8 caracteres, números y caracteres especiales)">
                    </label>
                    <label for="">Nivel<select name="NIVEL" id="NIVEL">
                        <option value="1">1</option>
                        <option value="2">2</option>
                       </select></label>
                       
                    
                    <input type="submit" name="enviar" value="Registrarse">
                </form>
            </div>
        </div>
    </div>


    <?php
    // Función para validar la contraseña
    function validarContrasena($PASSWORD)
    {
        // Verificar longitud mínima de 8 caracteres
        if (strlen($PASSWORD) < 8) {
            return false;
        }

        // Verificar si contiene al menos un número
        if (!preg_match('/[0-9]/', $PASSWORD)) {
            return false;
        }

        // Verificar si contiene al menos un carácter especial (puedes personalizar la lista según tus necesidades)
        if (!preg_match('/[!@#$%^&*(),.?":{}|<>]/', $PASSWORD)) {
            return false;
        }

        // La contraseña cumple con los requisitos
        return true;
    }

    if (isset($_REQUEST['enviar'])) {
        $NOMBRE = $_POST['NOMBRE'];
        $EDAD = $_POST['EDAD'];
        $GENERO = $_POST['GENERO'];
        $CORREO = $_POST['CORREO'];
        $PASSWORD = $_POST['PASSWORD'];
        $NIVEL = $_POST['NIVEL'];

       
        // Validar la contraseña
        if (!validarContrasena($PASSWORD)) {
            echo '<script type="text/javascript">
                    alert("La contraseña no cumple con los requisitos (al menos 8 caracteres, números y caracteres especiales).");
                  </script>';
            // Puedes hacer algo más aquí, como redirigir al usuario a la página de registro.
            exit(); // Salir del script si la contraseña no cumple con los requisitos.
        }
        $pass_cifrado = password_hash($PASSWORD,PASSWORD_DEFAULT,array("cost">=10));

        $query = $db->connect()->prepare('select CORREO from registros where CORREO = :CORREO');
        $query->execute(['CORREO' => $CORREO]);
        $row = $query->fetch(PDO::FETCH_NUM);
        if ($query->rowCount() <= 0) {
            $insert = "insert into registros(NOMBRE, EDAD, GENERO,CORREO, PASSWORD, NIVEL) values(:NOMBRE, :EDAD, :GENERO,:CORREO, :PASSWORD, :NIVEL)";
            $insert = $db->connect()->prepare($insert);
            $insert->bindParam('NOMBRE', $NOMBRE, PDO::PARAM_STR, 50);
            $insert->bindParam('EDAD', $EDAD, PDO::PARAM_STR);
            $insert->bindParam('GENERO', $GENERO, PDO::PARAM_STR, 10);
            $insert->bindParam('CORREO', $CORREO, PDO::PARAM_STR, 50);
            $insert->bindParam('PASSWORD', $pass_cifrado, PDO::PARAM_STR);
            $insert->bindParam('NIVEL', $NIVEL, PDO::PARAM_STR);

            $insert->execute();
            if (!$query) {
                echo "Error: ", $query->errorInfo();
            }
            echo '<script type="text/javascript">
      alert("REGISTRO EXITOSO!!!");
    </script>';

        } else if ($query->rowCount() > 0) {

            echo '<script type="text/javascript">
        alert("EL CORREO YA EXISTE");
      </script>';
        }
    }
    ?>

    <div class="container-form hide login">
        <div class="information">
            <div class="info-childs">
                <h2>¡¡Bienvenido nuevamente!!</h2>
                <p>Para poder ingresar a la página por favor Inicia sesión con tus datos</p>
                <input type="button" id="sing-up" value="Registrarse">
            </div>
        </div>
        <div class="form-information">
            <div class="form-information-childs">
                <h2>Iniciar Sesión</h2>
                <p>O iniciar sesión con una cuenta </p>
                <form action="./php/inicio.php" method="POST" class="form">

                    <label for="">
                        <i class='bx bx-envelope'></i>
                        <input type="email" required name="CORREO" placeholder="Correo electrónico">
                    </label>
                    <label for="">
                        <i class='bx bx-lock-alt'></i>
                        <input type="password" required name="PASSWORD" placeholder="Contraseña">
                    </label>
                    <input type="submit" value="Iniciar sesión">
                </form>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="./js/animaciones.js"></script>
    <script src="js/script.js"></script>
</body>

</html>