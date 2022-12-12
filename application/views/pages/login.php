<style>
.login{
    width: 50%;
    margin-top: 5%;
    border-style: 1px solid black;
    padding: 5%;
    border-radius: 25px;
    box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
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

            <button type="submit" class="btn btn-primary">Login</button>

        </form>
        <br>
        <a href="recovery">Forgot Password?</a>
    </div>
</center>
<!-- for missing closing tags -->
</div>
</div>
</div>
</div>
</body>
</html>