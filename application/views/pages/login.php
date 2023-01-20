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

.footer {
  position: absolute;
  bottom: 0;
  width: 100%;
  height: 40px;
  background-color: #1e6c07;
  color: white
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

<div class="footer">
    <center>
        <table>
            <tr>
                <td><a role="button" data-bs-toggle="modal" data-bs-target="#privacy">Privacy Policy</a></td>
                <td style="width:10%"></td>
                <td><a role="button" data-bs-toggle="modal" data-bs-target="#terms">Terms of Use</a></td>
            </tr>
        </table>
    </center>
</div>

<!-- Modal -->
<div class="modal fade" id="privacy" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="termsLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">Privacy Policy</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        In compliance with the Data Privacy Act of 2012, Bukidnon Provincial Hospital 
        of Kibawe is committed to protect and respect your personal data privacy. 
        The hospital collects various data and information from employee’s using the 
        Human Resource Leave and Tardy Management System. In processing this data and 
        information, BPH - Kibawe is commited to ensure the free flow of information as 
        required under the Freedom of Information Act (Executive Order No. 2 S. 2016). 
        This privacy notice informs the public on how we collect, use and disclose personal 
        information of our data subjects.
        <br>
        <br>
        Should there be data privacy concerns and requests, you may visit the HR office of 
        Bukidnon Provincial Hospital of Kibawe.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Understood</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="terms" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="termsLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="termsLabel">Terms of Use</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Use of our Website
        <br>
        <br>
        You agree to use our website for legitimate purposes and not for any illegal or 
        unauthorized purpose, including without limitation, in violation of any 
        intellectual property or privacy law. By agreeing to the Terms, you represent and 
        warrant that you are at least the age of majority in your state or province of 
        residence and are legally capable of entering into a binding contract.
        <br>
        <br>
        You agree to not use our website to conduct any activity that would constitute 
        a civil or criminal offence or violate any law. You agree not to attempt to 
        interfere with our website’s network or security features or to gain unauthorized 
        access to our systems.
        <br>
        <br>
        You agree to provide us with accurate personal information, such as your email address 
        and other contact details according to your work. You agree to promptly update your 
        account and information. You authorize us to collect and use this information to 
        contact you in accordance with our Privacy Policy.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Understood</button>
      </div>
    </div>
  </div>
</div>


<!-- for missing closing tags -->
</div>
</div>
</div>
</div>
</body>
</html>