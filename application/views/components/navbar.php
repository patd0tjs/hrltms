<div class="container-fluid">
    <div class="row flex-nowrap">
        <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0" style="background-color: #1e6c07;">
            <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100" align="center">
                <a href="/" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                    <span class="fs-5 d-none d-sm-inline">
                        <img src="<?= base_url()?>assets/img/logo.jpg" alt="" class="img-fluid" style="width:60%">
                        <br>
                        <strong>BPH-KIBAWE</strong>  
                    </span>
                </a>
                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">

                    <?php if($this->session->id == 'admin'){?>
                        <li class="nav-item">
                            <a href="<?= base_url()?>admin" class="nav-link align-middle px-0" style="color: white">
                                <span class="ms-1 d-none d-sm-inline">
                                    <?php if ($title == 'Dashboard'){ ?>
                                        <strong>Dashboard</strong>
                                    <?php } else {?>
                                        Dashboard
                                    <?php } ?>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url()?>admin/employees" class="nav-link px-0 align-middle" style="color: white">
                                <span class="ms-1 d-none d-sm-inline">
                                    <?php if ($title == 'Employees'){ ?>
                                        <strong>Employees</strong>
                                    <?php } else {?>
                                        Employees
                                    <?php } ?>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url()?>admin/dtr" class="nav-link px-0 align-middle" style="color: white">
                                <span class="ms-1 d-none d-sm-inline">
                                    <?php if ($title == 'Daily Time Record'){ ?>
                                        <strong>DTR</strong>
                                    <?php } else {?>
                                        DTR
                                    <?php } ?>
                                </span>
                            </a>
                        </li>

                        <li>
                            <a href="<?= base_url()?>admin/schedules" class="nav-link px-0 align-middle" style="color: white">
                                <span class="ms-1 d-none d-sm-inline">
                                    <?php if ($title == 'Schedules'){ ?>
                                        <strong>Schedules</strong>
                                    <?php } else {?>
                                        Schedules
                                    <?php } ?>
                                </span>
                            </a>
                        </li>

                        <li>
                            <a href="<?= base_url()?>admin/tardy" class="nav-link px-0 align-middle" style="color: white">
                                <span class="ms-1 d-none d-sm-inline">
                                    <?php if ($title == 'Tardy'){ ?>
                                        <strong>Tardy</strong>
                                    <?php } else {?>
                                        Tardy
                                    <?php } ?>
                                </span>
                            </a>
                        </li>

                        <li>
                            <a href="<?= base_url()?>admin/undertime" class="nav-link px-0 align-middle" style="color: white">
                                <span class="ms-1 d-none d-sm-inline">
                                    <?php if ($title == 'Undertime'){ ?>
                                        <strong>Undertime</strong>
                                    <?php } else {?>
                                        Undertime
                                    <?php } ?>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url()?>admin/leaves" class="nav-link px-0 align-middle" style="color: white">
                                <span class="ms-1 d-none d-sm-inline">
                                    <?php if ($title == 'Employee Leave Requests'){ ?>
                                        <strong>Leaves</strong>
                                    <?php } else {?>
                                        Leaves
                                    <?php } ?>
                                    <i class="bi bi-bell-fill"></i> <?= count($pending_leaves)?>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a role="button" data-bs-toggle="modal" data-bs-target="#export" class="nav-link px-0 align-middle" style="color: white">
                                <span class="ms-1 d-none d-sm-inline">Tardy/Undertime Report</span>
                            </a>
                        </li>
                    <?php } else {?>
                        <li class="nav-item">
                            <a href="<?= base_url()?>profile" class="nav-link align-middle px-0" style="color: white">
                                <span class="ms-1 d-none d-sm-inline">
                                    <?php if ($title == 'Employee Profile'){ ?>
                                        <strong>Profile</strong>
                                    <?php } else {?>
                                        Profile
                                    <?php } ?>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url()?>schedule" class="nav-link px-0 align-middle" style="color: white">
                                <span class="ms-1 d-none d-sm-inline">
                                    <?php if ($title == 'My Schedule'){ ?>
                                        <strong>Schedule</strong>
                                    <?php } else {?>
                                        Schedule
                                    <?php } ?>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url()?>deficiencies" class="nav-link px-0 align-middle" style="color: white">
                                <span class="ms-1 d-none d-sm-inline">
                                    <?php if ($title == 'Employee Deficiencies'){ ?>
                                        <strong>Deficiencies</strong>
                                    <?php } else {?>
                                        Deficiencies
                                    <?php } ?>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url()?>leaves" class="nav-link px-0 align-middle" style="color: white">
                                <span class="ms-1 d-none d-sm-inline">
                                    <?php if ($title == 'Employee Leaves'){ ?>
                                        <strong>My Leaves</strong>
                                    <?php } else {?>
                                        My Leaves
                                    <?php } ?>
                                </span>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
                <hr>
                <div class="dropdown pb-4">
                    <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="d-none d-sm-inline mx-1"><?= ucfirst($this->session->id)?></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                        <li><a class="dropdown-item" type="button" data-bs-toggle="modal" data-bs-target="#changePass">Change Password</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="changePass" tabindex="-1" aria-labelledby="changePassLabel" data-bs-backdrop="static" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="changePassLabel">Change Password</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <?= form_open('users/change_password');?>
                        <div class="modal-body">

                        <div class="mb-3">
                            <label class="form-label" for="old">Enter Old Password:</label>
                            <input class="form-control" type="password" name="old" id="old" required></div>

                            <div class="mb-3">
                            <label class="form-label" for="pw">Enter New Password:</label>
                            <input class="form-control" type="password" name="pw" id="pw" required></div>

                            <div class="mb-3">
                            <label class="form-label" for="pw2">Re-enter New Password:</label>
                            <input class="form-control" type="password" name="pw2" id="pw2" required></div>


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="export" tabindex="-1" aria-labelledby="exportLabel" data-bs-backdrop="static" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exportLabel">Tardy/Undertime Report</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <?= form_open('reports/export');?>
                        <div class="modal-body">

                        <div class="mb-3">
                            <label class="form-label" for="s_date">From:</label>
                            <input class="form-control" type="date" name="s_date" id="s_date" required></div>

                            <div class="mb-3">
                            <label class="form-label" for="e_date">To:</label>
                            <input class="form-control" type="date" name="e_date" id="e_date" required></div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Generate Report</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col py-3" style='background-color: #b8dbc9;'>
            <?php $this->load->view('components/topbar'); ?>
            <div class="content">
                <?php if ($this->session->flashdata('error')){?>

                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= $this->session->flashdata('error')?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>

                <?php } elseif ($this->session->flashdata('success')){ ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= $this->session->flashdata('success')?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php } ?>

                
                <h1><?= $title?></h1>
            
