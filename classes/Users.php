<?php
require_once('../config.php');
Class Users extends DBConnection {
	private $settings;
	public function __construct(){
		global $_settings;
		$this->settings = $_settings;
		parent::__construct();
	}
	public function __destruct(){
		parent::__destruct();
	}
	public function save_users(){

		function reArrayFiles(&$file_post){
			$file_ary = array();
			$file_count = count($file_post['name']);
			$file_keys = array_keys($file_post);
		  
			for($i = 0; $i<$file_count; $i++){
				foreach($file_keys as $key){
					$file_ary[$i][$key] = $file_post[$key][$i];
				}
			}
		  
			return $file_ary;
		  }
		  
		  
		  function pre_r($array){
			echo '<pre>';
			print_r($array);
			echo '</pre>';
		  }
		  
		if(empty($_POST['password']))
			unset($_POST['password']);
		else
		$_POST['password'] = md5($_POST['password']);
		extract($_POST);
		$data = '';
		foreach($_POST as $k => $v){
			if(!in_array($k,array('id'))){
				if(!empty($data)) $data .=" , ";
				$data .= " {$k} = '{$v}' ";
			}
		}
		if(empty($id)){
			$qry = $this->conn->query("INSERT INTO users set {$data}");
			if($qry){
				$id=$this->conn->insert_id;
				$this->settings->set_flashdata('success','User Details successfully saved.');
				foreach($_POST as $k => $v){
					if($k != 'id'){
						if(!empty($data)) $data .=" , ";
						if($this->settings->userdata('id') == $id)
						$this->settings->set_userdata($k,$v);
					}
				}
				if(!empty($_FILES['userfile'])){
					// echo "merong laman";

					$file_array = reArrayFiles($_FILES['userfile']);

					for($i = 0; $i<count($file_array); $i++){
						if($file_array[$i]['error']){
							?> <div class="alert alert-danger">
							<?php echo $file_array[$i]['name'].' - '.$phpFileUploadErrors[$file_array[$i]['error']];
							?> </div> <?php
						}
				  
						else{
							$extensions = array('jpg', 'png', 'gif', 'jpeg', 'pdf');
				  
							$file_ext = explode('.', $file_array[$i]['name']);
				  
							$name = $file_ext[0];
							$name = preg_replace("!-!", " ", $name);
							$name = ucwords($name);
							
				  
							$file_ext = end($file_ext);
				  
							if(!in_array($file_ext, $extensions)){
								?> <div class="alert alert-danger">
								<?php echo "{$file_array[$i]['name']} - Invalid File Extension!";
								?> </div> <?php
							}
				  
							else {
								
								$img_dir = '../uploads/avatars/'.$file_array[$i]['name'];
								move_uploaded_file($file_array[$i]['tmp_name'], $img_dir);
								// move_uploaded_file($file_array[$i]['tmp_name'], $img_dir);
				  
								$sql = "UPDATE users set name='$name', image_dir='$img_dir' where id = '{$id}'";
								mysqli_query($this->conn, $sql);
								// $mysqli->query($sql) or die ($mysqli->error);
				  
								
				  
								// echo '<script>alert("We received your registration for accessing the web-based query system for university of rizal system binangonan campus. Kindly Wait for your account confirmation in 24 up to 48 hours, An email will be sent to you once the account is validated Thank You.")</script>';
								// echo '<script>window.location.href = "studentregister.php"</script>';
							}
				  
				  
						}
				  
					}
					// if(!is_dir(base_app."uploads/avatars"))
					// 	mkdir(base_app."uploads/avatars");
					// $ext = pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION);
					// $fname = "uploads/avatars/$id.png";
					// $accept = array('image/jpeg','image/png');
					// if(!in_array($_FILES['img']['type'],$accept)){
					// 	$err = "Image file type is invalid";
					// }
					// if($_FILES['img']['type'] == 'image/jpeg')
					// 	$uploadfile = imagecreatefromjpeg($_FILES['img']['tmp_name']);
					// elseif($_FILES['img']['type'] == 'image/png')
					// 	$uploadfile = imagecreatefrompng($_FILES['img']['tmp_name']);
					// if(!$uploadfile){
					// 	$err = "Image is invalid";
					// }
					// $temp = imagescale($uploadfile,200,200);
					// if(is_file(base_app.$fname))
					// unlink(base_app.$fname);
					// $upload =imagepng($temp,base_app.$fname);
					// if($upload){
					// 	$this->conn->query("UPDATE `users` set `avatar` = CONCAT('{$fname}', '?v=',unix_timestamp(CURRENT_TIMESTAMP)) where id = '{$id}'");
					// 	if($this->settings->userdata('id') == $id)
					// 	$this->settings->set_userdata('avatar',$fname."?v=".time());
					// }

					// imagedestroy($temp);
				}
				return 1;
			}else{
				return 2;
			}

		}else{
			$qry = $this->conn->query("UPDATE users set $data where id = {$id}");
			if($qry){
				$this->settings->set_flashdata('success','User Details successfully updated.');
				foreach($_POST as $k => $v){
					if($k != 'id'){
						if(!empty($data)) $data .=" , ";
						if($this->settings->userdata('id') == $id)
							$this->settings->set_userdata($k,$v);
					}
				}

				if(!empty($_FILES['userfile'])){
					// echo "merong laman";

					$file_array = reArrayFiles($_FILES['userfile']);

					for($i = 0; $i<count($file_array); $i++){
						if($file_array[$i]['error']){
							?> <div class="alert alert-danger">
							<?php echo $file_array[$i]['name'].' - '.$phpFileUploadErrors[$file_array[$i]['error']];
							?> </div> <?php
						}
				  
						else{
							$extensions = array('jpg', 'png', 'gif', 'jpeg', 'pdf');
				  
							$file_ext = explode('.', $file_array[$i]['name']);
				  
							$name = $file_ext[0];
							$name = preg_replace("!-!", " ", $name);
							$name = ucwords($name);
							
				  
							$file_ext = end($file_ext);
				  
							if(!in_array($file_ext, $extensions)){
								?> <div class="alert alert-danger">
								<?php echo "{$file_array[$i]['name']} - Invalid File Extension!";
								?> </div> <?php
							}
				  
							else {
								
								$img_dir = '../uploads/avatars/'.$file_array[$i]['name'];
								move_uploaded_file($file_array[$i]['tmp_name'], $img_dir);
								// move_uploaded_file($file_array[$i]['tmp_name'], $img_dir);
				  
								$sql = "UPDATE users set name='$name', image_dir='$img_dir' where id = '{$id}'";
								mysqli_query($this->conn, $sql);
								// $mysqli->query($sql) or die ($mysqli->error);
				  
								
				  
								// echo '<script>alert("We received your registration for accessing the web-based query system for university of rizal system binangonan campus. Kindly Wait for your account confirmation in 24 up to 48 hours, An email will be sent to you once the account is validated Thank You.")</script>';
								// echo '<script>window.location.href = "studentregister.php"</script>';
							}
				  
				  
						}
				  
					}
				// if(!empty($_FILES['img']['tmp_name'])){
				// 	if(!is_dir(base_app."uploads/avatars"))
				// 		mkdir(base_app."uploads/avatars");
				// 	$ext = pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION);
				// 	$fname = "uploads/avatars/$id.png";
				// 	$accept = array('image/jpeg','image/png');
				// 	if(!in_array($_FILES['img']['type'],$accept)){
				// 		$err = "Image file type is invalid";
				// 	}
				// 	if($_FILES['img']['type'] == 'image/jpeg')
				// 		$uploadfile = imagecreatefromjpeg($_FILES['img']['tmp_name']);
				// 	elseif($_FILES['img']['type'] == 'image/png')
				// 		$uploadfile = imagecreatefrompng($_FILES['img']['tmp_name']);
				// 	if(!$uploadfile){
				// 		$err = "Image is invalid";
				// 	}
				// 	$temp = imagescale($uploadfile,200,200);
				// 	if(is_file(base_app.$fname))
				// 	unlink(base_app.$fname);
				// 	$upload =imagepng($temp,base_app.$fname);
				// 	if($upload){
				// 		$this->conn->query("UPDATE `users` set `avatar` = CONCAT('{$fname}', '?v=',unix_timestamp(CURRENT_TIMESTAMP)) where id = '{$id}'");
				// 		if($this->settings->userdata('id') == $id)
				// 		$this->settings->set_userdata('avatar',$fname."?v=".time());
				// 	}

				// 	imagedestroy($temp);
				}

				return 1;
			}else{
				return "UPDATE users set $data where id = {$id}";
			}
			
		}
	}
	
	public function delete_users(){
		extract($_POST);
		$qry = $this->conn->query("DELETE FROM users where id = $id");
		if($qry){
			$this->settings->set_flashdata('success','User Details successfully deleted.');
			if(is_file(base_app."uploads/avatars/$id.png"))
				unlink(base_app."uploads/avatars/$id.png");
			return 1;
		}else{
			return false;
		}
	}
	
}

$users = new users();
$action = !isset($_GET['f']) ? 'none' : strtolower($_GET['f']);
switch ($action) {
	case 'save':
		echo $users->save_users();
	break;
	case 'delete':
		echo $users->delete_users();
	break;
	default:
		// echo $sysset->index();
		break;
}