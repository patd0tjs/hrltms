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

            <table>
              <thead>
                <tr>
                  <th>
                    Date:
                  </th>
                  <th>
                    Time In:
                  </th>
                  <th>
                    Time Out:
                  </th>
                </tr>
              </thead>
              <tbody id="dtr_list">
                <tr>
                  <td>
                    <input type="date" name="date" id="date" class="form-control">
                  </td>
                  <td>
                    <input type="time" name="time_in" id="time_in" class="form-control">
                  </td>
                  <td>
                    <input type="time" name="time_out" class="form-control" id="time_out">
                  </td>
                </tr>
              </tbody>
              <tfoot>
                <tr>
                  <td>
                    <input type="hidden" name="extra_dates" value="0" id="extra_dates">
                  <button type="button" onclick="add_dtr_date()">
                    Add More
                  </button>
                  </td>
                </tr>
              </tfoot>
            </table>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Add DTR</button>
        </div>
      </form>
    </div>
  </div>
</div>

<button style="margin-bottom: 10px;" type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exportDTR">
  Export
</button>

<div class="modal fade" id="exportDTR" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exportDTRLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exportDTRLabel">DTR Report</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?= base_url()?>reports/export_dtr" method="post">
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
                <td><?= ucfirst($emp_dtr['l_name']) . ', ' . ucfirst($emp_dtr['f_name']) . ' ' . ucfirst($emp_dtr['m_name'])?></td>
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
      $('#dtr').DataTable();
  });

  function add_dtr_date(){
    document.getElementById('extra_dates').value++;

    const extra = document.createElement('tr');
    extra.className = "extras";

    const dtr_date = document.createElement('td');
    const dtr_start = document.createElement('td');
    const dtr_end = document.createElement('td');

    const input_date = document.createElement("input");
    input_date.className = 'form-control';
    input_date.setAttribute("type", "date");
    input_date.setAttribute("name", "date" + document.getElementById('extra_dates').value);
    input_date.setAttribute("required", "true");

    const input_start = document.createElement("input");
    input_start.className = 'form-control';
    input_start.setAttribute("type", "time");
    input_start.setAttribute("name", "time_in" + document.getElementById('extra_dates').value);
    input_start.setAttribute("required", "true");

    const input_end = document.createElement("input");
    input_end.className = 'form-control';
    input_end.setAttribute("type", "time");
    input_end.setAttribute("name", "time_out" + document.getElementById('extra_dates').value);
    input_end.setAttribute("required", "true");

    dtr_date.appendChild(input_date);
    dtr_start.appendChild(input_start);
    dtr_end.appendChild(input_end);

    extra.appendChild(dtr_date);
    extra.appendChild(dtr_start);
    extra.appendChild(dtr_end);

    const extra_date = document.getElementById('dtr_list');

    extra_date.appendChild(extra);
}
</script>

