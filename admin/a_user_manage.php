
<!DOCTYPE html>
<html lang="en">
    <?php
        include "../admin/a_head.php";  
    ?>
<body>
    <?php
        require "../components/a_navbar.php";
    ?>
    
    <table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">User Name</th>
      <th scope="col">Email</th>
      <th scope="col">Ban</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
      <td>@mdo</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td colspan="2">Larry the Bird</td>
      <td>@twitter</td>
    </tr>
  </tbody>
</table>


    <?php
        include "../admin/a_footer.php";
    ?>
</body>
</html>