<?php 

    session_start();

    include('../rentas_php/Conexion.php');
    $CORREO = $PASSWORD = "";
    if(isset($_SESSION['rol'])){
        switch ($_SESSION['rol']) {
          case 1:
            header('location: ../carrito.php');
            break;
          
          case 2:
            header('location: ../rentas_php/menu.php');
            break;
            default:
        }
      }
    if(isset($_POST['CORREO']) && isset($_POST['PASSWORD'])){
        $CORREO = $_POST['CORREO'];
        $PASSWORD = $_POST['PASSWORD'];


        $db = new DataBase();
        $query = "SELECT * FROM registros WHERE CORREO = :CORREO";
        
        $stmt = $db->connect()->prepare($query);

        $stmt->execute(['CORREO' => $CORREO]);
        $result = $stmt->fetch();

        if(!empty($result) && password_verify($PASSWORD,$result['PASSWORD'])){

              // Validar rol

          $rol = $result[6];
          // echo 'Valor del rol '.$rol;
          $_SESSION['rol'] = $rol;

          switch ($_SESSION['rol']) {
            case 1:
              header('location: ../carrito.php');
              break;
            
            case 2:
              header('location: ../rentas_php/menu.php');
              break;
              default:
          }

        }else{
            echo '<script language="javascript">
            alert("DATOS INCORRECTOS!!!")
            window.location = "../login.php"
            </script>';
        }
        
    }

?>