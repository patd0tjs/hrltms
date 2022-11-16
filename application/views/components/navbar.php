<div class="container-fluid">
    <div class="row flex-nowrap">
        <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
            <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                <a href="/" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                    <span class="fs-5 d-none d-sm-inline">My Logo</span>
                </a>
                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">

                <?php if($this->session->id == 'admin'){?>
                    <li class="nav-item">
                        <a href="<?= base_url()?>admin" class="nav-link align-middle px-0">
                            <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url()?>admin/employees" class="nav-link px-0 align-middle">
                            <i class="fs-4 bi-table"></i> <span class="ms-1 d-none d-sm-inline">Employees</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url()?>admin/dtr" class="nav-link px-0 align-middle">
                            <i class="fs-4 bi-table"></i> <span class="ms-1 d-none d-sm-inline">DTR</span>
                        </a>
                    </li>

                    <li>
                        <a href="<?= base_url()?>admin/schedules" class="nav-link px-0 align-middle">
                            <i class="fs-4 bi-table"></i> <span class="ms-1 d-none d-sm-inline">Schedules</span>
                        </a>
                    </li>

                    <li>
                        <a href="<?= base_url()?>admin/tardy" class="nav-link px-0 align-middle">
                            <i class="fs-4 bi-table"></i> <span class="ms-1 d-none d-sm-inline">Tardy</span>
                        </a>
                    </li>

                    <li>
                        <a href="<?= base_url()?>admin/undertime" class="nav-link px-0 align-middle">
                            <i class="fs-4 bi-table"></i> <span class="ms-1 d-none d-sm-inline">Undertime</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url()?>admin/leaves" class="nav-link px-0 align-middle">
                            <i class="fs-4 bi-table"></i> <span class="ms-1 d-none d-sm-inline">Leaves</span>
                        </a>
                    </li>
                <?php } else {?>
                    <li class="nav-item">
                        <a href="<?= base_url()?>profile" class="nav-link align-middle px-0">
                            <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Profile</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url()?>deficiencies" class="nav-link px-0 align-middle">
                            <i class="fs-4 bi-table"></i> <span class="ms-1 d-none d-sm-inline">Deficiencies</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url()?>leaves" class="nav-link px-0 align-middle">
                            <i class="fs-4 bi-table"></i> <span class="ms-1 d-none d-sm-inline">Leaves</span>
                        </a>
                    </li>
                <?php } ?>
                </ul>
                <hr>
                <div class="dropdown pb-4">
                    <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="d-none d-sm-inline mx-1"><?= $this->session->id?></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                        <li><a class="dropdown-item" href="<?= base_url()?>login">Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col py-3">
            <div class="content">
                <h1><?= $title?></h1>
            
