<?php $this->mhome->addbrowse($selproduct['pid']);?>
<input type="hidden" id="session" value="<?php echo $this->session->userdata('uid');?>"> 
<div id="main">
	<div class="product">
		<div class="pinfo">
			<img src="images/3c/<?php echo $selproduct['pimg']; ?>" alt="" />
			<?php // $selfollow = $this->mhome->selfollow($selproduct['pid']);?>
			<div id="follow">
				<?php
					$data['pid'] = $selproduct['pid'];
					$this->load->view('follow', $data);
				?>
			</div>
		</div>
		<div class="info">
			<div class="tags">
				<a href="welcome/tags/<?php echo $selproduct['cname']; ?>"><?php echo $selproduct['cname']; ?>品牌</a>
				<a href="welcome/product/<?php echo $selproduct['bname']; ?>"><?php echo $selproduct['bname']; ?></a>
				<a href="welcome/product/money/<?php echo $selproduct['money']; ?>"><?php echo $selproduct['money']; ?></a>
			</div>
			<h2><?php echo $selproduct['pname']; ?></h2>
			<p><?php echo $selproduct['pinfo']; ?><a href="welcome/editpro/<?php echo $selproduct['pname'];?>">[修改]</a></p>
		</div>
	
	</div>
	
	
	<div class="left">
		<!-- 参数 -->
		<div id="parameter">
			<?php echo $selproduct['para']; ?>
		</div>
		<div class="sort" >
			<a href="welcome/comment/<?php echo rawurldecode($this->uri->segment(3));?>" <?php if($this->uri->segment(4) ==""){echo 'class="active"';} ?>>热门观点</a>
			<a href="welcome/comment/<?php echo rawurldecode($this->uri->segment(3));?>/time" <?php if($this->uri->segment(4) !=""){echo 'class="active"';} ?>>最新观点</a>
			<span>查看参数</span>
		</div>
		
		
		<div id="comment">
		<?php $this->load->view('comment_box');?>
		</div>
		<div style="clear:both"></div>
		<div class="comment_box" id="answer">
		<?php
			if($this->session->userdata('uid') == ""):
		?>
			<div class="nologin">
			<?php echo form_open('welcome/login');?>
				<input type="text" name="email"  value="" placeholder="邮箱" id="email">
				<input type="password" name="password"  value="" placeholder="密码" id="password">
				<input type="submit" value="登录" class="follow" />
			<?php echo form_close();?>
			<a href="">忘记密码</a><a href="">我要注册</a>
			</div>
		<?php
			else:
			$is_comment = $this->mhome->is_comment(rawurldecode($this->uri->segment(3)));
			//echo $is_comment;
			if($is_comment <= 0):
			echo form_open('welcome/addinfo','id="VoteForm"');
		?>
			<a href="welcome/users/<?php echo $seluser['uid'];?>"><img src="images/user/<?php echo $seluser['photo'];?>" alt="" width="34px" class="user_pic" /></a>
			<div class="author">
				<p>添加我的观点：</p>
				<a href="welcome/users/<?php echo $seluser['uid'];?>"><?php echo $seluser['name'];?></a><span>（<?php echo $seluser['uinfo'];?>）</span>
			</div>
			<div class="answer_box">
				<p id="answer_title">
					标题：<input type="text" name="title" id="title" autocomplete="off" />
					<input type="hidden" name="pname"  value="<?php echo $selproduct['pname'];?>">
					<input type="hidden" name="pid"  value="<?php echo $selproduct['pid'];?>">
					<input type="radio" name="score" value="1" id="score"> 很差
					<input type="radio" name="score" value="2" id="score"> 较差
					<input type="radio" name="score" value="3" id="score"> 还行
					<input type="radio" name="score" value="4" id="score"> 推荐
					<input type="radio" name="score" value="5" id="score"> 力荐
				</p>
				
				<script type="text/plain" id="myEditor" class="myEditor">
				</script>
					<script type="text/javascript">
						var editor_a = new baidu.editor.ui.Editor();
						editor_a.render('myEditor');
					</script>
				<div class="button_box answer_submit"><p class="success"></p><input type="submit" class="submit" value="添加体验" name="submit" id="form_submit"/></div>
			</div>
		<?php 
			echo form_close(); 
			else:
		?>
			<a href="<?php echo $_SERVER["REQUEST_URI"],'#',$this->session->userdata('uid');?>">您已经评论过此产品了。一个产品你只能评论一次，但你可以对现有的评论进行修改</a>
		<?php
				endif;
			endif;
		?>
		</div>
		
	</div>
	<div class="right">
		<div class="guess">
			<h3>推荐指数</h3>
			<div class="status">
				<?php 
					$info_num = $this->mhome->info_num($selproduct['pname']);
					if($info_num == 0){
						$sum = 0;
						$info_num = 1;
					}else{
						$info_sum = $this->mhome->info_sum($selproduct['pname']);
						$sum = $info_sum['score'];
					}
					$score = $sum/$info_num;
				?>
				<img src="images/1px.gif" title="<?php echo  round($score,1);?>分" class="star level<?php echo round($score);?>" /><span><?php echo round($score);?>颗星</span>
			</div>
		</div>
	
		<h3>相似产品</h3>
		<div class="guess_3c">
			<ul class="u_like">
			<?php $like_product = $this->mhome->like_product($selproduct['bname']);foreach($like_product as $row_like):?>
				<li><a href="welcome/comment/<?php echo $row_like['pname'];?>"><?php echo $row_like['bname'],' ',$row_like['pname'];?></a></li>
			<?php endforeach;?>
			</ul>
		</div>

			
		
		<div class="guess">
			<h3>问题状态</h3>
			<div class="status">
				<p>创建时间：<?php echo $selproduct['addtime']; ?> </p>
				<p>共计浏览了<?php echo $selproduct['browse']; ?>次 33人关注了该产品</p>
				<?php //echo $selproduct['pid'];?>
				<?php $follow_p = $this->mhome->follow_p($selproduct['pid']);?>
				
				<?php foreach($follow_p as $row_p): ?>
				<div class="f_user">
					<a href="welcome/users/<?php echo $row_p['uid']; ?>" title="<?php echo $row_p['name']; ?>"><img src="images/user/<?php echo $row_p['photo']; ?>" alt="" /></a>
				</div>
				<?php endforeach;?>
			</div>
		</div>
	
	
		
	</div>
<script type="text/javascript">
$('#VoteForm').submit(function() {
	var result=false;
	var content=editor_a.hasContents();
	//alert(editor_a.hasContents());
    $("input[name='score']").each(function(data){
        if($("input[name='title']").val() != "" && $(this).attr("checked")==true && editor_a.hasContents()==true){ 
          result=true; //跳出循环   
        } 
	});
	if($("input[name='title']").val() == ""){
		//$('.success').text(editor_a.getContent());
		$('.success').text("给你的观点起一个标题吧"); 
	}else{
		if(!result){
			$('.success').text("给这款数码打一个分吧");
		}
		if(!content){
			$('.success').text("你还没有输入内容呢");
		}
	}
   return result;
}); 


if($('#session').val() == ""){
	$("#follow a").attr("href","<?php echo site_url('welcome/login');?>");
	$(".up a").attr("href","<?php echo site_url('welcome/login');?>");
	$(".down a").attr("href","<?php echo site_url('welcome/login');?>");
}else{
	$('#follow').live("click",function(){
		var form_data = {
			pid: <?php echo $selproduct['pid'];?>,
			ajax: '1'
		};
		if($("#follow a").text() == "关注")
		{	
			$.ajax({
				url:"<?php echo site_url('welcome/addfollow/');?>",
				type:'POST',
				data:form_data,
				success:function(msg){
					$('#follow').html(msg);
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
					$('#follow').html(msg);
				}
			});
		}
		return false;
	})
	

	//点击赞同
	$('.up a').live("click",
		function(){
		//alert($(".up input").val())
			var form_data = {
				iid: $(this).prev(":input").val(),
				ajax: '1'
			};
			//var up = parseInt($(this).text())+1;
			//var down = $(this).parent().prev('.down a').text()+1;
			//alert(up);
			//alert(down);
			var msgg = '#msgg'+$(this).prev(":input").val();
			//alert(msgg);
			$.ajax({
				url:"<?php echo site_url('welcome/addup/');?>",
				type:'POST',
				data:form_data,
				success:function(msg){
					//alert($('.up a').html(msg));
					//$('.up a').html(msg);
					//$('.up a').html($('.up a').text()+=1);
					//$('.yes a').html(up);
					$(msgg).html(msg);
					//alert($('#msgg+iid').html(msg));
					//alert(++$('.up a').text());
				}
			});
			//$(this).parent().removeClass("up").addClass("yes");
			//$(this).parent().prev('.down').removeClass("no").addClass("down");
			//$(this).parent().prev('.down a').text(down)
			return false;
		}
	)
	//点击反对
	
	$('.down a').live("click",
		function(){
		//alert($(".up input").val())
			var form_data = {
				iid: $(this).prev(":input").val(),
				ajax: '1'
			};
			//var up = parseInt($(this).text())+1;
			//var down = $(this).parent().prev('.down a').text()+1;
			//alert(up);
			//alert(down);
			var msgg = '#msgg'+$(this).prev(":input").val();
			//alert(msgg);
			$.ajax({
				url:"<?php echo site_url('welcome/adddown/');?>",
				type:'POST',
				data:form_data,
				success:function(msg){
					//alert($('.up a').html(msg));
					//$('.up a').html(msg);
					//$('.up a').html($('.up a').text()+=1);
					//$('.yes a').html(up);
					$(msgg).html(msg);
					//alert($(msgg).html(msg));
					//alert($('#msgg+iid').html(msg));
					//alert(++$('.up a').text());
				}
			});
			//$(this).parent().removeClass("up").addClass("yes");
			//$(this).parent().prev('.down').removeClass("no").addClass("down");
			//$(this).parent().prev('.down a').text(down)
			return false;
		}
	)

}
	// $('.answer_submit :submit').click(
		// function(){
			// var form_data = {
				// title: $("#answer_title :text").val(),
				// score: $('#answer_title :input:radio:checked').val(),
				// pname:  $('#answer_title :input:hidden').val(),
			//	editorValue: editor.getContent(),
				// ajax: '1'
			// };
			
			//alert(editor.getContent());
			//alert(1);
			
			// $.ajax({
				// url:"<?php echo site_url('welcome/addinfo');?>",
				// type:'POST',
				// data:form_data,
				// success:function(msg){
				//	$('.no a').html(up);
				//	$('#msg').html(msg);
				// }
			// });

			// return false;
		// }
	// )


	
	

</script>
<script type="text/javascript" src="js/jconfirmaction.jquery.js"></script>
<script type="text/javascript">
(function() {
	$('#del').jConfirmAction();
})(jQuery);
</script>