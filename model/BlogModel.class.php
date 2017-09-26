<?php
	class BlogModel{
		public $mysqli;
		function __construct(){
			$this->mysqli = new mysqli("localhost","root","","ztstunew");
			$this->mysqli->query('set names utf8');
		}
		public function addBlog($content,$user_id){
			$sql = "insert into blog(content,user_id) value('{$content}',{$user_id})";
			$res = $this->mysqli->query($sql);
			return $res;
		}
		public function getBlogLists($offset = 0,$limit=20){
			$sql = "select * from blog limit {$offset},{$limit}";
			$res = $this->mysqli->query($sql);
			$data = $res->fetch_all(MYSQL_ASSOC);
		    return $data;
		}
		public function getBlogCount(){
			$sql = "select count(*) as num from blog";
			$res = $this->mysqli->query($sql);
			$data = $res->fetch_all(MYSQL_ASSOC);
			return $data[0]['num'];
		}
		function getUserInfoByName($name) {
			$sql = "select * from user where name = '{$name}'";
			$res = $this->mysqli->query($sql);
			$data = $res->fetch_all(MYSQL_ASSOC);
			return $data[0];
		}
		public function getinfo($id){
			$sql = "select * from blog where id = {$id}";
			$res = $this->mysqli->query($sql);
            $info = $res->fetch_all(MYSQL_ASSOC);
			return $info[0];
		}
	}