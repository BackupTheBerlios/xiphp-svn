<?php

require_once './inc/clsKernel.php';

/**
 *  Classe de manipulation des bases de données MySQL
 *
 *  C'est cette classe qui contrôle la manipulation des donnés pour MySQL. Elle
 *  utilise la version objet de l'extension mysqli de PHP5. Par ce fait seul la
 *	version 4.1.3 et plus de MySQL est utilisable.
 *
 *   This file is part of XI-PHP (eXtended Interface PHP) <http://xiphp.yaugsoft.com>
 *   Copyright (C) 2007..08  Production YaugSoft <xiphp@yaugsoft.com>
 *
 *   This program is free software: you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation, either version 3 of the License, or
 *   (at your option) any later version.
 *
 *   This program is distributed in the hope that it will be useful,
 *   but WITHOUT ANY WARRANTY; without even the implied warranty of
 *   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *   GNU General Public License for more details.
 *
 *   You should have received a copy of the GNU General Public License
 *   along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @package    xiphp
 * @subpackage class
 * @author     Patrick Guay <xiphp@yaugsoft.com>
 * @copyright  (C) 2007..08 Production YaugSoft.
 * @license    http://www.gnu.org/licenses/gpl.html GNU GPL
 * @since      2007/12/23 (v. 0.1)
 *
 */

class clsDB extends clsKernel
{

    /**
     *  Variable objet de manipulation de la base de données
	 *
	 * @access 	private
     */
	private $oDB = Null;

    /**
     * 	Pour vérifier si l'objet est connecté à une base de données.
     */
	public $bIsConnected = false;


    /**
     * Constructeur de la classe clsDB
     *
     * @access	public
     * @author  Patrick Guay <xiphp@yaugsoft.com>
     * @since   2007/12/23 (v. 0.1)
     * @return  void
     */
	function __construct()
	{
        try {

			@ $this->oDB = new mysqli(DB_Server,DB_User,DB_Pass,DB_Name);

            // Vérification de la connexion
			if (mysqli_connect_errno()) {
                throw new Exception(self::Lng('ERR_9110').mysqli_connect_error(),9100);
			    exit();
			}
            $this->bIsConnected = true;
        }
		catch (Exception $e) {
    		self::ShowException($e);
		}
	}

    /**
     * Destructeur de la classe clsDB
     *
     * @access	public
     * @author  Patrick Guay <xiphp@yaugsoft.com>
     * @since   2007/12/23 (v. 0.1)
     * @return  void
     */
	function __destruct()
	{
        if ($this->bIsConnected) {
        	$this->oDB->Close();
        }
	}

    /**
     * Exécution d'une requête SQL sous forme de string.
     *
     * @access	public
     * @author  Patrick Guay <xiphp@yaugsoft.com>
     * @since   2007/12/30 (v. 0.1)
     * @param   string [$sSQL] Chaine de caractère contenant les commandes SQL.
     * @return  Objet base de données ou True/False pour requête sans retour de données.
     */
    public function RunQuery($sSQL)
	{

        try {

            $sSQL = trim($sSQL);
        	return $this->oDB->query($sSQL);

		}
        catch (Exception $e) {
            self::ShowException($e);
        }

	}

    /**
     * Exécution d'une requête SQL à partir d'un fichier.
     *
	 * 	Prend en compte les lignes vide et les lignes de commentaire débutant par "--".
	 *	Techniquement, les requètes en provenance de phpMyAdmin sont valide.
	 *
     * @access	public
     * @author  Patrick Guay <xiphp@yaugsoft.com>
     * @since   2007/12/30 (v. 0.1)
     * @param   string [$sFilePath] Chemin d'acces du fichier
     * @return  True/False
     */
	public function RunQueryFromFile($sFilePath)
	{
		$bExecOK = false;
        try {

        	if ($fSQL = @fopen($sFilePath, 'r')) {

				$sReq = '';
				while( !feof($fSQL) ) {
					$sLine = trim(fgets($fSQL));
					//Suppression des lignes vides, et des commentaires.
					if( !empty($sLine) && substr($sLine, 0, 2) !== '--' )	{
                    	$sReq .= ' ' . $sLine;
					}
					//Vérification de la fin d'une commande SQL selon le ";" de fin. et son exécution.
                    $sReq = trim($sReq);
					if (substr($sReq, -1) == ';') {
                        if ($this->RunQuery($sReq)) {
                        	$sReq = '';
						} else {
							throw new Exception(self::Lng('ERR_9111').$sReq,9111);
                        }

					}
				}
				@fclose($fSQL);
				$bExecOK = true;

			} else {
				throw new Exception(self::Lng('ERR_9110').$sFilePath,9110);
			}
		}
        catch (Exception $e) {
            self::ShowException($e);
        }

		return $bExecOK;
	}

    /**
     * Ajout d'une entrée dans une table
     *
     * @access	public
     * @author  Patrick Guay <xiphp@yaugsoft.com>
     * @since   2008/01/04 (v. 0.1)
	 * @param   string [$sTable] Nom de la table de la BD où ajouter les données.
	 * @param	table [$tField] Liste des colones / valeurs (Clef / valeur)
     * @return  true/false si ok
     */
	public function Add($sTable,$tField)
	{
		$bExecOK = false;
        try {

        	$sSQL = "INSERT INTO $sTable SET ";
			foreach ($tField as $sCol => $sVal) {
            	$sSQL .= $sCol.'=';
                if (is_string($sVal)) {
                	$sSQL .= '"'.$sVal.'"';
                } else {
                    $sSQL .= $sVal;
                }
                $sSQL .= ',';
			}

            $sSQL = substr($sSQL,0,-1);//suppression de la dernière virgule

			if ($this->RunQuery($sSQL)) {
            	$bExecOK = true;
			} else {
				throw new Exception(self::Lng('ERR_9112').$sSQL,9112);
            }

        }
        catch (Exception $e) {
            self::ShowException($e);
        }

		return $bExecOK;
	}

    /**
     * Modification d'une donnée dans une table.
     *
     * @access	public
     * @author  Patrick Guay <xiphp@yaugsoft.com>
     * @since   2008/01/08 (v. 0.1)
     * @param   string [$sTable] Nom de la table de la BD où modifier les données.
	 * @param	table [$tField] Liste des colones / valeurs (Clef / valeur) à modifier.
	 * @param   string [$sWhere] Condition de modification
     * @return  true/false si ok
     */
	public function Update($sTable,$tField,$sWhere)
	{
        $bExecOK = false;
        try {

        	$sSQL = "UPDATE $sTable SET ";
			foreach ($tField as $sCol => $sVal) {
            	$sSQL .= $sCol.'=';
                if (is_string($sVal)) {
                	$sSQL .= '"'.$sVal.'"';
                } else {
                    $sSQL .= $sVal;
                }
                $sSQL .= ',';
			}
            $sSQL = substr($sSQL,0,-1);//suppression de la dernière virgule
			$sSQL .= ' WHERE '.$sWhere;

			if ($this->RunQuery($sSQL)) {
            	$bExecOK = true;
			} else {
				throw new Exception(self::Lng('ERR_9113').$sSQL,9113);
            }

        }
        catch (Exception $e) {
            self::ShowException($e);
        }

		return $bExecOK;
	}

    /**
     * Suppression d'une donnée dans une table.
     *
     * @access 	public
     * @author  Patrick Guay <xiphp@yaugsoft.com>
     * @since   2008/01/08 (v. 0.1)
     * @param   string [$sTable] Nom de la table de la BD où supprimer les données.
	 * @param   string [$sWhere] Condition de suppression (Vide par défaut). Si vide supprime toutes les lignes de la table.
     * @return  true/false si ok
     */
	public function Delete($sTable,$sWhere="")
	{
        $bExecOK = false;
        try {

        	$sSQL = "DELETE FROM $sTable";
			if ($sWhere <> "") {
            	$sSQL .= ' WHERE '.$sWhere;
            }

			if ($this->RunQuery($sSQL)) {
            	$bExecOK = true;
			} else {
				throw new Exception(self::Lng('ERR_9114').$sSQL,9114);
            }

        }
        catch (Exception $e) {
            self::ShowException($e);
        }

		return $bExecOK;

	}


}
?>