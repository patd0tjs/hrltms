<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Apply For Leave
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Apply For Leave</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?= base_url()?>dateandtime/request_leave" method="post">
        <div class="modal-body">

            <label for="employee">Select Employee:</label>
            <select name="emp_id" id="emnployee" required>
                <?php foreach($employees as $employee):?>
                <option value="<?= $employee['id']?>"><?= $employee['l_name'] . ', ' . $employee['f_name'] .  ' ' . $employee['m_name']?></option>
                <?php endforeach?>
            </select>

            <br>
            <label for="nature">Nature of Leave: </label>
            <select name="nature" id="nature" required>
              <option value="Vacation Leave">Vacation Leave - Any Date</option>
              <option value="Maandatory/Force Leave">Maandatory/Force Leave - Any Date</option>
              <option value="Sick Leave">Sick Leave - Any Date</option>
              <option value="Maternity Leave">Maternity Leave - 105 Days</option>
              <option value="Paternity Leave">Paternity Leave - 7 Days</option>
              <option value="Social Privilege Leave">Social Privilege Leave - 3 Days</option>
              <option value="Solo Parent Leave">Solo Parent Leave - 7 Days</option>
              <option value="Study Leave">Study Leave - Up to 6 Months</option>
              <option value="VAWC Leave">VAWC Leave - 10 Days</option>
              <option value="Rehabilitation Leave">Rehabilitation Leave - Up to 6 Months</option>
              <option value="Special Leave Benefits for Women">Special Leave Benefits for Women - Up to 2 Months</option>
              <option value="Special Emergency (Calamity) Leave">Special Emergency (Calamity) Leave - Up to 5 Days</option>
              <option value="Monetization of Leave Credit">Monetization of Leave Credits - Any Date</option>
              <option value="Terminal Leave">Terminal Leave - Any Date</option>
              <option value="Adoption Leave">Adoption Leave - Any Date</option>
            </select>

            <br>
            <label for="s_date">Start Date: </label>
            <input type="date" name="s_date" id="s_date" required>

            <br>
            <label for="e_date">End Date: </label>
            <input type="date" name="e_date" id="e_date" required>
        </div>
        <div class="modal-footer">
            <input type="hidden" name="status" value="approved">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Send Request</button>
        </div>
      </form>
    </div>
  </div>
</div>
<h3>Pending</h3>
 <table id='pending' class="table table-striped" style="width: 100%">
    <thead>
        <tr>
            <th>Employee ID</th>
            <th>Employee Name</th>
            <th>Nature</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Date Filed</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($pending as $request):?>
        <tr>
            <td><?= $request['emp_id']?></td>
            <td>
                <?= $request['l_name'] . ', ' . $request['f_name'] . ' ' . $request['m_name']?>
            </td>
            <td><?= $request['nature']?></td>
            <?php 
              $time = strtotime($request['s_date']);
              $leave_s_date = date('M d, Y',$time);
            ?>
            <td><?= $leave_s_date?></td>
            <?php 
              $time = strtotime($request['e_date']);
              $leave_e_date = date('M d, Y',$time);
            ?>
            <td><?= $leave_e_date?></td>

            <?php 
              $time = strtotime($request['date_filed']);
              $leave_date_filed = date('M d, Y',$time);
            ?>
            <td><?= $leave_date_filed?></td>
            <td>
                <form action="<?= base_url()?>dateandtime/approve_leave" method="post">
                    <input type="hidden" name="id" value="<?= $request['id']?>">
                    <button class="btn btn-success" onclick="return confirm('Confirm leave approval?')">Approve</button>
                </form>
            </td>
        </tr>
        <?php endforeach ?>
    </tbody>
 </table>

 <h3>Approved</h3>
 <table id='approved' class="table table-striped" style="width: 100%">
    <thead>
        <tr>
            <th>Employee ID</th>
            <th>Employee Name</th>
            <th>Nature</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Date Filed</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($approved as $leave):?>
        <tr>
            <td><?= $leave['emp_id']?></td>
            <td>
                <?= $leave['l_name'] . ', ' . $leave['f_name'] . ' ' . $leave['m_name']?>
            </td>
            <td><?= $leave['nature']?></td>
            <?php 
              $time = strtotime($leave['s_date']);
              $s_date = date('M d, Y',$time);
            ?>
            <td><?= $s_date?></td>
            <?php 
              $time = strtotime($leave['e_date']);
              $e_date = date('M d, Y',$time);
            ?>
            <td><?= $e_date?></td>

            <?php 
              $time = strtotime($leave['date_filed']);
              $date_filed = date('M d, Y',$time);
            ?>
            <td><?= $date_filed?></td>
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
    $('#pending').DataTable();
});

$(document).ready(function () {
    $('#approved').DataTable();
});
  </script>