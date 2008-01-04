<?PHP
    /**
     * Fichier pour les tests de développement.
	 * (ATTENTION!!! Sujet à changement fréquant, uniquement pour les test.)
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
