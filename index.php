<?php session_start(); include('./inc/config.php');

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

//Registrar usuario
if(isset($_POST["registrar"]))
    {
//Variables del formulario
$usuario = trim($_POST['usuario']);
$nombre = trim($_POST['nombre']);
$apellido = trim($_POST['apellido']);
$identificacion = trim($_POST['identificacion']);
$pass = trim($_POST['pass']);
$email = trim($_POST['email']);

//Comprobamos que el usuario no exista
$siusuarioexiste = "SELECT * FROM usuarios WHERE usuario = '$usuario' ";
$siidentificacionexiste = "SELECT * FROM usuarios WHERE identificacion = '$identificacion' ";

$existe1 = $bdd->query($siusuarioexiste);
$contar1 = $existe1->rowCount();

$existe = $bdd->query($siidentificacionexiste);
$contar = $existe->rowCount();

if ($contar == 1) {
//Usuario si existe
 $message = '<font color=red>Este usuario ya esta registrado</font>';
            }else{
				//Si no existe
if ($contar1 == 1) {
//Identificacion si existe
 $message = '<font color=red>Esta identificacion ya existe</font>';
            }else{
				//Si no existe
   $crearusuario = $bdd->query("INSERT INTO `usuarios` (`usuario`, `nombre`, `apellido`, `identificacion`, `contraseña`, `email`)
           VALUES ('$usuario', '$nombre', '$apellido', '$identificacion', '$pass', '$email')");
                            $message = '<font color=green>Usuario creado exitosamente</font>';
                        }
                    }
					}
					
//Agregar auto (Administracion)
if(isset($_POST["agregarauto"]))
    {
//Variables del formulario
$marca = trim($_POST['marca']);
$modelo = trim($_POST['modelo']);
$combustible = trim($_POST['combustible']);

$agregarauto = $bdd->query("INSERT INTO `autos` (`marca`, `modelo`, `combustible`)
           VALUES ('$marca', '$modelo', '$combustible')");
                            $message = '<font color=green>Auto creado exitosamente</font>';
                        }				

//Agregar reserva
if(isset($_POST["reserva"]))
    {
if (empty($resultado)) {
    $mensajereserva = "¡No se encontraron autos";
}

    $hacerreserva = $bdd->query("INSERT INTO reservas (idusuario, idauto, fechareserva)
                VALUES ('$_SESSION[id]', '$_POST[lista]', '$_POST[fechareserva]')");
    $mensajereserva = '<font color="green">¡Reserva tomada!</font>';
}		

//Agregar orden
if(isset($_POST["ordenar"]))
    {
if (empty($resultado)) {
    $mensajeorden = "¡No se encontraron autos";
}

    $hacerreserva = $bdd->query("INSERT INTO ordenes (idusuario, idauto, desde, hasta)
                VALUES ('$_SESSION[id]', '$_POST[listaordenar]', '$_POST[desde]', '$_POST[hasta]')");
    $mensajeorden = '<font color="green">¡Orden agregado!</font>';
}				
						
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"/>
    <link rel="stylesheet" href="./css/styles.css" />
    <link rel="shortcut icon" href="./favicon.ico" type="image/x-icon" />
	
	 <!-- Ajax registro -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
	<script>
		$(document).ready(function(){
			$("#enviar").on("click",function(event){
    event.preventDefault();

				var usuario = $("#usuario").val();
				var nombre = $("#nombre").val();
				var apellido = $("#apellido").val();
				var identificacion = $("#identificacion").val();
				var pass = $("#pass").val();
				var email = $("#email").val();

				$.post("./inc/registrar.php", {usuario:usuario, nombre:nombre, apellido:apellido, identificacion:identificacion, pass:pass, email:email}, function(datos){
					$("#resultado").html(datos);
				});

			});
		});


	</script>
    <title>Car Rental with ZipCar</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand d-flex align-items-end" href="#"
        ><img
          width="50"
          src="./images/Resized-logo.png"
          alt="Logo"
          class="mr-3"
        />
        <h3 class="d-inline">ZipCar</h3></a
      >
      <button
        class="navbar-toggler"
        type="button"
        data-toggle="collapse"
        data-target="#navbarColor01"
        aria-controls="navbarColor01"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>
	  
<!-- ZONA DE MENU -->
      <div class="collapse navbar-collapse" id="navbarColor01">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="#"
              >How it works <span class="sr-only">(current)</span></a
            >
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Pricing</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Help</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Contact</a>
          </li>
		  <?php	//Si el usuario esta conectado	
		  if (isset($_SESSION['id']) AND isset($_SESSION['usuario'])) {
	echo' <li class="nav-item">
            <a class="nav-link" href="#reserva">Reserve</a>
          </li>
		  <li class="nav-item">
            <a class="nav-link" href="#reserva">Order</a>
          </li>
		  <li class="nav-item">
            <a class="nav-link" href="/inc/desconexion.php">Exit</a>
          </li>
		  '; } else  {
		  //Si no esta conectado mostramos el registro?>
		  <li class="nav-item">
            <a class="nav-link" href="#registro">Register</a>
          </li>
		  <li class="nav-item"><a class="nav-link" href="#"></a></li><li class="nav-item"><a class="nav-link" href="#"></a></li><li class="nav-item"><a class="nav-link" href="#"></a></li><li class="nav-item"><a class="nav-link" href="#"></a></li><li class="nav-item"><a class="nav-link" href="#"></a></li><li class="nav-item"><a class="nav-link" href="#"></a></li><li class="nav-item"><a class="nav-link" href="#"></a></li><li class="nav-item"><a class="nav-link" href="#"></a></li><li class="nav-item"><a class="nav-link" href="#"></a></li>
		  <?php }?>
		  <li class="nav-item"><a class="nav-link" href="#"></a></li><li class="nav-item"><a class="nav-link" href="#"></a></li><li class="nav-item"><a class="nav-link" href="#"></a></li><li class="nav-item"><a class="nav-link" href="#"></a></li><li class="nav-item"><a class="nav-link" href="#"></a></li>
		  <?php //Mostramos la zona de conexion
		  include ('inc/conexion.php'); ?>
        </ul>
      </div>
    </nav>
<!-- FIN ZONA DE MENU -->

    <div
      id="carouselExampleSlidesOnly"
      class="carousel slide vh-100"
      data-ride="carousel"
      data-pause="false"
    >
      <div class="hero-text w-100">
        <h1 style="font-size: 3.5em;" class="text-white text-center">
          Rent cars anyday at any hour
        </h1>
        <h4
          style="font-size: 2em;"
          class="text-white text-center mt-4 font-weight-normal"
        >
          Access to any car near you, ready to book at any hour or day
        </h4>
      </div>

      <div class="carousel-inner h-100">
        <div class="carousel-item h-100 active"></div>
        <div class="carousel-item h-100"></div>
        <div class="carousel-item h-100"></div>
      </div>
    </div>
<?php if (isset($_SESSION['id']) AND isset($_SESSION['usuario'])) { 

$reservas = $bdd->query('SELECT * FROM reservas WHERE idusuario = '.$_SESSION['id'].' ');
	while ($datosreservas = $reservas->fetch())
	{
		//Variables para mostrar mensaje de bienvenida
$fecha = $datosreservas['fechareserva'];
$idauto = $datosreservas['idauto'];
}

$datosautos = 'SELECT * FROM autos WHERE id = '.$idauto.' '; 
$datosautosok = $bdd -> prepare($datosautos); 
$datosautosok -> execute(); 
$autosresultado = $datosautosok -> fetchAll(PDO::FETCH_OBJ);

$datosordenes = 'SELECT * FROM ordenes WHERE id = '.$_SESSION['id'].' '; 
$datosordenesok = $bdd -> prepare($datosordenes); 
$datosordenesok -> execute(); 
$ordenesresultado = $datosordenesok -> fetchAll(PDO::FETCH_OBJ);

$busqueda=$bdd->prepare('SELECT * FROM autos');
     $busqueda->execute();
     $resultado = $busqueda->fetchAll();

	// Ocultamos la reserva y orden si el usuario no esta conectado
	?>
<!-- ZONA DE RESERVA Y ORDEN -->
    <section id="reserva" class="about">
                <div class="container">
				<h3 class="pt-5 mb-5 text-center">Reserve and order</h3>
      <div class="text-center row no-gutters w-100 ml-auto mr-auto justify-content-center" >
        <div class="col-md-6 pl-4 pr-4 mb-5">
          <article class="soft w-100 p-4 h-100 rounded d-flex flex-column align-items-center" >
            <img src="./images/icons/Drive.png" alt="drive" class="mt-3" style="width: 35%;" />
            <h4 class="mt-4 mb-2">Reserve</h4>
            <p class="mt-3">
              <br /><?php if(isset($mensajereserva)) { echo $mensajereserva; } ?>
            <form method="post">
            <select name=lista>
             <?php foreach ($resultado as $res) {
                 echo '<option value='.$res['id'].'>'.$res['marca'].' - '.$res['modelo'].' - '.$res['combustible'].'</option><br />';}?>
                 </select><br /><br />
			<input id="fechareserva" placeholder="00/00/0000" name="fechareserva" type="text" tabindex="1" required><br /><br />
			<button name="reserva" type="submit" id="reserva">Reserve</button>
			</form><br />
			<h4 class="mt-4 mb-2">Mis reservas</h4><br />
			<?php if($datosautosok -> rowCount() > 0)   { 
foreach($autosresultado as $autosresultadook) { echo'
			Auto: '.$autosresultadook -> marca.' '.$autosresultadook -> modelo.' - '.$autosresultadook -> combustible.'<br />
            Fecha: '.$fecha.' '; }
 }
?> 
            </p>
          </article>
        </div>
        <div class="col-md-6 pl-4 pr-4 mb-5">
          <article class="soft w-100 p-4 h-100 rounded d-flex flex-column align-items-center" >
            <img src="./images/icons/Return.png" alt="drive" class="mt-3" style="width: 35%;" />
            <h4 class="mt-4 mb-2">Order</h4>
            <p class="mt-3">
              <br /><?php if(isset($mensajeorden)) { echo $mensajeorden; } ?>
            <form method="post">
            <select name=listaordenar>
             <?php foreach ($resultado as $res) {
                 echo '<option value='.$res['id'].'>'.$res['marca'].' - '.$res['modelo'].' - '.$res['combustible'].'</option><br />';}?>
                 </select><br /><br />
			<input id="desde" placeholder="00/00/0000" name="desde" type="text" tabindex="1" required><br /><br />
			<input id="hasta" placeholder="00/00/0000" name="hasta" type="text" tabindex="1" required><br /><br />
			<button name="ordenar" type="submit" id="registrar">Order</button>
			</form><br />
			<h4 class="mt-4 mb-2">Mis ordenes</h4><br />
			<?php if($datosordenesok -> rowCount() > 0)   { 
foreach($ordenesresultado as $ordenesresultadook) { 

$datosautosorden = 'SELECT * FROM autos WHERE id = '.$ordenesresultadook -> idauto.' '; 
$datosautosordenok = $bdd -> prepare($datosautosorden); 
$datosautosordenok -> execute(); 
$datosautosresultado = $datosautosordenok -> fetchAll(PDO::FETCH_OBJ);

foreach($datosautosresultado as $datosautosresultadook) {
	echo '
			Auto: '.$datosautosresultadook -> marca.' '.$datosautosresultadook -> modelo.' - '.$datosautosresultadook -> combustible.'<br />
            Desde: '.$ordenesresultadook -> desde.'<br />
			Hasta: '.$ordenesresultadook -> hasta.' '; }
 }}
?> 
            </p>
          </article>
        </div>
      </div>
				
				</div>
				</section>
<!-- FIN ZONA DE RESERVA Y ORDEN -->
<?php }else{ } ?>
    <section class="container-fluid mt-5">
      <h3 class="pt-5 mb-5 text-center">How ZipCar works?</h3>
      <div
        class="text-center row no-gutters ml-auto mr-auto justify-content-center"
        style="width: 90%;"
      >
        <div class="col-md-6 col-lg-4 pl-4 pr-4 mb-5">
          <article
            class="soft w-100 p-4 h-100 rounded d-flex flex-column align-items-center"
          >
            <img
              src="./images/icons/Join.png"
              alt=""
              class="mt-3"
              style="width: 35%;"
            />
            <h4 class="mt-4 mb-2">Join</h4>
            <p class="mt-3">
              Registrate at our page when our evaluators approve you we'll send
              a zipcard in the email.
            </p>
          </article>
        </div>
        <div class="col-md-6 col-lg-4 pl-4 pr-4 mb-5">
          <article
            class="soft w-100 p-4 h-100 rounded d-flex flex-column align-items-center"
          >
            <img
              src="./images/icons/Drive.png"
              alt="drive"
              class="mt-3"
              style="width: 35%;"
            />
            <h4 class="mt-4 mb-2">Drive</h4>
            <p class="mt-3">
              Book a round trip car by the hour or day.
            </p>
          </article>
        </div>
        <div class="col-md-6 col-lg-4 pl-4 pr-4 mb-5">
          <article
            class="soft w-100 p-4 h-100 rounded d-flex flex-column align-items-center"
          >
            <img
              src="./images/icons/Return.png"
              alt="drive"
              class="mt-3"
              style="width: 35%;"
            />
            <h4 class="mt-4 mb-2">Return</h4>
            <p class="mt-3">
              When you're done, return the car to the same location you picked
              it up from.
            </p>
          </article>
        </div>
      </div>

      <h3 class="pt-5 mb-5 text-center">Why ZipCar?</h3>
      <div
        class="text-center row no-gutters ml-auto mr-auto justify-content-center"
        style="width: 90%;"
      >
        <div class="col-md-6 col-lg-3 pl-2 pr-2 mb-5">
          <article
            class="soft w-100 p-4 h-100 rounded d-flex flex-column align-items-center"
          >
            <img
              src="./images/icons/Save.png"
              alt="money"
              class="mt-3"
              style="width: 35%;"
            />
            <h4 class="mt-4 mb-2">Save money</h4>
            <p class="mt-3">
              Zipcar covers gas, insurance, parking, and maintenance over car
              ownership.
            </p>
          </article>
        </div>
        <div class="col-md-6 col-lg-3 pl-2 pr-2 mb-5">
          <article
            class="soft w-100 p-4 h-100 rounded d-flex flex-column align-items-center"
          >
            <img
              src="./images/icons/Map.png"
              alt="drive"
              class="mt-3"
              style="width: 35%;"
            />
            <h4 class="mt-4 mb-2">Cars nears you</h4>
            <p class="mt-3">
              Zipcars live in your local neighborhood, and in cities, campuses
              and airports across the globe.
            </p>
          </article>
        </div>
        <div class="col-md-6 col-lg-3 pl-2 pr-2 mb-5">
          <article
            class="soft w-100 p-4 h-100 rounded d-flex flex-column align-items-center"
          >
            <img
              src="./images/icons/Time.png"
              alt="drive"
              class="mt-3"
              style="width: 35%;"
            />
            <h4 class="mt-4 mb-2">Drive on-demand</h4>
            <p class="mt-3">
              No waiting in line at the counter. Just book and go.
            </p>
          </article>
        </div>
        <div class="col-md-6 col-lg-3 pl-2 pr-2 mb-5">
          <article
            class="soft w-100 p-4 h-100 rounded d-flex flex-column align-items-center"
          >
            <img
              src="./images/icons/Space.png"
              alt=""
              class="mt-3"
              style="width: 35%;"
            />
            <h4 class="mt-4 mb-2">Go beyond public transit</h4>
            <p class="  mt-3">
              Registrate at our page when our evaluators approve you we'll send
              a zipcard in the email.
            </p>
          </article>
        </div>
      </div>
    </section>
<?php	//Si el usuario esta conectado	
		  if (isset($_SESSION['id']) AND isset($_SESSION['usuario'])) {
	 } else  {?>	
<!-- ZONA DE REGISTRO -->
    <section id="registro" class="about">
                <div class="container">
				<h3 class="pt-5 mb-5 text-center">Register</h3>
      <div class="text-center row no-gutters ml-auto mr-auto justify-content-center" style="width: 90%;" >
        <div class="col-md-10 pl-4 pr-4 mb-5">
          <article class="soft w-100 p-4 h-100 rounded d-flex flex-column align-items-center" >
            <img src="./images/icons/registro.png" alt="drive" class="mt-3 w-25"  />
			<br /><?php if(isset($message)) { echo $message; } ?>
            <p class="mt-3">
            <form method="post" class="w-50">

            
            <div class="form-group">
              <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Username" required>
          </div>

          <div class="form-group">
              <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Name" required>
          </div>

          <div class="form-group">
              <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Lastname" required>
          </div>

          <div class="form-group">
              <input id="identificacion" class="form-control" placeholder="Identification number" name="identificacion" type="text" required>
          </div>

          <div class="form-group">
              <input id="pass" class="form-control" placeholder="Password" name="pass" type="password" required>
          </div>

          <div class="form-group">
              <input id="email" class="form-control" placeholder="E-mail" name="email" type="email" tabindex="1" required>
          </div>
          <button name="registrar" type="submit" id="registrar" class="btn btn-primary">Submit</button>

			</form>
            </p>
          </article>
        </div>
      </div>
<?php } ?>				
				</div>
				</section>
<!-- FIN ZONA DE REGISTRO -->

<?php if ($admin == 1){ ?>
<!-- ZONA ADMINISTRACION -->
    <section id="reserva" class="about">
                <div class="container">
				<h3 class="pt-5 mb-5 text-center">Administration</h3>
      <div class="text-center row no-gutters ml-auto mr-auto justify-content-center" style="width: 90%;" >
        <div class="col-md-6 col-lg-4 pl-4 pr-4 mb-5">
          <article class="soft w-100 p-4 h-100 rounded d-flex flex-column align-items-center" >
            <h4 class="mt-4 mb-2">Agregar auto</h4>
            <p class="mt-3">
              <br /><?php if(isset($message)) { echo $message; } ?>
            <form method="post">
            <input id="marca" placeholder="Marca" name="marca" type="text" tabindex="1" required><br /><br />
			<input id="modelo" placeholder="Modelo" name="modelo" type="text" tabindex="1" required><br /><br />
			<input id="combustible" placeholder="Combustible" name="combustible" type="text" tabindex="1" required><br /><br />
			<button name="agregarauto" type="submit" id="registrar">Agregar</button>
			</form>
            </p>
          </article>
        </div>
      </div>
				
				</div>
				</section>
<!-- FIN ZONA ADMINISTRACION -->
<?php } else  {}?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script
      src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
      integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
      integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
      integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
      crossorigin="anonymous"
    ></script>
  </body>
</html>