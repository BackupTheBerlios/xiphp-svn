<?PHP
    /**
     * Fichier pour les tests de d�veloppement.
	 * (ATTENTION!!! Sujet � changement fr�quant, uniquement pour les test.)
     */

    /**
     * Liste les fichiers d'inclusion
     */
	require_once './inc/clsKernel.php';



    clsKernel::ShowInfoXIPHP();

    echo DB_Server;

    try
    {
  
	throw new Exception($LANG["ERR_9001"],666);

	}
    catch (Exception $e)
    {
    	clsKernel::ShowException($e);
    }

?>
