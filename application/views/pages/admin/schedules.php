
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
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Add Schedule
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <!-- main submit form -->
      <form action="<?= base_url();?>users/add_schedule" method="post">
        <div class="modal-body">

        <!-- select employee -->
          <label for="employee">Select Employee:</label>
          <select name="employee" id="emnployee" required>
            <?php foreach($employees as $employee):?>
              <option value="<?= $employee['id']?>"><?= $employee['l_name'] . ', ' . $employee['f_name'] .  ' ' . $employee['m_name']?></option>
            <?php endforeach?>
          </select>

          <br>
          <label for="datePick">Select Dates: </label>
          <input type="text" id="datePick" name="date" required/>

          <br>
          <label for="time_in">Time In:</label>
          <input type="time" name="time_in" id="time_in">
          <br>
          <label for="time_in">Time Out:</label>
          <input type="time" name="time_out" id="time_out">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Add Schedule</button>
        </div>
      </form>
    </div>
  </div>
</div>


 <table id='schedules'>
  <thead>
    <tr>
      <th>Employee ID</th>
      <th>Name</th>
      <th>Date</th>
      <th>Time In</th>
      <th>Time Out</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($schedules as $schedule):?>
      <tr>
        <td><?= $schedule['emp_id']?></td>
        <td><?= $schedule['l_name'] . ', ' . $schedule['f_name'] . ' ' . $schedule['m_name']?></td>
        <td><?= $schedule['date']?></td>
        <td><?= $schedule['time_in']?></td>
        <td><?= $schedule['time_out']?></td>
      </tr>
    <?php endforeach ?>
  </tbody>
 </table>
  <script>
    $(document).ready(function () {
      $('#datePick').multiDatesPicker(
        { dateFormat: 'yy-m-d' }
      );
    });

    $(document).ready(function () {
    $('#schedules').DataTable();
});
  </script>