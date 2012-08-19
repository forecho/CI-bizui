	<?php foreach ($selinfo as $row_info):?>
		<div class="comment_box" id="<?php echo $row_info['uid']?>">
			<a href="welcome/users/<?php echo $row_info['uid'];?>"><img src="images/user/001.jpg" alt="" width="34px" class="user_pic" /></a>
			<div class="author">
				<p>[<?php
				switch ($row_info['score']){
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
					<?php echo $row_info['title'];?>
				</p>
				<a href="welcome/users/<?php echo $row_info['uid'];?>"><?php $seluser = $this->mhome->seluser($row_info['uid']); echo $seluser['name'];?></a><span>（<?php echo $seluser['uinfo'] ?>）</span>
			</div>
			<div class="content">
				<?php echo $row_info['content'];?>
				<?php if($this->session->userdata('uid') == $row_info['uid']):?>
				<a href="javascript:void(0);" class="edit">修改</a>
				<span class="edit">|</span>
				<a href="welcome/delinfo/<?php echo $row_info['iid']?>" id="del">删除</a>
				<?php endif;?>
			</div>
			<?php if($this->session->userdata('uid') == $row_info['uid']):?>
			<div class="answer_box edit_answer">
			<?php echo form_open('welcome/editinfo','id="VoteForm"');?>
				<p id="answer_title">
					标题：<input type="text" name="title" id="title" value="<?php echo $row_info['title'];?>" autocomplete="off" />
					<input type="hidden" name="iid"  value="<?php echo $row_info['iid'];?>">
					<input type="radio" name="score" value="1" id="score" <?php if($row_info['score'] == 1){echo "checked";}?>> 很差
					<input type="radio" name="score" value="2" id="score" <?php if($row_info['score'] == 2){echo "checked";}?>> 较差
					<input type="radio" name="score" value="3" id="score" <?php if($row_info['score'] == 3){echo "checked";}?>> 还行
					<input type="radio" name="score" value="4" id="score" <?php if($row_info['score'] == 4){echo "checked";}?>> 推荐
					<input type="radio" name="score" value="5" id="score" <?php if($row_info['score'] == 5){echo "checked";}?>> 力荐
				</p>
				
			<script type="text/plain" id="myEditor" class="myEditor"><?php echo $row_info['content'];?>
			</script>
			<script type="text/javascript">
				var editor_a = new baidu.editor.ui.Editor();
				editor_a.render('myEditor');
			</script>
				<div class="button_box"><p class="success"></p><a href="javascript:void(0);" class="cancel" >取消</a><input type="submit" class="submit" value="添加体验" name="submit" id="form_submit"/></div>
			<?php echo form_close();?>
			</div>
			<?php endif;?>
			
		
			<div class="bar">
				<div id="msgg<?php echo $row_info['iid'];?>">
					<span class="<?php $yes = $this->session->userdata('uid') != "" && $this->mhome->selyes($row_info['iid']) >0; if($yes){echo 'yes';}else{echo 'up';}?>"><input type="hidden" value="<?php echo $row_info['iid']?>"> <a href="javascript:void(0);" title="<?php if($yes){echo '您已经赞同过了';}else{echo '表示赞同';}?>" class=""><?php //$num_yes_no = $this->mhome->num_yes_no($row_info['iid']);echo substr_count($num_yes_no["yes"],'@')-1;?><?php echo $row_info['yes_num'];?></a></span>
					<span class="<?php $no = $this->session->userdata('uid') != "" && $this->mhome->selno($row_info['iid']) >0; if($no){echo 'no';}else{echo 'down';}?>"><input type="hidden" value="<?php echo $row_info['iid']?>"><a href="javascript:void(0);" title="<?php if($no){echo '取消反对';}else{echo '表示反对';}?>" class=""><?php //$num_yes_no = $this->mhome->num_yes_no($row_info['iid']);echo substr_count($num_yes_no["no"],'@')-1;?><?php echo $row_info['no_num'];?></a></span>
				</div>
				<span><a href="javascript:void(0);"><?php echo $row_info['addtime'];?></a></span>
				<span class="comment">
					<?php $num_comment = $this->mhome->num_comment($row_info['iid']);?>
					<a href="javascript:void(0);" title="<?php if($num_comment == 0){echo '添加评论';}else{echo '查看评论';}?>">
					<?php if($num_comment == 0){echo '添加评论';}else{echo $num_comment.'条评论';}?>
					</a>
				</span>
			</div>
			<div class="comments">
				<div class="comment_p_top"></div>
				<?php 
					$selcomment = $this->mhome->selcomment($row_info['iid']); 
					foreach($selcomment as $row_comment):
				?>
				<ul class="comment_p">
					<li><a href=""><?php $sel_user = $this->mhome->seluser($row_comment['uid']); echo $sel_user['name'];?>：</a></li>
					<li><?php echo $row_comment['comment'];?></li>
					<li class="time">&nbsp;&nbsp;<?php echo $row_comment['addtime'];?></li>
				</ul>
				<?php endforeach;?>
				<div class="i_comment">
					<?php
						if($this->session->userdata('uid') == ""):
					?>
					<div class="nologin">
						<a href="welcome/login" class="follow">登陆</a>
						<a href="" class="follow message">注册</a>
					</div>
					<?php else: echo form_open('welcome/addcomment');?>
					<input type="hidden" name="iid"  value="<?php echo $row_info['iid'];?>">
					<textarea name="comment"></textarea>
					<div class="button_box"><span>关闭</span><input type="submit" class="submit" value="评论" name="submit" /></div>
					<?php echo form_close();endif;?>
				</div>
			</div>
		</div>
		<?php endforeach;?>