		<?php
			if($this->uri->segment(4) == ""):
			//$iinfo = $i_info[0]['iid'];
			//print_r($i_info);
			foreach($u_index_ajax as $row_u):
			foreach($row_u as $row_ii_ajax):
		?>
		<div class="user_box">
			<h3><a href="welcome/comment/<?php echo $row_ii_ajax['pname'];?>"><?php echo $row_ii_ajax['bname'],' ',$row_ii_ajax['pname'];?></a></h3>
			<div class="push">
				<a href="welcome/users/<?php echo $row_ii_ajax['uid'];?>"><?php echo $row_ii_ajax['name'];?></a>回答了该问题
				• <?php echo $iinfo_num = $this->mhome->iinfo_num($row_ii_ajax['pname']);?>个体验 
				<span class="is_follow follow<?php echo $row_ii_ajax['pid'];?>">• <?php $selfollow = $this->mhome->selfollow($row_ii_ajax['pid']);?><input type="hidden" value="<?php echo $row_ii_ajax['pid']?>"><a href="javascript:void(0);<?php //if($selfollow > 0){echo 'welcome/del_follow/'.$row_ii_ajax['pid'];}else{echo 'welcome/add_follow/'.$row_ii_ajax['pid'];}?>"><?php if($selfollow > 0){echo '取消关注';}else{echo '关注';}?></a></span>
				• <?php echo $row_ii_ajax['addtime'];?> <?php if($row_ii_ajax['yes_num'] != 0){echo '•',$row_ii_ajax['yes_num'],'票赞同';}?>
				<div class="answer">
					<b><p>[<?php
					switch ($row_ii_ajax['score']){
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
					<?php echo $row_ii_ajax['title'];?>
					</p></b>
					<p><?php echo $row_ii_ajax['content'];?></p>
				</div>
			</div>
		</div>
		<?php
			endforeach;
			endforeach;
			endif;
		?>



<?php
	//print_r( $u_index_ajax_num);
	if( array_sum($u_index_ajax_num) == 2){
?>
<div id="more"> <a  id="<?php echo $lastmsg; ?>" class="load_more" href="javascript:void(0);">更多</a>  </div>

<?php
	}else {
    
    echo '<div id="more"><a  id="end" class="load_more" href="javascript:void(0);">没有了 </a>  </div>';
    
	}
?>