<?php
	class BlogController{
		public function add(){
			if(!isset($_SESSION['me'])||$_SESSION['me']['id']<=0){
				header('Refresh:3,Url=index.php?c=UserCenter&a=login');
				echo "不能发布文章，请登录！";
				die();
			}
			include "./view/blog/add.html";	
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
			$p = isset($_GET['p']) ? $_GET['p'] : 1;
			$pageNum = 3;
			$offset = ($p - 1) * $pageNum;
			$count = $blogModel->getBlogCount();
			$allPage = ceil($count/$pageNum);
			$data = $blogModel->getBlogLists($offset,$pageNum);
			foreach ($data as $key => $value){
				$user_info = $userModel->getUserInfoById($value['user_id']);
				$data[$key]['user_name'] = $user_info['name'];
		    }
			include "./view/blog/lists.html";
		}
		public function info(){
			$id = $_GET['id'];
			$blogModel = new BlogModel();
			$info = $blogModel->getinfo($id);
			include "./view/user/info.html";
		}
	}