<!DOCTYPE html>
<html lang="es">
	<head>
		<title>Consulta de Noticias.</title>
		<meta charset="utf-8">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
		<link rel="stylesheet" href="../css/boton.css" media="print">
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
		<div class="container">
			<div class="row">
    		</div>
				<div class="col-8">
					<?php
					$db = new Database();
				$query = $db->connect()->prepare('select * FROM rentas order by ID desc');
				$query->setFetchMode(PDO::FETCH_ASSOC);
				$query->execute();
				//$row = $query->fetch();
				if($query -> rowCount() > 0){
                    print ("<br/><br/><br/>");
					print ("Listado de rentas registradas.");
					print ("<br/><br/><hr/><br/>");
					print ("<table class='table table-striped table-responsive '>\n");
					print ("<tr>\n");
					print ("<thead>\n");
						print ("<th>Id</th>\n");
                        print ("<th>Nombre</th>\n");
                        print ("<th>Apellido</th>\n");
						print ("<th>Correo</th>\n");
						print ("<th>Título</th>\n");
						print ("<th>Teléfono</th>\n");
						print ("<th>Monto</th>\n");
						print ("<th>Anticipo</th>\n");
						print ("<th>Pago</th>\n");
                        print ("<th>Pago total</th>\n");
                        print ("<th>Saldo pendiente</th>\n");
						print ("<th>Estado</th>\n");
						print ("<th>Renta</th>\n");
						print ("<th>Devolución</th>\n");

						print ("</th>\n");
					print ("</thead>\n");
					while ($row = $query->fetch()){
						$total = $row['ANTICIPO'] + $row['PAGO'];
						$saldoPendiente = $row['MONTO'] - $row['PAGO_TOTAL'];
						print ("<tr>\n");
						print ("<td>" . $row['ID'] . "</td>\n");
						print ("<td>" . $row['NOMBRE'] . "</td>\n");
						print ("<td>" . $row['APELLIDO'] . "</td>\n");
						print ("<td>" . $row['CORREO'] . "</td>\n");
						print ("<td>" . $row['TITULO_LIBRO'] . "</td>\n");
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
				}
				else
					print ("No hay registros disponibles");
			//mysqli_close($conexion);
		?>
			<!--// en la clase btn btn-primary boton, btn-primary es estilo de bootstrap y boton
				es una clase de estilo que está en un archivo llamado boton.css-->
      <div class="container">
        <a href="./consultar.php" class="btn btn-info boton">Regresar</a>
        <a href="" class="btn btn-primary boton" onclick="window.print()">Imprimir</a>
				<a href="generarExcel.php" class="btn btn-secondary boton" onclick="">Generar Excel</a>
      </div>
				</div><!--class="col-8"-->
			</div><!--class="row"-->
		</div><!--class="container"-->
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js" integrity="sha384-lpyLfhYuitXl2zRZ5Bn2fqnhNAKOAaM/0Kr9laMspuaMiZfGmfwRNFh8HlMy49eQ" crossorigin="anonymous"></script>
	</body>
</html>