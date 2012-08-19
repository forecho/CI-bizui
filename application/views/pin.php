<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<style type="text/css">
/* RESET */
html, body {height:100%;}
body, div, p, h1, h2, h3, h4, h5, h6, dl, dt, dd, ol, ul, li, th, td, blockquote, pre, form, fieldset, legend, input, button, textarea, hr {margin:0; padding:0;}
h1, h2, h3, h4, h5, h6 {font-size:100%;font-weight:normal;}
fieldset, img {border:0;}
ul, ol {list-style:none outside none;}
q:before, q:after {content:'';}
table {border-collapse:collapse;border-spacing:0;}
input, textarea {outline-style:none;}
textarea {resize:none;}
address, caption, cite, code, dfn, em, i, th, var {font-style:normal;font-weight:normal;}
legend {color:#000;}
abbr, acronym {border:0:font-variant:normal;}

body {
background-image: url("http://static.pinfun.com/images/common/defaultbg.gif");
background-repeat: repeat;
background-color: #E8E7E3;
}
body,button,input,select,textarea{font:12px/1.125 "微软雅黑", "宋体", Helvetica, Arial, sans-serif;color:#333;}
a {text-decoration:none;color:#999;outline:none;}
a:hover {text-decoration:none;color:#09f;}
a:hover img {opacity: 0.92;}

.head_p {
width: 30px;
height: 30px;
}


/* 输入框 */
.input_text { border:1px solid #e1e1e1; -webkit-border-radius:5px;-moz-border-radius:5px;-o-border-radius:5px; background:#fff;padding-left:5px;line-height:30px;}
/* 透明 */
.alpha {filter:alpha(opacity=0);-moz-opacity:0;opacity:0;}
.PF_clearb {
clear: both;
}


#container{
position: relative;
margin: 0 auto;
border: 0;	
}
.pin {
background-color: white;
padding: 12px 0 0;
position: relative;
}
.pin .image {
width: 196px;
display: block;
margin: 0 auto;
position: relative;
}
.pin .image img {
padding: 2px;
vertical-align: middle;
max-width: 190px;
margin: auto;
}
.pin .description {
line-height: 22px;
}
.pin .description, .pin .likecomment {
width: 196px;
margin: 10px auto 0;
word-wrap: break-word;
color: #666;
}


.item {
width: 221px;
float: left;
}
.PF_g_line {
border-width: 1px;
border-style: solid;
border-color: #DDD;
border-left: none;
border-top: none;
}


.origin {
background-color: #F7F7F7;
}
.pinlist {
margin: 5px auto 0;
}
.pinlist li.first {
border-top: none;
}
.pinlist li .userimage {
float: left;
width: 32px;
height: 32px;
}
.origin li {
background-color: #F7F7F7;
}
.pinlist li {
vertical-align: top;
overflow: hidden;
padding: 10px 5px;
border-top: 1px solid #F7F7F7;
}
.pinlist li .userimage img {
vertical-align: middle;
padding: 2px;
border: 1px solid #DDD;
border-image: initial;
}
.pinlist li p, .pinlist li form {
margin-left: 50px;
overflow: hidden;
line-height: 18px;
width: 158px;
}

.comments {
margin-top: 0;
}

</style>
</head>

<body>
<?php
$result = Array
(
	'tb_1212.jpg',
    'tb_13.jpg',
    'tb_16(1).jpg',
    'tb_16(2).jpg',
    'tb_16.jpg',
    'tb_2.jpg',
    'tb_23.jpg',
    'tb_3.jpg',
    'tb_30.jpg',
    'tb_41.jpg',
    'tb_5.jpg',
    'tb_9.jpg',
	'tb_2312.jpg',
	'121212.jpg',
	'long.jpg',
	'f53db8b9be66b8fb1f2cff537615249096f90fae13c95-j3lUGI_fw192.jpg',
	'ccce8d960a1956ebf1f4f8dc2611bd06ba8e35301264c6-uA90mj_fw192.png',
	'9041c37ff8e8f47088749416ce2abdbb644944e7c184-FWkwHR_fw192.jpg'
)
?>
<div class="container" id="container">
<?php
$i=0;

$tmp_left = array();
$tmp_top = array();

foreach($result as $k=>$v){
	$images_arr = getimagesize("./images/".$v);
	
	$top=0;
	if($i<=3){
		$left=222*$i;
		echo '<div class="item pin PF_g_line" style="position: absolute; top: '.$top.'px; left: '.$left.'px; display: block; "><img src="./images/'.$v.'" /></div>';
		$tmp_left[$i]=$left;
		$tmp_top[$i]=$images_arr[1]+30;
	}else{
		
		$left=$tmp_left[$i-4];
		if($i%4==0){
			echo '<div class="item pin PF_g_line" style="position: absolute; top: '.$tmp_top[$i-4].'px; left: '.$left.'px; display: block; "><img src="./images/'.$v.'" />'.$left.'</div>';
		}else{
		/*$tmp_top[$i]=$tmp_top[$i-4]+$images_arr[1];
		$tmp_left[$i]=$left;*/
			echo '<div class="item pin PF_g_line" style="position: absolute; top: '.$tmp_top[$i-4].'px; left: '.$left.'px; display: block; "><img src="./images/'.$v.'" />'.$left.'</div>';
		
		}
		
		$tmp_top[$i]=$tmp_top[$i-4]+$images_arr[1]+30;
		$tmp_left[$i]=$tmp_left[$i-4];
		
		
	}
?>
	
<?php
$i++;
}
?>

</div>

</body>
</html>