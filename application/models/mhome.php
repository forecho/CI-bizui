<?php 
class Mhome extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	
	
	
	//登陆
	function login($email,$password) {
		$query = $this
				->db
				->where('email',$email)
				->where('password',$password)
				//->where('password',md5($password))
				->limit(1)
				->get('user');
		if ($query->num_rows() > 0) {
			return $query->row();
		}
	}
	
	function sessionid($email) {
		$query = $this->db->get_where('user',array('email' => $email));
		return $query->row_array();
	}	

	//读取类型
	function selclass(){
		$this->db->order_by("cid", "asc"); 
		$query = $this->db->get('class');
		return $query->result_array();
	}
	
	//读取品牌
	function sel_brands($cname){
		$this->db->order_by("bid", "asc"); 
		$query = $this->db->get_where('brands',array('cname' => $cname));
		return $query->result_array();
	}
	function selbrands(){
		$this->db->order_by("bid", "asc"); 
		$query = $this->db->get('brands');
		return $query->result_array();
	}
	//价格区间
	function selmoney(){
		$query = $this->db->get('money');
		return $query->result_array();
	}
	
	//查品牌一样的产品
	function sel_product($bname){
		$this->db->order_by("pid", "asc"); 
		$query = $this->db->get_where('product',array('bname' => $bname));
		return $query->result_array();
	}
	//查品牌一样的产品
	function sel_product_m($money){
		$this->db->order_by("pid", "asc"); 
		$query = $this->db->get_where('product',array('money' => $money));
		return $query->result_array();
	}
	function like_product($bname){
		$this->db->limit(15);
		$this->db->order_by("pid", "asc"); 
		$query = $this->db->get_where('product',array('bname' => $bname));
		return $query->result_array();
	}
	//添加浏览次数
	function addbrowse($pid){
		$query = $this->db->get_where('product',array('pid' => $pid))->row_array();
		$browse = $query['browse']+1;
		$this->db->where('pid', $pid);
		$this->db->update('product', array('browse' => $browse)); 
	}
	
	//查询产品
	function selproduct($pname){
		$query = $this->db->get_where('product',array('pname' => $pname));
		return $query->row_array();
	}
	//查询是否关注
	function selfollow($pid){
		$uid = $this->session->userdata('uid');
		$query = $this->db->get_where('follow',array('pid' => $pid,'uid' => $uid));
		return $query->num_rows(); 
	}
	//查询产品
	function seluser($uid){
		$query = $this->db->get_where('user',array('uid' => $uid));
		return $query->row_array();
	}
	//查询评论
	function selcomment($iid){
		$query = $this->db->get_where('comment',array('iid' => $iid));
		return $query->result_array();
	}
	//查询产品信息评论数量
	function num_comment($iid){
		$query = $this->db->get_where('comment',array('iid' => $iid));
		return $query->num_rows(); 
	}
	//查询观点
	function selinfo($pname){
		$this->db->order_by("yes_num", "desc"); 
		$this->db->order_by("addtime", "asc"); 
		$query = $this->db->get_where('info',array('pname' => $pname));
		return $query->result_array();
	}
	function selinfo_time($pname){
		$this->db->order_by("addtime", "desc"); 
		$query = $this->db->get_where('info',array('pname' => $pname));
		return $query->result_array();
	}
	
	//添加图片
	function addproduct($file_name) {
		$pname = $this->input->post('pname');
		$bname = $this->input->post('bname');
		$pinfo = $this->input->post('pinfo');
		$cname = $this->input->post('cname');
		$money = $this->input->post('money');
		//$pinfo = $this->input->post('pinfo');
		//$para = $this->input->post('para');  //参数
		date_default_timezone_set('PRC');
		$addtime = date("Y-m-d H:i:s");
		$data = array('pname'=>$pname,'bname'=>$bname,'cname'=>$cname,'money'=>$money,'pinfo'=>$pinfo,'addtime'=>$addtime,'pimg'=>$file_name);
		$query = $this->db->insert('product',$data);
	}
		//添加图片
	function editproduct($file_name) {
		$pname = $this->input->post('pname');
		$bname = $this->input->post('bname');
		$pinfo = $this->input->post('pinfo');
		$cname = $this->input->post('cname');
		$money = $this->input->post('money');
		$pid = $this->input->post('pid');
		$para = $this->input->post('editorValue');  //参数
		date_default_timezone_set('PRC');
		$addtime = date("Y-m-d H:i:s");
		$data = array('pname'=>$pname,'bname'=>$bname,'cname'=>$cname,'money'=>$money,'pinfo'=>$pinfo,'addtime'=>$addtime,'pimg'=>$file_name,'para'=>$para);
		$this->db->update('product',$data,array('pid' => $pid));
	}
	
	
	
	
	//添加信息
	function addinfo($pname,$pid) {
		$title = $this->input->post('title');
		$score = $this->input->post('score');
		$uid = $this->session->userdata('uid');
		$content = $this->input->post('editorValue');  
		date_default_timezone_set('PRC');
		$addtime = date("Y-m-d");
		$data = array('title'=>$title,'score'=>$score,'content'=>$content,'addtime'=>$addtime,'pname'=>$pname,'uid'=>$uid,'yes'=>'@','no'=>'@');
		$query = $this->db->insert('info',$data);
		
		if($this->selfollow($pid) == 0){
			$follow = array('uid'=>$uid,'pid'=>$pid,'addtime'=>$addtime);
			$this->db->insert('follow',$follow);
		}
	}
	
	function editinfo($iid){
		$title = $this->input->post('title');
		$score = $this->input->post('score');
		$content = $this->input->post('editorValue'); 
		$data = array('title'=>$title,'score'=>$score,'content'=>$content);
		$this->db->update('info',$data,array('iid' => $iid));
	}
	
	//删除信息
	function delinfo($iid) {
		$query = $this->db->delete('info', array('iid'=>$iid));
	}
	
	
	//添加信息评论
	function addcomment($iid) {
		$comment = $this->input->post('comment');
		$uid = $this->session->userdata('uid');
		date_default_timezone_set('PRC');
		$addtime = date("Y-m-d H:i:s");
		$data = array('comment'=>$comment,'iid'=>$iid,'addtime'=>$addtime,'uid'=>$uid);
		$query = $this->db->insert('comment',$data);
	}
	//查询每个产品信息数量
	function info_num($pname){
		$query = $this->db->get_where('info',array('pname' => $pname));
		return $query->num_rows(); 
	}
	//求评分总和
	function info_sum($pname){
		$this->db->select_sum('score');
		$query = $this->db->get_where('info',array('pname' => $pname));
		return $query->row_array();
	}
	//是否评论
	function is_comment($pname){
		$uid = $this->session->userdata('uid');
		$query = $this->db->get_where('info',array('pname' => $pname,'uid' => $uid));
		return $query->num_rows(); 
	}
	//添加关注
	function addfollow($pid) {
		$uid = $this->session->userdata('uid');
		date_default_timezone_set('PRC');
		$addtime = date("Y-m-d");
		$data = array('pid'=>$pid,'addtime'=>$addtime,'uid'=>$uid);
		$query = $this->db->insert('follow',$data);
	}
	//取消关注
	function delfollow($pid) {
		$uid = $this->session->userdata('uid');
		$data = array('pid'=>$pid,'uid'=>$uid);
		$query = $this->db->delete('follow',$data);
	}
	
	//是否投票
	function sel_yes_no($iid){
		$uid = '@'.$this->session->userdata('uid').'@';
		$where = "iid = $iid AND (no like '%$uid%' OR like '%$uid%')";
		$this->db->where($where);
		$query = $this->db->get('info');
		return $query->num_rows(); 
	}
	//是否赞同
	function selyes($iid){
		$uid = '@'.$this->session->userdata('uid').'@';
		$this->db->like('yes', $uid); 
		$query = $this->db->get_where('info',array('iid' => $iid));
		return $query->num_rows(); 
	}
	//是否反对
	function selno($iid){
		$uid = '@'.$this->session->userdata('uid').'@';
		$this->db->like('no', $uid); 
		$query = $this->db->get_where('info',array('iid' => $iid));
		return $query->num_rows(); 
	}

	
	//查询票数
	function num_yes_no($iid){
		$query = $this->db->get_where('info',array('iid' => $iid));
		return $query->row_array();
	}	
	
	
	//点击赞同
	function addup($iid) {		
		$query = $this->db->get_where('info',array('iid' => $iid))->row_array();
		$user = '@'.$this->session->userdata('uid').'@';
		if(strpos($query['yes'],$user) === false){
			$uid = $this->session->userdata('uid').'@';
			$yes = $query['yes'].$uid;
			$yes_num = $query['yes_num']+1;
			$no_num = $query['no_num'];
			if($query['no_num'] != 0){
				$no_num = $query['no_num']-1;
			}
			$no = str_replace($uid, '', $query['no']);
			$data = array('yes'=>$yes,'no'=>$no,'yes_num'=>$yes_num,'no_num'=>$no_num);
			$this->db->update('info',$data,array('iid' => $iid));
		}
	}
	//点击反对
	function adddown($iid) {		
		$query = $this->db->get_where('info',array('iid' => $iid))->row_array();
		$user = '@'.$this->session->userdata('uid').'@';
		if(strpos($query['no'],$user) === false){
			$uid = $this->session->userdata('uid').'@';
			$no = $query['no'].$uid;
			$yes_num = $query['yes_num'];
			if($query['yes_num'] != 0){
				$yes_num = $query['yes_num']-1;
			}
			$no_num = $query['no_num']+1;
			$yes = str_replace($uid, '', $query['yes']);
			$data = array('no'=>$no,'yes'=>$yes,'yes_num'=>$yes_num,'no_num'=>$no_num);
			$this->db->update('info',$data,array('iid' => $iid));
		}
	}

	//关注他的人数
	function follow_i($uid){
		$uid = '@'.$uid.'@';
		$this->db->like('follow_u', $uid); 
		$query = $this->db->get('user');
		return $query->num_rows(); 
	}
	//回答体验数
	function info_n($uid){
		$query = $this->db->get_where('info',array('uid' => $uid));
		return $query->num_rows(); 
	}
	//关注产品数
	function follow_n($uid){
		$query = $this->db->get_where('follow',array('uid' => $uid));
		return $query->num_rows(); 
	}
	
	//产品被关注的人数
	function follow_num($pid){
		$query = $this->db->get_where('follow',array('pid' => $pid));
		return $query->num_rows(); 
	}
	
	
	//我关注的产品
	function i_product($uid){
		$this->db->select('*');
		$this->db->from('follow');
		$this->db->join('product', 'product.pid = follow.pid');
		$this->db->limit(15);
		$this->db->order_by("bname", "asc"); 
		$this->db->where('uid', $uid);
		$query = $this->db->get();
		return $query->result_array();
	}
	
	//查询我的体验
	function i_info($uid){
		$this->db->order_by("yes_num", "desc"); 
		$this->db->order_by("info.addtime", "asc"); 
		$this->db->limit(10);
		$this->db->select('*');
		$this->db->from('info');
		$this->db->join('product', 'product.pname = info.pname');
		$this->db->where('uid', $uid);
		$query = $this->db->get();
		return $query->result_array();
	}
	
	//查询我的体验ajax
	function i_info_ajax($lastmsg,$uid){
		$this->db->order_by("yes_num", "desc"); 
		$this->db->order_by("info.addtime", "asc"); 
		$this->db->limit(10,$lastmsg);
		$this->db->select('*');
		$this->db->from('info');
		$this->db->join('product', 'product.pname = info.pname');
		$this->db->where('uid', $uid);
		$query = $this->db->get();
		return $query->result_array();
	}

	//查询我的体验ajax数量
	function i_info_ajax_num($lastmsg,$uid){
		$this->db->order_by("yes_num", "desc"); 
		$this->db->order_by("info.addtime", "asc"); 
		$this->db->limit(10,$lastmsg);
		$this->db->select('*');
		$this->db->from('info');
		$this->db->join('product', 'product.pname = info.pname');
		$this->db->where('uid', $uid);
		$query = $this->db->get();
		return $query->num_rows(); 
	}
	
	
	
	
	
	
	//查询每个产品信息数量
	function iinfo_num($pname){
		$query = $this->db->get_where('info',array('pname' => $pname));
		return $query->num_rows(); 
	}

	//查询我的关注
	function i_follow($uid){
		$this->db->order_by("follow.addtime", "asc"); 
		$this->db->select('*');
		$this->db->from('follow');
		$this->db->join('product', 'product.pid = follow.pid');
		$this->db->where('uid', $uid);
		$query = $this->db->get();
		return $query->result_array();
	}
	
	//查询我的关注ajax
	function i_follow_ajax($lastmsg,$uid){
		$this->db->order_by("follow.addtime", "asc");
		$this->db->limit(10,$lastmsg);
		$this->db->select('*');
		$this->db->from('follow');
		$this->db->join('product', 'product.pid = follow.pid');
		$this->db->where('uid', $uid);
		$query = $this->db->get();
		return $query->result_array();
	}
	
	
	//查询我的关注ajax数量
	function i_follow_ajax_num($lastmsg,$uid){
		$this->db->order_by("follow.addtime", "asc");
		$this->db->limit(10,$lastmsg);
		$this->db->select('*');
		$this->db->from('follow');
		$this->db->join('product', 'product.pid = follow.pid');
		$this->db->where('uid', $uid);
		$query = $this->db->get();
		return $query->num_rows(); 
	}
	
	
	//我关注的人
	function u_follow($uid){
		$query = $this->db->get_where('user',array('uid' => $uid))->row_array();
		$str = $query['follow_u'];
		//$lang = substr_count($str,'@');
		//print_r(explode("@",$str));
		$array = explode("@",$str);
		for($i=0;$i<3;$i++){
			if($array[$i] != ""){
			$u_array[] = $this->db->get_where('user',array('uid' => $array[$i]))->row_array();
			}
		}
		//print_r($u_array);
		if(isset($u_array)){
			return $u_array;
		}
	}
	
	//我关注的人ajax
	function u_follow_ajax($lastmsg,$uid){
		$query = $this->db->get_where('user',array('uid' => $uid))->row_array();
		$str = $query['follow_u'];
		//$lang = substr_count($str,'@');
		//print_r(explode("@",$str));
		$array = explode("@",$str);
		for($i=0;$i<3;$i++){
			if($array[$lastmsg] != ""){
			$u_array[] = $this->db->get_where('user',array('uid' => $array[$lastmsg]))->row_array();
			$lastmsg++;
			}
		}
		//print_r($u_array);
		if(isset($u_array)){
			return $u_array;
		}
	}
	function u_follow_ajax_num($lastmsg,$uid){
		$query = $this->db->get_where('user',array('uid' => $uid))->row_array();
		$str = $query['follow_u'];
		//$lang = substr_count($str,'@');
		//print_r(explode("@",$str));
		$array = explode("@",$str);
		//print_r($u_array);
		$array_num = count($array);
		return $array_num;
	}
	
	
	//好友动态
	function u_index($uid){
		$query = $this->db->get_where('user',array('uid' => $uid))->row_array();
		$str = $query['follow_u'];
		$lang = substr_count($str,'@');
		//print_r(explode("@",$str));
		$array = explode("@",$str);
		//print_r($array);

			//$this->db->order_by("yes_num", "desc"); 
			//$this->db->order_by("info.addtime", "asc"); 
			$this->db->limit(2);
			$this->db->select('*');
			$this->db->from('info');
			$this->db->join('user', 'user.uid = info.uid');
			$this->db->join('product', 'product.pname = info.pname');
			//$this->db->where();
			$array = array_filter($array);
			//print_r($array);
			$this->db->where_in('info.uid', $array);
			//$this->db->or_where_in('follow.uid', $array);
			$query = $this->db->get();
		
		$u_array[] = $query->result_array();
		
		//print_r($u_array);
		if(isset($u_array)){
			return $u_array;
		}
	}
	
	function u_index0($uid){
		$query = $this->db->get_where('user',array('uid' => $uid))->row_array();
		$str = $query['follow_u'];
		$lang = substr_count($str,'@');
		//print_r(explode("@",$str));
		$array = explode("@",$str);
		//print_r($array);

			//$this->db->order_by("yes_num", "desc"); 
			//$this->db->order_by("info.addtime", "asc"); 
			$this->db->limit(2);
			$this->db->select('*');
			$this->db->from('info');
			$this->db->join('user', 'user.uid = info.uid');
			$this->db->join('product', 'product.pname = info.pname');
			//$this->db->where();
			$array = array_filter($array);
			//print_r($array);
			$this->db->where_in('info.uid', $array);
			$query = $this->db->get();
		
		$u_array[] = $query->result_array();
		
		//print_r($u_array);
		if(isset($u_array)){
			return $u_array;
		}
	}
	
	
	
	function u_index_ajax($lastmsg,$uid){
		$query = $this->db->get_where('user',array('uid' => $uid))->row_array();
		$str = $query['follow_u'];
		$lang = substr_count($str,'@');
		//print_r(explode("@",$str));
		$array = explode("@",$str);
			$this->db->limit(2,$lastmsg);
			$this->db->select('*');
			$this->db->from('info');
			$this->db->join('user', 'user.uid = info.uid');
			$this->db->join('product', 'product.pname = info.pname');
			//$this->db->where();
			$array = array_filter($array);
			//print_r($array);
			$this->db->where_in('info.uid', $array);
			$query = $this->db->get();
		
		$u_array[] = $query->result_array();
		
		//print_r($u_array);
		if(isset($u_array)){
			return $u_array;
		}
	}
	
	
	//查询首页ajax数量
	function u_index_ajax_num($lastmsg,$uid){
		$query = $this->db->get_where('user',array('uid' => $uid))->row_array();
		$str = $query['follow_u'];
		$lang = substr_count($str,'@');
		//print_r(explode("@",$str));
		$array = explode("@",$str);
			
			$this->db->limit(2,$lastmsg);
			$this->db->select('*');
			$this->db->from('info');
			$this->db->join('user', 'user.uid = info.uid');
			$this->db->join('product', 'product.pname = info.pname');
			//$this->db->where();
			$array = array_filter($array);
			//print_r($array);
			$this->db->where_in('info.uid', $array);
			$query = $this->db->get();
		
		$u_array[] = $query->num_rows(); 
		
		//print_r($u_array);
		if(isset($u_array)){
			return $u_array;
		}
	}
		
	function index_n($uid){
		$query = $this->db->get_where('user',array('uid' => $uid))->row_array();
		$str = $query['follow_u'];
		$lang = substr_count($str,'@');
		//print_r(explode("@",$str));
		$array = explode("@",$str);
		for($i=0;$i<$lang;$i++){
			if($array[$i] != ""){
				$query = $this->db->get_where('info',array('uid' =>  $array[$i]));
				$u_array[] = $query->num_rows(); 
			}
		}
		//print_r($u_array);
		if(isset($u_array)){
			return $u_array;
		}
	}
	
	
	//是否关注 人
	function sel_ifollow($uid){
		$uidd = $this->session->userdata('uid');
		$follow_u = '@'.$uid.'@';
		$this->db->like('follow_u', $follow_u);
		$query = $this->db->get_where('user',array('uid' => $uidd));
		return $query->num_rows(); 
	}
	//关注 人
	function add_ifollow($uid){
		$uidd = $this->session->userdata('uid');
		$query = $this->db->get_where('user',array('uid' => $uidd))->row_array();
		$follow_u = $query['follow_u'].$uid.'@';

			//$no = str_replace($uid, '', $query['no']);
		$data = array('follow_u' => $follow_u);
		$this->db->update('user',$data,array('uid' => $uidd));
	
	}
	
	//取消关注 人
	function del_ifollow($uid){
		$uidd = $this->session->userdata('uid');
		$query = $this->db->get_where('user',array('uid' => $uidd))->row_array();
		$user = $uid.'@';
		$follow_u = str_replace($user, '', $query['follow_u']);
		$data = array('follow_u' => $follow_u);
		$this->db->update('user',$data,array('uid' => $uidd));
	}
	
	
	function follow_u($uid){
		$this->db->limit(1);
		$follow_u = '@'.$uid.'@';
		$this->db->like('follow_u', $follow_u);
		$query = $this->db->get('user')->result_array();
		//print_r($query);
		return $query;
	}
	function follow_i_ajax($lastmsg,$uid){
		$this->db->limit(1,$lastmsg);
		$follow_u = '@'.$uid.'@';
		$this->db->like('follow_u', $follow_u);
		$query = $this->db->get('user')->result_array();
		//print_r($query);
		return $query;
	}
	
	function follow_i_ajax_num($lastmsg,$uid){
		$this->db->limit(1,$lastmsg);
		$follow_u = '@'.$uid.'@';
		$this->db->like('follow_u', $follow_u);
		$query = $this->db->get('user');
		return $query->num_rows(); 
	}
	
	//查询粉丝数
	function sel_followi($uid){
		$uidd = $this->session->userdata('uid');
		$follow_u = '@'.$uid.'@';
		$this->db->like('follow_u', $follow_u);
		$query = $this->db->get_where('user',array('uid' => $uidd));
		return $query->num_rows(); 
	}

	
	//查询关注该产品的人
	function follow_p($pid){
		$this->db->order_by("follow.addtime", "asc"); 
		$this->db->select('*');
		$this->db->from('follow');
		$this->db->join('user', 'user.uid = follow.uid');
		$this->db->where('pid', $pid);
		$query = $this->db->get();
		return $query->result_array();
	}
	
	
}
?>