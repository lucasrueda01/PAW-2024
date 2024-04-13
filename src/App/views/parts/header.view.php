<header> <!--block-->
        <h1><a href="/" class="logo logo_chico" id="menuDesktop">Paw Burger</a></h1>
        <input type="checkbox" name="menuHamburguesa" id="menuHamburguesa">
        <label for="menuHamburguesa"class="logo logo_chico" id="menuMobile">Paw Burger</label>
        <h1><a href="/" class="logo logo_grande_mobile">Paw Burger</a></h1>


        <nav class="container_nav"> 
            <ul class="nav_menu"> 

                <?php require __DIR__.'/nav.view.php' ?>            

                <li class="opciones_nav">
                    <input type="checkbox" name="menuGestionEmpleado" id="checkPerfilEmpleado">
                    <label for="checkPerfilEmpleado" class="labelPerfilEmpleado">PERFIL EMPLEADO</label>
                    <ul class="submenu">
                        <li class="opciones_nav">
                            <a href="/gestion_lista_mesas">GESTION MESAS</a>
                        </li>
                        <li class="opciones_nav">
                            <a href="/gestion_mesa">GESTION MESA</a>
                        </li>
                        <li class="opciones_nav">
                            <a href="/pedidos_entrantes">PEDIDOS ENTRANTES</a>
                        </li>
                    </ul>
                </li>
            </ul>
             <ul class="nav_usuario">
                <li class="opciones_nav">
                    <input type="checkbox" name="menuPerfil" id="menuPerfil">
                    <label for="menuPerfil" class="icono_usuario">Perfil Usuario</label>
                    <ul class="submenu">
                        <li class="opciones_nav opciones_nav_oculto"><a href="/inicio_sesion">Cliente</a></li>
                        <li class="opciones_nav opciones_nav_oculto"><a href="#">Cerrar Sesion</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
</header>
