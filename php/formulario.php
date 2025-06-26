<?php 
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'Invitados.php';
if (!isset($_SESSION['confirmarEnvio'])) {
    $_SESSION['confirmarEnvio'] = '';
} 
if (!isset($_SESSION['error'])) {
    $_SESSION['error'] = '';
}
if($_SERVER['REQUEST_METHOD']==='POST'){
    //1. sanitizar los campos 
    $nombre = trim(htmlspecialchars($_POST['nombre'])); 
    $apellidos = trim(htmlspecialchars($_POST['apellidos'])); 
    $telefono = trim(htmlspecialchars($_POST['telefono']));
    $acompanyante = isset($_POST['acompanyante']) ? $_POST['acompanyante'] : '';
    $numAcompanyantes = isset($_POST['numInvitados']) && $_POST['numInvitados'] !== '' ? (int) $_POST['numInvitados']
    : 0;

    //comprobamos que no estén vacíos los campos 
    if(empty($nombre)||empty($apellidos)||empty($telefono)||empty($acompanyante)){
        $_SESSION['error'] .= "No pueden haber campos vacíos";   
        header('Location: ../views/asistencia.php');
        exit;
    } 
    if(isset($_POST['alergenos']) && is_array($_POST['alergenos'])) {
        $alergenos = $_POST['alergenos']; //comprobamos que sea un array, si no lo creamos
    }else {
        $alergenos = array();
    } 
    if (!in_array($acompanyante, ['si', 'no'], true)) {
    $_SESSION['error'] .= "Debes seleccionar si vienes con acompañante o no.";
    header('Location: ../views/asistencia.php');
    exit;
    }
    // 2. Patrones
    $patron_nombre    = '/^[A-Za-zÀ-ÖØ-öø-ÿ\s\-]{2,50}$/';
    $patron_telefono  = '/^(?:\+34|0034)?[ -]?[679]\d{2}(?:[ -]?\d{3}){2}$/';
    $patron_acompanyante = '/^[0-9]{1,2}$/';
    //validamos nombre y apellidos 
    if(!preg_match($patron_nombre, $nombre)){
        $_SESSION['error'] .= "Formato de nombre incorrecto";
        header('Location: ../views/asistencia.php');
        exit;
    }
    if(!preg_match($patron_nombre, $apellidos)){
        $_SESSION['error'] .= "Formato de apellidos incorrecto";
        header('Location: ../views/asistencia.php');
        exit;
    }
     // Validamos teléfono
    if(!preg_match($patron_telefono, $telefono)){ 
        $_SESSION['error'] .= "Formato de telefono incorrecto";
        header('Location: ../views/asistencia.php');
        exit;
    } 
    //validamos acompanyantess 
    if(!preg_match($patron_acompanyante, $numAcompanyantes)){
        $_SESSION['error'] .= "Formato de número de acompañantes incorrecto";
        header('Location: ../views/asistencia.php');
        exit;
    }
    //validamos alergenos 
     $valores_permitidos = array(
        'Gluten',
        'Pescado',
        'Soja',
        'Mostaza',
        'Marisco',
        'Huevos',
        'Frutos de Cáscara',
        'Leche',
        'Granos de Sésamo'
    );
    foreach($alergenos as $al){
        if(!in_array($al, $valores_permitidos, true)){
            $_SESSION['error'] .= "Nombre de alergenos incorrecto";
           header('Location: ../views/asistencia.php');
            exit;
        }
    }

    //mostramos los errores 
    if (!empty($_SESSION['error'])) {
    print_r($_SESSION['error']);
}
    //convertimos el array de alergenos en un string separado por comas 
    $alergenos_str = '';
    if(!empty($alergenos)){
    $alergenos_str = implode(', ', $alergenos);
    }
    //Una vez hemos comprobado que los datos están bien pasamos a guardarlos en la base de datos 
    $invitado = new Invitados ($nombre , $apellidos, $telefono , $alergenos_str, $acompanyante, $numAcompanyantes);
    //lo guardamos en la base de datos 
    try {
    if ($invitado->guardar()) {
        $_SESSION['confirmarEnvio'] = "¡Guardado Correctamente!";
    } else {
        $_SESSION['errorEnvio'] = "Ha ocurrido un problema";
    }
    } catch (Exception $e) {
    $_SESSION['error'] .= "Excepción: " . $e->getMessage();
    }
    
    header("Location: ../views/asistencia.php");
    exit;
    
    
}
?>