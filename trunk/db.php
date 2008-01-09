<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>Test de la classe clsDB</title>
</head>

<body>
	<h1>Test de la classe clsDB</h1>

<?PHP

	require_once './inc/clsDB.php';

    // Affichage des infos du projet
    clsKernel::ShowInfoXIPHP();


	$oDB = New clsDB();

		$tData = array('txt'=>'Text Add 1','numb'=>455);
		echo $oDB->Add('test',$tData);

		$tData = array('txt'=>'Text Add 2','numb'=>456);
		echo $oDB->Add('test',$tData);

		$tData = array('txt'=>'Text Add 3','numb'=>457);
		echo $oDB->Add('test',$tData);


        $tData = array('txt'=>'Text Add 2b','numb'=>4561);
		echo $oDB->Update('test',$tData,'numb=456');

        
		echo $oDB->Delete('test','id>2 and id<5');

	$oDB = null;



?>

	<p>Requête exécuté.</p>

</body>

</html>