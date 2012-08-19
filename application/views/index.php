<input type="hidden" id="session" value="<?php echo $this->session->userdata('uid');?>"> 
<div id="main">
	<div style="clear:both"></div>
	<input type="hidden" id="session" value="<?php echo $this->session->userdata('uid');?>"> 
	<div class="user_left">
		<div class="sort" >
			<a href="" >大家都在关注</a>
		</div>
		<?php
			$uid = $this->session->userdata('uid');
			$u_follow = $this->mhome->u_index($uid);
			//print_r($u_follow);
				if(isset($u_follow)):
					foreach($u_follow as $row_u):
					foreach($row_u as $row_uf):
		?>
		<div class="user_box">
			<h3><a href="welcome/comment/<?php echo $row_uf['pname'];?>"><?php echo $row_uf['bname'],' ',$row_uf['pname'];?></a></h3>
			<div class="push">
				<a href="welcome/users/<?php echo $row_uf['uid'];?>"><?php echo $row_uf['name'];?></a>回答了该问题
				• <?php echo $iinfo_num = $this->mhome->iinfo_num($row_uf['pname']);?>个体验 
				<span class="is_follow follow<?php echo $row_uf['pid'];?>">• <?php $selfollow = $this->mhome->selfollow($row_uf['pid']);?><input type="hidden" value="<?php echo $row_uf['pid']?>"><a href="javascript:void(0);<?php //if($selfollow > 0){echo 'welcome/del_follow/'.$row_uf['pid'];}else{echo 'welcome/add_follow/'.$row_uf['pid'];}?>"><?php if($selfollow > 0){echo '取消关注';}else{echo '关注';}?></a></span>
				• <?php echo $row_uf['addtime'];?> <?php if($row_uf['yes_num'] != 0){echo '•',$row_uf['yes_num'],'票赞同';}?>
				<div class="answer">
					<b><p>[<?php
					switch ($row_uf['score']){
						case 1;
						echo "很差";
						break;
						case 2;
						echo "较差";
						break;
						case 3;
						echo "还行";
						break;
						case 4;
						echo "推荐";
						break;
						case 5;
						echo "力荐";
						break;
					}?>]
					<?php echo $row_uf['title'];?>
					</p></b>
					<p><?php echo $row_uf['content'];?></p>
				</div>
			</div>
		</div>
		<?php
					endforeach;
					endforeach;
				else:
		?>
		<div class="user_box u_info">
			<div class="f_info">
				<p>Ta暂时还未关注好友</p>
			</div>
		</div>
		<?php
				endif;
				//print_r($this->mhome->index_n($uid));
				$index_n = $this->mhome->index_n($uid);
				//echo array_sum($index_n);
			if($this->uri->segment(4) == "" && array_sum($index_n) > 2):
		?>
		<div id="more"> <a  id="2" class="load_more" href="javascript:void(0);">更多</a> </div>
		<?php endif;?>
	</div>
	
</div>
</body>
</html>
<script type="text/javascript">
if($('#session').val() == ""){
	$(".is_follow a").attr("href","<?php echo site_url('welcome/login');?>");
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
	
	
		
}
$('.load_more').live("click",function() {//If user clicks on hyperlink with class name = load_more
	var last_msg_id = $(this).attr("id");
	var form_data = {
			uid:$('#session').val(),
			lastmsg:last_msg_id
		};
		//alert($('#session').val());
	//Get the id of this hyperlink 
	//this id indicate the row id in the database 
	if(last_msg_id!='end'){
    //if  the hyperlink id is not equal to "end"
		$.ajax({//Make the Ajax Request
			type: "POST",
			url: "<?php echo site_url('welcome/u_index_ajax');?>",
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