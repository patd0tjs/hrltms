<style>
body{
    background-image: url("assets/img/bg.png");
    background-repeat: no-repeat;
    background-size: auto;
}
.login{
    width: 70%;
    margin-top: 5%;
    border-style: 1px solid black;
    padding: 5%;
    border-radius: 25px;
    box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
    background-color: white;
}
.alert{
    width: 25%;
    position: absolute;
    top: 0;
    left: 0; 
    right: 0; 
    margin-left: auto; 
    margin-right: auto; 
}
.login button{
    margin-top: 5%;
    width: 100%;
}
a{
    text-decoration: none;
    color: black;
}

#login-logo{
    width: 70%;
    margin-top: 8%
}

</style>
<center>
    <?php if ($this->session->flashdata('error')){?>

        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= $this->session->flashdata('error')?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        
    <?php } elseif ($this->session->flashdata('success')){ ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= $this->session->flashdata('success')?>
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
            <div class="login">
                <form action="<?= base_url()?>users/login" method="post">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" name="username" placeholder="username" required>
                        <label for="floatingInput">Username ID</label>
                    </div>
                    <div class="form-floating">
                        <input type="password" class="form-control" id="floatingPassword" name="pw" placeholder="Password" required>
                        <label for="floatingPassword">Password</label>
                    </div>

                    <button type="submit" class="btn btn-success">Login</button>

                </form>
                <br>
                <a href="recovery">Forgot Password?</a>
            </div>
         </div>
    </div>

</center>

<!-- Modal -->
<div class="modal fade" id="terms" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="termsLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="termsLabel">Terms And Condition</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Understood</button>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
    $(window).on('load', function() {
        $('#terms').modal('show');
    });
</script>

<!-- for missing closing tags -->
</div>
</div>
</div>
</div>
</body>
</html>