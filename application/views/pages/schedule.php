<table id='schedules' class="table table-striped" style="width: 100%">
  <thead>
    <tr>
      <th>Start Date</th>
      <th>End Date</th>
      <th>Time In</th>
      <th>Time Out</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($my_schedules as $schedule):?>
      <tr>
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
      </tr>
    <?php endforeach ?>
  </tbody>
 </table>

 <script>
$(document).ready(function () {
    $('#schedules').DataTable({
      "order": [],
    });
});
 </script>