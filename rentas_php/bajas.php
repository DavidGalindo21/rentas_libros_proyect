<html>
	<head>
		<title>Eliminar Renta</title>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" href="../css/estilos_form.css">
	</head>
	<body>
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
		<?php
			//include('index.php');
			$clave = isset($_REQUEST['ID']) ? $_REQUEST['ID'] : null ;
		?>	
	<!--	<div class="container">
			<div class="row">
			<div class="col-4">
      <div class="list-group">
					<a href="#" class="list-group-item" aria-current="true">
						Administración de Rentas
					</a>
					<a href="AltaRentas.php" class="list-group-item list-group-item-action">Agregar Renta</a>
					<a href="consultaRentas.php" class="list-group-item list-group-item-action">Consultar Rentas</a>
					<a href="cambiosRentas.php" class="list-group-item list-group-item-action">Modificar Rentas</a>
					<a href="bajaRenta.php" class="list-group-item list-group-item-action">Eliminar Renta</a>
					</div>
    		</div>-->
				<div class="col-8 mx-auto">
					<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
						<div class="mb-3">
							<label for="exampleFormControlInput1" class="form-label">Folio de renta a eliminar:</label>
							<input type="text" class="form-control" id="ID"  value="<?php echo $clave;?>" name ="ID">
						</div>
						<div class="mb-3">
							<input type="submit" class="btn btn-primary" name ="buscar" id="buscar" value="Buscar clave!!!"/>
						</div>
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
							if (isset($_REQUEST['buscar'])){
								$clave=isset($_REQUEST['ID']) ? $_REQUEST['ID'] :  null;
								$query = $db->connect()->prepare('select * FROM rentas where ID = :ID');
								$query->setFetchMode(PDO::FETCH_ASSOC);
								$query->execute(['ID' => $clave]);
								$row = $query->fetch();
								if($query -> rowCount() <= 0){
									echo "<h2>No existe ese número de folio.</h2>";
								}elseif ($query -> rowCount() > 0){
									print ("<hr/>");
									print ("Datos del registro.");
									print ("<hr/>");
									print ("<table class='table table-striped'>\n");
										print ("<tr>\n");
											print ("<th>Folio</th>\n");
											print ("<td>".$row['ID']. "</td>\n");
										print ("</tr>\n");
										print ("<tr>\n");
										print ("<th>Nombre</th>\n");
										print ("<td>".$row['NOMBRE']. "</td>\n");
									print ("</tr>\n");
									print ("<tr>\n");
									print ("<th>Apellido</th>\n");
									print ("<td>".$row['APELLIDO']. "</td>\n");
								print ("</tr>\n");
								print ("<tr>\n");
								print ("<th>Título</th>\n");
								print ("<td>".$row['TITULO_LIBRO']. "</td>\n");
							print ("</tr>\n");
							print ("<tr>\n");
							print ("<th>Correo</th>\n");
							print ("<td>".$row['CORREO']. "</td>\n");
						print ("</tr>\n");
						print ("<tr>\n");
						print ("<th>Teléfono</th>\n");
						print ("<td>".$row['NUMERO_TELEFONO']. "</td>\n");
					print ("</tr>\n");
										print ("<tr>\n");
											print ("<th>Fecha</th>\n");
											print ("<td>" . $row['FECHA_RENTA'] . "</td>\n");
										print ("</tr>\n");
										print ("<tr>\n");
											print ("<th>Fecha Entrega</th>\n");
											print ("<td>".$row['FECHA_ENTREGA']. "</td>\n");
										print ("</tr>\n");
										print ("<tr>\n");
											print ("<th>Monto</th>\n");
											print ("<td>" . $row['MONTO'] . "</td>\n");
										//$variable = utf8_decode($variable);
										print ("</tr>\n");
										print ("<tr>\n");
											print ("<th>Anticipo</th>\n");
											print ("<td>" .$row['ANTICIPO']. "</td>\n");
										print ("</tr>\n");
										print ("<tr>\n");
											print ("<th>Pago</th>\n");
											print ("<td>" . $row['PAGO'] . "</td>\n");
										print ("</tr>\n");
										print ("<tr>\n");
										print ("<th>Pago total</th>\n");
										print ("<td>".$row['PAGO_TOTAL']. "</td>\n");
									print ("</tr>\n");
                                        print ("<tr>\n");
											print ("<th>Saldo</th>\n");
											print ("<td>" . $row['SALDO_PENDIENTE'] . "</td>\n");
										print ("</tr>\n");
										print ("<tr>\n");
										print ("<th>Estado</th>\n");
										print ("<td>".$row['ESTADO_RENTA']. "</td>\n");
									print ("</tr>\n");
									print ("</table>");
									print ("<hr />");
									print ("<input type='submit' class='btn btn-danger' name='borrar' value='Eliminar registro'/></form>\n");
								}
							}
							if (isset($_REQUEST['borrar'])){
								$clave=isset($_REQUEST['ID']) ? $_REQUEST['ID'] :  null;
								
								$query = $db->connect()->prepare('delete FROM rentas where ID = :ID');
								$query->execute(['ID' => $clave]);
								if (!$query){
									echo "Error".$query->errorInfo();
								}
								echo "<br /><hr />Registro de renta eliminado.";
								// Cerrar conexión 
							$query->closeCursor(); // opcional en MySQL, dependiendo del controlador de base de datos puede ser obligatorio
							$query = null; // obligado para cerrar la conexión
							$db = null;
							}
						?>
					</div>
				<div class="col">
				</div>
			</div>
		</div>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js" integrity="sha384-lpyLfhYuitXl2zRZ5Bn2fqnhNAKOAaM/0Kr9laMspuaMiZfGmfwRNFh8HlMy49eQ" crossorigin="anonymous"></script>
		<script src="https://unpkg.com/scrollreveal"></script>
        <script src="./js/animaciones_form.js"></script>
	</body>
</html>