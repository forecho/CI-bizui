<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<title></title>
</head>
<body>
<?php echo $error;?>
<?php echo form_open('welcome/login');?>
	<input type="text" name="email"  value="" placeholder="邮箱">
	<input type="password" name="password"  value="" placeholder="密码">
	<input type="submit" value="登录" />
<?php echo form_close();?>
</body>
</html>