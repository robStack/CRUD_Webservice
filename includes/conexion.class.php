<?php
	class conexionMysql {
		
		private $mysqli;
		public $errorConexion;
		
		public function __construct(){
			$this->mysqli = new mysqli('localhost','root','mysql','prototype');
			if (mysqli_connect_error()){
				$this->errorConexion = true;
			}
		}

		public function __destruct(){
			$this->mysqli->close();
		}

		public function create($datos){
			if(!$this->errorConexion){
				$mysqli = $this->mysqli;
				$nombre = $mysqli -> real_escape_string(trim($datos['nombre']));
				$telefono = $mysqli -> real_escape_string(trim($datos['telefono']));
				$direccion = $mysqli -> real_escape_string(trim($datos['direccion']));
				$password = $mysqli -> real_escape_string(trim($datos['password']));
				$email = $mysqli -> real_escape_string(trim($datos['email']));
				$password = sha1(md5($password));
				$datos = $mysqli -> prepare('INSERT INTO usuarios_datos(nombre,telefono,direccion,email) VALUES(?,?,?,?)');
				$datos -> bind_param('ssss',$nombre,$telefono,$direccion,$email);
				$datos -> execute();
				$login = $mysqli -> prepare('INSERT INTO usuarios_login(email,password) VALUES(?,?)');
				$login -> bind_param('ss',$email,$password);
				$login -> execute();
				return 'Registro exitoso';
			}
			else
				return 'Error estableciendo la conexión con la base de datos';
		}

		public function read(){
			if(!$this->errorConexion){
				$tabla = $this->mysqli -> query('SELECT id_user,nombre,telefono,direccion,email FROM usuarios_datos');
				$html = '<table id="userTable" class="table table-hover">
							<thead>
								<tr>
									<th>Nombre</th>
									<th>Teléfono</th>
									<th>Dirección</th>
									<th class="colEsc">Email</th>
									<th>Editar</th>
									<th>Eliminar</th>
								</tr>
							</thead>
							<tbody>';
				while ($lista = $tabla -> fetch_assoc()) {
					$html .= '<tr>
								<td>'.$lista['nombre'].'</td>
								<td>'.$lista['telefono'].'</td>
								<td>'.$lista['direccion'].'</td>
								<td class="colEsc">'.$lista['email'].'</td>
								<td class="botones centrar"><a href="#" name="'.$lista['id_user'].'" class="btn btn-warning edit"><i class="icon-edit"></i></a></td>
								<td class="botones centrar"><a href="#" id="'.$lista['id_user'].'" class="btn btn-danger delete"><i class="icon-remove"></i></a></td>
							</tr>';
					}
					$html .= '<tr>
							<td colspan="5"><a id="add" href="#altaUsuario" class="btn btn-success"><i class="icon-plus"></i></a></td>
							<td><a id="reload" class="btn"><i class="icon-repeat"></i></a></td>
						</tr>
						</tbody>
						</table>';
				return $html;
			}
			else
				return '<p class="error">Error estableciendo la conexión con la base de datos</p>';
		}

		public function update($datos){
			if(!$this->errorConexion){
				$mysqli = $this->mysqli;
				$id = $mysqli -> real_escape_string(trim($datos['id']));
				$nombre = $mysqli -> real_escape_string(trim($datos['nombre']));
				$telefono = $mysqli -> real_escape_string(trim($datos['telefono']));
				$direccion = $mysqli -> real_escape_string(trim($datos['direccion']));
				$update = $mysqli -> prepare('UPDATE usuarios_datos SET nombre = ?,direccion= ?,telefono= ? WHERE id_user = ?');
				$update -> bind_param('sssi',$nombre,$direccion,$telefono,$id);
				$update -> execute();
				return 'Actualización exitosa';
			}
			else
				return 'Error estableciendo la conexión con la base de datos';
		}

		public function delete($idUser){
			if(!$this->errorConexion){
				$mysqli = $this->mysqli;
				$id = $mysqli -> real_escape_string(trim($idUser));				
				$delete = $mysqli -> prepare('DELETE FROM usuarios_datos WHERE id_user = ?');
				$delete -> bind_param('i',$id);
				$delete -> execute();
				$email = $mysqli -> prepare('SELECT email FROM usuarios_datos WHERE id_user = ?');
				$email -> bind_param('i',$id);
				$email -> bind_result($correo);
				$delete = $mysqli -> prepare('DELETE FROM usuarios_login WHERE email = ?');
				$delete -> bind_param('s',$correo);
				$delete -> execute();
				return 'Se elimino satisfactoriamente';
			}
			else
				return 'Error estableciendo la conexión con la base de datos';
		}

		public function read_data($id){
			if(!$this->errorConexion){
				$mysqli = $this->mysqli;
				$datos = $mysqli -> prepare('SELECT nombre,telefono,direccion FROM usuarios_datos WHERE id_user = ?');
				$datos -> bind_param('i',$id);				
				$datos -> bind_result($nombre,$telefono,$direccion);
				$datos -> execute();
				$datos -> fetch();
				return  array('nombre' => $nombre, 'telefono' => $telefono,'direccion' => $direccion);
			}
			else
				return 'Error estableciendo la conexión con la base de datos';
		}
	}
?>