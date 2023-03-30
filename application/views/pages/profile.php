<div class="container">
    <div align="right">
    <table>
        <tr>
            <td style="padding: 10px">
                Name: <?= ucfirst($my_info['l_name']). ', ' . ucfirst($my_info['f_name']). ' ' . ucfirst($my_info['m_name']);?>
                <br>
                Employee ID: <?= $my_info['id']?>
            </td>
            <td>
                <img style="height: 150px;  border-radius: 5px; float: right;" src="<?= $my_info['id_pic']?>" alt="user profile">
            </td>
        </tr>
    </table>
    </div>


<!-- <br><br><br><br><br><br><br> -->
<div class="row row-cols-3">
    <!-- <div class="col">
        <label class="form-label" for="">Last Name: </label>
        <input class="form-control" type="text" value="<?= $my_info['l_name']?>" disabled>
    </div>
    <div class="col">
        <label class="form-label" for="">First Name: </label>
        <input class="form-control" type="text" value="<?= $my_info['f_name']?>" disabled>
    </div>
    <div class="col">
        <label class="form-label" for="">Middle Name: </label>
        <input class="form-control" type="text" value="<?= $my_info['m_name']?>" disabled>
    </div>
    <div class="col">
        <label class="form-label" for="">Employee ID: </label>
        <input class="form-control" type="text" value="<?= $my_info['id']?>" disabled>
    </div> -->
    <div class="col">
        <label class="form-label" for="">Department: </label>
        <input class="form-control" type="text" value="<?= $my_info['department']?>" disabled>
    </div>
    <div class="col">
        <label class="form-label" for="">Designation: </label>
        <input class="form-control" type="text" value="<?= $my_info['designation']?>" disabled>
    </div>
    <div class="col">
        <label class="form-label" for="">Employement Status</label>
        <input class="form-control" type="text" value="<?= $my_info['status']?>" disabled>
    </div>
    <div class="col">
        <label class="form-label" for="">Sex: </label>
        <input class="form-control" type="text" value="<?= $my_info['sex']?>" disabled>
    </div>
    <div class="col">
        <label class="form-label" for="">Birthday: </label>
        <input class="form-control" type="text" value="<?= $my_info['bday']?>" disabled>
    </div>
    <div class="col">
        <label class="form-label" for="">Birth Place: </label>
        <input class="form-control" type="text" value="<?= ucfirst($my_info['birth_place'])?>" disabled>
    </div>
    <div class="col">
        <label class="form-label" for="">Purok: </label>
        <input class="form-control" type="text" value="<?= ucfirst($my_info['purok'])?>" disabled>
    </div>
    <div class="col">
        <label class="form-label" for="">Barangay: </label>
        <input class="form-control" type="text" value="<?= ucfirst($my_info['brgy'])?>" disabled>
    </div>
    <div class="col">
        <label class="form-label" for="">Municipality: </label>
        <input class="form-control" type="text" value="<?= ucfirst($my_info['municipality'])?>" disabled>
    </div>
    <div class="col">
        <label class="form-label" for="">Province: </label>
        <input class="form-control" type="text" value="<?= ucfirst($my_info['province'])?>" disabled>
    </div>
    <div class="col">
        <label class="form-label" for="">ZIP: </label>
        <input class="form-control" type="text" value="<?= $my_info['zip']?>" disabled>
    </div>
    <div class="col">
        <label class="form-label" for="">Date Hired: </label>
        <input class="form-control" type="text" value="<?= $my_info['date_hired']?>" disabled>
    </div>
    <div class="col">
        
        <label class="form-label" for="">Tenure: </label>
        <?php 
            $hired = new DateTime($my_info['date_hired']);
            $curr_date =new DateTime();
            $difference = date_diff($hired, $curr_date);
            $tenure = $difference->format('%y years, %m months %d days');
        ?>
        <input class="form-control" type="text" value="<?= $tenure?>" disabled>
    </div>
    <div class="col">
        <label class="form-label" for="">Plantilla: </label>
        <input class="form-control" type="text" value="<?= $my_info['plantilla']?>" disabled>
    </div>
    <div class="col">
        <label class="form-label" for="">Highest Education Attained: </label>
        <input class="form-control" type="text" value="<?= $my_info['education']?>" disabled>
    </div>
    <div class="col">
        <label class="form-label" for="">School: </label>
        <input class="form-control" type="text" value="<?= ucwords($my_info['school'])?>" disabled>
    </div>
    <div class="col">
        <label class="form-label" for="">PRC License No. : </label>
        <input class="form-control" type="text" value="<?= $my_info['prc']?>" disabled>
    </div>
    <div class="col">
        <label class="form-label" for="">PRC Registration: </label>
        <input class="form-control" type="text" value="<?= $my_info['prc_reg']?>" disabled>
    </div>
    <div class="col">
        <label class="form-label" for="">PRC Expiration: </label>
        <input class="form-control" type="text" value="<?= $my_info['prc_exp']?>" disabled>
    </div>
    <div class="col">
        <label class="form-label" for="">PhilHealth No.: </label>
        <input class="form-control" type="text" value="<?= $my_info['philhealth']?>" disabled>
    </div>
    <div class="col">
        <label class="form-label" for="">Phone No.: </label>
        <input class="form-control" type="text" value="<?= $my_info['phone']?>" disabled>
    </div>
    <div class="col">
        <label class="form-label" for="">Marital Status: </label>
        <input class="form-control" type="text" value="<?= $my_info['marital_status']?>" disabled>
    </div>
    <div class="col">
        <label class="form-label" for="">GSIS No.: </label>
        <input class="form-control" type="text" value="<?= $my_info['gsis']?>" disabled>
    </div>
    <div class="col">
        <label class="form-label" for="">SSS No.: </label>
        <input class="form-control" type="text" value="<?= $my_info['sss']?>" disabled>
    </div>
    <div class="col">
        <label class="form-label" for="">Pag-Ibig No.: </label>
        <input class="form-control" type="text" value="<?= $my_info['pag_ibig']?>" disabled>
    </div>
    <div class="col">
        <label class="form-label" for="">TIN No.: </label>
        <input class="form-control" type="text" value="<?= $my_info['tin']?>" disabled>
    </div>
    <div class="col">
        <label class="form-label" for="">ATM No.: </label>
        <input class="form-control" type="text" value="<?= $my_info['atm']?>" disabled>
    </div>
    <div class="col">
        <label class="form-label" for="">Blood Type: </label>
        <input class="form-control" type="text" value="<?= $my_info['blood_type']?>" disabled>
    </div>
    <div class="col">
        <label class="form-label" for="">Email Address: </label>
        <input class="form-control" type="text" value="<?= $my_info['email']?>" disabled>
    </div>
    &nbsp;
    <div class="col">
    <label class="form-label" for="">Remarks: </label>
    <textarea class="form-control" name="remarks" cols="30" rows="10" placeholder="remarks" disabled><?= $my_info['remarks']?></textarea>
</div>
</div>
</div>

