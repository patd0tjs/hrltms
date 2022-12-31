<style>
.recovery{
    width: 70%;
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

#login-logo{
    width: 70%;
    margin-top: 8%
}

</style>
<center>
    <?php if ($this->session->flashdata('error')){?>

        <div class="alert alert-danger alert-dismissible fade show" role="alert" id="alert">
            <?= $this->session->flashdata('error')?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        
    <?php } ?>

    <div class="row">
        <div class="col">
            <div align="right">
                <img src="<?= base_url()?>assets/img/logo-2.png" id="login-logo"> 
            </div>
        </div>
        <div class="col-8">
            <div class="recovery">
                <form action="<?= base_url()?>users/validate_code" method="post">
                    <h6>Please enter the recovery code that was sent to your email:</h6>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" name="code" placeholder="code" required>
                    </div>
                    <button type="submit" class="btn btn-success">Submit</button>

                </form>
            </div>
        </div>
    </div>
</center>
<!-- for missing closing tags -->
</div>
</div>
</div>
</div>
</body>
</html>