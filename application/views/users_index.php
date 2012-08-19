		<div class="sort" >
			<a href="welcome/users/<?php echo $uid;?>" <?php if($this->uri->segment(4) == ""){echo 'class="active"';}?> >体验过</a>
			<a href="welcome/users/<?php echo $uid.'/follow';?>" <?php if($this->uri->segment(4) == "follow"){echo 'class="active"';}?> >正在关注</a>
			<a href="welcome/users/<?php echo $uid.'/i_follow';?>" <?php if($this->uri->segment(4) == "i_follow"){echo 'class="active"';}?> >关注的人</a>
			<a href="welcome/users/<?php echo $uid.'/follow_i';?>" <?php if($this->uri->segment(4) == "follow_i"){echo 'class="active"';}?> >粉丝</a>
			<!--<a href="">收藏</a> <a href="">留言板</a> -->
		</div>
		<?php
			//体验过
			if($this->uri->segment(4) == ""):
				$i_info = $this->mhome->i_info($uid);
				if(!isset($i_info[0])):
		?>
		<div class="user_box u_info">
			<div class="f_info">
				<p>Ta暂时还未体验过任何产品</p>
			</div>
		</div>
		
		<?php
				else:
				$iinfo = $i_info[0]['iid'];
				//print_r($i_info);
					foreach($i_info as $row_ii):
		?>
		<div class="user_box">
			<h3><a href="welcome/comment/<?php echo $row_ii['pname'];?>"><?php echo $row_ii['bname'],' ',$row_ii['pname'];?></a></h3>
			<div class="push">
				<a href="welcome/users/<?php echo $uid;?>"><?php echo $uname;?></a>回答了该问题
				• <?php echo $iinfo_num = $this->mhome->iinfo_num($row_ii['pname']);?>个体验 
				<span class="is_follow follow<?php echo $row_ii['pid'];?>">• <?php $selfollow = $this->mhome->selfollow($row_ii['pid']);?><input type="hidden" value="<?php echo $row_ii['pid']?>"><a href="javascript:void(0);<?php //if($selfollow > 0){echo 'welcome/del_follow/'.$row_ii['pid'];}else{echo 'welcome/add_follow/'.$row_ii['pid'];}?>"><?php if($selfollow > 0){echo '取消关注';}else{echo '关注';}?></a></span>
				• <?php echo $row_ii['addtime'];?> <?php if($row_ii['yes_num'] != 0){echo '•',$row_ii['yes_num'],'票赞同';}?>
				<div class="answer">
					<b><p>[<?php
					switch ($row_ii['score']){
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
					<?php echo $row_ii['title'];?>
					</p></b>
					<p><?php echo $row_ii['content'];?></p>
				</div>
			</div>
		</div>
		<?php
					endforeach;
				endif;
			endif;
			//正在关注
			if($this->uri->segment(4) == "follow"):
			$i_follow = $this->mhome->i_follow($uid);
				if(empty($i_follow)):
		?>
		<div class="user_box u_info">
			<div class="f_info">
				<p>Ta暂时还未关注任何产品</p>
			</div>
		</div>		
		
		<?php
				endif;
				foreach($i_follow as $row_if):
		?>
		<div class="user_box">
			<h3><a href="welcome/comment/<?php echo $row_if['pname'];?>"><?php echo $row_if['bname'],' ',$row_if['pname'];?></a></h3>
			<div class="push">
				<a href="welcome/users/<?php echo $uid;?>"><?php echo $uname;?></a>关注了该问题 • <?php echo $iinfo_num = $this->mhome->iinfo_num($row_if['pname']);?>个体验 
				<span class="is_follow follow<?php echo $row_if['pid'];?>">• <?php $selfollow = $this->mhome->selfollow($row_if['pid']);?><input type="hidden" value="<?php echo $row_if['pid']?>"><a href="javascript:void(0);"><?php if($selfollow > 0){echo '取消关注';}else{echo '关注';}?></a></span>
				• <?php echo $row_if['addtime'];?>
			</div>
		</div>
		<?php
				endforeach;
			endif;
			//关注的人
			if($this->uri->segment(4) == "i_follow"):
			$u_follow = $this->mhome->u_follow($uid);
			//print_r($u_follow);
			
				if(isset($u_follow)):
					foreach($u_follow as $row_uf):
		?>
		<div class="user_box u_info">
			<div class="u_follow follow<?php echo $row_uf['uid'];?>">
				<?php $sel_ifollow = $this->mhome->sel_ifollow($row_uf['uid']);?><input type="hidden" value="<?php echo $row_uf['uid']?>"><a href="javascript:void(0);"><?php if($row_uf['uid'] != $this->session->userdata('uid')){if($sel_ifollow > 0){echo '取消关注';}else{echo '关注';}}?></a>
			</div>
			<a href="welcome/users/<?php echo $row_uf['uid'];?>"><img src="images/img/<?php echo $row_uf['photo'];?>" alt="<?php echo $row_uf['name'];?>" width="66px" /></a>
			<div class="f_info">
				<h3><a href="welcome/users/<?php echo $row_uf['uid'];?>"><?php echo $row_uf['name'];?></a></h3><br />
				<p><?php echo $row_uf['uinfo'];?></p><br />
				<p><span><?php echo $this->mhome->follow_i($row_uf['uid']);?>个粉丝</span> <span><?php echo $this->mhome->info_n($row_uf['uid']);?>回答</span></p>
			</div>
			
		</div>
		<?php
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
			endif;
			//粉丝
			if($this->uri->segment(4) == "follow_i"):
			$follow_u = $this->mhome->follow_u($uid);
				if(empty($follow_u)):
		?>
		<div class="user_box u_info">
			<div class="f_info">
				<p>暂时还未有人关注Ta</p>
			</div>
		</div>		
		
		<?php
				endif;
			//print_r($follow_u);
				foreach($follow_u as $row_fu):
		?>
		<div class="user_box u_info">
			<div class="u_follow follow<?php echo $row_fu['uid'];?>">
				<?php $sel_followi = $this->mhome->sel_followi($row_fu['uid']);?><input type="hidden" value="<?php echo $row_fu['uid']?>"><a href="javascript:void(0);"><?php if($row_fu['uid'] != $this->session->userdata('uid')){if($sel_followi > 0){echo '取消关注';}else{echo '关注';}}?></a>
			</div>
			<a href="welcome/users/<?php echo $row_fu['uid'];?>"><img src="images/img/<?php echo $row_fu['photo'];?>" alt="<?php echo $row_fu['name'];?>" width="66px" /></a>
			<div class="f_info">
				<h3><a href="welcome/users/<?php echo $row_fu['uid'];?>"><?php echo $row_fu['name'];?></a></h3><br />
				<p><?php echo $row_fu['uinfo'];?></p><br />
				<p><span><?php echo $this->mhome->follow_i($row_fu['uid']);?>个粉丝</span> <span><?php echo $this->mhome->info_n($row_fu['uid']);?>回答</span></p>
			</div>
			
		</div>
		<?php
				endforeach;
			endif;
			//显示更多
			if($this->uri->segment(4) == "" && $this->mhome->info_n($uid) > 10):
		?>
		<div id="more"> <a  id="10" class="load_more" href="javascript:void(0);">更多</a> </div>
		<?php 
			endif;
			if($this->uri->segment(4) == "follow" && $this->mhome->follow_n($uid) > 10):
		?>
		<div id="more"> <a  id="10" class="load_more" href="javascript:void(0);">更多</a> </div>
		<?php 
			endif;
			$seluser = $this->mhome->seluser($uid);
			$i_follow_num = substr_count($seluser["follow_u"],'@');
			if($this->uri->segment(4) == "i_follow" &&  $i_follow_num  > 3):
		?>
		<div id="more"> <a  id="3" class="load_more" href="javascript:void(0);">更多</a> </div>
		<?php 
			endif;
			if($this->uri->segment(4) == "follow_i" && $this->mhome->follow_i($uid) > 1):
		?>
		<div id="more"> <a  id="1" class="load_more" href="javascript:void(0);">更多</a> </div>
		<?php 
			endif;
		?>