<style>
  body{
    display: flex;
    flex-direction: column;
    min-height: 100vh;
  }
  footer{
    flex-shrink: 0;
    padding: 10px;
    margin:20px;
  }
  .text-body-secondary{
    color: var(--primary-color) !important;;
  }
  .border-top{
    border-top: var(--bs-border-width) var(--bs-border-style) var(--secondary-color) !important;
  }
</style>
<footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
    <p class="col-md-4 mb-0 text-body-secondary">© 2024 BlueTeam, Inc</p>

    

    <ul class="nav col-md-4 justify-content-end">
      <li class="nav-item"><a href="<?php echo BASE_URL; ?>home.php" class="nav-link px-2 text-body-secondary">Home</a></li>
      <li class="nav-item"><a href="<?php echo BASE_URL; ?>rent_page.php" class="nav-link px-2 text-body-secondary">Find rent</a></li>
      <li class="nav-item"><a href="<?php echo BASE_URL; ?>forum_page.php" class="nav-link px-2 text-body-secondary">Forum</a></li>
      <li class="nav-item"><a href="<?php echo BASE_URL; ?>chat_page.php" class="nav-link px-2 text-body-secondary">Chat Chit</a></li>
      <li class="nav-item"><a href="<?php echo BASE_URL; ?>profile_page.php" class="nav-link px-2 text-body-secondary">Profile</a></li>
    </ul>
  </footer>