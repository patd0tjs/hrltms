<style>
.recovery{
    width: 50%;
    margin-top: 5%;
    border-style: 1px solid black;
    padding: 5%;
    border-radius: 25px;
    box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
}
#alert{
    width: 25%;
    position: absolute;
    top: 0;
    left: 0; 
    right: 0; 
    margin-left: auto; 
    margin-right: auto; 
}
.recovery button{
    margin-top: 5%;
    width: 100%;
}

h6 {
    text-align: left;
}

</style>
<center>
    <?php if ($this->session->flashdata('error')){?>

        <div class="alert alert-danger alert-dismissible fade show" role="alert" id="alert">
            <?= $this->session->flashdata('error')?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } ?>

    <div class="recovery">
        <form action="<?= base_url()?>users/recover_password" method="post">
            <h6>Please enter your new password:</h6>
            <div class="form-floating mb-3">
                <input type="password" class="form-control" id="floatingInput" name="pw" placeholder="pw" required>
            </div>

            <h6>Please re-enter your new password:</h6>
            <div class="form-floating mb-3">
                <input type="password" class="form-control" id="floatingInput" name="pw2" placeholder="pw2" required>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</center>
<!-- for missing closing tags -->
</div>
</div>
</div>
</div>
</body>
</html>