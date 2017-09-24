<?php
	class BlogController{
		public function add(){
			if(!isset($_SESSION['me'])||$_SESSION['me']['id']<=0){
			header('Refresh:3,Url=index.php?c=UserCenter&a=login');
			// 	header('Location:index.php?c=UserCenter&a=login');
				echo "不能发布文章，请登录！";
			}else{
				include "./view/blog/add.html";
			}
			
		}
		public function doAdd(){
			$content = $_POST['content'];
			$user_id = $_SESSION['me']['id'];
			$blogModel = new BlogModel();
			$blogModel->addBlog($content,$user_id);
			header('Refresh:3,Url=index.php?c=Blog&a=lists');
			echo "发布成功，3秒后跳转";
		}
		public function lists(){
			$blogModel = new BlogModel();
			$userModel = new UserModel();
			$data = $blogModel->getBlogLists();
			foreach ($data as $key => $value){
				$user_info = $userModel->getUserInfoById($value['user_id']);
				$data[$key]['user_name'] = $user_info['name'];
		    }
			include "./view/blog/lists.html";
		}
	}