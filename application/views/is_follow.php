<input type="hidden" value="<?php echo $pid;?>"><?php $selfollow = $this->mhome->selfollow($pid);?><a href="javascript:void(0);"><?php if($selfollow > 0){echo '取消关注';}else{echo '关注';}?></a>
