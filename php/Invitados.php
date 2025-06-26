<?php 
session_start();
if (!isset($_SESSION['mensaje'])) {
    $_SESSION['mensaje'] = '';
}
if (!isset($_SESSION['errorGuardar'])) {
    $_SESSION['errorGuardar'] = '';
}
class Invitados {
    private $nombre;
    private $apellidos;
    private $tel; 
    public $alergenos;
    public $acompanyante;
    public $numAcompanyantes;
    public function __construct  ($nombre,$apellidos,$tel,$alergenos,$acompanyante,$numAcompanyantes){
        $this->nombre = $nombre;
        $this->apellidos=$apellidos;
        $this->tel = $tel;
        $this->alergenos = $alergenos;
        $this->acompanyante = $acompanyante;
        $this->numAcompanyantes = $numAcompanyantes;
    }
    public function setNombre($nombre): void{
        $this->nombre = $nombre;
    }
    public function setApellidos ($apellidos): void{
        $this->apellidos = $apellidos;
    }
    public function setTel ($tel): void{
        $this->tel = $tel;
    }
    public function getNombre(): string{
        return $this->nombre;
    }
    public function getApellidos(): string{
        return $this->apellidos;
    }
    public function getTel(): string{
        return $this->tel;
    } 
    //Métodos para conectar la base de datos 
    public static function  conectar (){
        //abrimos la conexión con la base de datos 
        $conexion = mysqli_connect('localhost','root','854809','Boda') or die ("Error en la conexión: ".mysqli_connect_error());
        return $conexion;
    }
    //método para guardar en la base de datos 
    public function guardar(){
        $guardado = false;
        if($this->comparar()){
            $_SESSION['mensaje'] .= "Ya existe un registro con este nombre";
            return false;
        }
        $conexion = self::conectar();
        $sql = 'INSERT INTO invitados(nombre, apellidos, telefono, alergenos, acompanyante, numAcompanyantes) VALUES (?, ?, ?, ?, ?, ?) ';
        $stmt = mysqli_prepare($conexion, $sql);
        if(!$stmt){
            die("Error en la preparación" .mysqli_error($conexion));
        }
        mysqli_stmt_bind_param($stmt, 'sssssi',$this->nombre, $this->apellidos, $this->tel, $this->alergenos, $this->acompanyante , $this->numAcompanyantes); 
        //ejecutar 
        $ejecutar = mysqli_stmt_execute($stmt); 

        if(!$ejecutar){ 
            die ("Error en la ejecución de la consulta" . mysqli_stmt_error($stmt));
        }
        $filas_afectadas = mysqli_stmt_affected_rows($stmt);
        if( $filas_afectadas>0){
            $guardado = true;
        }
        //cerramos las conexiones 
        mysqli_stmt_close($stmt);
        mysqli_close($conexion);
        return $guardado;   
    }
    public function mostrar (){
        $conexion = self::conectar(); 
        $sql = 'SELECT * FROM invitados';
        $datos = mysqli_query($conexion, $sql); 
        if($datos){
            if(mysqli_num_rows($datos) > 0){
                while($dato = mysqli_fetch_assoc($datos)){
                    $_SESSION['mensaje'] .= "<tr> <td>".$dato['nombre']."</td> <td>".$dato['apellidos']."</td> <td>".$dato['telefono']."</td> <td>".$dato['alergenos']."</td> <td>".$dato['acompanyante']."</td> <td>".$dato['numAcompanyantes']."</td></tr>";
                }
            }else{
                echo "No hay registros";
             }
        }
        mysqli_close($conexion);
    }
    public function eliminar ($nombre){
        $conexion = self::conectar(); 
            $stmt = $conexion->prepare("DELETE FROM invitados WHERE nombre = ?");
            $stmt->bind_param("s", $nombre); // s = string
            if ($stmt->execute()) {
                $_SESSION['mensaje'].= "Se ha eliminado correctamente";
            } else {
                $_SESSION['mensaje'].= "Error en la consulta: " . mysqli_stmt_error($stmt);
            }
            $stmt->close();
            mysqli_close($conexion);
    }
    public function buscar($nombre){
    $conexion = self::conectar();
    $sql = "SELECT * FROM invitados WHERE nombre = ?";
    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt,'s',$nombre); 
    if(mysqli_stmt_execute($stmt)){
        $resultados = mysqli_stmt_get_result($stmt);
        if ($resultados && mysqli_num_rows($resultados) > 0) {
            $_SESSION['mensaje'] = '';
            while($fila = mysqli_fetch_assoc($resultados)){
                $_SESSION['mensaje'] .= "<tr> <td>".$fila['nombre']."</td> <td>".$fila['apellidos']."</td> <td>".$fila['telefono']."</td> <td>".$fila['alergenos']."</td> <td>".$fila['acompanyante']."</td><td>".$fila['numAcompanyantes']."</td></tr>";
            }
        } else {
            $_SESSION['mensaje'] .= "No se encontraron resultados.";
        }
    } else {
        echo "Error al ejecutar la consulta";
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conexion);
}

    public function comparar(){
        $existe = false;
        $conexion = self::conectar();
        $sql = "SELECT * FROM invitados WHERE nombre = ? AND apellidos = ?";
        //preparamos la consulta 
        $stmt = mysqli_prepare($conexion, $sql);
        //adjudicamos los parametros 
        mysqli_stmt_bind_param($stmt,'ss',$this->nombre , $this->apellidos); 

        if (mysqli_stmt_execute($stmt)) {
    $resultados = mysqli_stmt_get_result($stmt);
    if ($resultados && mysqli_num_rows($resultados) > 0) {
        $existe = true;
    }
}
        mysqli_stmt_close($stmt);
        mysqli_close($conexion);

        return $existe;

    }
}
?>