<?php require APPROOT . '/views/inc/header.php';?>


  
<div class="columns">
    <div class="column"></div>
    <div class="column is-half">
        <section class="section">
            <div class="container">
                <h1 class="title">Create An Account</h1>
                <h2>Please fill out this form to register with us.</h2>
            </div>
        </section>
        <form action="<?php echo URLROOT; ?>/users/register" class="card-content" method="post">
                <div class="field">
                    <div class="control">
                            <label for="name">Login name: <sup>*</sup></label>
                            <input name="name" class="input <?php echo (!empty($data['name_err'])) ? 'is-invalid' : '';?>" type="text" placeholder="Login name"
                            value="<?php echo $data['name']; ?>">
                            <p class="help is-danger"><?php echo $data['name_err']; ?></p>
                        </div>
                    </div>
                    <div class="field">
                        <p class="control">
                            <label for="email">Email: <sup>*</sup></label>
                            <input name="email" class="input <?php echo (!empty($data['email_err'])) ? 'is-invalid' : '';?>" type="email" placeholder="Email"
                            value="<?php echo $data['email']; ?>">
                            <p class="help is-danger"><?php echo $data['email_err']; ?></p>
                        </p>
                    </div>
                    <div class="field">
                        <p class="control">
                            <label for="password">Password: <sup>*</sup></label>
                            <input name="password" class="input <?php echo (!empty($data['password_err'])) ? 'is-invalid' : '';?>" type="password" placeholder="Password"
                            value="<?php echo $data['password']; ?>">
                            <p class="help is-danger"><?php echo $data['password_err']; ?></p>
                        </p>
                    </div>
                    <div class="field">
                        <p class="control">
                            <label for="confirm_password">Confirm password: <sup>*</sup></label>
                            <input name="confirm_password" class="input <?php echo (!empty($data['confirm_password_err'])) ? 'is-invalid' : '';?>" type="password" placeholder="Confirm password"
                            value="<?php echo $data['confirm_password']; ?>">
                            <p class="help is-danger"><?php echo $data['confirm_password_err']; ?></p>
                        </p>
                    </div>
                    <div class="columns">
                        <div class="column is_half">
                            <input type="submit" value="Register" class="button is-primary" value="Register">
                        </div>
                        <div class="column is_half">
                            <a class="button" href="<?php echo URLROOT;?>/users/login">Already have an account ?</a>
                        </div>
                    </div>
        </form>
    </div>
    <div class="column"></div>
</div>

<?php require APPROOT . '/views/inc/footer.php';?>