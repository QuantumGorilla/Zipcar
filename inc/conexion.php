<?php 
if (isset($_POST['user']) AND isset($_POST['passw']))
{

$pass = $_POST['passw'];
$usuario = $_POST['user'];

$req = $bdd->prepare('SELECT * FROM usuarios WHERE usuario = :user AND contraseña = :passw');
$req->execute(array(
    'user' => $usuario,
    'passw' => $pass));

$resultat = $req->fetch();

if (!$resultat)
{
    $erreur = 'Contraseña o usuario incorrecto!';
}
else
{
    $_SESSION['id'] = $resultat['id'];
    $_SESSION['usuario'] = $resultat['usuario'];
}

}

include ('config.php');



if (isset($_SESSION['id']) AND isset($_SESSION['usuario']))
{
	$datosbienvenidos = $bdd->query('SELECT * FROM usuarios WHERE id='.$_SESSION['id'].' ');
	while ($dbienvenidos = $datosbienvenidos->fetch())
	{
		//Variables para mostrar mensaje de bienvenida
$nombre = $dbienvenidos['nombre'];
$apellido = $dbienvenidos['apellido'];
$admin = $dbienvenidos['admin'];
}
	//Si conecta mostramos el mensaje de bienvenida
echo '<li class="nav-item">
            <li class="nav-item"><a class="nav-link" href="#"></a></li><li class="nav-item"><a class="nav-link" href="#"></a></li><li class="nav-item"><a class="nav-link" href="#"></a></li><li class="nav-item"><a class="nav-link" href="#"></a></li><li class="nav-item"><a class="nav-link" href="#"></a></li><li class="nav-item"><a class="nav-link" href="#"></a></li><li class="nav-item"><a class="nav-link" href="#"></a></li><li class="nav-item"><a class="nav-link" href="#"></a></li><li class="nav-item"><a class="nav-link" href="#"></a></li><li class="nav-item"><a class="nav-link" href="#"></a></li><li class="nav-item"><a class="nav-link" href="#"></a></li><li class="nav-item"><a class="nav-link" href="#"></a></li><li class="nav-item"><a class="nav-link" href="#"></a></li><li class="nav-item"><a class="nav-link" href="#"></a></li><li class="nav-item"><a class="nav-link" href="#"></a></li><li class="nav-item"><a class="nav-link" href="#"></a></li>
		  <a class="nav-link">Bienvenido <strong>'.$nombre.' '.$apellido.'</strong></a> 
          </li>';
}
else
        {
			//Si no conecta mostramos el formulario 
			?>

		<form method="post" action="index.php" class="form-inline">

		
		<input class="form-control mr-sm-2" id="user" placeholder="Username" name="user" type="text" required>
		<input class="form-control mr-sm-2" id="passw" placeholder="Password" name="passw" type="password" required>
    <button class="btn btn-outline-success my-2 my-sm-0 font-weight-bold" type="submit" value="Login" name="submit">Login</button>
  
			</form> <?php
					   } ?>
	
</div>