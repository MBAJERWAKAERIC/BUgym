<?php
session_start();
ini_set('display_errors', 1);
Class Action {
	private $db;

	public function __construct() {
		ob_start();
   	include 'db_connect.php';
    
    $this->db = $conn;
	}
	function __destruct() {
	    $this->db->close();
	    ob_end_flush();
	}

	function login(){
		
			extract($_POST);		
			$qry = $this->db->query("SELECT * FROM users where username = '".$username."' and password = '".md5($password)."' ");
			if($qry->num_rows > 0){
				foreach ($qry->fetch_array() as $key => $value) {
					if($key != 'passwors' && !is_numeric($key))
						$_SESSION['login_'.$key] = $value;
				}
				if($_SESSION['login_type'] != 1){
					foreach ($_SESSION as $key => $value) {
						unset($_SESSION[$key]);
					}
					return 2 ;
					exit;
				}
					return 1;
			}else{
				return 3;
			}
	}
	function login2(){
		
			extract($_POST);
			if(isset($email))
				$username = $email;
		$qry = $this->db->query("SELECT * FROM users where username = '".$username."' and password = '".md5($password)."' ");
		if($qry->num_rows > 0){
			foreach ($qry->fetch_array() as $key => $value) {
				if($key != 'passwors' && !is_numeric($key))
					$_SESSION['login_'.$key] = $value;
			}
			if($_SESSION['login_alumnus_id'] > 0){
				$bio = $this->db->query("SELECT * FROM alumnus_bio where id = ".$_SESSION['login_alumnus_id']);
				if($bio->num_rows > 0){
					foreach ($bio->fetch_array() as $key => $value) {
						if($key != 'passwors' && !is_numeric($key))
							$_SESSION['bio'][$key] = $value;
					}
				}
			}
			if($_SESSION['bio']['status'] != 1){
					foreach ($_SESSION as $key => $value) {
						unset($_SESSION[$key]);
					}
					return 2 ;
					exit;
				}
				return 1;
		}else{
			return 3;
		}
	}
	function logout(){
		session_destroy();
		foreach ($_SESSION as $key => $value) {
			unset($_SESSION[$key]);
		}
		header("location:login.php");
	}
	function logout2(){
		session_destroy();
		foreach ($_SESSION as $key => $value) {
			unset($_SESSION[$key]);
		}
		header("location:../index.php");
	}

	function save_user(){
		extract($_POST);
		$data = " name = '$name' ";
		$data .= ", username = '$username' ";
		if(!empty($password))
		$data .= ", password = '".md5($password)."' ";
		$data .= ", type = '$type' ";
		if($type == 1)
			$establishment_id = 0;
		$data .= ", establishment_id = '$establishment_id' ";
		$chk = $this->db->query("Select * from users where username = '$username' and id !='$id' ")->num_rows;
		if($chk > 0){
			return 2;
			exit;
		}
		if(empty($id)){
			$save = $this->db->query("INSERT INTO users set ".$data);
		}else{
			$save = $this->db->query("UPDATE users set ".$data." where id = ".$id);
		}
		if($save){
			return 1;
		}
	}
	function delete_user(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM users where id = ".$id);
		if($delete)
			return 1;
	}
	function signup(){
		extract($_POST);
		$data = " name = '".$firstname.' '.$lastname."' ";
		$data .= ", username = '$email' ";
		$data .= ", password = '".md5($password)."' ";
		$chk = $this->db->query("SELECT * FROM users where username = '$email' ")->num_rows;
		if($chk > 0){
			return 2;
			exit;
		}
			$save = $this->db->query("INSERT INTO users set ".$data);
		if($save){
			$uid = $this->db->insert_id;
			$data = '';
			foreach($_POST as $k => $v){
				if($k =='password')
					continue;
				if(empty($data) && !is_numeric($k) )
					$data = " $k = '$v' ";
				else
					$data .= ", $k = '$v' ";
			}
			if($_FILES['img']['tmp_name'] != ''){
							$fname = strtotime(date('y-m-d H:i')).'_'.$_FILES['img']['name'];
							$move = move_uploaded_file($_FILES['img']['tmp_name'],'assets/uploads/'. $fname);
							$data .= ", avatar = '$fname' ";

			}
			$save_alumni = $this->db->query("INSERT INTO alumnus_bio set $data ");
			if($data){
				$aid = $this->db->insert_id;
				$this->db->query("UPDATE users set alumnus_id = $aid where id = $uid ");
				$login = $this->login2();
				if($login)
				return 1;
			}
		}
	}
	function update_account(){
		extract($_POST);
		$data = " name = '".$firstname.' '.$lastname."' ";
		$data .= ", username = '$email' ";
		if(!empty($password))
		$data .= ", password = '".md5($password)."' ";
		$chk = $this->db->query("SELECT * FROM users where username = '$email' and id != '{$_SESSION['login_id']}' ")->num_rows;
		if($chk > 0){
			return 2;
			exit;
		}
			$save = $this->db->query("UPDATE users set $data where id = '{$_SESSION['login_id']}' ");
		if($save){
			$data = '';
			foreach($_POST as $k => $v){
				if($k =='password')
					continue;
				if(empty($data) && !is_numeric($k) )
					$data = " $k = '$v' ";
				else
					$data .= ", $k = '$v' ";
			}
			if($_FILES['img']['tmp_name'] != ''){
							$fname = strtotime(date('y-m-d H:i')).'_'.$_FILES['img']['name'];
							$move = move_uploaded_file($_FILES['img']['tmp_name'],'assets/uploads/'. $fname);
							$data .= ", avatar = '$fname' ";

			}
			$save_alumni = $this->db->query("UPDATE alumnus_bio set $data where id = '{$_SESSION['bio']['id']}' ");
			if($data){
				foreach ($_SESSION as $key => $value) {
					unset($_SESSION[$key]);
				}
				$login = $this->login2();
				if($login)
				return 1;
			}
		}
	}

	function save_settings(){
		extract($_POST);
		$data = " name = '".str_replace("'","&#x2019;",$name)."' ";
		$data .= ", email = '$email' ";
		$data .= ", contact = '$contact' ";
		$data .= ", about_content = '".htmlentities(str_replace("'","&#x2019;",$about))."' ";
		if($_FILES['img']['tmp_name'] != ''){
						$fname = strtotime(date('y-m-d H:i')).'_'.$_FILES['img']['name'];
						$move = move_uploaded_file($_FILES['img']['tmp_name'],'assets/uploads/'. $fname);
					$data .= ", cover_img = '$fname' ";

		}
		
		// echo "INSERT INTO system_settings set ".$data;
		$chk = $this->db->query("SELECT * FROM system_settings");
		if($chk->num_rows > 0){
			$save = $this->db->query("UPDATE system_settings set ".$data);
		}else{
			$save = $this->db->query("INSERT INTO system_settings set ".$data);
		}
		if($save){
		$query = $this->db->query("SELECT * FROM system_settings limit 1")->fetch_array();
		foreach ($query as $key => $value) {
			if(!is_numeric($key))
				$_SESSION['settings'][$key] = $value;
		}

			return 1;
				}
	}

	
	function save_plan(){
		extract($_POST);
		$data = " plan = '$plan' ";
		$data .= ", amount = '$amount' ";
			if(empty($id)){
				$save = $this->db->query("INSERT INTO plans set $data");
			}else{
				$save = $this->db->query("UPDATE plans set $data where id = $id");
			}
		if($save)
			return 1;
	}
	function delete_plan(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM plans where id = ".$id);
		if($delete){
			return 1;
		}
	}
	function save_package(){
		extract($_POST);
		$data = " package = '$package' ";
		$data .= ", description = '$description' ";
		$data .= ", amount = '$amount' ";
			if(empty($id)){
				$save = $this->db->query("INSERT INTO packages set $data");
			}else{
				$save = $this->db->query("UPDATE packages set $data where id = $id");
			}
		if($save)
			return 1;
	}
	function delete_package(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM packages where id = ".$id);
		if($delete){
			return 1;
		}
	}
	function save_trainer(){
		extract($_POST);
		$data = " name = '$name' ";
		$data .= ", email = '$email' ";
		$data .= ", contact = '$contact' ";
		$data .= ", rate = '$rate' ";
			if(empty($id)){
				$save = $this->db->query("INSERT INTO trainers set $data");
			}else{
				$save = $this->db->query("UPDATE trainers set $data where id = $id");
			}
		if($save)
			return 1;
	}
	function delete_trainer(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM trainers where id = ".$id);
		if($delete){
			return 1;
		}
	}
	function save_member(){
		extract($_POST);
		$data = '';
		foreach($_POST as $k=> $v){
			if(!empty($v)){
				if(!in_array($k,array('id','plan_id','package_id','trainee_id'))){
					if(empty($data))
					$data .= " $k='{$v}' ";
					else
					$data .= ", $k='{$v}' ";
				}
			}
		}
			if(empty($member_id)){
				$i = 1;
				while($i == 1){
					$rand = mt_rand(1,99999999);
					$rand =sprintf("%'08d",$rand);
					$chk = $this->db->query("SELECT * FROM members where member_id = '$rand' ")->num_rows;
					if($chk <= 0){
						$data .= ", member_id='$rand' ";
						$i = 0;
					}
				}
			}

		if(empty($id)){
			if(!empty($member_id)){
				$chk = $this->db->query("SELECT * FROM members where member_id = '$member_id' ")->num_rows;
				if($chk > 0){
					return 2;
					exit;
				}
			}
			$save = $this->db->query("INSERT INTO members set $data ");
			if($save){
				$member_id = $this->db->insert_id;
				$data = " member_id ='$member_id' ";
				$data .= ", plan_id ='$plan_id' ";
				$data .= ", package_id ='$package_id' ";
				$data .= ", trainer_id ='$trainer_id' ";
				$data .= ", start_date ='".date("Y-m-d")."' ";
				$plan = $this->db->query("SELECT * FROM plans where id = $plan_id")->fetch_array()['plan'];
				$data .= ", end_date ='".date("Y-m-d",strtotime(date('Y-m-d').' +'.$plan.' months'))."' ";
				$save = $this->db->query("INSERT INTO registration_info set $data");
				if(!$save)
					$this->db->query("DELETE FROM members where id = $member_id");
			}
		}else{
			if(!empty($member_id)){
				$chk = $this->db->query("SELECT * FROM members where member_id = '$member_id' and id != $id ")->num_rows;
				if($chk > 0){
					return 2;
					exit;
				}
			}
			$save = $this->db->query("UPDATE members set $data where id=".$id);
		}
		if($save)
			return 1;
	}
	function delete_member(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM faculty where id = ".$id);
		if($delete){
			return 1;
		}
	}
	function save_schedule(){
		extract($_POST);
		$data = " member_id = '$member_id' ";
		$data .= ", date_from = '{$date_from}-1' ";
		$data .= ", date_to = '".(date("Y-m-d",strtotime($date_to.'-1 +1 month -1 day')))."' ";
		$data .= ", time_from = '$time_from' ";
		$data .= ", time_to = '$time_to' ";
		$data .= ", dow = '".(implode(",",$dow))."'";

		if(empty($id)){

			$save = $this->db->query("INSERT INTO schedules set ".$data);
		}else{
			$save = $this->db->query("UPDATE schedules set ".$data." where id=".$id);
		}
		if($save)
			return 1;
	}
	function delete_schedule(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM schedules where id = ".$id);
		if($delete){
			return 1;
		}
	}
	function get_schecdule(){
		extract($_POST);
		$data = array();
		$qry = $this->db->query("SELECT s.*,concat(m.lastname,',',m.firstname,' ', m.middlename) as name FROM schedules s inner join members m on m.id = s.member_id");
		while($row=$qry->fetch_assoc()){
			
			$data[] = $row;
		}
			return json_encode($data);
	}
	function save_payment(){
		extract($_POST);
		$data = '';
		foreach($_POST as $k=> $v){
			if(!empty($v)){
				if(empty($data))
				$data .= " $k='{$v}' ";
				else
				$data .= ", $k='{$v}' ";
			}
		}
			$save = $this->db->query("INSERT INTO payments set ".$data);
		if($save)
			return 1;
	}
	function renew_membership(){
		extract($_POST);
		$prev = $this->db->query("SELECT * FROM registration_info where id = $rid")->fetch_array();
		$data = '';
		foreach($prev as $k=> $v){
			if(!empty($v) && !is_numeric($k) && !in_array($k,array('id','start_date','end_date','date_created'))){
				if(empty($data))
				$data .= " $k='{$v}' ";
				else
				$data .= ", $k='{$v}' ";
				$$k=$v;
			}
		}
				$data .= ", start_date ='".date("Y-m-d")."' ";
				$plan = $this->db->query("SELECT * FROM plans where id = $plan_id")->fetch_array()['plan'];
				$data .= ", end_date ='".date("Y-m-d",strtotime(date('Y-m-d').' +'.$plan.' months'))."' ";
				$save = $this->db->query("INSERT INTO registration_info set $data");
				if($save){
					$id = $this->db->insert_id;
					$this->db->query("UPDATE registration_info set status = 0 where member_id = $member_id and id != $id ");
					return $id;
				}

	}
	function end_membership(){
		extract($_POST);
		$update = $this->db->query("UPDATE registration_info set status = 0 where id = ".$rid);
		if($update){
			return 1;
		}
	}
	
	function save_membership(){
		extract($_POST);
		$data = '';
		foreach($_POST as $k=> $v){
		if(!empty($v)){
			if(empty($data))
			$data .= " $k='{$v}' ";
			else
			$data .= ", $k='{$v}' ";
			$$k=$v;
		}
	}
	$data .= ", start_date ='".date("Y-m-d")."' ";
	$plan = $this->db->query("SELECT * FROM plans where id = $plan_id")->fetch_array()['plan'];
	$data .= ", end_date ='".date("Y-m-d",strtotime(date('Y-m-d').' +'.$plan.' months'))."' ";
	$save = $this->db->query("INSERT INTO registration_info set $data");
	if($save){
		$id = $this->db->insert_id;
		$this->db->query("UPDATE registration_info set status = 0 where member_id = $member_id and id != $id ");
		return 1;
	}
	}
}