<?php if ($this->session->flashdata('error')){?>

<div class="alert alert-danger alert-dismissible fade show" role="alert" id="alert">
    <?= $this->session->flashdata('error')?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

<?php } ?>
<style>
.ui-state-highlight {
  border: 0 !important;
}
 
.ui-state-highlight a {
  background: #363636 !important;
  color: #fff !important;
}
</style>
 

<!-- Button trigger modal -->
<button style="margin-bottom: 10px;" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Add Schedule
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Schedule</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <!-- main submit form -->
      <form action="<?= base_url();?>dateandtime/add_schedule" method="post">
        <div class="modal-body">

        <!-- select employee -->
        <div class="mb-3">
          <label class="form-label" for="employee">Select Employee:</label>
          <select class="form-control" name="employee" id="emnployee" required>
            <?php foreach($employees as $employee):?>
              <option value="<?= $employee['id']?>"><?= $employee['l_name'] . ', ' . $employee['f_name'] .  ' ' . $employee['m_name']?></option>
            <?php endforeach?>
          </select></div>

          <div class="mb-3">
          <label class="form-label" for="datePick">Select Dates: </label>
          <input class="form-control" type="text" id="datePick" name="date" required/></div>

          <div class="mb-3">
          <label class="form-label" for="time_in">Time In:</label>
          <input class="form-control" type="time" name="time_in" id="time_in"></div>
          
          <div class="mb-3">
          <label class="form-label" for="time_in">Time Out:</label>
          <input class="form-control" type="time" name="time_out" id="time_out"></div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Add Schedule</button>
        </div>
      </form>
    </div>
  </div>
</div>


 <table id='schedules' class="table table-striped" style="width: 100%">
  <thead>
    <tr>
      <th>Employee ID</th>
      <th>Name</th>
      <th>Designation</th>
      <th>Start Date</th>
      <th>End Date</th>
      <th>Time In</th>
      <th>Time Out</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($schedules as $schedule):?>
      <tr>
        <td><?= $schedule['emp_id']?></td>
        <td><?= $schedule['l_name'] . ', ' . $schedule['f_name'] . ' ' . $schedule['m_name']?></td>
        <td><?= $schedule['designation']?></td>
        <?php 
          $s_date = strtotime($schedule['s_date']);
          $new_s_date = date('M d, Y',$s_date);
        ?>
        <td><?= $new_s_date?></td>

        <?php 
          $e_date = strtotime($schedule['e_date']);
          $new_e_date = date('M d, Y',$e_date);
        ?>
        <td><?= $new_e_date?></td>

        <td><?= date('g:i a', strtotime($schedule['time_in']))?></td>
        <td><?= date('g:i a', strtotime($schedule['time_out']))?></td>
        <td>
          <button style="margin-bottom: 5px;" type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#sched<?= $schedule['id']?>">
            Edit
          </button>
          <?= form_open('dateandtime/delete_sched');?>
            <input type="hidden" value="<?= $schedule['id']?>" name="id">
            <button class="btn btn-danger btn-sm" type="sumbit">
              Delete
            </button>
          </form>
        </td>
      </tr>
    <?php endforeach ?>
  </tbody>
 </table>

 <?php foreach($schedules as $schedule):?>
  <div class="modal fade" id="sched<?= $schedule['id']?>" data-bs-backdrop="static" tabindex="-1" aria-labelledby="sched<?= $schedule['id']?>Label" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="sched<?= $schedule['id']?>Label">Update Schedule</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <!-- main submit form -->
        <form action="<?= base_url();?>dateandtime/change_schedule" method="post">
          <div class="modal-body">

          <!-- select employee -->
          <div class="mb-3">
            <label class="form-label" for="employee">Employee:</label>
            <input class="form-control" type="text" value="<?= $schedule['l_name'] . ', ' . $schedule['f_name'] .  ' ' . $schedule['m_name']?>" disabled></div>

            <div class="mb-3">
            <label class="form-label" for="datePick">Start Date: </label>
            <input class="form-control" type="date" id="datePick" name="s_date" value="<?= $schedule['s_date']?>" required/></div>

            <div class="mb-3">
            <label class="form-label" for="datePick">End Date: </label>
            <input class="form-control" type="date" id="datePick" name="e_date" value="<?= $schedule['e_date']?>" required/></div>

            <div class="mb-3">
            <label class="form-label" for="time_in">Time In:</label>
            <input class="form-control" type="time" name="time_in" id="time_in" value="<?= $schedule['time_in']?>"></div>
            
            <div class="mb-3">
            <label class="form-label" for="time_in">Time Out:</label>
            <input class="form-control" type="time" name="time_out" id="time_out" value="<?= $schedule['time_out']?>"></div>

          </div>

          <div class="modal-footer">
            <input type="hidden" value="<?= $schedule['id']?>" name="id">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Update Schedule</button>
          </div>
        </form>
      </div>
    </div>
  </div>
<?php endforeach?>
  <script>
    $(document).ready(function () {
      $('#datePick').multiDatesPicker(
        { dateFormat: 'yy-m-d' }
      );
    });

    $(document).ready(function () {
    $('#schedules').DataTable(
      {
        dom: 'Bfrtip',
        buttons: [
            'pdf' 
        ]
    }
    );
});
  </script>

  