<header> <!--block-->
        <h1><a href="/" class="logo logo_chico" id="menuDesktop">Paw Burger</a></h1>
        <input type="checkbox" name="menuHamburguesa" id="menuHamburguesa">
        <label for="menuHamburguesa" class="logo logo_chico" id="menuMobile">Paw Burger</label>
        <h1><a href="/" class="logo logo_grande_mobile">Paw Burger</a></h1>


        <nav class="container_nav"> 
            <ul class="nav_menu"> 

                <?php require __DIR__.'/nav.view.php' ?>            

                <li class="opciones_nav">
                    <input type="checkbox" name="menuGestionEmpleado" id="checkPerfilEmpleado">
                    <label for="checkPerfilEmpleado" class="labelPerfilEmpleado">PERFIL EMPLEADO</label>
                    <ul class="submenu submenuEmpleado">
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
                    <ul class="submenu submenu_">
                        <li class="opciones_nav opciones_nav_oculto"><a href="/perfil_usuario">Mi Perfil</a></li>
                        <li class="opciones_nav opciones_nav_oculto"><a href="/iniciar_sesion">Iniciar Sesion</a></li>
                        <li class="opciones_nav opciones_nav_oculto"><a href="/registrar_usuario">Registrar Usuario Sesion</a></li>
                        <li class="opciones_nav opciones_nav_oculto"><a href="/cerrar_sesion">Cerrar Sesion</a></li>
                    </ul>
                </li>
            </ul>
            <!--  -->
        </nav>
</header>
