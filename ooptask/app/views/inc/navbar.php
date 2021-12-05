<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3">
    <?php if (isLoggedIn()) { ?>
        <a class="navbar-brand" href="<?php echo URL_ROOT;?>/opers"><?php echo SITE_NAME; ?></a>
    <?php }else{ ?>
        <a class="navbar-brand" href="<?php echo URL_ROOT;?>"><?php echo SITE_NAME; ?></a>
    <?php } ?>
   <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
   </button>
   
   <div class="collapse navbar-collapse" id="navbarsExampleDefault">
      <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <?php if (isLoggedIn()) { ?>
                <a class="nav-link" href="<?php echo URL_ROOT;?>/opers">Home</a>
            <?php }else{ ?>
            <a class="nav-link" href="<?php echo URL_ROOT;?>">Home</a>
            <?php } ?>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="<?php echo URL_ROOT;?>/pages/addtask">Add a task</a>
          </li>
      </ul>
      
      <ul class="navbar-nav mr-right">
          <?php if( isset($_SESSION['user_id'])) : ?>
          <span class="navbar-text pl-5">User logged:</span>
          <li class="nav-item dropdown pr-5">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fa fa-user"></i> <?php echo $_SESSION['user_name'];?>
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="<?php echo URL_ROOT;?>/users/logout"><i class="fa fa-power-off"></i> Logout</a>
              </div>
          </li>
          <?php else : ?>
          <li class="nav-item">
              <a class="nav-link" href="<?php echo URL_ROOT;?>/users/login">Login</a>
          </li>
          <?php endif; ?>
      </ul>
</nav>
