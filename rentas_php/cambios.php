<!DOCTYPE html>
<html lang="es">
  <head>
     <title>Cambio en los datos de las rentas</title>
	 <meta charset="utf-8">
	 <link href="css/bootstrap.min.css" rel="stylesheet">
	 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" href="../css/estilos_form.css">
	 </head>
	 <body>
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
			$db = new Database();
			$clave="";
			$nombre_cliente="";
			$correo="";
			$apellido="";
			$monto_renta="";
			$telefo="";
			$titulo="";

			function test_entrada($data){
				$data = trim($data);
				$data = stripslashes($data);
				$data = htmlspecialchars($data);
				return $data;
			}
			if($_SERVER["REQUEST_METHOD"]=="POST"){
				$clave = test_entrada($_POST["ID"]);
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
		
			<!--<div class="container">
				<div class="row">
				<div class="col-4">
				<div class="list-group">
					<a href="#" class="list-group-item list-group-item-action active" aria-current="true">
					Administración de Rentas
					</a>
					<a href="AltaRentas.php" class="list-group-item list-group-item-action">Agregar Renta</a>
					<a href="consultaRentas.php" class="list-group-item list-group-item-action">Consultar Renta</a>
					<a href="cambiosRentas.php" class="list-group-item list-group-item-action">Modificar renta</a>
					<a href="bajaRenta.php" class="list-group-item list-group-item-action">Eliminar Renta</a>
				</div>
    		</div>-->
			<form method="POST" class="mx-auto" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]);?>">
					<div class="col-8 mx-auto">
						<div class="mb-3">
							<label for="exampleFormControlInput1" class="form-label">Clave de renta a modificar:</label>
							<input type="text" class="form-control" id="ID"  name="ID" value="<?php echo $clave;?>">
						</div>
						<div class="mb-3">
							<input type="submit" class="btn btn-primary" name ="buscar" id="buscar" value="Buscar clave!!!"/>
						</div>
						
			<?php
				if(isset($_REQUEST['buscar'])){
					$clave=isset($_REQUEST['ID']) ? $_REQUEST['ID'] : null;

					$query = $db->connect()->prepare('select * FROM rentas where ID = :ID');
								$query->setFetchMode(PDO::FETCH_ASSOC);
								$query->execute(['ID' => $clave]);
								$row = $query->fetch();
								if($query -> rowCount() > 0){
							echo
								'<div class="mb-3">
									<label for="exampleFormControlInput1" 
										class="form-label">Folio de renta a modificar:</label>
									<input type="text" class="form-control" value="'.$row['ID'].'" disabled/>
								</div>'.
								'<div class="mb-3">
									<label for="exampleFormControlInput1" 
										class="form-label">Cliente:</label>
									<input type="text" class="form-control" lang="es" href="qa-html-language-declarations.es"
										name="NOMBRE" value ="'.$row['NOMBRE'].'" readonly/>
								</div>'.
								'<div class="mb-3">
								<label for="exampleFormControlInput1" 
									class="form-label">Apellidos:</label>
								<input type="text" class="form-control" lang="es" href="qa-html-language-declarations.es"
									name="APELLIDO" value ="'.$row['APELLIDO'].'" readonly/>
							</div>'.
							'<div class="mb-3">
							<label for="exampleFormControlInput1" 
								class="form-label">Correo:</label>
							<input type="text" class="form-control" lang="es" href="qa-html-language-declarations.es"
								name="CORREO" value ="'.$row['CORREO'].'" readonly/>
						</div>'.
							'<div class="mb-3">
							<label for="exampleFormControlInput1" 
								class="form-label">Telefono:</label>
							<input type="text" class="form-control" lang="es" href="qa-html-language-declarations.es"
								name="NUMERO_TELEFONO" value ="'.$row['NUMERO_TELEFONO'].'"/>
						</div>'.

						'<div class="mb-3">
						<label for="exampleFormControlInput1" class="form-label">Título Libro:</label>
						<select class="form-select" aria-label="Default select example" name="TITULO_LIBRO" id="TITULO_LIBRO">
							<option value="'.$row['TITULO_LIBRO'].'">'.$row['TITULO_LIBRO'].'</option>
							<option value="Los hombres que no amaban a las mujeres">
							Los hombres que no amaban a las mujeres
						</option>
					
						<option value="La chica que soñaba con una cerilla y un bidón de gasolina">
							La chica que soñaba con una cerilla y un bidón de gasolina
						</option>
					
					
					
						<option value="La sangre manda">
							La sangre manda
						</option>
					
						<option value="Desarmadero">
							Desarmadero
						</option>
					
						<option value="El castillo de Barbazu">
							El castillo de Barbazu
						</option>
					
						<option value="El resplandor">
							El resplandor
						</option>
					
						<option value="Carrie">
							Carrie
						</option>
					
						<option value="It">
							It
						</option>
					
						<option value="El Extraño Caso Del Dr. Jekyll y Mr. Hyde">
						El Extraño Caso Del Dr. Jekyll y Mr. Hyde
						</option>
					
						<option value="El rito">
						El rito
						</option>
					
							<option value="El instituto">
							El instituto
						</option>
					
						<option value="Bajo la misma estrella">
						Bajo la misma estrella
						</option>
					
						<option value="El amor en los tiempos de cólera">
						El amor en los tiempos de cólera
						</option>
					
						<option value="Eleanor & Park" >
						Eleanor & Park
						</option>
					
						<option value="Como agua para chocolate" >
						Como agua para chocolate
						</option>
					
						<option value="El cuaderno de Noah" >
						El cuaderno de Noah
						</option>
					
						<option value="Posdata: te amo">
						Posdata: te amo
						</option>
					
						<option value="Cometas en el cielo">
						Cometas en el cielo
						</option>
					
						<option value="El día que se perdió la cordura">
						El día que se perdió la cordura
						</option>
					
						<option value="Las hijas de la criada">
						Las hijas de la criada
						</option>
					
						<option value="Mil soles espléndidos">
						Mil soles espléndidos
						</option>
					
						<option value="Por trece razones">
						Por trece razones
						</option>
					
						<option value="La vida después de ella">
						La vida después de ella
						</option>

						</select>
					</div>'.


								'<div class="mb-3">
									<label for="exampleFormControlInput1" class="form-label">Fecha de apartado:</label>
									<input type="date" class="form-control" name="FECHA_RENTA" value ="'.$row['FECHA_RENTA'].'" disabled>
								</div>'.
								'<div class="mb-3">
									<label for="exampleFormControlInput1" class="form-label">Fecha de entrega:</label>
									<input type="date" class="form-control" name="FECHA_ENTREGA" value ="'.$row['FECHA_ENTREGA'].'"/>
								</div>'.
								'<div class="mb-3">
									<label for="exampleFormControlInput1" 
										class="form-label" id=monto_renta>Monto de la renta:</label>
									<input type="text" class="form-control" lang="es" href="qa-html-language-declarations.es"
										name="MONTO" value ="'.$row['MONTO'].'" readonly/>
								</div>'.
								'<div class="mb-3">
									<label for="exampleFormControlInput1" 
										class="form-label">Anticipo:</label>
									<input type="text" class="form-control" lang="es" href="qa-html-language-declarations.es"
										name="ANTICIPO" value ="'.$row['ANTICIPO'].'" readonly/>
								</div>'.
								'<div class="mb-3">
									<label for="exampleFormControlInput1" 
										class="form-label">Saldo pendiente:</label>
									<input type="text" class="form-control" lang="es" href="qa-html-language-declarations.es"
										name="SALDO_PENDIENTE" value ="'.$row['SALDO_PENDIENTE'].'" disabled/>
								</div>'.
								'<div class="mb-3">
									<label for="exampleFormControlInput1" 
										class="form-label">Pago:</label>
									<input type="text" class="form-control" lang="es" href="qa-html-language-declarations.es"
										name="PAGO" value ="'.$row['PAGO'].'"/>
								</div>'.
								'<div class="mb-3">
									<label for="exampleFormControlInput1" class="form-label">Estado de la renta:</label>
									<select class="form-select" aria-label="Default select example" name="ESTADO_RENTA" id="ESTADO_RENTA">
										<option value="'.$row['ESTADO_RENTA'].'">'.$row['ESTADO_RENTA'].'</option>
										 <option value="apartado">Apartado</option>
										 <option value="entregado">Entregado</option>
										 <option value="devuelto">Devuelto</option>
									</select>
								</div>'.
								'<div class="mb-3">
									<button type="submit" class="btn btn-primary" name="cambiar">Cambiar datos</button>
								</div>';
						}else if ($query -> rowCount() <= 0){
							echo "no existe esa clave de Noticia.";
						}		 
				}//if(isset($_REQUEST[''buscar]))
				
				if(isset($_REQUEST['cambiar'])){ 
					$clave=$_POST['ID'];
					$nombre_cliente=$_POST['NOMBRE'];
					$apellido=$_POST['APELLIDO'];
					$correo=$_POST['CORREO'];
					$telefo=$_POST['NUMERO_TELEFONO'];
					$titulo=$_POST['TITULO_LIBRO'];
					$fecha_entrega=$_POST['FECHA_ENTREGA'];
					$pago=$_POST['PAGO'];
					$estado_renta = $_POST['ESTADO_RENTA'];
					$monto_renta = $_POST['MONTO'];
					$anticipo = $_POST['ANTICIPO'];
					$saldo_pendiente=$monto_renta-($anticipo+$pago);
					$pago_total=($anticipo+$pago);
					$fecha_en = strtotime('+5 day', strtotime($fecha_entrega));
					$fecha_en = date('Y-m-d', $fecha_en);

					$sql = "UPDATE rentas SET ID=?, NUMERO_TELEFONO=?,TITULO_LIBRO=?, FECHA_ENTREGA=?, MONTO=?, SALDO_PENDIENTE=?, PAGO=?, PAGO_TOTAL=?, ESTADO_RENTA=? WHERE ID=?";
					
					$stmt= $db->connect()->prepare($sql);
				$stmt->execute([$clave, $telefo,  $titulo, $fecha_en, $monto_renta, $saldo_pendiente, $pago, $pago_total, $estado_renta, $clave]);

					/*
					$consulta= 'update noticias set clave= : clave, titulo = :titulo, texto = :texto, fecha = :fecha, categoria = :categoria, tipo = :tipo where clave = :clave';
					$consulta = $db->connect()->prepare($consulta);
					$consulta->bindParam(':clave',$clave,PDO::PARAM_STR, 25);
					$consulta->bindParam(':titulo',$titulo,PDO::PARAM_STR, 25);
					$consulta->bindParam(':tipo',$tipo,PDO::PARAM_STR,25);
					$consulta->bindParam(':texto',$texto,PDO::PARAM_STR,25);
					$consulta->bindParam(':fecha',$fecha,PDO::PARAM_STR);
					$consulta->bindParam(':categoria',$categoria,PDO::PARAM_STR);
					$consulta->execute();
					*/
					$row = $stmt->fetch();
					if($stmt->rowCount() > 0){
						echo"<br/><br/>Los datos fueron modificados con éxito";
						print ("<br/><br/><hr/><br/>");
						print ("<table class='table table-striped'>\n");
							print ("<tr>\n");
								print ("<th>ID</th>\n");
								print ("<td>" . $clave . "</td>\n");
							print ("</tr>\n");
							print ("<tr>\n");
								print ("<th>Cliente</th>\n");
								print ("<td>" . $nombre_cliente . "</td>\n");
							print ("</tr>\n");
							print ("<tr>\n");
								print ("<th>Apellido</th>\n");
								print ("<td>" . $apellido . "</td>\n");
							print ("</tr>\n");
							print ("<tr>\n");
								print ("<th>Teléfono</th>\n");
								print ("<td>" . $telefo . "</td>\n");
							print ("</tr>\n");
							print ("<tr>\n");
								print ("<th>Título</th>\n");
								print ("<td>" . $titulo . "</td>\n");
							print ("</tr>\n");
							
							print ("<tr>\n");
								print ("<th>Fecha entrega</th>\n");
								print ("<td>" . $fecha_entrega . "</td>\n");
								//$variable = utf8_decode($variable);
							print ("</tr>\n");
							print ("<tr>\n");
								print ("<th>Monto de la renta</th>\n");
								print ("<td>" . $monto_renta . "</td>\n");
								//$variable = utf8_decode($variable);
							print ("</tr>\n");
							print ("<tr>\n");
							print ("<th>Anticipo</th>\n");
							print ("<td>" . $anticipo . "</td>\n");
							//$variable = utf8_decode($variable);
						print ("</tr>\n");
						print ("<tr>\n");
							print ("<th>Pago</th>\n");
							print ("<td>" . $pago . "</td>\n");
							//$variable = utf8_decode($variable);
						print ("</tr>\n");
							print ("<tr>\n");
								print ("<th>Saldo pendiente</th>\n");
								print ("<td>" . $saldo_pendiente . "</td>\n");
								//$variable = utf8_decode($variable);
							print ("</tr>\n");
							print ("<tr>\n");
								print ("<th>Pago total</th>\n");
								print ("<td>" . $pago_total . "</td>\n");
								//$variable = utf8_decode($variable);
							print ("</tr>\n");
							print ("<tr>\n");
								print ("<th>Estado Renta</th>\n");
								print ("<td>" .$estado_renta. "</td>\n");
							print ("</tr>\n");
							print ("<tr>\n");
						print ("</table>\n");
						print ("<hr />");
					}else if ($stmt->rowCount()<=  0){
						echo "No se actualizó el registro!!!";
					}
				}//boton cambiar
				//mysqli_close($conexion);
			?>
		</form><!--El form cierra hasta aquí por que los datos del reg.
				son parte del formulario-->
				</div> <!--class="col-8"-->
					<div class="col">
					</div>
				</div><!--class="row"-->
			</div><!--class="container"-->
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js" integrity="sha384-lpyLfhYuitXl2zRZ5Bn2fqnhNAKOAaM/0Kr9laMspuaMiZfGmfwRNFh8HlMy49eQ" crossorigin="anonymous"></script>
		<script src="https://unpkg.com/scrollreveal"></script>
        <script src="./js/animaciones_form.js"></script>
	</body>
</html>