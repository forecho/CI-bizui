<?php $selfollow = $this->mhome->selfollow($pid);?>
<?php //if($selfollow > 0){echo '<span>1</span>';}?>
<a href="javascript:void(0);" class="follow <?php if($selfollow > 0){echo 'message';}?>" ><?php if($selfollow == 0){echo '关注';}else{echo '取消关注';}?></a>