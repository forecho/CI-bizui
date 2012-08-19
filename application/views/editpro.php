<script type="text/javascript" src="ueditor/editor_config~.js"></script>
<div id="main">
	<div style="clear:both"></div>
	<div class="product_tab"><h2>修改<?php echo rawurldecode($this->uri->segment(3));?>产品<a href="<?php //echo $_SERVER['HTTP_REFERER']?>">返回</a></h2></div>
	<div class="add_box">
		<?php echo form_open_multipart('welcome/editproduct');?>
		<dl>
			<div style="clear:both"></div>
			<br />
			<input type="hidden" name="pid" value="<?php echo $selproduct['pid'];?>"/>
			<input type="hidden" name="pimg" value="<?php echo $selproduct['pimg'];?>"/>
			<img src="images/3c/<?php echo $selproduct['pimg'];?>" alt="" />
			<dd id="uploadImg">
				<input type="file" name="upload" id="file" size="1"  />
				<a href="#">修改图片</a>
			</dd><br /><br /><br />
			<dt class="float">数码型号：</dt>
			<dd><input type="text" name="pname" class="input_box :required"  value="<?php echo $selproduct['pname'];?>"/></dd>
			<dt class="float">数码分类：</dt>
			<dd>
				<select name="cname" class="input_box" id="bTrade">
					<option value="">—数码分类—</option>  
					<?php foreach($selclass as $classname):?>
					<option value="<?php echo $classname['cname'];?>" <?php if($selproduct['cname'] == $classname['cname']){echo 'selected="selected"';} ?>><?php echo $classname['cname'];?></option>
					<?php endforeach;?>
				</select> 
			</dd>
			<dt class="float">数码品牌：</dt>
			<dd id="quote">
				<select name="bname" class="input_box" id="sTrade">
					<option value="<?php echo $selproduct['bname'];?>"><?php echo $selproduct['bname'];?></option>  
				</select> 
			</dd>
			<dt class="float">参考价格：</dt>
			<dd>
				<select name="money" class="input_box">
					<?php foreach($selmoney as $row_m):?>
					<option value="<?php echo $row_m['mrange'];?>" <?php if($selproduct['money'] == $row_m['mrange']){echo 'selected="selected"';} ?>><?php echo $row_m['mrange'];?></option>
					<?php endforeach;?>
				</select> 
			</dd>
			<dt>简单介绍：</dt>
			<dd><textarea name="pinfo" class=":required :max_length;300" rows="6"><?php echo $selproduct['pinfo'];?></textarea></dd>
			<dt>产品参数：</dt>
			<dd>
				<script type="text/plain" id="myEditor" class="myEditor">
				<?php echo $selproduct['para'];?>
				</script>
				<script type="text/javascript">
					var editor_a = new baidu.editor.ui.Editor();
					editor_a.render('myEditor');
				</script>
			</dd>
			<dd><input type="submit" value="提交"  class="submit"/></dd>
		</dl>
		
		<?php echo form_close(); ?>
		
	
	</div>
	
	
</div>

</div>
</body>
</html>
	<script type="text/javascript" src="js/vanadium.js"></script>
	<script src="js/check_form.js"></script>
<script type="text/javascript">
$("#bTrade").change(function(){     //jquery中change()函数 
	$("#quote").load("welcome/liandong_ajax/"+$("#bTrade").val());          //jqueryajax中load()函数  
});

</script>