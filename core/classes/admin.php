<?php 
class Admin{
	protected $pdo;

 	public function __construct($pdo){											
	    $this->pdo = $pdo;
	}

	 
	public function checkInput($data){
		$data = htmlspecialchars($data);
		$data = trim($data);
		$data = stripcslashes($data);
		return $data;
	}
	
	public function preventAccess($request, $currentFile, $currently){
		if($request == 'GET' && $currentFile == $currently){
			header('Location:'.BASE_URL.'index.php');
		}
	}
	

	public function login($adminName, $password){
		$passwordHash = md5($password);
		$stmt = $this->pdo->prepare('SELECT `adminID` FROM `admin` WHERE `adminName` = :adminName AND `password` = :password');
		$stmt->bindParam(':adminName', $adminName, PDO::PARAM_STR);
		$stmt->bindParam(':password', $passwordHash, PDO::PARAM_STR);
		$stmt->execute();

		$count = $stmt->rowCount();
		$admin = $stmt->fetch(PDO::FETCH_OBJ);

		if($count > 0){
			$_SESSION['adminID'] = $admin->adminID;
			//header('Location: a_home.php');
			echo "<script>location.href = 'a_home.php?msg=$msg';</script>";
			return true;
		}else{
			return false;
		}
	}


	  public function register($adminname, $password){
	    $passwordHash = md5($password);
	    $stmt = $this->pdo->prepare("INSERT INTO `admin` (`adminName`, `password`) VALUES (:adminname, :password");
	    $stmt->bindParam(":adminName", $adminname, PDO::PARAM_STR);
 	    $stmt->bindParam(":password", $passwordHash , PDO::PARAM_STR);
	    $stmt->execute();

	    $adminID = $this->pdo->lastInsertId();
	    $_SESSION['adminID'] = $adminID;
	  }


	public function adminData($admin_id){
		$stmt = $this->pdo->prepare('SELECT * FROM `admin` WHERE `adminID` = :admin_id');
		$stmt->bindParam(':adminID', $admin_id, PDO::PARAM_INT);
		$stmt->execute();

		return $stmt->fetch(PDO::FETCH_OBJ);
	}

	public function logout(){
		$_SESSION = array();
		session_destroy();
		header('Location: ../index.php');
	}

	public function create($table, $fields = array()){
		$columns = implode(',', array_keys($fields));
		$values  = ':'.implode(', :', array_keys($fields));
		$sql     = "INSERT INTO {$table} ({$columns}) VALUES ({$values})";

		if($stmt = $this->pdo->prepare($sql)){
			foreach ($fields as $key => $data) {
				$stmt->bindValue(':'.$key, $data);
			}
			$stmt->execute();
			return $this->pdo->lastInsertId();
		}
	}

	public function update($table, $user_id, $fields){
		$columns = '';
		$i       = 1;

		foreach ($fields as $name => $value) {
			$columns .= "`{$name}` = :{$name} ";
			if($i < count($fields)){
				$columns .= ', ';
			}
			$i++;
		}
		$sql = "UPDATE {$table} SET {$columns} WHERE `user_id` = {$user_id}";
		if($stmt = $this->pdo->prepare($sql)){
			foreach ($fields as $key => $value) {
				$stmt->bindValue(':'.$key, $value);
			}
			$stmt->execute();
		}
	}

	public function delete($table, $array){
		$sql   = "DELETE FROM " . $table;
		$where = " WHERE ";

		foreach($array as $key => $value){
			$sql .= $where . $key . " = '" . $value . "'";
			$where = " AND ";
		}
		$sql .= ";";
		$stmt = $this->pdo->prepare($sql);
		$stmt->execute();
	}
	

	public function checkPassword($password){
		$stmt = $this->pdo->prepare("SELECT `password` FROM `admin` WHERE `password` = :password");
        $md5 = md5($password);
		$stmt->bindParam(':password', $md5, PDO::PARAM_STR);
		$stmt->execute();

		$count = $stmt->rowCount();
		if($count > 0){
			return true;
		}else{
			return false;
		}
	}

	public function checkAdminName($adminname){
		$stmt = $this->pdo->prepare("SELECT `adminName` FROM `admin` WHERE `adminName` = :adminname");
		$stmt->bindParam(':adminName', $adminname, PDO::PARAM_STR);
		$stmt->execute();

		$count = $stmt->rowCount();
		if($count > 0){
			return true;
		}else{
			return false;
		}
	}	

	public function loggedIn(){
		return (isset($_SESSION['adminID'])) ? true : false;
	}

	public function listUsers(){
		if($this->loggedIn() === false) return false;
		$stmt = $this->pdo->prepare("SELECT * FROM `users`");
	    
        $stmt->execute();
	    $users = $stmt->fetchAll(PDO::FETCH_OBJ);
        echo'
		<div class="table-responsive">
			<table class="table table-hover my-table">
				<thead>
					<tr>
					<th scope="col">ID</th>
					<th scope="col">Name</th>
					<th scope="col">Screen Name</th>
					<th scope="col">Email</th>
					<th scope="col">Profile Image</th>
					<th scope="col">Bio</th>
					<th scope="col">Country</th>
					<th scope="col">Website</th>
					<th scope="col">Reset Password</th>
					<th scope="col">Delete</th>
					</tr>
				</thead>
					<tbody id="tableBody" class="table-group-divider">
		';
	    foreach ($users as $user) {
			echo'
				<tr>
				<th scope="row">'.$user->user_id.'</th>
				<td>'.$user->username.'</td>
				<td>'.$user->screenName.'</td>
				<td>'.$user->email.'</td>
				<td><img src="'.BASE_URL.$user->profileImage.'" class="card-img-top" alt="..." style="width: 80px; height: 80px;"></td>
				<td>'.$user->bio.'</td>
				<td>'.$user->country.'</td>
				<td>'.$user->website.'</td>
				';
			
				echo '<td><button class="resetPass" data-user="'.$user->user_id.'" type="submit">Reset</button></td>';
				echo '<td><button class="deleteUser" data-user="'.$user->user_id.'" type="submit">Delete</button></td>';

				
				
				echo'
				</tr>
			';
		}
					
		echo'
						
					</tbody>
				</table>
			</div>
			
		';
    }

	public function adminIdbyAdminname($adminname){
		$stmt = $this->pdo->prepare("SELECT `adminID` FROM `admin` WHERE (`adminName`  = :adminname)");
		$stmt->bindParam("adminName", $adminname, PDO::PARAM_STR);
		$stmt->execute();
	    $ad = $stmt->fetch(PDO::FETCH_OBJ);
	    return $ad->adminID;
	}



	public function timeAgo($datetime){
		$time    = strtotime($datetime);
 		$current = time();
 		$seconds = $current - $time;
 		$minutes = round($seconds / 60);
		$hours   = round($seconds / 3600);
		$months  = round($seconds / 2600640);

		if($seconds <= 60){
			if($seconds == 0){
				return 'now';
			}else{
				return $seconds.'s';
			}
		}else if($minutes <= 60){

			return $minutes.'m';

		}else if($hours <= 24){

			return $hours.'h';

		}else if($months <= 12){

			return date('M j', $time);

		}else{
			return date('j M Y', $time);
		}
	}
     
}
?>