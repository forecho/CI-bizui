<?php
	//print_r($follow_i_ajax);
	foreach($follow_i_ajax as $row_fi_ajax):
?>
<div class="user_box u_info">
	<div class="u_follow follow<?php echo $row_fi_ajax['uid'];?>">
		<?php $sel_ifollow = $this->mhome->sel_ifollow($row_fi_ajax['uid']);?><input type="hidden" value="<?php echo $row_fi_ajax['uid']?>"><a href="javascript:void(0);"><?php if($row_fi_ajax['uid'] != $this->session->userdata('uid')){if($sel_ifollow > 0){echo '取消关注';}else{echo '关注';}}?></a>
	</div>
	<a href="welcome/users/<?php echo $row_fi_ajax['uid'];?>"><img src="images/img/<?php echo $row_fi_ajax['photo'];?>" alt="<?php echo $row_fi_ajax['name'];?>" width="66px" /></a>
	<div class="f_info">
		<h3><a href="welcome/users/<?php echo $row_fi_ajax['uid'];?>"><?php echo $row_fi_ajax['name'];?></a></h3><br />
		<p><?php echo $row_fi_ajax['uinfo'];?></p><br />
		<p><span><?php echo $this->mhome->follow_i($row_fi_ajax['uid']);?>个粉丝</span> <span><?php echo $this->mhome->info_n($row_fi_ajax['uid']);?>回答</span></p>
	</div>
	
</div>
<?php
			endforeach;
	if( $follow_i_ajax_num == 1){
?>
<div id="more"> <a  id="<?php echo $lastmsg; ?>" class="load_more" href="javascript:void(0);">更多</a>  </div>

<?php
	}else {
    
    echo '<div id="more"><a  id="end" class="load_more" href="javascript:void(0);">没有了 </a>  </div>';
    
	}
?>