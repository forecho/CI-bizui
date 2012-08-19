<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper(array('form', 'url'));
		$this->load->model('mhome');
	}
	
	public function index(){
		$this->load->view('header');
		$this->load->view('index');
		$this->load->view('footer');
	}
	
	// index_ajax
	function u_index_ajax(){
		$lastmsg = $this->input->post('lastmsg');
		$uid = $this->input->post('uid');
		if(isset($lastmsg) && is_numeric($lastmsg)){
			$data['u_index_ajax'] = $this->mhome->u_index_ajax($lastmsg,$uid);
			$data['u_index_ajax_num'] = $this->mhome->u_index_ajax_num($lastmsg,$uid);
			$data['uid'] = $uid;
			$data['lastmsg'] = $lastmsg+2;
			$this->load->view('index_ajax',$data);
		}
	}
	
	
	//登陆
	function login(){
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$data["error"] = "";
		if ($this->form_validation->run()!= false) {
			$this->load->model('mhome');
			$res = $this->mhome->login(
					$this->input->post('email'),
					$this->input->post('password')
			);
			if ($res != "") {
				$sessionid = $this->mhome->sessionid($this->input->post('email'));
				$this->session->set_userdata('uid',$sessionid['uid']);
				//echo $this->session->userdata('uid');
				redirect('welcome/index');
			}else{
				$data["error"] = "密码用户名错误";
			}
		}
 		$this->load->view('login',$data);
		
	}
	
	//退出
	function logout() {
		$this->session->sess_destroy();
		//$this->load->view('login');
	}
	
	
	function users(){
		$data['seluser'] = $this->mhome->seluser($this->uri->segment(3));
		$this->load->view('header');
		$this->load->view('users',$data);
	}
	
	function comment(){
		$data['selproduct'] = $this->mhome->selproduct(rawurldecode($this->uri->segment(3)));
		if($this->uri->segment(4) ==""){
			$data['selinfo'] = $this->mhome->selinfo(rawurldecode($this->uri->segment(3)));
		}else{
			$data['selinfo'] = $this->mhome->selinfo_time(rawurldecode($this->uri->segment(3)));
		}
		$data['seluser'] = $this->mhome->seluser($this->session->userdata('uid'));
		$this->load->view('header');
		$this->load->view('comment',$data);
	}
	
	function explore(){
		$this->load->view('header');
		$this->load->view('explore');
	}
	
	function tags(){
		$data['selclass'] = $this->mhome->selclass();
		$data['selbrands'] = $this->mhome->sel_brands(rawurldecode($this->uri->segment(3)));
		$this->load->view('header');
		$this->load->view('tags',$data);
	}
	
	function product(){
		if($this->uri->segment(4) ==""){
			$data['sel_product'] = $this->mhome->sel_product(rawurldecode($this->uri->segment(3)));
		}else{
			$data['sel_product'] = $this->mhome->sel_product_m(rawurldecode($this->uri->segment(4)));
		}
		$this->load->view('header');
		$this->load->view('product',$data);
	}
	function addpro(){
		$data['selclass'] = $this->mhome->selclass();
		$data['selbrands'] = $this->mhome->selbrands();
		$data['selmoney'] = $this->mhome->selmoney();
		$this->load->view('header');
		$this->load->view('addpro',$data);
	}
	function editpro(){
		$data['selclass'] = $this->mhome->selclass();
		$data['selbrands'] = $this->mhome->selbrands();
		$data['selmoney'] = $this->mhome->selmoney();
		$data['selproduct'] = $this->mhome->selproduct(rawurldecode($this->uri->segment(3)));
		$this->load->view('header');
		$this->load->view('editpro',$data);
	}
	
	
	
	function liandong_ajax(){
		$cname = rawurldecode($this->uri->segment(3));
		$data['sel_brands'] = $this->mhome->sel_brands($cname);
		$this->load->view('liandong_ajax',$data);
	}
	
	
	
	//添加产品
	function addproduct() {
		$config['upload_path'] = 'images/3c/';//绝对路径
		$config['allowed_types'] = 'cdr|gif|jpg|png';//文件支持类型
		$config['max_size'] = '2000';
		$config['encrypt_name'] = true;//重命名文件

		$this->load->library('upload',$config);
		
		if ($this->upload->do_upload('upload')) {
			$upload_data = $this->upload->data();
			//图片处理
			$config['source_image'] = $upload_data['full_path'];
			$config['maintain_ratio'] = true;
			$config['width'] = 120;
			$config['height'] = 90;
			$this->load->library('image_lib',$config);
			$this->image_lib->resize();
			
			$query = 1; 
			//调用模型，写入数据库
			$this->mhome->addproduct($upload_data['file_name']);
		}
		else {
			$this->upload->display_errors();
			$query = 0; 
			  echo $this->upload->display_errors();
		}
		//提示
		$data['succ'] = $query;
		$data['su1'] = "提交成功";
		$data['su0'] = "文件上传失败,请检查文件再重新上传";
		$this->load->view('success', $data);		
	}
	
	//修改产品
	function editproduct() {
		$file_name = $this->input->post('pimg');
		if($_FILES["upload"]["error"] > 0){
			$this->mhome->editproduct($file_name);
			$query = 1; 
		}else{
			@unlink('./images/3c/'.$file_name);

			$config['upload_path'] = 'images/3c/';//绝对路径
			$config['allowed_types'] = 'cdr|gif|jpg|png';//文件支持类型
			$config['max_size'] = '2000';
			$config['encrypt_name'] = true;//重命名文件

			$this->load->library('upload',$config);
			
			if ($this->upload->do_upload('upload')) {
				$upload_data = $this->upload->data();
				//图片处理
				$config['source_image'] = $upload_data['full_path'];
				$config['maintain_ratio'] = true;
				$config['width'] = 120;
				$config['height'] = 90;
				$this->load->library('image_lib',$config);
				$this->image_lib->resize();
				
				//调用模型，写入数据库
				$this->mhome->editproduct($upload_data['file_name']);
				$query = 1; 
			}
			else {
				$query = 0; 
				echo $this->upload->display_errors();
			}
			
		}
		//提示
		$data['succ'] = $query;
		$data['su1'] = "提交成功";
		$data['su0'] = "文件上传失败,请检查文件再重新上传";
		$this->load->view('success', $data);		
	}
	
	
	//添加信息
	function addinfo(){
		if(isset($_POST['submit'])){
			$this->mhome->addinfo($_POST['pname'],$_POST['pid']);
			$query = 1; 
		}else {
			$query = 0; 
		}
		redirect($_SERVER['HTTP_REFERER'].'#answer');
	}
	//修改信息
	function editinfo(){
		if(isset($_POST['submit'])){
			$this->mhome->editinfo($_POST['iid']);
			$query = 1; 
		}else {
			$query = 0; 
		}
		redirect($_SERVER['HTTP_REFERER'].'#answer');
	
	}
	//删除信息
	function delinfo(){
		$this->mhome->delinfo($this->uri->segment(3));
		redirect($_SERVER['HTTP_REFERER'].'#answer');
	}

	// function addinfo(){

		//echo rawurldecode($this->uri->segment(3));
		
		// $data['selproduct'] = $this->mhome->selproduct(rawurldecode($this->uri->segment(3)));
		// if($this->uri->segment(4) ==""){
			// $data['selinfo'] = $this->mhome->selinfo(rawurldecode($this->uri->segment(3)));
		// }else{
			// $data['selinfo'] = $this->mhome->selinfo_time(rawurldecode($this->uri->segment(3)));
		// }
		// if($this->input->post('ajax')){
			// $this->mhome->addinfo(rawurldecode($this->uri->segment(3)));
			// $this->load->view('comment_box',$data);
		// }else{
			// $this->load->view('success');
			//redirect($_SERVER['HTTP_REFERER']);
		// }
	// }
	
	//添加信息评论
	function addcomment(){
		if(isset($_POST['submit'])){
			$this->mhome->addcomment($_POST['iid']);
			$query = 1; 
			redirect($_SERVER['HTTP_REFERER']);
		}else {
			$query = 0; 
		}
		//提示
		// $data['succ'] = $query;
		// $data['su1'] = "提交成功";
		// $data['su0'] = "文件上传失败,请检查文件再重新上传";
		// $this->load->view('success', $data);
	}
	//添加关注
	function addfollow(){
		$pid = $this->input->post('pid');
		if($this->input->post('ajax')){
			$this->mhome->addfollow($pid);
			$data['pid'] = $pid;
			
			$this->load->view('follow', $data);
			//$query = 1; 
			//redirect($_SERVER['HTTP_REFERER']);
		}
	}
	//取消关注
	function delfollow(){
		$pid = $this->input->post('pid');
		if($this->input->post('ajax')){
			$this->mhome->delfollow($pid);
			$data['pid'] = $pid;
			$this->load->view('follow', $data);
			//$query = 1; 
			//redirect($_SERVER['HTTP_REFERER']);
		}
	}	


	//添加关注
	function add_follow(){
		$pid = $this->input->post('pid');
		if($this->input->post('ajax')){
			$this->mhome->addfollow($pid);	
			$data['pid'] = $pid;
			$this->load->view('is_follow', $data);
		}
		//redirect($_SERVER['HTTP_REFERER']);
	}
	//取消关注
	function del_follow(){
		$pid = $this->input->post('pid');
		if($this->input->post('ajax')){
			$this->mhome->delfollow($pid);	
			$data['pid'] = $pid;
			$this->load->view('is_follow', $data);
		}
	
	
		// $pid = $this->uri->segment(3);
		// $this->mhome->delfollow($pid);
		// redirect($_SERVER['HTTP_REFERER']);
	}
	
	//表示赞同
	function addup(){
		$iid = $this->input->post('iid');
		if($this->input->post('ajax')){
			$this->mhome->addup($iid);
			$data['iid'] = $iid;
			$this->load->view('up', $data);
		}
	}
	//取消赞同
	function adddown(){
		$iid = $this->input->post('iid');
		if($this->input->post('ajax')){
			$this->mhome->adddown($iid);
			$data['iid'] = $iid;
			$this->load->view('up', $data);
		}
	}	
	
	//关注人
	function add_ifollow(){
		if($this->uri->segment(3) != ''){
			$uid = $this->uri->segment(3);
			$this->mhome->add_ifollow($uid);
			redirect($_SERVER['HTTP_REFERER']);
		}
		$uid = $this->input->post('uid');
		if($this->input->post('ajax')){
			$this->mhome->add_ifollow($uid);
			$data['uid'] = $uid;
			$this->load->view('ifollow', $data);
			//redirect($_SERVER['HTTP_REFERER']);
		}
	}
	//取消关注 人
	function del_ifollow(){
		if($this->uri->segment(3) != ''){
			$uid = $this->uri->segment(3);
			$this->mhome->del_ifollow($uid);
			redirect($_SERVER['HTTP_REFERER']);
		}
	
		$uid = $this->input->post('uid');
		if($this->input->post('ajax')){
			$this->mhome->del_ifollow($uid);
			$data['uid'] = $uid;
			$this->load->view('ifollow', $data);
			//$query = 1; 
			//redirect($_SERVER['HTTP_REFERER']);
		}
	}
	
	// users_ajax
	function i_info_ajax(){
		$lastmsg = $this->input->post('lastmsg');
		$uid = $this->input->post('uid');
		if(isset($lastmsg) && is_numeric($lastmsg)){
			$data['i_info_ajax'] = $this->mhome->i_info_ajax($lastmsg,$uid);
			$data['i_info_ajax_num'] = $this->mhome->i_info_ajax_num($lastmsg,$uid);
			$data['uid'] = $uid;
			$data['lastmsg'] = $lastmsg+10;
			$data['uname'] = $this->input->post('uname');
			$this->load->view('users_ajax',$data);
		}
	}
	
	// 正在关注ajax
	function i_follow_ajax(){
		$lastmsg = $this->input->post('lastmsg');
		$uid = $this->input->post('uid');
		if(isset($lastmsg) && is_numeric($lastmsg)){
			$data['i_follow_ajax'] = $this->mhome->i_follow_ajax($lastmsg,$uid);
			$data['i_follow_ajax_num'] = $this->mhome->i_follow_ajax_num($lastmsg,$uid);
			$data['uid'] = $uid;
			$data['lastmsg'] = $lastmsg+10;
			$data['uname'] = $this->input->post('uname');
			$this->load->view('i_follow_ajax',$data);
		}
	}
	
	// 正在关注ajax
	function u_follow_ajax(){
		$lastmsg = $this->input->post('lastmsg');
		$uid = $this->input->post('uid');
		if(isset($lastmsg) && is_numeric($lastmsg)){
			$data['u_follow_ajax'] = $this->mhome->u_follow_ajax($lastmsg,$uid);
			$data['u_follow_ajax_num'] = $this->mhome->u_follow_ajax_num($lastmsg,$uid);
			//$data['uid'] = $uid;
			$data['lastmsg'] = $lastmsg+3;
			//$data['uname'] = $this->input->post('uname');
			$this->load->view('u_follow_ajax',$data);
		}
	}
		// 粉丝ajax
	function follow_i_ajax(){
		$lastmsg = $this->input->post('lastmsg');
		$uid = $this->input->post('uid');
		if(isset($lastmsg) && is_numeric($lastmsg)){
			$data['follow_i_ajax'] = $this->mhome->follow_i_ajax($lastmsg,$uid);
			$data['follow_i_ajax_num'] = $this->mhome->follow_i_ajax_num($lastmsg,$uid);
			//$data['uid'] = $uid;
			$data['lastmsg'] = $lastmsg+1;
			//$data['uname'] = $this->input->post('uname');
			$this->load->view('follow_i_ajax',$data);
		}
	}
	
	
	
}