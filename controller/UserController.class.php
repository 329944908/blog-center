<?php
	class UserController{
		public function setSession(){
			session_start();
		}
		public function getSession() {
			return $_SESSION;
		}
		public function add(){
			include "./view/user/add.html";
		}
		public function doAdd(){
			$name = $_POST['username'];
			$age = $_POST['age'];
			$password = $_POST['password'];
			if (empty($name) || empty($age) ||empty($password)) {
				header('Refresh:3,Url=index.php?c=User&a=lists');
				echo '参数错误发布失败，3秒后跳转到list';
				die();
			}
			$userModel = new userModel();
			$status = $userModel->addUser($name, $age, $password);
			if ($status) {
				header('Refresh:1,Url=index.php?c=User&a=lists');
				echo '发布成功，1秒后跳转到list';
				die();
			} else {
				header('Refresh:3,Url=index.php?c=User&a=lists');
				echo '发布失败，3秒后跳转到list';
				die();
			}
		}
		public function delete(){
			$id = $_GET['id'] ? (int)$_GET['id'] : 0;
			$userModel = new UserModel();
			$res = $userModel->deleteUser($id);
			if(!is_int($id)||!$id){
				header('Refresh:3,Url=index.php?c=User&a=lists');
				echo "参数不合法";
				die();
			}
			else {
				header('Refresh:3,Url=index.php?c=User&a=lists');
				echo '删除成功，3秒后跳转到list';
				die();
			}
		}
		public function update(){
			$id = $_GET['id'] ? (int)$_GET['id'] : 0;
			$userModel = new UserModel();
			$info = $userModel->getUserinfo($id);
			include "./view/user/edit.html";
			if(!is_int($id)||!$id){
			header('Refresh:3,Url=Url=index.php?c=User&a=lists');
			echo "参数不合法";
			die();

			}
		}
		public function doUpdate(){
			$id = $_POST['id'];
			$name = $_POST['username'];
			$age = $_POST['age'];
			$password = $_POST['password'];
			$userModel = new UserModel();
			$res = $userModel->updateUser($id,$name, $age, $password);
			header('Refresh:3,Url=index.php?c=User&a=lists');
			echo "修改成功，3秒后跳转";
		}
		public function lists(){
			$userModel = new UserModel();
			$data = $userModel->getUserLists();
			include "./view/user/lists.html";
		}
	}