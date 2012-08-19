<input type="hidden" value="<?php echo $uid;?>"><?php $sel_ifollow = $this->mhome->sel_ifollow($uid);?><a href="javascript:void(0);"><?php if($sel_ifollow > 0){echo '取消关注';}else{echo '关注';}?></a>
