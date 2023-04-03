<div class="btn-group" role="group" aria-label="Basic radio toggle button group">
  <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" onclick="showPending()" checked>
  <label class="btn btn-outline-warning" for="btnradio1">Pending</label>

  <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off" onclick="showApproved()">
  <label class="btn btn-outline-success" for="btnradio2">Approved</label>
</div>

<br>
<br>

<div id="pending_section">
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

          <div class="mb-3">
              <label class="form-label" for="nature">Nature of Leave: </label>
              <select class="form-control" name="nature" id="nature" required onchange="others()">
                <option value="" selected hidden disabled>Select Type of Leave</option>
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
                <option value="Others">Others</option>
              </select></div>

              <textarea class="form-control" name="reason" id="reason" cols="30" rows="10" style="display: none" placeholder="Reason" required></textarea>
              
              <div class="mb-3">
              <label class="form-label" for="s_date">Start Date: </label>
              <input class="form-control" type="date" name="s_date" id="s_date" required></div>

              <div class="mb-3">
              <label class="form-label" for="e_date">End Date: </label>
              <input class="form-control" type="date" name="e_date" id="e_date" required></div>
              
          </div>
          <div class="modal-footer">
              <input type="hidden" name="emp_id" value="<?=$this->session->id?>">
              <input type="hidden" name="status" value="pending">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" onclick="return confirm('Send leave application? You have five days to comply and submit your requirements. If you cannot submit the requirements, your application will be cancelled.')" class="btn btn-primary">Send Request</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <h3>Pending</h3>
  <table id='pending' class="table table-striped" style="width: 100%">
      <thead>
          <tr>
            <th>Nature</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Date Filed</th>
          </tr>
      </thead>
      <tbody>
          <?php foreach($pending as $request):?>
          <tr>
              <td><?= $request['nature']?></td>
              <?php 
                $time = strtotime($request['s_date']);
                $pending_s_date = date('M d, Y',$time);
              ?>
              <td><?= $pending_s_date?></td>
              <?php 
                $time = strtotime($request['e_date']);
                $pending_e_date = date('M d, Y',$time);
              ?>
              <td><?= $pending_e_date?></td>

              <?php 
                $time = strtotime($request['date_filed']);
                $pending_date_filed = date('M d, Y',$time);
              ?>
              <td><?= $pending_date_filed?></td>
          </tr>
          <?php endforeach ?>
      </tbody>
  </table>
</div>

<div id="approved_section" style="display: none">
  <h3>Approved</h3>
  <table id='approved' class="table table-striped" style="width: 100%">
      <thead>
          <tr>
            <th>Nature</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Date Filed</th>
          </tr>
      </thead>
      <tbody>
          <?php foreach($approved as $leave):?>
          <tr>
            <td><?= $leave['nature']?></td>
            <?php 
                $time = strtotime($leave['s_date']);
                $leave_s_date = date('M d, Y',$time);
              ?>
              <td><?= $leave_s_date?></td>
              <?php 
                $time = strtotime($leave['e_date']);
                $leave_e_date = date('M d, Y',$time);
              ?>
              <td><?= $leave_e_date?></td>

              <?php 
                $time = strtotime($leave['date_filed']);
                $leave_date_filed = date('M d, Y',$time);
              ?>
              <td><?= $leave_date_filed?></td>
          </tr>
          <?php endforeach ?>
      </tbody>
  </table>
</div>



<script>
$(document).ready(function () {
  $('#pending').DataTable({
      "order": [],
    });
});

$(document).ready(function () {
  $('#approved').DataTable({
      "order": [],
    });
});

function others(){
  let nature = document.getElementById('nature').value;
  let reason = document.getElementById('reason');

  if (nature == 'Others'){
    reason.style.display = "block";
    reason.required = true;
  } else {
    reason.style.display = "none";
    reason.required = false;
  }
}

function showPending(){
  let pending = document.getElementById("pending_section").style;
  let approved = document.getElementById("approved_section").style;

  pending.display = "block";
  approved.display = "none";
}

function showApproved(){
  let pending = document.getElementById("pending_section").style;
  let approved = document.getElementById("approved_section").style;

  pending.display = "none";
  approved.display = "block";
}
</script>