<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo SITE_NAME?></title>
</head>
<frameset rows="46,*" cols="*" frameborder="no" border="0" framespacing="0">
    <frame src="<?php echo site_url('welcome/header')?>" name="topframe" scrolling="no" noresize="noresize" id="topframe" />
    <frameset cols="211,*" framespacing="0" frameborder="no" border="0" bordercolor="#336699">
        <frame src="<?php echo site_url('welcome/nav')?>" name="leftframe" scrolling="auto" noresize="noresize" id="leftframe" noresize="noresize" />
        <frame src="<?php echo site_url('welcome/sysinfo')?>" name="mainframe" scrolling="auto" noresize="noresize" id="mainframe" />
    </frameset>
</frameset>
<noframes>
<body>
</body>
</noframes>
</html>