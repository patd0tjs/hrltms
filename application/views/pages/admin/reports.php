<style>
    .dataTables_filter {
display: none;
}
</style>
<form action="<?= base_url()?>reports/export" method="post">
    <label for="s_date">Start Date:</label>
    <input type="date" name="s_date" id="s_date" >

    <br>
    <label for="e_date">End Date:</label>
    <input type="date" name="e_date" id="e_date" >

    <br>
    <input type="submit" value="Generate Report">
</form>

<?php 

$a = '01:13:00';
$b = '03:43:00';

addtime($a, $b);
function addtime($time1, $time2)
{
    $x = new DateTime($time1);
    $y = new DateTime($time2);

    $interval1 = $x->diff(new DateTime('00:00:00')) ;
    $interval2 = $y->diff(new DateTime('00:00:00')) ;

    $e = new DateTime('00:00');
    $f = clone $e;
    $e->add($interval1);
    $e->add($interval2);
    $total = $f->diff($e)->format("%H:%I:%S");
    echo $total;
}
?>