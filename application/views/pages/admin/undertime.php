<table id='undertime' class="table table-striped" style="width: 100%">
  <thead>
    <tr>
      <th>Employee ID</th>
      <th>Name</th>
      <th>Date</th>
      <th>Deficiency</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($undertimes as $undertime):?>
      <tr>
        <td><?= $undertime['emp_id']?></td>
        <td><?= $undertime['l_name'] . ', ' . $undertime['f_name'] . ' ' . $undertime['m_name']?></td>
        <td><?= $undertime['date']?></td>
        <td><?= $undertime['diff']?></td>
      </tr>
    <?php endforeach ?>
  </tbody>
 </table>

 <script>
$(document).ready(function () {
    $('#undertime').DataTable();
});
</script>