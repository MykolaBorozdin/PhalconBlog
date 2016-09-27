<h2>Sign up using this form</h2>
<?php echo $this->tag->form("signup/register"); ?>
 <p>
    <label for="email">E-Mail</label>
    <?php echo $this->tag->emailField("email") ?>
 </p>
 
 <p>
    <label for="name">Password</label>
    <?php echo $this->tag->passwordField("password") ?>
 </p>

 <p>
    <?php echo $this->tag->submitButton("Register") ?>
 </p>

</form>