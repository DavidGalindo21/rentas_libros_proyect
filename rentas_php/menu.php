<!DOCTYPE html> 
<html lang="es">
	<head>
		<title>Administración de Noticias</title>
 
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
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
		?>

        <nav class="navbar w-100">
            <div class="row w-100 text-center m-auto">
                <div class="col-md-2 col-lg-2 link1 col-sm-6 col-6">
                    <a href="./menu.php" class="nav-link fw-bold">Administración de Noticias</a>
                    <img src="../img/svg/administracion.svg" class="svg1" alt="Logo enlace">
                </div>
                <div class="col-md-2 col-lg-2 link2 col-sm-6 col-6">
                    <a href="./agregarNoticia.php" class="nav-link fw-bold">Agregar Noticia</a>
                    <img src="../img/svg/agregar.svg" class="svg2" alt="Logo enlace">
                </div>
                <div class="col-md-2 col-lg-2 link3 col-sm-6 col-6">
                    <a href="./consultar.php" class="nav-link fw-bold">Consultar Noticia</a>
                    <img src="../img/svg/consultar.svg" class="svg3" alt="Logo enlace">
                </div>
                <div class="col-md-2 col-lg-2 link4 col-sm-6 col-6">
                    <a href="./cambios.php" class="nav-link fw-bold">Modificar Noticia</a>
                    <img src="../img/svg/modificar.svg" class="svg4" alt="Logo enlace">
                </div>
                <div class="col-md-2 col-lg-2 link5 col-sm-6 col-6">
                    <a href="./bajas.php" class="nav-link fw-bold">Eliminar Noticia</a>
                    <img src="../img/svg/eliminar.svg" class="svg5" alt="Logo enlace">
                </div>
                <div class="col-md-2 col-lg-2 link6 col-sm-6 col-6">
                    <a href="./cerrar.php" class="nav-link fw-bold">Cerrar Sesión</a>
                    <img src="../img/svg/cerrar.svg" class="svg6" alt="Logo enlace">
                </div>
            </div>
        </nav>
	<div class="px-5">
		
	<label class="form-label">LISTADO DE RENTAS REGISTRADAS</label>
		<?php
			$db = new Database();
			$query = $db->connect()->prepare('SELECT * FROM rentas order by ID desc');
				$query->setFetchMode(PDO::FETCH_ASSOC);
				$query->execute();
				//$row = $query->fetch();
				if($query -> rowCount() > 0){
					print ("<hr/>");
					print ("<table class='table tabla-registros table-striped  table-responsive'>\n");
					print ("<tr>\n");
					print ("<thead>\n");
						print ("<th>Id</th>\n");
						print ("<th>Nombre</th>\n");
						print ("<th>Apellido</th>\n");
						print ("<th>Titulo del libro</th>\n");
						print ("<th>Correo</th>\n");
						print ("<th>Numero Telefónico</th>\n");
						print ("<th>Fecha de renta</th>\n");
						print ("<th>Fecha de entrega</th>\n");
						print ("<th>Monto</th>\n");
						print ("<th>Anticipo</th>\n");
						print ("<th>Pago</th>\n");
						print ("<th>Saldo Pendiente</th>\n");
						print ("<th>Pago Total</th>\n");
						print ("<th>Estado Renta</th>\n");
						print ("</th>\n");
					print ("</thead>\n");
					while ($row = $query->fetch()){
						print("<tbody>");
						print ("<tr>\n");
						print ("<td>" . $row['ID'] . "</td>\n");
						print ("<td>" . $row['NOMBRE'] . "</td>\n");
						print ("<td>" . $row['APELLIDO'] . "</td>\n");
						print ("<td>" . $row['TITULO_LIBRO'] . "</td>\n");
						print ("<td>" . $row['CORREO'] . "</td>\n");
						print ("<td>" . $row['NUMERO_TELEFONO'] . "</td>\n");
						print ("<td>" . $row['FECHA_RENTA'] . "</td>\n");
						print ("<td>" . $row['FECHA_ENTREGA'] . "</td>\n");
						print ("<td>" . $row['MONTO'] . "</td>\n");
						print ("<td>" . $row['ANTICIPO'] . "</td>\n");
						print ("<td>" . $row['PAGO'] . "</td>\n");
						print ("<td>" . $row['SALDO_PENDIENTE'] . "</td>\n");
						print ("<td>" . $row['PAGO_TOTAL'] . "</td>\n");
						print ("<td>" . $row['ESTADO_RENTA'] . "</td>\n");
						print ("</tr>\n");
						print("</tbody>");
					}
					print ("</table>\n");
				}
				else
					print ("No hay registros disponibles");
		?>
	
	</div>
   
	<script src="https://unpkg.com/scrollreveal"></script>
        <script src="./js/animaciones_form.js"></script>
	</body>
</html>
