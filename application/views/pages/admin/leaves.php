<h3>Pending</h3>
 <table id='pending' class="table table-striped" style="width: 100%">
    <thead>
        <tr>
            <th>Employee ID</th>
            <th>Employee Name</th>
            <th>Date</th>
            <th>Reason</th>
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
            <td><?= $request['date']?></td>
            <td><?= $request['reason']?></td>
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
            <th>Date</th>
            <th>Reason</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($approved as $leave):?>
        <tr>
            <td><?= $leave['emp_id']?></td>
            <td>
                <?= $leave['l_name'] . ', ' . $leave['f_name'] . ' ' . $leave['m_name']?>
            </td>
            <td><?= $leave['date']?></td>
            <td><?= $leave['reason']?></td>
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