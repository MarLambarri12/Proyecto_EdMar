<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="../img/Logo1.png" alt="Logo" width="50" height="50">
            </a>
            <button class="btn btn-outline-light" type="submit">
                <i class="bi bi-list" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions"
                    aria-controls="offcanvasWithBothOptions">&nbsp;Menú</i>
            </button>

            <!--  <a class="nav-link text-white" href="#" >
    <i class="bi bi-list" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions">Menú prinsipal</i> 
</a> -->
            &nbsp;&nbsp;&nbsp;

            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
                aria-controls="offcanvasNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="offcanvas offcanvas-start bg-dark text-white" tabindex="-1" id="offcanvasNavbar"
                aria-labelledby="offcanvasNavbarLabel">
                <!-- Bóton para activar el menu prinsipal -->
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Tienda Online</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>

                <div class="offcanvas-body">
                    <form class="d-flex mx-auto w-50">
                        <input class="form-control me-2" type="search" placeholder="Busca lo que necesites"
                            aria-label="Search">
                        <button class="btn btn-outline-light" type="submit">
                            <i class="bi bi-search"></i>
                        </button>
                    </form>
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="bi bi-person-vcard"></i>&nbsp;Afiliados</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="bi bi-receipt-cutoff"></i>&nbsp;Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="bi bi-people-fill"></i>&nbsp;Usuarios y permisos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../codigo/php/usuarios/salir.php"><i class="bi bi-person-circle"></i>&nbsp;Cerrar sesión</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- Aqui inicia el menu prinsipal -->
    <div class="offcanvas offcanvas-start text-white" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions"
        aria-labelledby="offcanvasWithBothOptionsLabel">
        <div class="offcanvas-header bg-dark">
            <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel"><i
                    class="bi bi-person-fill-gear"></i>&nbsp;Administrador</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                aria-label="Close"></button>
        </div>
        <div class="offcanvas-body text-black">
            <!-- Acordeón -->
            <div class="accordion" id="accordionPanelsStayOpenExample">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true"
                            aria-controls="panelsStayOpen-collapseOne">
                            <strong>Gestionar productos</strong>
                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show">
                        <div class="accordion-body">
                            <div class="list-group">
                                <button type="button" class="list-group-item list-group-item-action"><i
                                        class="bi bi-arrow-right-circle-fill"></i><strong>&nbsp;Añadir y editar
                                        productos</strong></button>
                                <button type="button" class="list-group-item list-group-item-action"><i
                                        class="bi bi-arrow-right-circle-fill"></i><strong>&nbsp;Categorías de
                                        productos</strong></button>
                                <button type="button" class="list-group-item list-group-item-action"><i
                                        class="bi bi-arrow-right-circle-fill"></i><strong>&nbsp;Inventario y
                                        stok</strong></button>
                                <button type="button" class="list-group-item list-group-item-action"><i
                                        class="bi bi-arrow-right-circle-fill"></i><strong>&nbsp;Galería de
                                        productos</strong></button>
                            </div>
                        </div>
                    </div>
                    <!-- Segundo acordeon -->
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false"
                                aria-controls="panelsStayOpen-collapseTwo">
                                <strong>Gestionar pedidos</strong>
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse">
                            <div class="accordion-body">
                                <div class="list-group">
                                    <button type="button" class="list-group-item list-group-item-action"><i
                                            class="bi bi-arrow-right-circle-fill"></i><strong>&nbsp;Visualización y
                                            seguimiento</strong></button>
                                    <button type="button" class="list-group-item list-group-item-action"><i
                                            class="bi bi-arrow-right-circle-fill"></i><strong>&nbsp;Devoluciones y
                                            reembolsos</strong></button>
                                    <button type="button" class="list-group-item list-group-item-action"><i
                                            class="bi bi-arrow-right-circle-fill"></i><strong>&nbsp;Generación de
                                            facturas</strong></button>
                                </div>
                            </div>
                        </div>
                        <!-- Tercer acordeón -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false"
                                    aria-controls="panelsStayOpen-collapseThree">
                                    <strong>Analisis y reportes</strong>
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                    <div class="list-group">
                                        <button type="button" class="list-group-item list-group-item-action"><i
                                                class="bi bi-arrow-right-circle-fill"></i><strong>&nbsp;Reportes de
                                                ventas</strong></button>
                                        <button type="button" class="list-group-item list-group-item-action"><i
                                                class="bi bi-arrow-right-circle-fill"></i><strong>&nbsp;Informes de
                                                inventarios</strong></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Final del acordeón -->
                    </div>
</header>