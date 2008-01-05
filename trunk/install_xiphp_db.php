<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>Installation de la Base de donnée pour XI-PHP.</title>
</head>

<body>

<?PHP
    /**
     * Installation de la Base de donnée pour XI-PHP.
     */

	require_once './inc/clsDB.php';

    clsKernel::ShowInfoXIPHP();

    echo " <h1>Installation de la requête SQL -> config.sql</h1> ";
    echo ' <p>
    	Vérifier que vous avez bien configurer le fichier "connect.php" pour que
		la requête SQL s\'exécute correctement.
	</p><br />';

    try {

		$oDB = New clsDB();

		if (!$oDB->RunQueryFromFile('./config/config.sql')) {
        	throw new Exception(clsKernel::Lng('ERR_9111'),9111);
		}

		echo 'Installation terminé avec succes.';
		
	}
	catch (Exception $e) {
	    clsKernel::ShowException($e);
	}

	$oDB = null;

?>

</body>

</html>