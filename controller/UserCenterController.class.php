<?php
	class UserCenterController{
		public function login(){
			include "./view/usercenter/login.html";
		}
		public function doLogin(){
			$name = $_POST['name'];
			$password = $_POST['password'];
			$userModel = new userModel();
			$userInfo = $userModel->getUserInfoByName($name);
			if($userInfo['password']==$password){
				unset($userInfo['password']);
				$_SESSION['me'] = $userInfo;
				header('Refresh:3,Url=index.php?c=Blog&a=lists');
				echo '登录成功';
				die();
			}else{
				echo '登录不成功';
				die();
			}
		}
		public function logout(){
			unset($_SESSION['me']);
			header('Refresh:3,Url=index.php?c=UserCenter&a=login');
			echo '退出登录';
			die();
		}
		public function reg(){
			include "./view/usercenter/reg.html";
		}
		public function doReg(){
			$name = $_POST['username'];
			$age = $_POST['age'];
			$password = $_POST['password'];
			if (empty($name) || empty($age) ||empty($password)) {
				header('localhost:index.php?c=UserCenter&a=reg');
				echo '参数错误，请重新填写';
				die();
			}
			$userModel = new userModel();
			$status = $userModel->addUser($name, $age, $password);
			if ($status) {
				header('Refresh:1,Url=index.php?c=UserCenter&a=login');
				echo '注册成功，请登录';
				die();
			} else {
				header('localhost:index.php?c=UserCenter&a=reg');
				echo '注册失败';
				die();
			}
		}
	}
