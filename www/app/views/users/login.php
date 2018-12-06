<?php require APPROOT . '/views/inc/header.php';?>


<div class="columns">
    <div class="column"></div>
    <div class="column is-half">
        <section class="section">
            <div class="container">
                <h1 class="title">Create An Account</h1>
                <h2>Please fill out in your credentials to log in.</h2>
            </div>
        </section>
        <?php flash('register_success'); ?>
        <form action="<?php echo URLROOT; ?>/users/login" class="card-content" method="post">
                <div class="field">
                    <div class="control">
                            <label for="name">Login name: <sup>*</sup></label>
                            <input name="name" class="input <?php echo (!empty($data['name_err'])) ? 'is-invalid' : '';?>" type="text" placeholder="Login name"
                            value="<?php echo $data['name']; ?>">
                            <span class="invalid-feedback"><?php echo $data['name_err']; ?></span>
                        </div>
                    </div>
                    <div class="field">
                        <p class="control">
                            <label for="password">Password: <sup>*</sup></label>
                            <input name="password" class="input <?php echo (!empty($data['password_err'])) ? 'is-invalid' : '';?>" type="password" placeholder="Password"
                            value="<?php echo $data['password']; ?>">
                            <span class="invalid-feedback"><?php echo $data['password_err']; ?></span>
                        </p>
                    </div>
                    <div class="columns">
                        <div class="column is_half">
                            <input type="submit" value="Login" class="button is-primary" value="Login">
                        </div>
                        <div class="column is_half">
                            <a class="button" href="<?php echo URLROOT;?>/users/register">No account? Register!</a>
                        </div>
                    </div>
        </form>
    </div>
    <div class="column"></div>
</div>
  
<?php require APPROOT . '/views/inc/footer.php';?>