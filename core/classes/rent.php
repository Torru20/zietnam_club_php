<?php

class Rent extends User{

 	public function __construct($pdo){
		$this->pdo = $pdo;
	}
 
	public function rents($user_id, $num){
		$stmt = $this->pdo->prepare("SELECT * FROM `rents`LEFT JOIN `users` ON `houseOf` = `user_id`");
	    
        $stmt->execute();
	    $rents = $stmt->fetchAll(PDO::FETCH_OBJ);
        echo'<div class="row row-cols-1 row-cols-md-3 g-4">';
	    foreach ($rents as $rent) {
			$user = $this->userData($rent->houseOf);
			if($rent->status=='for_rent'){
			echo'
                <div class="col">
                    <div class="card">
                    	<img src="'.BASE_URL.$rent->postImage.'" class="card-img-top" alt="...">
                   
						<div class="card-body">
							<h5 class="card-title">
							'.$rent->screenName.'
							</h5>
							<p class="card-text">'.$rent->description.'</p>
							<h3>
								'.$rent->price.'
							</h3>
						</div>
						<div data-bs-dismiss="offcanvas" class="people-message" data-user='.$rent->houseOf.'>
							chat now
						</div>
						<div class="card-footer">
							<small class="text-body-secondary">'.$this->timeAgo($rent->postedOn).'</small>
						</div>
                	</div>
            	</div>
            ';
        }}
        echo '</div>';
    }

	public function rentsAdmin(){
		$stmt = $this->pdo->prepare("SELECT * FROM `rents`LEFT JOIN `users` ON `houseOf` = `user_id`");
        $stmt->execute();
	    $rents = $stmt->fetchAll(PDO::FETCH_OBJ);
        echo'
		<div class="table-responsive">
			<table class="table table-hover my-table">
				<thead>
					<tr>
					<th scope="col">ID</th>
					<th scope="col">Description</th>
					<th scope="col">User</th>
					<th scope="col">Image</th>
					<th scope="col">Date</th>
					<th scope="col">Price</th>
					<th scope="col">Status</th>
					<th scope="col">Accept</th>
					<th scope="col">Delete</th>
					</tr>
				</thead>
					<tbody class="table-group-divider">
		';
	    foreach ($rents as $rent) {
			$user = $this->userData($rent->houseOf);
			echo'
				<tr>
				<th scope="row">'.$rent->houseID.'</th>
				<td>'.$rent->description.'</td>
				<td>'.$rent->screenName.'</td>
				<td><img src="'.BASE_URL.$rent->postImage.'" class="card-img-top" alt="..." style="width: 80px; height: 80px;"></td>
				<td>'.$rent->postedOn.'</td>
				<td>'.$rent->price.'</td>
				<td>'.$rent->status.'</td>
				';
				if ($rent->status=='rented'||$rent->status=='for_rent') {
					echo'<td></td>';
					echo "<td><label class='deletePostRent' data-rent='.$rent->houseID.'>Delete</label></td>"; 

				}else{
					echo '<td><button class="acceptPostRent" data-rent="'.$rent->houseID.'" type="submit">Accept</button></td>';
                    echo '<td><button class="deletePostRent" data-rent="'.$rent->houseID.'" type="submit">Delete</button></td>';

				}
				
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
	public function rentsByID($user_id){
	    $stmt = $this->pdo->prepare("SELECT * FROM `rents` LEFT JOIN `users` ON `houseOf` = `user_id` WHERE `houseOf` = :user_id");
        $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
        $stmt->execute();
	    $rents = $stmt->fetchAll(PDO::FETCH_OBJ);
        echo'
		<div class="table-responsive">
			<table class="table table-hover my-table">
				<thead>
					<tr>
					<th scope="col">ID</th>
					<th scope="col">Description</th>
					<th scope="col">Image</th>
					<th scope="col">Date</th>
					<th scope="col">Price</th>
					<th scope="col">Status</th>
					<th scope="col">Rented</th>
					<th scope="col">Delete</th>
					</tr>
				</thead>
					<tbody class="table-group-divider">
		';
	    foreach ($rents as $rent) {
			$user = $this->userData($rent->houseOf);
			echo'
				<tr>
				<th scope="row">'.$rent->houseID.'</th>
				<td>'.$rent->description.'</td>
				<td><img src="'.BASE_URL.$rent->postImage.'" class="card-img-top" alt="..." style="width: 80px; height: 80px;"></td>
				<td>'.$rent->postedOn.'</td>
				<td>'.$rent->price.'</td>
				<td>'.$rent->status.'</td>
						
			';
			if ($rent->status=='waiting'||$rent->status=='rented') {
				echo'<td></td>';
				echo "<td><label class='deletePostRent' data-rent='.$rent->houseID.'>Delete</label></td>"; 

			}else{
				echo '<td><button class="rentedPostRent" data-rent="'.$rent->houseID.'" type="submit">Rented</button></td>';
				echo '<td><button class="deletePostRent" data-rent="'.$rent->houseID.'" type="submit">Delete</button></td>';

			}
			
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

	public function rentFindByID($houseID){
		$stmt = $this->pdo->prepare("SELECT * FROM `rents`WHERE `houseID` = :houseID");
		$stmt->bindParam(":houseID", $houseID, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_OBJ);
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

	public function update($table, $house_id, $fields){
		$columns = '';
		$i       = 1;

		foreach ($fields as $name => $value) {
			$columns .= "`{$name}` = :{$name} ";
			if($i < count($fields)){
				$columns .= ', ';
			}
			$i++;
		}
		$sql = "UPDATE {$table} SET {$columns} WHERE `houseID` = {$house_id}";
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

}
?>
