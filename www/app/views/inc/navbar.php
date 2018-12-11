<nav class="navbar navbar-padding" role="navigation" aria-label="main navigation">
  <div class="navbar-brand">
    <a class="navbar-item" href="<?php echo URLROOT; ?>">
      <h1><?php echo SITENAME; ?></h1>
    </a>

    <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
    </a>
  </div>

  <div id="navbarBasicExample" class="navbar-menu">
    <div class="navbar-start">
      <a class="navbar-item">
        Home
      </a>
      <a class="navbar-item">    
      </a>
    </div>

    <div class="navbar-end">
    <?php if(isset($_SESSION['user_id'])) : ?>
    <div class="navbar-item">
        <div class="buttons">
          <a class="button" href="<?php echo URLROOT?>/users/profile">
            <strong>User profil</strong>
          </a>
          <a class="button is-primary" href="<?php echo URLROOT?>/users/logout">
            <strong>logout</strong>
          </a>
        </div>
      </div>
    <?php else : ?>
      <div class="navbar-item">
        <div class="buttons">
          <a class="button is-primary" href="<?php echo URLROOT?>/users/register">
            <strong>Sign up</strong>
          </a>
          <a class="button is-light" href="<?php echo URLROOT?>/users/login">
            Log in
          </a>
        </div>
      </div>
    <?php endif; ?>>
    </div>
  </div>
</nav>