<?php
  //con cabeceras de php
  header("Content-Type: application/xlsx");
  header("Content-Disposition: attachment; filename = Excel.xlsx");
?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<title>Consulta de Noticias.</title>
		<meta charset="utf-8">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
		<link rel="stylesheet" href="../css/boton.css" media="print">
	</head>
	<body>
		<?php
			//include('index.php');
			include('Conexion.php');
		?>	
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
					print ("<table class='table table-striped'>\n");
					print ("<tr>\n");
					print ("<thead>\n");
						print ("<th>Id</th>\n");
                        print ("<th>Nombre</th>\n");
                        print ("<th>Apellido</th>\n");
						print ("<th>Título del libro</th>\n");
						print ("<th>Teléfono</th>\n");
						print ("<th>Monto</th>\n");
						print ("<th>Anticipo</th>\n");
                        print ("<th>Pago total</th>\n");
                        print ("<th>Saldo pendiente</th>\n");
						print ("<th>Estado</th>\n");
						print ("<th>Entrega</th>\n");
						print ("<th>Devolución</th>\n");

						print ("</th>\n");
					print ("</thead>\n");
					while ($row = $query->fetch()){
						print ("<tr>\n");
						print ("<td>" . $row['ID'] . "</td>\n");
						print ("<td>" . $row['NOMBRE'] . "</td>\n");
						print ("<td>" . $row['APELLIDO'] . "</td>\n");
						print ("<td>" . $row['TITULO_LIBRO'] . "</td>\n");
						print ("<td>" . $row['NUMERO_TELEFONO'] . "</td>\n");
						print ("<td>" . $row['MONTO'] . "</td>\n");
                        print ("<td>" . $row['ANTICIPO'] . "</td>\n");
                        print ("<td>" . $row['PAGO_TOTAL'] . "</td>\n");
                        print ("<td>" . $row['SALDO_PENDIENTE'] . "</td>\n");
                        print ("<td>" . $row['ESTADO_RENTA'] . "</td>\n");
						print ("<td>" . $row['FECHA_ENTREGA'] . "</td>\n");
						print ("<td>" . $row['FECHA_DEVOLUCION'] . "</td>\n");
						print ("</tr>\n");
					}
					print ("</table>\n");
				}
				else
					print ("No hay registros disponibles");
			//mysqli_close($conexion);
		?>
				</div><!--class="col-8"-->
			</div><!--class="row"-->
		</div><!--class="container"-->
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js" integrity="sha384-lpyLfhYuitXl2zRZ5Bn2fqnhNAKOAaM/0Kr9laMspuaMiZfGmfwRNFh8HlMy49eQ" crossorigin="anonymous"></script>
	</body>
</html>