<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<title></title>
	<base href="<?php echo base_url();?>"/>
	<link rel="stylesheet" type="text/css" href="css/style.css" media="all" />
	<link rel="stylesheet" href="ueditor/themes/default/ueditor.css"/>
	<!--[if (gt IE 6)&(lt IE 9)]><link rel="stylesheet" href="css/ie.css" type="text/css" media="all" /><![endif]-->
	<!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js" type="text/javascript"></script> -->
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/javascript.js"></script>
	<script type="text/javascript" charset="utf-8" src="ueditor/editor_all_min.js"></script>
	<script type="text/javascript" charset="utf-8" src="ueditor/editor_config.js"></script>
   <!--  <script type="text/javascript">
       var UEDITOR_HOME_URL = "";
    </script> -->
    <!--使用版-->
   
</head>
<body>
<!--[if lte IE 6]>
<div id="ie6-warning" style="color:red;font-size:18px">你正在使用的浏览器版本太低，将不能正常浏览本站及使用知乎的所有功能。请升级 <a href="http://windows.microsoft.com/zh-CN/internet-explorer/downloads/ie">Internet Explorer</a> 或使用 <a href="http://www.google.com/chrome/">Google Chrome</a> 浏览器。</div>
<![endif]-->
<p id="back-to-top"><a href="#top"><span></span>返回顶部</a></p>
<div class="header">
	<div id="header_top">
		<div id="top">
			<a href="welcome/<?php if($this->session->userdata('uid') == ""){echo "login";}else{echo "index";}?>" class="logo" title="返回首页"></a>
			<div id="searchbox">
				
					<input type="text" name="search" id="search" autocomplete="off"/>
					<input type="submit" value="搜索" id="submit" />
				
			</div>
			<ul class="user_nav">
				<li><a href="">首页</a></li>
				<li><a href="">苏格拉威士忌找不到了</a></li>
				<li><a href="">通知</a></li>
			</ul>
			<ul class="user_tag">
				<li><a href="">设置</a></li>
				<li><a href="">退出</a></li>
			</ul>
		</div>
	</div>


</div>