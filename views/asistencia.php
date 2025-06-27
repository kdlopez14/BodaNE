<?php   session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Confirmar Asistencia"> 
    <meta name="author" content="Daniela López">
    <meta name="robots" content="noindex, follow">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/index.css">
    <link rel="stylesheet" href="../style/asistencia.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Pinyon+Script&family=Ponomar&family=Radley:ital@0;1&family=Tangerine:wght@400;700&display=swap" rel="stylesheet">
    <title>Asistencia</title>
</head>
<body>
    <!--<php include_once ("php/header.php"); ?>-->
    <header>
        <div id="barraNav">
            <nav>
                <ul id="menuNav">
                    <li><a href="../index.html" title="inicio">Inicio</a></li>
                    <li><a href="asistencia.php">Asistencia</a></li>
                    <li><a href="../index.html#sectionUbi" title="Ubicaciones del evento">Ubicación</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <main>
        <section id="fondoFormulario">
            <div class="bordeRound" id="asistencia">
                <h1 class="centro" id="tituloAsistencia">Asistencia</h1>
                <form id="formulario" name="formulario" method="POST" action="../php/formulario.php">

                    <!-- Campo: Nombre -->
                    <div class="form-control">
                        <label for="nombre">Nombre:</label>
                        <input id="nombre" class="input" type="text" name="nombre" />
                        <small></small>
                    </div>

                    <!-- Campo: Apellidos -->
                    <div class="form-control">
                        <label for="apellidos">Apellidos:</label>
                        <input id="apellidos" class="input" type="text" name="apellidos" />
                        <small></small>
                    </div>

                    <!-- Campo: Teléfono -->
                    <div class="form-control">
                        <label for="telefono">Teléfono:</label> <!-- Faltaba el "for" -->
                        <input id="telefono" class="input" type="text" name="telefono" />
                        <small></small>
                    </div>

                    <!-- Campo: Alergénos -->
                    <div class="form-control">
                        <div>
                            <input type="checkbox" name="alergenoss" id="alergenoss">
                            <label for="alergenoss">Alergénos</label>
                        </div>
                        <div id="alergenos">                         
                    </div>
                     <div class="form-control">
                        <label for="numInvitados">Acompañantes Invitados:</label> <!-- Faltaba el "for" -->
                        <input id="numInvitados"  type="number" name="numInvitados" min='0' max='10'/>
                        <small></small>
                    </div>
                        <!-- Campo: Acompañante -->
                        <div class="form-control"  id="grupo-acompanyante">
                            <label>Acompañante Extra:</label><br />
                            <input class="radio" type="radio" name="acompanyante" value="si" id="acom_si" />
                            <label for="acom_si" class="inline">Sí</label>

                            <input class="radio" type="radio" name="acompanyante" value="no" id="acom_no" />
                            <label for="acom_no" class="inline">No</label>
                            <p id="cubierto" class="oculto">&#9888 En caso de asistir con acompañante, se deberá abonar
                                el importe correspondiente al cubierto adicional.</p>
                            <small></small>
                        </div>

                        <!-- Botón de envío -->
                        <input id="botonEnviar" class="bordeRound" type="submit" name="botonEnviar"
                            value="Confirmar Asistencia">
                        <div id="confirmacionGuardado">
                            <?php
                          
                            if (isset($_SESSION['confirmarEnvio']) && !empty($_SESSION['confirmarEnvio'])) {
                                echo "<p style='color: green;'>" . $_SESSION['confirmarEnvio'] . "</p>";
                                unset($_SESSION['confirmarEnvio']); // eliminar para que no se repita al refrescar
                            }

                            if (isset($_SESSION['errorEnvio']) && !empty($_SESSION['errorEnvio'])) {
                                echo "<p style='color: red;'>" . $_SESSION['errorEnvio'] . "</p>";
                                unset($_SESSION['errorEnvio']); // eliminar tras mostrar
                            }
                            ?>
                        </div>
                </form>


            </div>
        </section>
    </main>
    <footer>
        <div id="logo">
        </div>
        <div id="separador">
            <p>&#9474;</p>
            <p>&#9474;</p>
            <p>&#9474;</p>
            <p>&#9474;</p>
            <p>&#9474;</p>
            <p>&#9474;</p>
            <p>&#9474;</p>
        </div>
        <div id="nicolasEstefania">
            <p id="textoFooter">
            Nicolas y Estefania <br>12 de septiembre de 2025</p>
        </div>
        <div >
            <p>&#9474;</p>
            <p>&#9474;</p>
            <p>&#9474;</p>
            <p>&#9474;</p>
            <p>&#9474;</p>
            <p>&#9474;</p>
            <p>&#9474;</p>
        </div>
        <div>
            <div class="redesSociales">
                <a href="https://www.instagram.com/fany.28.14?igsh=OTZncXB4azRjaTVt" target="_blank">Instagram</a>
                <div class="logosRedes">
                    <a href="https://www.instagram.com/fany.28.14?igsh=OTZncXB4azRjaTVt" target="_blank"><img
                            class="img" src="../imagenes/logos/instagram.png"   width="40" height="40" /></a>
                </div>
            </div>
            <div class="redesSociales">
                <a href="https://wa.me/34632078249?text=Hola" target="_blank">
                    WhatsApp
                </a>
                <div class="logosRedes">
                    <a href="https://wa.me/34632078249?text=Hola" target="_blank">
                        <img class="img" src="../imagenes/logos/whatsapp.png"   width="40" height="40" />
                    </a>

                </div>
            </div>
            <div class="redesSociales">
                <a href="mailto:nicolas_david10@hotmail.com?subject=Hola&body=Quiero%20contactarte">Email</a>
                <div class="logosRedes">
                    <img class="img" src="../imagenes/logos/email.png"   width="40" height="40"/>
                </div>
            </div>
        </div>
        <div id="informacion">
        </div>
        <!--contacto novios-->
    </footer>
    <script type="module" src="../js/baseDatos.js" defer></script>
    <script type="module" src="../js/acciones/acciones.js" defer></script>
</body>

</html>