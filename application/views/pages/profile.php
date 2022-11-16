<img src="<?= $my_info['id_pic']?>" alt="" class="img-fluid">
<div class="row">
    <div class="col">
        <label for="">Employee ID: </label>
        <input type="text" value="<?= $my_info['id']?>" disabled>
    </div>
    <div class="col">
        <label for="">Department: </label>
        <input type="text" value="<?= $my_info['department']?>" disabled>
    </div>
    <div class="col">
        <label for="">Designation: </label>
        <input type="text" value="<?= $my_info['designation']?>" disabled>
    </div>
    <div class="col">
        <label for="">Employement Status</label>
        <input type="text" value="<?= $my_info['status']?>" disabled>
    </div>
    <div class="col">
        <label for="">Sex: </label>
        <input type="text" value="<?= $my_info['sex']?>" disabled>
    </div>
    <div class="col">
        <label for="">Birthday: </label>
        <input type="text" value="<?= $my_info['bday']?>" disabled>
    </div>
    <div class="col">
        <label for="">Birth Place: </label>
        <input type="text" value="<?= $my_info['birth_place']?>" disabled>
    </div>
    <div class="col">
        <label for="">Purok: </label>
        <input type="text" value="<?= $my_info['purok']?>" disabled>
    </div>
    <div class="col">
        <label for="">Barangay: </label>
        <input type="text" value="<?= $my_info['brgy']?>" disabled>
    </div>
    <div class="col">
        <label for="">Municipality: </label>
        <input type="text" value="<?= $my_info['municipality']?>" disabled>
    </div>
    <div class="col">
        <label for="">Province: </label>
        <input type="text" value="<?= $my_info['province']?>" disabled>
    </div>
    <div class="col">
        <label for="">ZIP: </label>
        <input type="text" value="<?= $my_info['zip']?>" disabled>
    </div>
    <div class="col">
        <label for="">Date Hired: </label>
        <input type="text" value="<?= $my_info['date_hired']?>" disabled>
    </div>
    <div class="col">
        
        <label for="">Tenure: </label>
        <?php 
            $hired = new DateTime($my_info['date_hired']);
            $curr_date =new DateTime();
            $difference = date_diff($hired, $curr_date);
            $tenure = $difference->format('%y years, %m months %d days');
        ?>
        <input type="text" value="<?= $tenure?>" disabled>
    </div>
    <div class="col">
        <label for="">Plantilla: </label>
        <input type="text" value="<?= $my_info['plantilla']?>" disabled>
    </div>
    <div class="col">
        <label for="">Highest Education Attained: </label>
        <input type="text" value="<?= $my_info['education']?>" disabled>
    </div>
    <div class="col">
        <label for="">School: </label>
        <input type="text" value="<?= $my_info['school']?>" disabled>
    </div>
    <div class="col">
        <label for="">PRC License No. : </label>
        <input type="text" value="<?= $my_info['prc']?>" disabled>
    </div>
    <div class="col">
        <label for="">PRC Registration: </label>
        <input type="text" value="<?= $my_info['prc_reg']?>" disabled>
    </div>
    <div class="col">
        <label for="">PRC Expiration: </label>
        <input type="text" value="<?= $my_info['prc_exp']?>" disabled>
    </div>
    <div class="col">
        <label for="">PhilHealth No.: </label>
        <input type="text" value="<?= $my_info['philhealth']?>" disabled>
    </div>
    <div class="col">
        <label for="">Phone No.: </label>
        <input type="text" value="<?= $my_info['phone']?>" disabled>
    </div>
    <div class="col">
        <label for="">Marital Status: </label>
        <input type="text" value="<?= $my_info['marital_status']?>" disabled>
    </div>
    <div class="col">
        <label for="">GSIS No.: </label>
        <input type="text" value="<?= $my_info['gsis']?>" disabled>
    </div>
    <div class="col">
        <label for="">SSS No.: </label>
        <input type="text" value="<?= $my_info['sss']?>" disabled>
    </div>
    <div class="col">
        <label for="">Pag-Ibig No.: </label>
        <input type="text" value="<?= $my_info['pag_ibig']?>" disabled>
    </div>
    <div class="col">
        <label for="">TIN No.: </label>
        <input type="text" value="<?= $my_info['tin']?>" disabled>
    </div>
    <div class="col">
        <label for="">ATM No.: </label>
        <input type="text" value="<?= $my_info['atm']?>" disabled>
    </div>
    <div class="col">
        <label for="">Blood Type: </label>
        <input type="text" value="<?= $my_info['blood_type']?>" disabled>
    </div>
    <div class="col">
        <label for="">Email Address: </label>
        <input type="text" value="<?= $my_info['email']?>" disabled>
    </div>
</div>
<div class="col">
    <label for="">Remarks: </label>
    <textarea name="remarks" cols="30" rows="10" placeholder="remarks" disabled><?= $my_info['remarks']?></textarea>
</div>

