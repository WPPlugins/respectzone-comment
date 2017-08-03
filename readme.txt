=== Plugin Name ===
Contributors: respectzone
Tags: comments, spam
Requires at least: 4.3
Tested up to: 4.7
Stable tag: 4.3
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Remplace les insultes des commentaires par des licornes et autres icones.

Replace all insults in comments with licorns and others icons.

== Description ==

Cette extension remplace les mots d'insulte saisis dans les commentaires par des licornes et autres icones.
L'analyse est effectuée à partir d'une liste de mots d'insultes, contenus dans un fichier.
Ce fichier est situé dans un répertoire de l'extension (/file/fichier.txt) et il existe aussi sur notre site web 'respectzone.org'.
Depuis le menu d'administration, vous pourrez choisir d'utiliser le fichier qui se trouve en local dans le répertoire de l'extension, ou celui qui est sur notre site web.
Si vous sélectionnez notre site, l'extension effectuera un appel vers notre serveur pour chaque controle, afin d'utiliser une liste à jour.
Cette liste ne contient pour l'instant que des injures en français, mais le fichier peut être facilement modifié pour supprimer des mots ou en ajouter (en français ou dans une autre langue).
Ce service est gratuit, il ne nécessite pas de compte, et aucun suivi de son utilisation n'est effectué.
La liste sur notre serveur est accessible ici : https://api.respectzone.org/wp-content/plugins/api-licornsandhaters/ajax.php


This plugin replaces all insults words entered in comments with licorns and others icons.
The analysis is performed from lit of insults words, contained in a file.
This list is stored in the plugin directory (/file/fichier.txt) and it exists also on our web site or on our website 'respectzone.org'.
From the admin panel, you could choose to use the local file in the plugin directory, or the one on our web site.
If you choose our website, the extension will make a call to our webservice each time, in order to use an up-to-date list.
This list contains only french insults with this current version, but the file can be easely updated to suppress or to add words (in French or in another language). 
This service is free, it does'nt require a user code, and there is no tracking about it usage.
The list on our server is here : https://api.respectzone.org/wp-content/plugins/api-licornsandhaters/ajax.php

== Installation ==

1. Téléchargez les fichiers du plugin dans le répertoire `/wp-content/plugins/plugin-name`, ou installez directement le plugin via l'écran des plugins de WordPress.
2. Activez le plugin via l'écran 'Extensions' dans WordPress.
3. Sélectionnez l'option 'RZ Plugin' dans le menu Wordpress et choisissez la source du fichier d'insultes : le fichier local, ou celui de notre site web 'respectzone.org'.

1. Upload the plugin files to the `/wp-content/plugins/plugin-name` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress.
3. Select the 'RZ Plugin' option in the Wordpress menu, and choose the source of the insults file : the local file, or the one from our 'respectzone.org' web site. 

== Frequently Asked Questions ==

= Comment désinstaller l'extension ? =

L'extension n'utilise pas de table SQL. Pour le désinstaller, il suffit de supprimer son répertoire sur le serveur.

= How to uninstall the plugin ? =

The plugin doesn't use any SQL table. To be unisntalled, just suppress its directory on the server.

== Screenshots ==

== Changelog ==

= 1.7 =
* documentation. 
* minor changes.

= 1.0 =
* initial version.
