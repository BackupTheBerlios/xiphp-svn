<?php

/**#@+
 * Inclusion des fichiers de configuration.
 *
 * connect.php = Donnnées de connection à la base de données.
 * config.php = Configuration général de XI-PHP. 
 */
require_once './config/connect.php';
require_once './config/config.php';
/**#@-*/

/**
 *  Classe de base de toute la hiérarchie du projet XI-PHP
 *
 *  C'est à partir de cette classe que toute nouvelle classe doit hérité (directement
 *  ou inderectement par héritage) pour faire partie d'un projet XI-PHP, ou plus encore
 *  pour créer une extention à XI-PHP. C'est le coeur de l'interface, c'est cette classe
 *  qui contrôle les fichiers de configuration et de langage.
 *
 *   This file is part of XI-PHP (eXtended Interface PHP) <http://xiphp.yaugsoft.com>
 *   Copyright (C) 2007  Production YaugSoft <xiphp@yaugsoft.com>
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
 * @abstract
 * @package    xiphp
 * @subpackage class
 * @author     Patrick Guay <xiphp@yaugsoft.com>
 * @copyright  (C) 2007 Production YaugSoft.
 * @license    http://www.gnu.org/licenses/gpl.html GNU GPL
 * @since      2007/10/27 (v. 0.1)
 *
 */
abstract class clsKernel
{
    /**#@+
     * Constante de description du projet.
     */
    Const sXIPHP_Version     = '0.1';
    Const sXIPHP_VersionDesc = 'Pré-Alpha';
    Const sXIPHP_Copyright   = '(c) 2007 Production YaugSoft';
    Const sXIPHP_Licence     = 'GNU GPL v3 [http://www.gnu.org/licenses/gpl.html]';
    Const sXIPHP_URLSite     = 'http://xiphp.yaugsoft.com';
    Const sXIPHP_URLRepos    = 'http://developer.berlios.de/svn/?group_id=9134';
    Const sXIPHP_Contact     = 'Patrick Guay [xiphp@yaugsoft.com]';
    /**#@-*/

    /**
     * Langue active, la langue par défaut est attribué par "DEFLANG"
     */
	static $sActiveLang = DEFLANG;


    /**
     * Pour afficher
     *
     * @static
     * @author  Patrick Guay <xiphp@yaugsoft.com>
     * @since   2007/12/16 (v. 0.1)
     * @param   string [$sTag] Nom de la clef de référence dans le tableau du langage.
     * @return  string
	 * @see     Le nom de la langue active est déterminé par $sActiveLang et modifiable par la function SetLang
     */
	static function Lng($sTag)
	{
        try {
			if (! file_exists('./lang/'.self::$sActiveLang.'.php')) {
            	throw new Exception('CRITICAL LANGUAGE ERROR ::: ./lang/'.self::$sActiveLang.'.php',0);
			} else {
				require './lang/'.self::$sActiveLang.'.php';
				Return $tLANG[$sTag];
	        }
		}
		catch (Exception $e) {
		    self::ShowException($e);
		}
	}

    /**
     * Changement de la langue active.
	 *
	 * Prendre note que le fichier langue doit exister, sinon il y aura une exception. Si vide prend la langue par défaut
     *
     * @static
     * @author  Patrick Guay <xiphp@yaugsoft.com>
     * @since   2007/12/16 (v. 0.1)
     * @param   string [$sLangName] Nom de la nouvelle langue,
     * @return  boolean  Si le changement est effectué correctement, retourne "true"
     */
	static function SetLang($sLangName = DEFLANG)
	{
        try {
			if (! file_exists('./lang/'.$sLangName.'.php')) {
            	throw new Exception(self::Lng('ERR_9020'),9020);
			} else {
				self::$sActiveLang = $sLangName;
				return true;
	        }
		}
		catch (Exception $e) {
		    self::ShowException($e);
		}
	}

    /**
     * Affichage des constante de description du projet.
     *
     * @static
     * @author  Patrick Guay <xiphp@yaugsoft.com>
     * @since    2007/10/28 (v. 0.1)
     * @return   void
     */
    static function ShowInfoXIPHP()
    {
        $str  = '<hr size="5" />';
        $str .= '<strong>XI-PHP</strong>  (eXtended Interface PHP) <br />';
        $str .= '<strong>¯¯_¯_¯_¯_¯_¯_¯__</strong> <br />';
        $str .= '<strong>Version :</strong> '.self::sXIPHP_Version.' ('.self::sXIPHP_VersionDesc.') <br />';
		$str .= '<strong>Copyright :</strong> '.self::sXIPHP_Copyright.' <br />';
        $str .= '<strong>Licence :</strong> '.self::sXIPHP_Licence.' <br />';
        $str .= '<strong>URL :</strong> <a href="'.self::sXIPHP_URLSite.'">'.self::sXIPHP_URLSite.'</a> <br />';
        $str .= '<strong>URL Repository :</strong> <a href="'.self::sXIPHP_URLRepos.'">'.self::sXIPHP_URLRepos.'</a> <br />';
        $str .= '<strong>Contact :</strong> '.self::sXIPHP_Contact.' <br />';
        $str .= '<hr size="5" /> <br />';
        echo $str;
    }

    /**
     * Affichage formaté des informations d'une exception.
     *
     * @static
     * @author  Patrick Guay <xiphp@yaugsoft.com>
     * @since   2007/11/11 (v. 0.1)
     * @param   exception [$e] Information transmise par une exception
	 * @param   string [$sTitle] Titre de l'exception, par défaul = 'XI-PHP Exception'
     * @return  void
	 * @see     Les messages d'erreur doivent être inclus dans les fichiers langage (ex. lang/french.php)
     */
    static function ShowException($e,$sTitle = 'XI-PHP Exception')
    {
		$str = '<br />';
        $str .= '<table width="100%" style="background-color:red; border:3px solid black">';
        $str .= '<tr><td style="background-color:yellow; border:1px solid yellow">';
        $str .= ' <strong>'.$sTitle.'  ('.$e->getcode().')</strong>';
		$str .= '</td></tr>';
        $str .= '<tr><td>';
        $str .= '<strong>File : </strong>'.$e->getFile().' (line '.$e->getLine().')';
		$str .= '<hr size="1" style="color:black" />';
		$str .= '<strong>Msg : </strong>'.$e->getMessage();
		$str .= '<hr size="1" style="color:black" />';
		$str .= $e->getTraceAsString();
		$str .= '</td></tr>';
        $str .= '</table> <br />';
        echo $str;
    }


}

?>




