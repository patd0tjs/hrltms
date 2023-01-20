<br>

<div class="btn-group" role="group" aria-label="Basic radio toggle button group">
  <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" onclick="showTardy()" checked>
  <label class="btn btn-outline-warning" for="btnradio1">Tardy</label>

  <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off" onclick="showUndertime()">
  <label class="btn btn-outline-success" for="btnradio2">Undertime</label>
</div>
<br>
<br>
<div id="my_tardy">
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
            <?php 
                $time = strtotime($tardy['date']);
                $newtardy = date('M d, Y',$time);
            ?>
            <td><?= $newtardy?></td>
            <td><?= $tardy['diff']?></td>
        </tr>
        <?php endforeach ?>
    </tbody>
 </table>
</div>

<div id="my_undertime" style="display: none">
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
            <?php 
                $time = strtotime($undertime['date']);
                $newundertime = date('M d, Y',$time);
            ?>
            <td><?= $newundertime?></td>
            <td><?= $undertime['diff']?></td>
        </tr>
        <?php endforeach ?>
    </tbody>
 </table>
</div>


 <script>
$(document).ready(function () {
    $('#tardy').DataTable();
});

$(document).ready(function () {
    $('#undertime').DataTable();
});

function showTardy(){
  let tardy = document.getElementById("my_tardy").style;
  let undertime = document.getElementById("my_undertime").style;

  tardy.display = "block";
  undertime.display = "none";
}

function showUndertime(){
  let tardy = document.getElementById("my_tardy").style;
  let undertime = document.getElementById("my_undertime").style;

  tardy.display = "none";
  undertime.display = "block";
}
</script>