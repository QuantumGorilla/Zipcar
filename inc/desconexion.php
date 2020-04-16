<?php 
//Eliminamos la sesion actual
session_start();
$_SESSION = array();
session_destroy(); ?>
<SCRIPT LANGUAGE="JavaScript">
         document.location.href="../index.php"
    </SCRIPT>