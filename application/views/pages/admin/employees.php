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
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

        <!-- employee info -->
        <div class="modal-body">
        <form action="<?= base_url()?>users/add_emp" method="post" enctype="multipart/form-data">

          <label for="profile_pic">Employee Picture:</label>
          <input type="file" name="profile_pic" accept="image/*" placeholder="profile_pic">
          
          <input type="text" name="id" placeholder="employee id" required>

          <br>
          <input type="text" name="l_name" placeholder="surname" required>

          <br>
          <input type="text" name="f_name" placeholder="first name" required>

          <br>
          <input type="text" name="m_name" placeholder="middle name">

          <br>
          <label for="departments">Department:</label>
          <select id="departments" name="department" required>
            <?php foreach($departments as $department):?>
              <option value="<?= $department['id']?>"><?= $department['name']?></option>
            <?php endforeach ?>
          </select>

          <br>
          <label for="designation">Designation:</label>
          <select id="designation" name ="designation" required>
            <?php foreach($designations as $designation):?>
              <option value="<?= $designation['id']?>"><?= $designation['name']?></option>
            <?php endforeach ?>
          </select>

          <br>
          <label for="status">Employment Status:</label>
          <select id="status" name="status" required>
            <option value="regular">Regular</option>
            <option value="irregular">Irregular</option>
          </select>

          <br>
          <label for="sex">Sex:</label>
          <select id="sex" name="sex" required>
            <option value="male">Male</option>
            <option value="female">Female</option>
          </select>

          <br>
          <label for="bday">Birthday:</label>
          <input type="date" name="bday" required>

          <br>
          <input type="text" name="birth_place" placeholder="Place of Birth" required>

          <br>
          <label for="">Address:</label>

          <br>
          <input type="text" name="purok" placeholder="purok">

          <br>
          <input type="text" name="brgy" placeholder="barangay" required>
          
          <br>
          <input type="text" name="municipality" placeholder="municipality" required>
          
          <br>
          <input type="text" name="province" placeholder="province" required>
          
          <br>
          <input type="number" name="zip" placeholder="zip code" required>

          <br>
          <label for="">Date Hired:</label>
          <input type="date" name="date_hired" required>

          <br>
          <input type="number" name="plantilla" placeholder="plantilla number">

          <br>
          <label for="education">Education:</label>
          <select name="education" id="education" required>
            <option value="elem">Elementary</option>
            <option value="jhs">Junior High</option>
            <option value="shs">Senior High</option>
            <option value="bachelors">Bachelor's Degree</option>
            <option value="post_grad">Post Graduate Degree</option>
          </select>

          <input type="text" name="school" placeholder="School Name" required>

          <br>
          <input type="number" name="prc" placeholder="PRC Number">

          <label for="">Date of Registration:</label>
          <input type="date" name="prc_reg">

          <label for="">Date of Expiry:</label>
          <input type="date" name="prc_exp">

          <br>
          <input type="number" name="philhealth" placeholder="philhealth number"/>

          <br>
          <input type="number" name="phone" placeholder="contact number" required>

          <br>
          <label for="marital_status">Marital Status:</label>
          <select name="marital_status" id="marital_status" required>
            <option value="single">Single</option>
            <option value="married">Married</option>
            <option value="separated">Separated</option>
            <option value="divorced">Divorced</option>
            <option value="widowed">Widowed</option>
          </select>

          <br>
          <input type="number" name="gsis" placeholder="gsis number">

          <br>
          <input type="number" name="sss" placeholder="sss number">

          <br>
          <input type="number" name="pag_ibig" placeholder="pag-ibig number">

          <br>
          <input type="number" name="tin" placeholder="tin number" required>

          <br>
          <input type="number" name="atm" placeholder="atm number" required>

          <br>
          <label for="">Blood Type:</label>
          <select name="blood_type" required>
            <option value="A+">A+</option>
            <option value="A-">A-</option>
            <option value="B+">B+</option>
            <option value="B-">B-</option>
            <option value="AB+">AB+</option>
            <option value="AB-">AB-</option>
            <option value="O+">O+</option>
            <option value="O-">O-</option>
          </select>

          <br>
          <input type="email" name="email" placeholder="email" email>

          <br>
          <textarea name="remarks" cols="30" rows="10" placeholder="remarks"></textarea>
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

<table id="employee_tbl" class="table table-striped" style="width:100%">
  <thead>
    <tr>
      <th>Employee ID</th>
      <th>Last Name</th>
      <th>First Name</th>
      <th>Middle Name</th>
      <th>Action</th>
    </tr>
  </thead>

  <tbody>
    <?php foreach($employees as $emp):?>
      <tr>
        <td><?=$emp['id']?></td>
        <td><?=$emp['l_name']?></td>
        <td><?=$emp['f_name']?></td>
        <td><?=$emp['m_name']?></td>
        <td>
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
          <h1 class="modal-title fs-5" id="emp<?= $emp['id']?>Label">Cats</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

          <!-- employee info -->
          <div class="modal-body">
          <form action="<?= base_url()?>users/edit_emp" method="post" enctype="multipart/form-data">

            <label for="profile_pic">Employee Picture:</label>
            <input type="file" name="profile_pic" accept="image/*" placeholder="profile_pic">
            
            <input type="hidden" name="id" placeholder="employee id" value="<?= $emp['id']?>" required>

            <input type="hidden" name="old_pic" value="<?= $emp['id_pic']?>" required>

            <br>
            <input type="text" name="l_name" placeholder="surname" value="<?= $emp['l_name']?>" required>

            <br>
            <input type="text" name="f_name" placeholder="first name" value="<?= $emp['f_name']?>" required>

            <br>
            <input type="text" name="m_name" placeholder="middle name" value="<?= $emp['m_name']?>">

            <br>
            <label for="departments">Department:</label>
            <select id="departments" name="department" required>
              <?php foreach($departments as $department):?>
                <option value="<?= $department['id']?>"><?= $department['name']?></option>
              <?php endforeach ?>
            </select>

            <br>
            <label for="designation">Designation:</label>
            <select id="designation" name ="designation" required>
              <?php foreach($designations as $designation):?>
                <option value="<?= $designation['id']?>"><?= $designation['name']?></option>
              <?php endforeach ?>
            </select>

            <br>
            <label for="status">Employment Status:</label>
            <select id="status" name="status" required>
              <option value="regular">Regular</option>
              <option value="irregular">Irregular</option>
            </select>

            <br>
            <label for="sex">Sex:</label>
            <select id="sex" name="sex" required>
              <option value="male">Male</option>
              <option value="female">Female</option>
            </select>

            <br>
            <label for="bday">Birthday:</label>
            <input type="date" name="bday" value="<?= $emp['bday']?>" required>

            <br>
            <input type="text" name="birth_place" placeholder="Place of Birth" value="<?= $emp['birth_place']?>" required>

            <br>
            <label for="">Address:</label>

            <br>
            <input type="text" name="purok" placeholder="purok" value="<?= $emp['purok']?>">

            <br>
            <input type="text" name="brgy" placeholder="barangay" value="<?= $emp['brgy']?>" required>
            
            <br>
            <input type="text" name="municipality" placeholder="municipality" value="<?= $emp['municipality']?>" required>
            
            <br>
            <input type="text" name="province" placeholder="province" value="<?= $emp['province']?>" required>
            
            <br>
            <input type="number" name="zip" placeholder="zip code" value="<?= $emp['zip']?>" required>

            <br>
            <label for="">Date Hired:</label>
            <input type="date" name="date_hired" value="<?= $emp['date_hired']?>" required>

            <br>
            <input type="number" name="plantilla" value="<?= $emp['plantilla']?>" placeholder="plantilla number">

            <br>
            <label for="education">Education:</label>
            <select name="education" id="education" required>
              <option value="elem">Elementary</option>
              <option value="jhs">Junior High</option>
              <option value="shs">Senior High</option>
              <option value="bachelors">Bachelor's Degree</option>
              <option value="post_grad">Post Graduate Degree</option>
            </select>

            <input type="text" name="school" placeholder="School Name" value="<?= $emp['school']?>" required>

            <br>
            <input type="number" name="prc" value="<?= $emp['prc']?>" placeholder="PRC Number">

            <label for="">Date of Registration:</label>
            <input type="date" name="prc_reg" value="<?= $emp['prc_reg']?>">

            <label for="">Date of Expiry:</label>
            <input type="date" name="prc_exp" value="<?= $emp['prc_exp']?>">

            <br>
            <input type="number" name="philhealth" value="<?= $emp['philhealth']?>" placeholder="philhealth number"/>

            <br>
            <input type="number" name="phone" placeholder="contact number" value="<?= $emp['phone']?>" required>

            <br>
            <label for="marital_status">Marital Status:</label>
            <select name="marital_status" id="marital_status" required>
              <option value="single">Single</option>
              <option value="married">Married</option>
              <option value="separated">Separated</option>
              <option value="divorced">Divorced</option>
              <option value="widowed">Widowed</option>
            </select>

            <br>
            <input type="number" name="gsis" placeholder="gsis number" value="<?= $emp['gsis']?>">

            <br>
            <input type="number" name="sss" placeholder="sss number" value="<?= $emp['sss']?>">

            <br>
            <input type="number" name="pag_ibig" placeholder="pag-ibig number" value="<?= $emp['pag_ibig']?>">

            <br>
            <input type="number" name="tin" placeholder="tin number" value="<?= $emp['tin']?>" required>

            <br>
            <input type="number" name="atm" placeholder="atm number" value="<?= $emp['atm']?>" required>

            <br>
            <label for="">Blood Type:</label>
            <select name="blood_type" required>
              <option value="A+">A+</option>
              <option value="A-">A-</option>
              <option value="B+">B+</option>
              <option value="B-">B-</option>
              <option value="AB+">AB+</option>
              <option value="AB-">AB-</option>
              <option value="O+">O+</option>
              <option value="O-">O-</option>
            </select>

            <br>
            <input type="email" name="email" placeholder="email" value="<?= $emp['email']?>" required>

            <br>
            <textarea name="remarks" cols="30" rows="10" placeholder="remarks"><?= $emp['remarks']?></textarea>
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
$(document).ready(function () {
    $('#employee_tbl').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'pdf' 
        ]
    }
    );
});
</script>