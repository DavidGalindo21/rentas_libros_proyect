<!DOCTYPE html>
<html lang="es">
	<head>
		<title>Consulta de Noticias.</title>
		<meta charset="utf-8">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" href="../css/estilos_form.css">
		<style>
			td{
				text-align: center;
			}
			th{
				text-align:center;
			}
		</style>
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
			$clave="";
		?>	
		<!--<div class="container">
			<div class="row">
			<div class="col-4">
				<div class="list-group">
					<a href="menu.php" class="list-group-item list-group-item-action active" aria-current="true">
					Administración de Noticias
					</a>
					<a href="AltaRentas.php" class="list-group-item list-group-item-action">Agregar Renta</a>
					<a href="#" class="list-group-item list-group-item-action">Consultar Renta</a>
					<a href="cambiosRentas.php" class="list-group-item list-group-item-action">Modificar Renta</a>
					<a href="bajaRenta.php" class="list-group-item list-group-item-action">Eliminar Renta</a>
				</div>
    		</div>-->
			
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
			
			<div class="container">
						
			<form method="post" class="w-50 mx-auto formulario"
						action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
						
						<div class="form-group">
							<label for="exampleFormControlInput1" class="form-label">Clave de renta</label>
							<input type="text" class="form-control" id="clave" name ="clave" value="<?php echo $clave;?>"/>
						</div>
						<div class="form-group d-flex mt-3">
							<input type="submit" class="btn btn-info" name="buscar" value="Consultar renta">
							<input type="submit" class="btn btn-danger" name="todo" value="Mostrar todas las rentas">
						</div>
					</form>
					<?php
					$db = new Database();
			if (isset($_REQUEST['buscar'])){
				//echo "Si entro a buscar una clave!!!";
				$clave=isset($_REQUEST['clave']) ? $_REQUEST['clave'] :  null;

				$query = $db->connect()->prepare('select * FROM rentas where ID = :clave');
								$query->setFetchMode(PDO::FETCH_ASSOC);
								$query->execute(['clave' => $clave]);
								$row = $query->fetch();
								if($query -> rowCount() <= 0){
									echo "<br /><br /><h2>No existe ese número de clave.</h2>";
								}elseif ($query -> rowCount() > 0){
									$total = $row['ANTICIPO'] + $row['PAGO'];
						$saldoPendiente = $row['MONTO'] - $row['PAGO_TOTAL'];
									print ("<br/><br/><br/>");
									print ("Datos del registro.");
									print ("<br/><br/><hr/><br/>");
									print ("<table class='table table-striped table-responsive{-lg} '>\n");
										print ("<tr>\n");
											print ("<th>Id</th>\n");
											print ("<td>".$row['ID']. "</td>\n");
										print ("</tr>\n");
										print ("<tr>\n");
											print ("<th>Nombre</th>\n");
											print ("<td>" . $row['NOMBRE'] . "</td>\n");
										print ("</tr>\n");
                                        print ("<tr>\n");
                                        print ("<th>Apellido</th>\n");
                                        print ("<td>" . $row['APELLIDO'] . "</td>\n");
                                    print ("</tr>\n");
										print ("<tr>\n");
											print ("<th>Libro</th>\n");
											print ("<td>" . $row['TITULO_LIBRO'] . "</td>\n");
										print ("</tr>\n");
										print ("<tr>\n");
										print ("<th>Correo</th>\n");
										print ("<td>" . $row['CORREO'] . "</td>\n");
									print ("</tr>\n");
                                        print ("<tr>\n");
                                        print ("<th>Teléfono</th>\n");
                                        print ("<td>" . $row['NUMERO_TELEFONO'] . "</td>\n");
                                        print ("</tr>\n");
										print ("<tr>\n");
											print ("<th>Monto</th>\n");
											print ("<td>" . $row['MONTO'] . "</td>\n");
										//$variable = utf8_decode($variable);
										print ("</tr>\n");

										print ("<tr>\n");
											print ("<th>Anticipo</th>\n");
											print ("<td>" . $row['ANTICIPO'] . "</td>\n");
										//$variable = utf8_decode($variable);
										print ("</tr>\n");

										print ("<tr>\n");
											print ("<th>Pago</th>\n");
											print ("<td>" . $row['PAGO'] . "</td>\n");
										//$variable = utf8_decode($variable);
										print ("</tr>\n");
										print ("<tr>\n");
											print ("<th>Pago Total</th>\n");
											print ("<td>" . $total . "</td>\n");
										//$variable = utf8_decode($variable);
										print ("</tr>\n");
										print ("<tr>\n");
											print ("<th>Saldo Pendiente</th>\n");
											print ("<td>" .$saldoPendiente. "</td>\n");
										print ("</tr>\n");
										print ("<tr>\n");
											print ("<th>Estado</th>\n");
											print ("<td>" . $row['ESTADO_RENTA'] . "</td>\n");
										print ("</tr>\n");
                                        print ("<tr>\n");
											print ("<th>Fecha de Renta</th>\n");
											print ("<td>" . $row['FECHA_RENTA'] . "</td>\n");
										print ("</tr>\n");
                                        print ("<tr>\n");
											print ("<th>Fecha de Devolución</th>\n");
											print ("<td>" . $row['FECHA_ENTREGA'] . "</td>\n");
										print ("</tr>\n");
									print ("</table>\n");
									print ("<br /><hr />");
				} 
			}
			if (isset($_REQUEST['todo'])){

				$query = $db->connect()->prepare('select * FROM rentas order by ID desc');
				$query->setFetchMode(PDO::FETCH_ASSOC);
				$query->execute();
				//$row = $query->fetch();
				if($query -> rowCount() > 0){
					print ("<br/><br/><br/>");
					print ("Listado de rentas registradas.");
					print ("<br/><br/><hr/><br/>");
					print ("<table class='table table-striped table-responsive{-md} '>\n");
					print ("<tr>\n");
					print ("<thead>\n");
						print ("<th>Id</th>\n");
                        print ("<th>Nombre</th>\n");
                        print ("<th>Apellido</th>\n");
						print ("<th>Título del libro</th>\n");
						print ("<th>Correo</th>\n");
						print ("<th>Teléfono</th>\n");
						print ("<th>Monto</th>\n");
						print ("<th>Anticipo</th>\n");
						print ("<th>Pago</th>\n");
                        print ("<th>Pago total</th>\n");
                        print ("<th>Saldo pendiente</th>\n");
						print ("<th>Estado</th>\n");
						print ("<th>Fecha Renta</th>\n");
						print ("<th>Fecha Entrega</th>\n");

						print ("</th>\n");
					print ("</thead>\n");
					while ($row = $query->fetch()){
						$total = $row['ANTICIPO'] + $row['PAGO'];
						$saldoPendiente = $row['MONTO'] - $row['PAGO_TOTAL'];
						print ("<tr>\n");
						print ("<td>" . $row['ID'] . "</td>\n");
						print ("<td>" . $row['NOMBRE'] . "</td>\n");
						print ("<td>" . $row['APELLIDO'] . "</td>\n");
						print ("<td>" . $row['TITULO_LIBRO'] . "</td>\n");
						print ("<td>" . $row['CORREO'] . "</td>\n");
						print ("<td>" . $row['NUMERO_TELEFONO'] . "</td>\n");
						print ("<td>" . $row['MONTO'] . "</td>\n");
                        print ("<td>" . $row['ANTICIPO'] . "</td>\n");
                        print ("<td>" . $row['PAGO'] . "</td>\n");
                        print ("<td>" . $total . "</td>\n");
                        print ("<td>" . $saldoPendiente . "</td>\n");
                        print ("<td>" . $row['ESTADO_RENTA'] . "</td>\n");
						print ("<td>" . $row['FECHA_RENTA'] . "</td>\n");
						print ("<td>" . $row['FECHA_ENTREGA'] . "</td>\n");
						print ("</tr>\n");
					}
					print ("</table>\n");
					print("<a href='detalle.php' class=' mt-2 btn btn-warning'> Ver detalle con cabeceras de PHP</a>");
					print ("<form method='POST' action='Reporte_fpdf/reportes.php'>"); 
					print ("<button type='submit' class=' mt-2 mb-2 btn btn-primary'>Genera reporte</button>");
					print ("</form>"); 
				}
				else
					print ("No hay registros disponibles");
			}
			//mysqli_close($conexion);
		?>
				
			</div>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js" integrity="sha384-lpyLfhYuitXl2zRZ5Bn2fqnhNAKOAaM/0Kr9laMspuaMiZfGmfwRNFh8HlMy49eQ" crossorigin="anonymous"></script>
		<script src="https://unpkg.com/scrollreveal"></script>
        <script src="./js/animaciones_form.js"></script>
	</body>
</html>
