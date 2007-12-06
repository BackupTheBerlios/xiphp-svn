<?PHP
    /**
     * Fichier pour les tests de développement.
     */

    /**
     * Autochargement des classes au lieu de faire des "Require_once"
     *
     * Cette clase s'exécute automatiquement ne pas appeler directement.
     *
     * @access public
     * @author Patrick Guay <xiphp@yaugsoft.com>
     * @param  string Nom de classe
     * @return void
     */
    function __autoload($class_name)
    {
        require_once 'inc/'. $class_name . '.php';
    }

    clsKernel::ShowInfoXIPHP();

    echo DB_Server;

    try
    {
  
	throw new Exception('Message de cul d\'exception a marde',666);

	}
    catch (Exception $e)
    {
    	clsKernel::ShowException($e);
    }

?>
