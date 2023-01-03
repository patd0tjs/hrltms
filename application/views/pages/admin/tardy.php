<?php if ($this->session->flashdata('error')){?>

<div class="alert alert-danger alert-dismissible fade show" role="alert" id="alert">
    <?= $this->session->flashdata('error')?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

<?php } ?>

<button style="margin-bottom: 10px;" type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exportTardy">
  Export
</button>

<div class="modal fade" id="exportTardy" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exportTardyLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exportTardyLabel">Tardy Report</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?= base_url()?>reports/export_tardy" method="post">
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label" for="s_date">From: </label>
            <input class="form-control" type="date" name="s_date" id="s_date" required>
          </div>

          <div class="mb-3">
            <label class="form-label" for="e_date">To: </label>
            <input class="form-control" type="date" name="e_date" id="e_date" required>
          </div>

          <div class="modal-footer">
            <input type="hidden" name="status" value="approved">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Download</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<table id='tardy' class="table table-striped" style="width: 100%">
  <thead>
    <tr>
      <th>Employee ID</th>
      <th>Name</th>
      <th>Designation</th>
      <th>Date</th>
      <th>Deficiency</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($tardies as $tardy):?>
      <tr>
        <td><?= $tardy['emp_id']?></td>
        <td><?= $tardy['l_name'] . ', ' . $tardy['f_name'] . ' ' . $tardy['m_name']?></td>
        <td><?= $tardy['designation']?></td>
        <?php 
          $time = strtotime($tardy['date']);
          $newformat = date('M d, Y',$time);
        ?>
        <td><?= $newformat?></td>
        <td><?= $tardy['diff']?></td>
      </tr>
    <?php endforeach ?>
  </tbody>
 </table>

 <script>
$(document).ready(function () {
    $('#tardy').DataTable();
});
</script>