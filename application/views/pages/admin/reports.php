<form action="<?= base_url()?>reports/export" method="post">
    <label for="s_date">Start Date:</label>
    <input type="date" name="s_date" id="s_date" >

    <br>
    <label for="e_date">End Date:</label>
    <input type="date" name="e_date" id="e_date" >

    <br>
    <input type="submit" value="Generate Report">
</form>
