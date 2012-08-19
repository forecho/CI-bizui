<div id="main">
	<input type="hidden" id="session" value="<?php echo $this->session->userdata('uid');?>"> 
	<div style="clear:both"></div>
	<div class="product_tab">
	<?php if($this->uri->segment(4) == ""):?>
		<h2><?php echo rawurldecode($this->uri->segment(3)); ?> <a href="welcome/tags/<?php echo $sel_product[0]['cname']?>">返回品牌专区</a></h2>
	<?php else:?>
		<h2><?php echo rawurldecode($this->uri->segment(4)); ?> <a href="welcome/tags/<?php echo $sel_product[0]['cname']?>">返回品牌专区</a></h2>
	<?php endif;?>
	</div>
	<div class="product_box">
		<?php foreach($sel_product as $row_product):?>
		<div class="product_b">
			<div class="product_link">
				<a href="welcome/comment/<?php echo $row_product['pname'];?>"><img src="images/3c/<?php echo $row_product['pimg'];?>" alt="<?php echo $row_product['bname'],$row_product['pname'];?>" title="<?php echo $row_product['bname'],$row_product['pname'];?>"/></a>
				<p><a href="welcome/comment/<?php echo $row_product['pname'];?>"><?php echo $row_product['bname'],' ',$row_product['pname'];?></a></p>
				<input type="hidden" value="<?php echo $row_product['pid'];?>"> 
				<div id="follow" class="msgg<?php echo $row_product['pid']?>">
				<?php
					$data['pid'] = $row_product['pid'];
					$this->load->view('follow', $data);
				?>
				</div>
			</div>
			<div class="product_f">
				<p><?php echo $iinfo_num = $this->mhome->iinfo_num($row_product['pname']);?>个人发表了观点</p>
				<p><?php echo $follow_num = $this->mhome->follow_num($row_product['pid']);?>个人关注此了产品</p>
			</div>
		</div>
		<?php endforeach;?>
		<div class="product_b">
			<a href='welcome/<?php if($this->session->userdata('uid') == ""){echo "login";}else{echo "addpro";}?>' title="添加数码"><img src="images/add.png" alt="" id="add" /></a>
		</div>
	</div>
	
	
	</div>
</div>
</body>
</html>
<script type="text/javascript">
if($('#session').val() == ""){
	$("#follow a").attr("href","<?php echo site_url('welcome/login');?>");
}else{
	$('#follow').live("click",function(){
		var form_data = {
			pid: $(this).prev(":input").val(),
			ajax: '1'
		};
		var msgg = '.msgg'+$(this).prev(":input").val();
		if($(this).children("a").text() == "关注")
		{	
			$.ajax({
				url:"<?php echo site_url('welcome/addfollow/');?>",
				type:'POST',
				data:form_data,
				success:function(msg){
					$(msgg).html(msg);
				}
			});
		}
		else
		{
			$.ajax({
				url:"<?php echo site_url('welcome/delfollow/');?>",
				type:'POST',
				data:form_data,
				success:function(msg){
					$(msgg).html(msg);
				}
			});
		}
		return false;
	})
}
</script>