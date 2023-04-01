<!-- this script should load first -->
<script>
  function check_id(){
  let warning = document.getElementById('id_warn').style;
  let id = document.getElementById('id').value;

  const usernames = [
    <?php foreach($employees as $emp):?>
    '<?= $emp['id']?>',
    <?php endforeach;?>
  ];

  if(usernames.includes(id)){
    warning.display = 'block';
  } else {
    warning.display = 'none';
  }

}
</script>

<?php if ($this->session->flashdata('error')){?>

<div class="alert alert-danger alert-dismissible fade show" role="alert" id="alert">
    <?= $this->session->flashdata('error')?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

<?php } ?>
<!-- add employee button -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Add Employee
</button>

<!-- add employee modal -->
<div class="modal fade" data-bs-backdrop="static" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Employee</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

        <!-- employee info -->
        <div class="modal-body">
        <form action="<?= base_url()?>users/add_emp" method="post" enctype="multipart/form-data">

          <div class="mb-3">
          <label for="profile_pic" class="form-label">Employee Picture:</label>
          <input class="form-control" type="file" type="file" name="profile_pic" accept="image/*" placeholder="profile_pic">
          </div>
          
          <div class="mb-3">
          <label for="id" class="form-label">Employee ID:</label>
          <input type="text" name="id" id="id" class="form-control" placeholder="Employee ID" onkeyup="check_id()" required></div>

          <div class="mb-3">
          <label for="l_name" class="form-label">Employee Surname:</label>
          <input type="text" name="l_name" class="form-control" placeholder="Surname" required></div>

          <div class="mb-3">
          <label for="f_name" class="form-label">Employee Firstname:</label>
          <input type="text" class="form-control" name="f_name" placeholder="Firstname" required></div>

          <div class="mb-3">
          <label for="m_name" class="form-label">Employee Middlename</label>
          <input type="text" class="form-control" name="m_name" placeholder="Middlename"></div>

          <div class="mb-3">
          <label for="departments" class="form-label">Department:</label>
          <select id="departments" class="form-control" name="department" required>
            <?php foreach($departments as $department):?>
              <option value="<?= $department['id']?>"><?= $department['name']?></option>
            <?php endforeach ?>
          </select></div>

          <div class="mb-3">
          <label for="designation" class="form-label">Designation:</label>
          <select id="designation" class="form-control" name ="designation" required>
            <?php foreach($designations as $designation):?>
              <option value="<?= $designation['id']?>"><?= $designation['name']?></option>
            <?php endforeach ?>
          </select></div>

          <div class="mb-3">
          <label for="status" class="form-label">Employment Status:</label>
          <select id="status" class="form-control" name="status" onchange="disablePlantilla()" required>
            <option value="Regular">Permanent</option>
            <option value="Irregular">JO</option>
            <option value="Casual">Casual</option>
          </select></div>

          <div class="mb-3">
          <label for="sex" class="form-label">Sex:</label>
          <select id="sex" class="form-control" name="sex" required>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
          </select></div>

          <div class="mb-3">
          <label for="bday" class="form-label">Birthday:</label>
          <input type="date" name="bday" class="form-control" required></div>

          <div class="mb-3">
          <label for="birth_place" class="form-label">Birth Place:</label>
          <input type="text" name="birth_place" class="form-control" placeholder="Place of Birth" required></div>

          <div class="row g-3">
          <label for="" class="form-label">Address:</label>
          <div class="col-auto">
          <input class="form-control" type="text" name="purok" placeholder="Purok"></div>
          <div class="col-auto">
          <input class="form-control" type="text" name="brgy" placeholder="Barangay" required></div>
          <div class="col-auto">
          <input class="form-control" type="text" name="municipality" placeholder="Municipality" required></div>
          <div class="col-auto">
          <input class="form-control" type="text" name="province" placeholder="Province" required></div>
          <div class="col-auto">
          <input class="form-control" type="number" name="zip" placeholder="Zip code" required></div></div>

          <br>
          <div class="mb-3">
          <label class="form-label" for="date_hired">Date Hired:</label>
          <input class="form-control" type="date" name="date_hired" required></div>

          <div class="mb-3" id="plantilla">
            <label class="form-label" for="plantilla">Plantilla No:</label>
            <input class="form-control" type="number" name="plantilla" placeholder="Plantilla #">
          </div>

          <div class="row g-3">
          <label class="form-label" for="education">Education:</label>
          <div class="col-auto">
          <select class="form-control" name="education" id="education" required>
            <option value="Elementary">Elementary</option>
            <option value="JHS">JHS</option>
            <option value="SHS">SHS</option>
            <option value="Bachelor's Degree">Bachelor's Degree</option>
            <option value="Post Graduate">Post Graduate</option>
          </select></div>

          <div class="col-auto">
          <input class="form-control" type="text" name="school" placeholder="School Name" required></div></div>

          <br>
          <div class="mb-3">
            <label for="prc" class="form-label">PRC No:</label>
          <input class="form-control" type="number" name="prc" placeholder="PRC Number"></div>

          <div class="row g-3">
          <div class="col-auto">
          <label for="prc_reg" class="form-label">Date of Registration:</label>
          <input type="date" name="prc_reg" class="form-control"></div>

          <div class="col-auto">
          <label for="prc_exp" class="form-label">Date of Expiry:</label>
          <input type="date" name="prc_exp" class="form-control"></div></div>

          <br>
          <div class="mb-3">
          <label for="philhealth" class="form-label">Philhealth:</label>
          <input class="form-control" type="number" name="philhealth" placeholder="Philhealth #"/></div>

          <div class="mb-3">
          <label for="phone" class="form-label">Phone:</label>
          <input class="form-control" type="number" name="phone" placeholder="Contact #" required></div>

          <div class="mb-3">
          <label for="marital_status" class="form-label">Marital Status:</label>
          <select name="marital_status" id="marital_status" class="form-control" required>
            <option value="Single">Single</option>
            <option value="Married">Married</option>
            <option value="Separated">Separated</option>
            <option value="Divorced">Divorced</option>
            <option value="Widowed">Widowed</option>
          </select></div>

          <div class="mb-3">
          <label for="gsis" class="form-label">GSIS:</label>
          <input type="number" name="gsis" placeholder="GSIS #" class="form-control"></div>

          <div class="mb-3">
          <label for="sss" class="form-label">SSS:</label>
          <input class="form-control" type="number" name="sss" placeholder="SSS #"></div>

          <div class="mb-3">
          <label for="pag_ibig" class="form-label">Pag-Ibig:</label>
          <input type="number" class="form-control" name="pag_ibig" placeholder="Pag-Ibig #"></div>

          <div class="mb-3">
          <label for="tin" class="form-label">TIN:</label>
          <input class="form-control" type="number" name="tin" placeholder="TIN #" required></div>

          <div class="mb-3">
          <label for="atm" class="form-label">ATM:</label>
          <input class="form-control" type="number" name="atm" placeholder="ATM #" required></div>

          <div class="mb-3">
          <label for="blood_type" class="form-label">Blood Type:</label>
          <select name="blood_type" class="form-control" required>
            <option value="A+">A+</option>
            <option value="A-">A-</option>
            <option value="B+">B+</option>
            <option value="B-">B-</option>
            <option value="AB+">AB+</option>
            <option value="AB-">AB-</option>
            <option value="O+">O+</option>
            <option value="O-">O-</option>
          </select></div>

          <div class="mb-3">
          <label for="email" class="form-label">Email:</label>
          <input type="email" class="form-control" name="email" placeholder="email" email></div>

          <div class="mb-3">
          <label for="remarks" class="form-label">Remarks:</label>
          <textarea name="remarks" class="form-control" cols="30" rows="10" placeholder="Remarks"></textarea></div>

        </div>

        <!-- submit -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Add Employee</button>
        </div>
      </form>
    </div>
  </div>
</div>

<form action="<?= base_url()?>admin/employees" method="get" id="filter">
<br>
<table>
  <tr>
    <td>
      <select id="departments" name="department" class="form-control" style="max-width: 200px;" required>
        <option value="" disabled selected hidden>Select Department</option>
        <?php foreach($departments as $department):?>
          <option value="<?= $department['id']?>"><?= $department['name']?></option>
        <?php endforeach ?>
      </select>
    </td>
    <td>
      <select id="departments" name="gender" class="form-control" style="max-width: 200px;" required>
        <option value="" disabled selected hidden>Select Gender</option>
        <option value="male">Male</option>
        <option value="female">Female</option>
      </select>
    </td>
    <td>
      <button class="btn btn-success">Filter</button>
    </td>
  </tr>
</table>
</form>
<br>
<table id="employee_tbl" class="table table-striped" style="width:100%;">
  <thead>
    <tr>
      <th>Employee ID</th>
      <th>Last Name</th>
      <th>First Name</th>
      <th>Middle Name</th>
      <th>Gender</th> 
      <th>Designation</th>
      <th>Department</th>
      <th>Action</th>
    </tr>
  </thead>

  <tbody>
    <?php foreach($employees as $emp):?>
      <tr>
        <td><?=$emp['id']?></td>
        <td><?=ucfirst($emp['l_name'])?></td>
        <td><?=ucfirst($emp['f_name'])?></td>
        <td><?=ucfirst($emp['m_name'])?></td>
        <td><?=$emp['sex']?></td>
        <td><?= $emp['designation_name']?></td>
        <td><?= $emp['department_name']?></td>
        <td>
          <form action="<?= base_url()?>reports/export_employee_data" method="post">
            <input type="hidden" name="id" value="<?= $emp['id']?>">
            <button type="submit" class="btn btn-success">
              Export
            </button>
          </form>    
          <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#emp<?= $emp['id']?>">
            Edit
          </button>
        </td>
      </tr>
    <?php endforeach ?>
  </tbody>
</table>

<?php foreach($employees as $emp):?>
  <div class="modal fade" data-bs-backdrop="static" id="emp<?= $emp['id']?>" tabindex="-1" aria-labelledby="emp<?= $emp['id']?>Label" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="emp<?= $emp['id']?>Label">Update Employee Details</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

          <!-- employee info -->
          <div class="modal-body">
          <form action="<?= base_url()?>users/edit_emp" method="post" enctype="multipart/form-data">

          <div class="mb-3">
            <label for="profile_pic" class="form-label">Employee Picture:</label>
            <input type="file" name="profile_pic" class="form-control" accept="image/*" placeholder="profile_pic"></div>

            <input type="hidden" name="id" placeholder="employee id" value="<?= $emp['id']?>" required>
            <input type="hidden" name="old_pic" value="<?= $emp['id_pic']?>" required>

            <br>
            <table style="width: 100%">
              <thead>
                <tr>
                  <th></th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Surname:</td>
                  <td><input class="form-control" type="text" name="l_name" placeholder="surname" value="<?= ucfirst($emp['l_name'])?>" required></td>
                </tr>
                <tr>
                  <td>First Name:</td>
                  <td><input class="form-control" type="text" name="f_name" placeholder="first name" value="<?= ucfirst($emp['f_name'])?>" required></td>
                </tr>
                <tr>
                  <td>Middle Name:</td>
                  <td><input class="form-control" type="text" name="m_name" placeholder="middle name" value="<?= ucfirst($emp['m_name'])?>"></td>
                </tr>
                <tr>
                  <td>Department:</td>
                  <td>            
                    <select class="form-control" id="departments" name="department" required>
                    <option value="<?= $emp['department_id']?>" selected hidden><?= $this->Users_model->get_department_name($emp['department_id'])['name']?></option>
                      <?php foreach($departments as $department):
                        if($department['id'] != $emp['department_id']){?>
                        <option value="<?= $department['id']?>"><?= $department['name']?></option>
                      <?php }endforeach ?>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td>Designation:</td>
                  <td>
                    <select class="form-control" id="designation" name ="designation" required>
                      <option value="<?= $emp['designation_id']?>" selected hidden><?= $this->Users_model->get_designation_name($emp['designation_id'])['name']?></option>
                      <?php foreach($designations as $designation):
                        if($designation['id'] != $emp['designation_id']) {?>
                          <option value="<?= $designation['id']?>"><?= $designation['name']?></option>
                      <?php } endforeach ?>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td>Employment Status:</td>
                  <td>
                    <select class="form-control" id="status_edit" name="status" required>
                      <option value="<?=$emp['status']?>" selected hidden><?= $emp['status']?></option>
                      <option value="Regular">Permanent</option>
                      <option value="Irregular">JO</option>
                      <option value="Casual">Casual</option>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td>Sex:</td>
                  <td>
                    <select class="form-control" id="sex" name="sex" required>
                      <option value="<?=$emp['sex']?>" selected hidden><?= $emp['sex']?></option>
                      <option value="Male">Male</option>
                      <option value="Female">Female</option>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td>Birthday:</td>
                  <td><input class="form-control" type="date" name="bday" value="<?= $emp['bday']?>" required></td>
                </tr>
                <tr>
                  <td>Place of Birth:</td>
                  <td><input class="form-control" type="text" name="birth_place" placeholder="Place of Birth" value="<?= ucfirst($emp['birth_place'])?>" required></td>
                </tr>
                <tr>
                  <td>Purok:</td>
                  <td><input class="form-control" type="text" name="purok" placeholder="purok" value="<?= ucfirst($emp['purok'])?>"></td>
                </tr>
                <tr>
                  <td>Barangay:</td>
                  <td><input class="form-control" type="text" name="brgy" placeholder="barangay" value="<?= ucfirst($emp['brgy'])?>" required></td>
                </tr>
                <tr>
                  <td>Municipality:</td>
                  <td><input class="form-control" type="text" name="municipality" placeholder="municipality" value="<?= ucfirst($emp['municipality'])?>" required></td>
                </tr>
                <tr>
                  <td>Province:</td>
                  <td><input class="form-control" type="text" name="province" placeholder="province" value="<?= ucfirst($emp['province'])?>" required></td>
                </tr>
                <tr>
                  <td>ZIP Code:</td>
                  <td><input class="form-control" type="number" name="zip" placeholder="zip code" value="<?= $emp['zip']?>" required></td>
                </tr>
                <tr>
                  <td>Date Hired:</td>
                  <td><input class="form-control" type="date" name="date_hired" value="<?= $emp['date_hired']?>" required></td>
                </tr>
                <tr>
                  <td>Plantilla:</td>
                  <td><input class="form-control" type="number" name="plantilla" value="<?= $emp['plantilla']?>" placeholder="plantilla number"></td>
                </tr>
                <tr>
                  <td>Education:</td>
                  <td>
                    <select class="form-control" name="education" id="education" required>
                      <option value="<?=$emp['education']?>" selected hidden><?= $emp['education']?></option>
                      <option value="Elementary">Elementary</option>
                      <option value="JHS">JHS</option>
                      <option value="SHS">SHS</option>
                      <option value="Bachelor's Degree">Bachelor's Degree</option>
                      <option value="Post Graduate">Post Graduate</option>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td>School Name:</td>
                  <td><input class="form-control" type="text" name="school" placeholder="School Name" value="<?= ucwords($emp['school'])?>" required></td>
                </tr>
                <tr>
                  <td>PRC Number:</td>
                  <td><input class="form-control" type="number" name="prc" value="<?= $emp['prc']?>" placeholder="PRC Number"></td>
                </tr>
                <tr>
                  <td>PRC Date of Registration:</td>
                  <td><input class="form-control" type="date" name="prc_reg" value="<?= $emp['prc_reg']?>"></td>
                </tr>
                <tr>
                  <td>PRC Date of Expiry:</td>
                  <td><input class="form-control" type="date" name="prc_exp" value="<?= $emp['prc_exp']?>"></td>
                </tr>
                <tr>
                  <td>PhilHealth Number:</td>
                  <td><input class="form-control" type="number" name="philhealth" value="<?= $emp['philhealth']?>" placeholder="philhealth number"/></td>
                </tr>
                <tr>
                  <td>Contact Number:</td>
                  <td><input class="form-control" type="number" name="phone" placeholder="contact number" value="<?= $emp['phone']?>" required></td>
                </tr>
                <tr>
                  <td>Marital Status:</td>
                  <td>
                    <select class="form-control" name="marital_status" id="marital_status" required>
                      <option value="<?=$emp['marital_status']?>" selected hidden><?= $emp['marital_status']?></option>
                      <option value="Single">Single</option>
                      <option value="Married">Married</option>
                      <option value="Separated">Separated</option>
                      <option value="Divorced">Divorced</option>
                      <option value="Widowed">Widowed</option>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td>GSIS Number:</td>
                  <td><input class="form-control" type="number" name="gsis" placeholder="gsis number" value="<?= $emp['gsis']?>"></td>
                </tr>
                <tr>
                  <td>SSS Number:</td>
                  <td><input class="form-control" type="number" name="sss" placeholder="sss number" value="<?= $emp['sss']?>"></td>
                </tr>
                <tr>
                  <td>Pag-Ibig Number:</td>
                  <td><input class="form-control" type="number" name="pag_ibig" placeholder="pag-ibig number" value="<?= $emp['pag_ibig']?>"></td>
                </tr>
                <tr>
                  <td>TIN Number:</td>
                  <td><input class="form-control" type="number" name="tin" placeholder="tin number" value="<?= $emp['tin']?>" required></td>
                </tr>
                <tr>
                  <td>ATM Number:</td>
                  <td><input class="form-control" type="number" name="atm" placeholder="atm number" value="<?= $emp['atm']?>" required></td>
                </tr>
                <tr>
                  <td>Blood Type:</td>
                  <td>
                    <select class="form-control" name="blood_type" required>
                      <option value="<?=$emp['blood_type']?>" selected hidden><?= $emp['blood_type']?></option>
                      <option value="A+">A+</option>
                      <option value="A-">A-</option>
                      <option value="B+">B+</option>
                      <option value="B-">B-</option>
                      <option value="AB+">AB+</option>
                      <option value="AB-">AB-</option>
                      <option value="O+">O+</option>
                      <option value="O-">O-</option>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td>Email:</td>
                  <td><input class="form-control" type="email" name="email" placeholder="email" value="<?= $emp['email']?>" required></td>
                </tr>
                <tr>
                  <td>Remarks:</td>
                  <td><textarea class="form-control" name="remarks" cols="30" rows="10" placeholder="Remarks"><?= $emp['remarks']?></textarea></td>
                </tr>
              </tbody>
            </table>
          </div>

          <!-- submit -->
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save Changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>
<?php endforeach ?>

<script>
function filter(){
  document.getElementById('filter').submit();
}

$(document).ready(function () {
    $('#employee_tbl').DataTable({
      "order": [],
    });
});

function disablePlantilla(){
  let status = document.getElementById('status').value;
  let plantilla = document.getElementById('plantilla').style;

  if(status == "irregular"){
    plantilla.display = "none";
  } else {
    plantilla.display = "block";
  }
}
</script>