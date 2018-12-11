<?php require APPROOT . '/views/inc/header.php';?>

<div class="columns c-padding">
    <div class="column is-three-fifths">
        <div class="box">
            <p class="title is-5">User profile</p>
            <form action="<?php echo URLROOT; ?>/users/login" class="card-content" method="post">
                <div class="field">
                    <div class="control">
                        <label for="name">User name:</label>
                        <input name="name" value="<?php echo $data['name']; ?>" class="input <?php echo (!empty($data['name_err'])) ? 'is-invalid' : '';?>" type="text"
                        value="<?php echo $data['name']; ?>">
                        <span class="invalid-feedback"><?php echo $data['name_err']; ?></span>
                    </div>
                </div>
                <div class="field">
                    <p class="control">
                        <label for="email">Email:</label>
                        <input name="email" value="<?php echo $data['email']; ?>" class="input <?php echo (!empty($data['email_err'])) ? 'is-invalid' : '';?>" type="email" 
                        value="<?php echo $data['email']; ?>">
                        <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>
                    </p>
                </div>
                <div class="columns">
                    <div class="column is_half">
                        <input type="submit" value="Save changes" class="button is-primary" >
                    </div>
                    <div class="column"></div>
                    <div class="column is_half">
                        <input type="submit" value="Change password" class="button" value="Change password">
                    </div>
                </div>
            </form>
        </div>
    </div>
<div class="column auto">
    <div class="box">
        <p class="title is-5">Posts list :</p>
        <p class="subtitle">TODO : list this user posts here.</p>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php';?>