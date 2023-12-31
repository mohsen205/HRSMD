<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="index.php">
        HRSMD
        <span class="" style="font-size:12px">(urgence)</span>
    </a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!">
        <span class="material-icons">
            menu
        </span>
    </button>
    <!-- Navbar Search-->
    <div class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
    </div>
    <!-- Navbar-->
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
                aria-expanded="false"><span class="material-symbols-outlined">
                    person
                </span></a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="../services/logout.php">Déconnexion</a></li>
            </ul>
        </li>
    </ul>
</nav>
<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <a class="nav-link" href="index.php">
                        <div class="sb-nav-link-icon">
                            <span class="material-symbols-outlined">
                                dashboard
                            </span>
                        </div>
                        Tableau de bord
                    </a>
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseDoctors"
                        aria-expanded="false" aria-controls="collapseDoctors">
                        <div class="sb-nav-link-icon">
                            <span class="material-symbols-outlined">
                                clinical_notes
                            </span>
                        </div>
                        Médecin
                        <div class="sb-sidenav-collapse-arrow">
                            <span class="material-symbols-outlined">
                                expand_more
                            </span>
                        </div>
                    </a>
                    <div class="collapse" id="collapseDoctors" aria-labelledby="headingOne"
                        data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="../dashboard/doctorsList.php">Liste de médecins</a>
                            <a class="nav-link" href="../dashboard/addDoctor.php">Ajouter un médecin</a>
                        </nav>
                    </div>

                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseInjury"
                        aria-expanded="false" aria-controls="collapseInjury">
                        <div class="sb-nav-link-icon">
                            <span class="material-symbols-outlined">
                                personal_injury
                            </span>
                        </div>
                        Patient
                        <div class="sb-sidenav-collapse-arrow">
                            <span class="material-symbols-outlined">
                                expand_more
                            </span>
                        </div>
                    </a>
                    <div class="collapse" id="collapseInjury" aria-labelledby="headingOne"
                        data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="../dashboard/patientList.php">Liste de patients</a>
                            <a class="nav-link" href="../dashboard/addPatient.php">Ajouter un patient</a>
                        </nav>
                    </div>

                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseBed"
                        aria-expanded="false" aria-controls="collapseBed">
                        <div class="sb-nav-link-icon">
                            <span class="material-symbols-outlined">
                                bed
                            </span>
                        </div>
                        Lit
                        <div class="sb-sidenav-collapse-arrow">
                            <span class="material-symbols-outlined">
                                expand_more
                            </span>
                        </div>
                    </a>
                    <div class="collapse" id="collapseBed" aria-labelledby="headingOne"
                        data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="../dashboard/bedList.php">Liste de lits</a>
                            <a class="nav-link" href="../dashboard/addBed.php">Ajouter un lit</a>
                        </nav>
                    </div>


                    <!--  -->
                    <?php if($_SESSION["role"] === "super_admin") { ?>
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseAdmin"
                        aria-expanded="false" aria-controls="collapseAdmin">
                        <div class="sb-nav-link-icon">
                            <span class="material-symbols-outlined">
                                admin_panel_settings
                            </span>
                        </div>
                        administrateur
                        <div class="sb-sidenav-collapse-arrow">
                            <span class="material-symbols-outlined">
                                expand_more
                            </span>
                        </div>
                    </a>
                    <div class="collapse" id="collapseAdmin" aria-labelledby="headingOne"
                        data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="../dashboard/AdminList.php">List des administrateurs</a>
                            <a class="nav-link" href="../dashboard/addAdmin.php">Ajouter un administrateur</a>
                        </nav>
                    </div>
                    <!--  -->
                    <?php } ?>
                </div>
            </div>
        </nav>
    </div>