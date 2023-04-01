<?php if ($this->session->flashdata('error')){?>

<div class="alert alert-danger alert-dismissible fade show" role="alert" id="alert">
    <?= $this->session->flashdata('error')?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

<?php } ?>

<button style="margin-bottom: 10px;" type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exportUndertime">
  Export
</button>

<div class="modal fade" id="exportUndertime" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exportUndertimeLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exportUndertimeLabel">Undertime Report</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?= base_url()?>reports/export_undertime" method="post">
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
<table id='undertime' class="table table-striped" style="width: 100%">
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
    <?php foreach($undertimes as $undertime):?>
      <tr>
        <td><?= $undertime['emp_id']?></td>
        <td><?= ucfirst($undertime['l_name']) . ', ' . ucfirst($undertime['f_name']) . ' ' . ucfirst($undertime['m_name'])?></td>
        <td><?= $undertime['designation']?></td>
        <?php 
          $time = strtotime($undertime['date']);
          $newformat = date('M d, Y',$time);
        ?>
        <td><?= $newformat?></td>
        <td><?= $undertime['diff']?></td>
      </tr>
    <?php endforeach ?>
  </tbody>
 </table>

 <script>
$(document).ready(function () {
    $('#undertime').DataTable({
      "order": [],
    });
});
</script>