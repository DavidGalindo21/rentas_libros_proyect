<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Renta de libros</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" href="../css/estilos_form.css">
</head>

<body class="d-flex justify-content-center align-items-center flex-column">
    

<?php 
			session_start();
			include('Conexion.php');
			if(!isset($_SESSION['rol'])){
				header('location: ../login.php');
			}else{
				if($_SESSION['rol'] != 2){
					header('location: ../login.php');
				}
			}
		
			$nombre_cliente=$apellido_cliente=$titulo=$correo=$fecha_entrega=$fecha_renta=$estado_renta="";
			$saldo_pendiente=0;
			$pago=0;
			$monto_renta=0;
			$pago_total=0;
			$anticipo=0;
            $numeroT="";
			$fecha_entrega= date('Y-m-d');
			$fecha_renta= date('Y-m-d');
			
			$db = new Database();
			$query = $db->connect()->prepare('select max(ID) as maximo FROM rentas');
			$query->execute();
			$row = $query->fetch();
			$numero=$row["maximo"];
			$numero++;

			function test_entrada($data){
				$data = trim($data);
				$data = stripslashes($data);
				$data = htmlspecialchars($data);
				return $data;
			}
			if($_SERVER["REQUEST_METHOD"]=="POST"){
				$nombre_cliente = test_entrada($_POST["NOMBRE"]);
                $apellido_cliente = test_entrada($_POST["APELLIDO"]);

                $titulo= test_entrada($_POST["TITULO_LIBRO"]);
				$correo = test_entrada($_POST["CORREO"]);
				$numeroT = test_entrada($_POST["NUMERO_TELEFONO"]);
                $fecha_entrega = test_entrada($_POST["FECHA_ENTREGA"]);
                $fecha_renta = test_entrada($_POST["FECHA_RENTA"]);
                $monto_renta = test_entrada($_POST["MONTO"]);
                $anticipo = test_entrada($_POST["ANTICIPO"]);
				$pago = test_entrada($_POST["PAGO"]);
				$estado_renta = test_entrada($_POST["ESTADO_RENTA"]);
				$campos = array();
			}
		?>


        <nav class="navbar w-100">
            <div class="row w-100 text-center m-auto">
                <div class="col-md-2 col-lg-2 link1 col-sm-6 col-6">
                    <a href="./menu.php" class="nav-link fw-bold">Administración de Noticias</a>
                    <img src="../img/svg/administracion.svg" class="svg1" alt="Logo enlace">
                </div>
                <div class="col-md-2 col-lg-2 link2 col-sm-6 col-6">
                    <a href="agregarNoticia.php" class="nav-link fw-bold">Agregar Renta</a>
                    <img src="../img/svg/agregar.svg" class="svg2" alt="Logo enlace">
                </div>
                <div class="col-md-2 col-lg-2 link3 col-sm-6 col-6">
                    <a href="consultar.php" class="nav-link fw-bold">Consultar Renta</a>
                    <img src="../img/svg/consultar.svg" class="svg3" alt="Logo enlace">
                </div>
                <div class="col-md-2 col-lg-2 link4 col-sm-6 col-6">
                    <a href="cambios.php" class="nav-link fw-bold">Modificar Renta</a>
                    <img src="../img/svg/modificar.svg" class="svg4" alt="Logo enlace">
                </div>
                <div class="col-md-2 col-lg-2 link5 col-sm-6 col-6">
                    <a href="bajas.php" class="nav-link fw-bold">Eliminar Renta</a>
                    <img src="../img/svg/eliminar.svg" class="svg5" alt="Logo enlace">
                </div>
                <div class="col-md-2 col-lg-2 link6 col-sm-6 col-6">
                    <a href="./cerrar.php" class="nav-link fw-bold">Cerrar Sesión</a>
                    <img src="../img/svg/cerrar.svg" class="svg6" alt="Logo enlace">
                </div>
            </div>
        </nav>
        
        <section class="mt-5 mb-5 formulario">
            <div class="formulario">
                <form method="POST" 
						autocomplete="on"
						action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"  class="form-control border-0">
                    <div class="infor text-center my-3">
                        <h1>Registro de rentas</h1>
                        <h5>Ingresa la información a registrar</h5>
                    </div>
                    <div class="form-group d-flex gap-3  mt-3 ">
                        <div class="derecha">
                        <input type="text" class="form-control" id="ID" style="display: none;" value="<?php echo $numero; ?>" name="ID">
                            <label for="nombre" class="form-label">Primer Nombre</label>
                            <input type="text" name="NOMBRE" id="NOMBRE" value="<?php echo $nombre_cliente;?>"   required class="form-control">
                            
                        </div>
                        <div class="izquierda">
                            <label for="apellido" class="form-label">Primer Apellido</label>
                            <input type="text" name="APELLIDO" id="APELLIDO" required class="form-control" value="<?php echo $apellido_cliente;?>">
                        </div>
                    </div>
                    <div class="form-group mt-3 ">
                        <label for="titulo" class="form-label">Titulo del Libro</label>
                        <select class="form-select" name="TITULO_LIBRO" id="TITULO_LIBRO" required>
    <option value="">Selecciona el libro</option>

    <option value="Los hombres que no amaban a las mujeres" <?php if($titulo=="Los hombres que no amaban a las mujeres") echo "selected"; ?>>
        Los hombres que no amaban a las mujeres
    </option>

    <option value="La chica que soñaba con una cerilla y un bidón de gasolina" <?php if($titulo=="La chica que soñaba con una cerilla y un bidón de gasolina") echo "selected"; ?>>
        La chica que soñaba con una cerilla y un bidón de gasolina
    </option>



    <option value="La sangre manda" <?php if($titulo=="La sangre manda") echo "selected"; ?>>
        La sangre manda
    </option>

    <option value="Desarmadero" <?php if($titulo=="Desarmadero") echo "selected"; ?>>
        Desarmadero
    </option>

    <option value="El castillo de Barbazu" <?php if($titulo=="El castillo de Barbazu") echo "selected"; ?>>
        El castillo de Barbazu
    </option>

    <option value="El resplandor" <?php if($titulo=="El resplandor") echo "selected"; ?>>
        El resplandor
    </option>

    <option value="Carrie" <?php if($titulo=="Carrie") echo "selected"; ?>>
        Carrie
    </option>

    <option value="It" <?php if($titulo=="It") echo "selected"; ?>>
        It
    </option>

    <option value="El Extraño Caso Del Dr. Jekyll y Mr. Hyde" <?php if($titulo=="El Extraño Caso Del Dr. Jekyll y Mr. Hyde") echo "selected"; ?>>
    El Extraño Caso Del Dr. Jekyll y Mr. Hyde
    </option>

    <option value="El rito" <?php if($titulo=="El rito") echo "selected"; ?>>
    El rito
    </option>

        <option value="El instituto" <?php if($titulo=="El instituto") echo "selected"; ?>>
        El instituto
    </option>

    <option value="Bajo la misma estrella" <?php if($titulo=="Bajo la misma estrella") echo "selected"; ?>>
    Bajo la misma estrella
    </option>

    <option value="El amor en los tiempos de cólera" <?php if($titulo=="El amor en los tiempos de cólera") echo "selected"; ?>>
    El amor en los tiempos de cólera
    </option>

    <option value="Eleanor & Park" <?php if($titulo=="Eleanor & Park") echo "selected"; ?>>
    Eleanor & Park
    </option>

    <option value="Como agua para chocolate" <?php if($titulo=="Como agua para chocolate") echo "selected"; ?>>
    Como agua para chocolate
    </option>

    <option value="El cuaderno de Noah" <?php if($titulo=="El cuaderno de Noah") echo "selected"; ?>>
    El cuaderno de Noah
    </option>

    <option value="Posdata: te amo" <?php if($titulo=="Posdata: te amo") echo "selected"; ?>>
    Posdata: te amo
    </option>

    <option value="Cometas en el cielo" <?php if($titulo=="Cometas en el cielo") echo "selected"; ?>>
    Cometas en el cielo
    </option>

    <option value="El día que se perdió la cordura" <?php if($titulo=="El día que se perdió la cordura") echo "selected"; ?>>
    El día que se perdió la cordura
    </option>

    <option value="Las hijas de la criada" <?php if($titulo=="Las hijas de la criada") echo "selected"; ?>>
    Las hijas de la criada
    </option>

    <option value="Mil soles espléndidos" <?php if($titulo=="Mil soles espléndidos") echo "selected"; ?>>
    Mil soles espléndidos
    </option>

    <option value="Por trece razones" <?php if($titulo=="Por trece razones") echo "selected"; ?>>
    Por trece razones
    </option>

    <option value="La vida después de ella" <?php if($titulo=="La vida después de ella") echo "selected"; ?>>
    La vida después de ella
    </option>
</select>
</div>
<div class="form-group d-flex gap-3 mt-3">
    <div class="derecha">
    </div>
</div>
   <label for="correo" class="form-label">Correo</label>
                            <input type="email" required name="CORREO" id="CORREO" value="<?php echo $correo;?>" class="form-control">

                        </div>
                        <div class="izquierda">
                            <label for="numero" class="form-label">Número Telefónico</label>
                            <input type="tel" required name="NUMERO_TELEFONO" id="NUMERO_TELEFONO" class="form-control" value="<?php echo $numeroT;?>">
                        </div>
                    </div>
                    <div class="form-group mt-3 ">
                        <label for="fechaRenta" class="form-label">Fecha de Renta</label>
                        <input type="date"  id="FECHA_RENTA" required name="FECHA_RENTA" value="<?php echo date("Y-m-d");?>"
								class="form-control">

                    </div>
                    <div class="form-group mt-3 ">
                        <label for="fechaEntrega" class="form-label">Fecha de Entrega</label>
                        <input type="date" required name="FECHA_ENTREGA" id="FECHA_ENTREGA" value="<?php echo date("Y-m-d");?>" class="form-control">
                    </div>
                    <div class="form-group d-flex justify-content-center gap-3 mt-3">
                        <div class="derecha">
                            <label for="monto" class="form-label">Monto</label>
                            <input type="text" required name="MONTO" id="MONTO" class="form-control" size="5" value="<?php echo $monto_renta;?>">

                        </div>
                        <div class="centro">
                            <label for="anticipo" class="form-label">Anticipo</label>
                            <input type="text" required name="ANTICIPO" id="ANTICIPO" class="form-control" size="5" value="<?php echo $anticipo;?>">
                        </div>
                        <div class="izquierda">
                            <label for="pago" class="form-label">Pago</label>
                            <input type="text" required name="PAGO" id="PAGO" class="form-control" size="5" value="<?php echo $pago;?>">
                        </div>
                    </div>
                    <div class="form-group mt-3">
                        <label for="estado" class="form-label">Estado de la Renta</label>
                        <select class="form-select" name="ESTADO_RENTA" id="ESTADO_RENTA">
                        <option value="Apartado"
									<?php 
									if($estado_renta=="Apartado") 
										echo "selected" 
									?>>Apartado</option>
								<option value="Entregado"
									<?php 
									if($estado_renta=="Entregado") 
										echo "selected" 
									?>>Entregado</option>
								<option value="Devuelto"
									<?php 
									if($estado_renta=="Devuelto") 
										echo "selected" 
									?>>Devuelto</option>
                        </select>
                    </div>
                    <div class="form-group mt-3 ">
                        <input type="submit" class="btn btn-dark btn-lg w-100" value="Registrar Renta" name="enviar">
                    </div>
                </form>

                <?php
		if (isset($_REQUEST['enviar'])){
			$nombre_cliente=$_POST['NOMBRE'];
            $apellido_cliente=$_POST['APELLIDO'];
			$titulo=$_POST['TITULO_LIBRO'];
            $correo=$_POST['CORREO'];
            $numeroT=$_POST['NUMERO_TELEFONO'];
			$fecha_entrega=$_POST['FECHA_ENTREGA'];
			$monto_renta =$_POST['MONTO'];
			$anticipo =$_POST['ANTICIPO'];
			$pago =$_POST['PAGO'];
			$estado_renta =$_POST['ESTADO_RENTA'];
            $fecha_renta = $_POST['FECHA_RENTA'];
			$saldo_pendiente=$monto_renta-($anticipo+$pago);
			$pago_total=($anticipo+$pago);
			$fecha_en = strtotime('+5 day', strtotime($fecha_entrega));
			$fecha_en = date('Y-m-d', $fecha_en);
			$insert="insert into rentas(NOMBRE, APELLIDO, TITULO_LIBRO, CORREO, NUMERO_TELEFONO, MONTO, ANTICIPO, PAGO, SALDO_PENDIENTE, PAGO_TOTAL, ESTADO_RENTA,FECHA_RENTA, FECHA_ENTREGA) values (:NOMBRE, :APELLIDO, :TITULO_LIBRO, :CORREO, :NUMERO_TELEFONO, :MONTO, :ANTICIPO, :PAGO, :SALDO_PENDIENTE, :PAGO_TOTAL, :ESTADO_RENTA, :FECHA_RENTA, :FECHA_ENTREGA)";
			$insert = $db->connect()->prepare($insert);
			$insert->bindParam(':NOMBRE',$nombre_cliente,PDO::PARAM_STR);
            $insert->bindParam(':APELLIDO',$apellido_cliente,PDO::PARAM_STR);
            $insert->bindParam(':TITULO_LIBRO',$titulo,PDO::PARAM_STR);
            $insert->bindParam(':CORREO',$correo,PDO::PARAM_STR);
            $insert->bindParam(':NUMERO_TELEFONO',$numeroT,PDO::PARAM_INT);
            $insert->bindParam(':MONTO',$monto_renta,PDO::PARAM_INT);
            $insert->bindParam(':ANTICIPO',$anticipo,PDO::PARAM_INT);
			$insert->bindParam(':PAGO',$pago,PDO::PARAM_INT);
			$insert->bindParam(':SALDO_PENDIENTE',$saldo_pendiente,PDO::PARAM_INT);
			$insert->bindParam(':PAGO_TOTAL',$pago_total,PDO::PARAM_INT);
			$insert->bindParam(':ESTADO_RENTA',$estado_renta,PDO::PARAM_STR);
            $insert->bindParam(':FECHA_RENTA',$fecha_renta,PDO::PARAM_STR);
            $insert->bindParam(':FECHA_ENTREGA',$fecha_en,PDO::PARAM_STR);
            $insert->execute();
			if (!$query){
				echo "Error:",$sql->errorInfo();
			}
			print ("¡¡¡DATOS REGISTRADOS!!!.");
			print ("<br/><hr/>");
			print ("<table class='table table-striped '>\n");
			print ("<tr>\n");
				print ("<th>Fecha apartado</th>\n");
				print ("<td>" .$fecha_renta. "</td>\n");
			print ("</tr>\n");
			print ("<tr>\n");
				print ("<th>Cliente</th>\n");
				print ("<td>" .$nombre_cliente."</td>\n");
			print ("</tr>\n");
			print ("<tr>\n");
				print ("<th>Fecha Entrega</th>\n");
				print ("<td>".$fecha_en."</td>\n");
			//$variable = utf8_decode($variable);
			print ("</tr>\n");
			print ("<tr>\n");
				print ("<th>Monto</th>\n");
				print ("<td>" .$monto_renta."</td>\n");
			print ("</tr>\n");
			print ("<tr>\n");
				print ("<th>Anticipo</th>\n");
				print ("<td>".$anticipo."</td>\n");
			print ("</tr>\n");
			print ("<tr>\n");
				print ("<th>Saldo pendiente</th>\n");
				print ("<td>".$saldo_pendiente."</td>\n");
			print ("</tr>\n");
			print ("</table>\n");
			print ("<br /><hr />");
			if (!$query){
				echo "Error:",$sql->errorInfo();
			}
			$query->closeCursor(); // opcional en MySQL, dependiendo del controlador de base de datos puede ser obligatorio
			$query = null; // obligado para cerrar la conexión
			$db = null;
		}
	?>


              




            </div>
        </section>




        <script src="https://unpkg.com/scrollreveal"></script>
        <script src="./js/animaciones_form.js"></script>
</body>

</html>