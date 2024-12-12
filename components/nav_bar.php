<link rel="stylesheet" href="../css/nav_bar.css">

<nav class="navbar navbar-expand-lg " >
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Zietnam Club</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" style="height=60px;" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="pages/index.php">H O M E</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            F I N D
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="test.php">H O M E S T A Y</a></li>
            <li><a class="dropdown-item" href="rent_manage.php">M A N A G E</a></li>
            
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Do you need some help?</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            C L U B
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="forum_page.php">F O R U M</a></li>
            <li><a class="dropdown-item" href="chat_page_test.php">C H A T C H I T</a></li>
            <li><a class="dropdown-item" id="messagePopup" href="#">Click</a></li>
            
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Do you need some help?</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo BASE_URL; ?>settings_page.php">S E T T I N G S</a>
        </li>
        
        <li class="nav-item">
          <a class="nav-link" href="<?php echo BASE_URL;?>notification.php"><i class="fa fa-bell" aria-hidden="true"></i><span> N O T I F I C A T I O N S</span><span id="notificaiton" class="ml-0"><?php if($notify->totalN > 0){echo '<span class="span-i">'.$notify->totalN.'</span>';}?></span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href='<?php echo BASE_URL; ?>includes/logout.php'><i class="fa fa-power-off"></i><span> L O G  O U T</span></a>
        </li>
        
                
        
      </ul>
        <div class="header-main-sm">
            <a href="https://www.facebook.com/saigontranslatorteambyjulie"><i class="fa-brands fa-facebook"></i></a>
            <a href="https://www.xiaohongshu.com/user/profile/627362150000000021020c68"><div class="header-main-sm-in"></div></a>
            <i id="change-mode" class="fas fa-moon"></i>

        </div>
    </div>
  </div>
</nav>
<div class="content">
  </div>
<script src="../js/header.js"></script>
<script src="../js/dark-mode.js"></script>