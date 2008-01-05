<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>Menu des pages de Test & Démo de XI-PHP</title>
</head>

<body>
    <h1>Menu des pages de Test & Démo de XI-PHP</h1>
	<?php
        require_once './inc/clsKernel.php';
    	clsKernel::ShowInfoXIPHP();
    ?>

	<a href="install_xiphp_db.php" title="Installation DB de XI-PHP">Installation DB de XI-PHP </a> -> "config.sql"
	<br />
	<br />
    <ul>
  		<li><a href="db.php" title="Test clsDB">Test clsDB</a></li>
	</ul>


</body>

</html>


