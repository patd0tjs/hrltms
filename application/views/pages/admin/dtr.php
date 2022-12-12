<?php if ($this->session->flashdata('error')){?>

<div class="alert alert-danger alert-dismissible fade show" role="alert" id="alert">
    <?= $this->session->flashdata('error')?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

<?php } ?>
<button style="margin-bottom: 10px;" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Add DTR
</button>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add DTR</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form action="<?= base_url()?>dateandtime/add_dtr" method="post">
        <div class="modal-body">

        <div class="mb-3">
            <label class="form-label" for="employee">Select Employee:</label>
            <select class="form-control" name="employee" id="employee" required>
                <?php foreach($employees as $employee):?>
                <option value="<?= $employee['id']?>"><?= $employee['l_name'] . ', ' . $employee['f_name'] .  ' ' . $employee['m_name']?></option>
                <?php endforeach?>
            </select></div>

            <div class="mb-3">
            <label for="date" class="form-label">Date: </label>
            <input type="date" name="date" id="date" class="form-control"></div>

            <div class="mb-3">
            <label for="time_in" class="form-label">Time In:</label>
            <input type="time" name="time_in" id="time_in" class="form-control"></div>

            <div class="mb-3">
            <label for="time_out" class="form-label">Time Out:</label>
            <input type="time" name="time_out" class="form-control" id="time_out"></div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Add DTR</button>
        </div>
      </form>
    </div>
  </div>
</div>

<table id="dtr" class="table table-striped" style="width: 100%; text-align: center">
    <thead>
        <tr>
            <th>Employee ID</th>
            <th>Employee Name</th>
            <th>Designation</th>
            <th>Start Date</th>
            <th>End Date</th>
            <td>Time In</td>
            <td>Time Out</td>
        </tr>
    </thead>
    <tbody>
        <?php foreach($dtr as $emp_dtr):?>
            <tr>
                <td><?= $emp_dtr['emp_id']?></td>
                <td><?= $emp_dtr['l_name'] . ', ' . $emp_dtr['f_name'] . ' ' . $emp_dtr['m_name']?></td>
                <td><?= $emp_dtr['designation']?></td>
                <?php 
                $time = strtotime($emp_dtr['s_date']);
                $newformat = date('M d, Y',$time);
                ?>
                <td><?= $newformat?></td>
        
                <?php 
                $time = strtotime($emp_dtr['e_date']);
                $newformat_e = date('M d, Y',$time);
                ?>
                <td><?= $newformat_e?></td>
                <td><?= date('g:i a', strtotime($emp_dtr['time_in']))?></td>
                <td><?= date('g:i a', strtotime($emp_dtr['time_out']))?></td>
            </tr>
        <?php endforeach?>
    </tbody>
</table>

<script>
$(document).ready(function () {
    $('#dtr').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'pdf' 
        ]
    });
});
</script>

