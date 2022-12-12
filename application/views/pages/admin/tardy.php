<?php if ($this->session->flashdata('error')){?>

<div class="alert alert-danger alert-dismissible fade show" role="alert" id="alert">
    <?= $this->session->flashdata('error')?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

<?php } ?>
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
    $('#tardy').DataTable(
      {
        dom: 'Bfrtip',
        buttons: [
            'pdf' 
        ]
    }
    );
});
</script>