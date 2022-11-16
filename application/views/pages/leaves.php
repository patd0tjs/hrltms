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
            <label for="datePick">Select Date(s): </label>
            <input type="text" id="datePick" name="date" required/>
        </div>
        <div class="modal-footer">
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
        <th>Date</th>
        <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($pending as $request):?>
        <tr>
            <td><?= $request['date']?></td>
            <td><?= $request['status']?></td>
        </tr>
        <?php endforeach ?>
    </tbody>
 </table>

 <h3>Approved</h3>
 <table id='pending' class="table table-striped" style="width: 100%">
    <thead>
        <tr>
        <th>Date</th>
        <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($approved as $leave):?>
        <tr>
            <td><?= $leave['date']?></td>
            <td><?= $leave['status']?></td>
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
  </script>