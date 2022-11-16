<br>
<h3>Tardy</h3>
<table id='tardy' class="table table-striped" style="width: 100%">
    <thead>
        <tr>
        <th>Date</th>
        <th>Deficiency</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($my_tardy as $tardy):?>
        <tr>
            <td><?= $tardy['date']?></td>
            <td><?= $tardy['diff']?></td>
        </tr>
        <?php endforeach ?>
    </tbody>
 </table>
<br>
<h3>Undertime</h3>
 <table id='undertime' class="table table-striped" style="width: 100%">
    <thead>
        <tr>
        <th>Date</th>
        <th>Deficiency</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($my_undertime as $undertime):?>
        <tr>
            <td><?= $undertime['date']?></td>
            <td><?= $undertime['diff']?></td>
        </tr>
        <?php endforeach ?>
    </tbody>
 </table>

 <script>
$(document).ready(function () {
    $('#tardy').DataTable();
});

$(document).ready(function () {
    $('#undertime').DataTable();
});
</script>