-- ******************************************************************************************
-- *   This file is part of XI-PHP (eXtended Interface PHP) <http://xiphp.yaugsoft.com>
-- *   Copyright (C) 2007..08  Production YaugSoft <xiphp@yaugsoft.com>
-- *
-- *   This program is free software: you can redistribute it and/or modify
-- *   it under the terms of the GNU General Public License as published by
-- *   the Free Software Foundation, either version 3 of the License, or
-- *   (at your option) any later version.
-- *
-- *   This program is distributed in the hope that it will be useful,
-- *   but WITHOUT ANY WARRANTY; without even the implied warranty of
-- *   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
-- *   GNU General Public License for more details.
-- *
-- *   You should have received a copy of the GNU General Public License
-- *   along with this program.  If not, see <http://www.gnu.org/licenses/>.
-- ******************************************************************************************
-- Version : 0.1
--
-- Base de données du projet: XI-PHP
--

-- --------------------------------------------------------

--
-- Structure de la table de test (table temporaire pour les tests) `test`
--

DROP TABLE IF EXISTS `test`;
CREATE TABLE `test` (
  `id` int(11) NOT NULL auto_increment,
  `txt` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

-- Contenu

INSERT INTO `test` (`id`, `txt`) VALUES
(1, 'Texte -1'),
(2, 'Texte -2');

-- --------------------------------------------------------