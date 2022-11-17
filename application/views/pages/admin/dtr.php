<?php if ($this->session->flashdata('error')){?>

<div class="alert alert-danger alert-dismissible fade show" role="alert" id="alert">
    <?= $this->session->flashdata('error')?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

<?php } ?>
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    add dtr
</button>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form action="<?= base_url()?>dateandtime/add_dtr" method="post">
        <div class="modal-body">
            <label for="employee">Select Employee:</label>
            <select name="employee" id="employee" required>
                <?php foreach($employees as $employee):?>
                <option value="<?= $employee['id']?>"><?= $employee['l_name'] . ', ' . $employee['f_name'] .  ' ' . $employee['m_name']?></option>
                <?php endforeach?>
            </select>

            <br>
            <label for="date">Date: </label>
            <input type="date" name="date" id="date">

            <br>
            <label for="am_in">Time In (AM)</label>
            <input type="time" name="am_in" id="am_in">

            <br>
            <label for="am_out">Time Out (AM)</label>
            <input type="time" name="am_out" id="am_out">

            <br>
            <label for="pm_in">Time In (PM)</label>
            <input type="time" name="pm_in" id="pm_in">

            <br>
            <label for="pm_out">Time Out (PM)</label>
            <input type="time" name="pm_out" id="pm_out">
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
            <th rowspan="2">Employee ID</th>
            <th rowspan="2">Employee Name</th>
            <th rowspan="2">Date</th>
            <th colspan="2">AM</th>
            <th colspan="2">PM</th>
        </tr>
        <tr>
            <td>Time In</td>
            <td>Time Out</td>
            <td>Time in</td>
            <td>Time Out</td>
        </tr>
    </thead>
    <tbody>
        <?php foreach($dtr as $emp_dtr):?>
            <tr>
                <td><?= $emp_dtr['emp_id']?></td>
                <td><?= $emp_dtr['l_name'] . ', ' . $emp_dtr['f_name'] . ' ' . $emp_dtr['m_name']?></td>
                <?php 
                $time = strtotime($emp_dtr['date']);
                $newformat = date('M d, Y',$time);
                ?>
                <td><?= $newformat?></td>
                <td><?= date('g:i a', strtotime($emp_dtr['am_in']))?></td>
                <td><?= date('g:i a', strtotime($emp_dtr['am_out']))?></td>
                <td><?= date('g:i a', strtotime($emp_dtr['pm_in']))?></td>
                <td><?= date('g:i a', strtotime($emp_dtr['pm_out']))?></td>
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

