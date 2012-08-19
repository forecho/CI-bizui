<input type="hidden" id="session" value="<?php echo $this->session->userdata('uid');?>"> 
<div id="main">
	<div style="clear:both"></div>
	<div class="user_right">
		<div class="user_img">
			<img src="images/img/<?php echo $seluser['photo'];?>" alt="" width="220px" />
			<h2><?php echo $seluser['name'];?></h2>
		</div>
		<?php if($this->uri->segment(3) != $this->session->userdata('uid')):?>
		<div class="panel">
			<?php $sel_fi = $this->mhome->sel_followi($this->uri->segment(3));?><a href="welcome/<?php if($this->session->userdata('uid') == ""){echo 'login';}else{if($sel_fi > 0){ echo 'del_ifollow/'.$this->uri->segment(3);}else{echo 'add_ifollow/'.$this->uri->segment(3);}}?>"  class="follow <?php if($sel_fi > 0){echo 'message';}?>"><?php if($sel_fi > 0){echo '取消关注';}else{echo '关注';}?></a>
			<a href="" class="follow message">发私信</a>
		</div>
		<?php endif;?>
		<div class="follow_num">
			<ul>
				<li><a href="welcome/users/<?php echo $this->uri->segment(3);?>/follow_i"><h2><?php echo $this->mhome->follow_i($this->uri->segment(3));?></h2><span>关注他的人</span></a></li>
				<li class="follow_r"><a href="welcome/users/<?php echo $this->uri->segment(3);?>/i_follow"><h2><?php echo substr_count($seluser["follow_u"],'@')-1;?></h2><span>他关注的人</span></a></li>
			</ul>
		
		</div>
	
		<h3>他关注的产品</h3>
		<div class="guess_3c">
			<ul class="u_like">
			<?php $i_product = $this->mhome->i_product($this->uri->segment(3));foreach($i_product as $row_i):?>
				<li><a href="welcome/comment/<?php echo $row_i['pname'];?>" ><?php echo $row_i['bname'],' ',$row_i['pname'];?></a></li>
			<?php endforeach;?>
			</ul>
		</div>
		<div class="guess">
			<h3>关于我</h3>
			<div class="status">
			<p><?php echo $seluser['uinfo'];?></p>
			</div>
		</div>
		
		<div class="footer">
			<span><a href="">使用指南</a></span>
			<span><a href="">CC协议</a></span>
			<span><a href="">© 2012你丫闭嘴</a></span>
			<!-- <div class="tag">ddd</div> -->
		</div>
		
	</div>
	

	
	
	
	<div class="user_left">
		<?php 
			$data['uname'] = $seluser['name'];
			$data['uid'] = $this->uri->segment(3);
			$this->load->view("users_index",$data);
		?>
	</div>
	
</div>
</body>
</html>
<script type="text/javascript">
if($('#session').val() == ""){
	$(".is_follow a").attr("href","<?php echo site_url('welcome/login');?>");
	$(".u_follow a").attr("href","<?php echo site_url('welcome/login');?>");
}else{
	$('.is_follow a').live("click",function(){
		var form_data = {
			pid:$(this).prev(":input").val(),
			ajax: '1'
		};
		var follow = '.follow'+$(this).prev(":input").val();
		if($(this).text() == "关注")
		{	
			$.ajax({
				url:"<?php echo site_url('welcome/add_follow/');?>",
				type:'POST',
				data:form_data,
				success:function(msg){
					$(follow).html(msg);
				}
			});
		}
		else
		{
			$.ajax({
				url:"<?php echo site_url('welcome/del_follow/');?>",
				type:'POST',
				data:form_data,
				success:function(msg){
					$(follow).html(msg);
				}
			});
		}
		return false;
	})
	
	
	//是否关注
	$('.u_follow a').live("click",function(){
		var form_data = {
			uid:$(this).prev(":input").val(),
			ajax: '1'
		};
		var follow = '.follow'+$(this).prev(":input").val();
		if($(this).text() == "关注")
		{	
			$.ajax({
				url:"<?php echo site_url('welcome/add_ifollow/');?>",
				type:'POST',
				data:form_data,
				success:function(msg){
					$(follow).html(msg);
				}
			});
		}
		else
		{
			$.ajax({
				url:"<?php echo site_url('welcome/del_ifollow/');?>",
				type:'POST',
				data:form_data,
				success:function(msg){
					$(follow).html(msg);
				}
			});
		}
		return false;
	});
		
}
$('.load_more').live("click",function() {//If user clicks on hyperlink with class name = load_more
	var last_msg_id = $(this).attr("id");
	var form_data = {
			uid:<?php echo $this->uri->segment(3);?>,
			lastmsg:last_msg_id,
			uname:"<?php echo $seluser['name'];?>"
		};
		//alert(last_msg_id);
	//Get the id of this hyperlink 
	//this id indicate the row id in the database 
	if(last_msg_id!='end'){
    //if  the hyperlink id is not equal to "end"
		$.ajax({//Make the Ajax Request
			type: "POST",
			<?php if($this->uri->segment(4) == ""):?>
				url: "<?php echo site_url('welcome/i_info_ajax');?>",
			<?php endif;if($this->uri->segment(4) == "follow"):?>
				url: "<?php echo site_url('welcome/i_follow_ajax');?>",
			<?php endif;if($this->uri->segment(4) == "i_follow"):?>
				url: "<?php echo site_url('welcome/u_follow_ajax');?>",
			<?php endif;if($this->uri->segment(4) == "follow_i"):?>
				url: "<?php echo site_url('welcome/follow_i_ajax');?>",
			<?php endif;?>
			data:form_data,

			beforeSend:  function() {
				$('a.load_more').html('<img src="images/loading.gif" />');//Loading image during the Ajax Request
			},
				success: function(html){//html = the server response html code
					$("#more").remove();//Remove the div with id=more 
					$(".user_left").append(html);//Append the html returned by the server .
				}
				
		});
	}
	return false;


});

</script>