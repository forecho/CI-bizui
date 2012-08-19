		<?php
			foreach($i_follow_ajax as $row_if_ajax):
		?>
		<div class="user_box">
			<h3><a href="welcome/comment/<?php echo $row_if_ajax['pname'];?>"><?php echo $row_if_ajax['bname'],' ',$row_if_ajax['pname'];?></a></h3>
			<div class="push">
				<a href="welcome/users/<?php echo $uid;?>"><?php echo $uname;?></a>关注了该问题 • <?php echo $iinfo_num = $this->mhome->iinfo_num($row_if_ajax['pname']);?>个体验 
				<span class="is_follow follow<?php echo $row_if_ajax['pid'];?>">• <?php $selfollow = $this->mhome->selfollow($row_if_ajax['pid']);?><input type="hidden" value="<?php echo $row_if_ajax['pid']?>"><a href="javascript:void(0);"><?php if($selfollow > 0){echo '取消关注';}else{echo '关注';}?></a></span>
				• <?php echo $row_if_ajax['addtime'];?>
			</div>
		</div>
		<?php
			endforeach;
	if( $i_follow_ajax_num == 10){
?>
<div id="more"> <a  id="<?php echo $lastmsg; ?>" class="load_more" href="javascript:void(0);">更多</a>  </div>

<?php
	}else {
    
    echo '<div id="more"><a  id="end" class="load_more" href="javascript:void(0);">没有了 </a>  </div>';
    
	}
?>