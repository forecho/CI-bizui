<!-- <span class="yes"><input type="hidden" value="<?php //echo $iid;?>"><a href="javascript:void(0);" title="" class=""><?php //$num_yes_no = $this->mhome->num_yes_no($iid);echo substr_count($num_yes_no["yes"],'@')-1;?></a></span> -->
<span class="<?php $yes = $this->session->userdata('uid') != "" && $this->mhome->selyes($iid) >0; if($yes){echo 'yes';}else{echo 'up';}?>"><input type="hidden" value="<?php echo $iid?>"> <a href="javascript:void(0);" title="<?php if($yes){echo '你已经赞同过了';}else{echo '表示赞同';}?>" class=""><?php $num_yes_no = $this->mhome->num_yes_no($iid);echo substr_count($num_yes_no["yes"],'@')-1;?></a></span>
<span class="<?php $no = $this->session->userdata('uid') != "" && $this->mhome->selno($iid) >0; if($no){echo 'no';}else{echo 'down';}?>"><input type="hidden" value="<?php echo $iid?>"><a href="javascript:void(0);" title="<?php if($no){echo '你已经反对过了';}else{echo '表示反对';}?>" class=""><?php $num_yes_no = $this->mhome->num_yes_no($iid);echo substr_count($num_yes_no["no"],'@')-1;?></a></span>