<?PHP
    /**
     * Fichier pour les tests de d�veloppement.
	 * (ATTENTION!!! Sujet � changement fr�quant, uniquement pour les test.)
     */

    /**
     * Liste les fichiers d'inclusion
     */
	require_once './inc/clsDB.php';


    // Affichage des infos du projet
    clsKernel::ShowInfoXIPHP();

	$oDB = New clsDB();

   	$oDB->RunQueryFromFile('./config/config.sql');

	$oDB = null;


?>
