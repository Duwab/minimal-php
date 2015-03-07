/*
 * jQuery File Upload Plugin PHP Class 8.3.2
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2010, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/MIT
 */
 
 
 Configuration:
 $CONF['files_path'] : dossier protégé où sont enregistrés les fichiers
 require("utils/upload/Files.php") pour inclure la classe Files qui permet la manipulation des fichiers dans le dossier $CONF['files_path'], afficher le formulaire d'upload, streamer
 route: /upload vers utils/upload/upload.php  pour uploader / supprimer des fichiers (voir s'il n'y a pas d'éventuelles autres fonctionnalités indésirées actives)
 
 
 lien pour télécharger: <a href="/file/austin.mp3" title="austin.mp3" download="austin.mp3">austin.mp3</a>
 lien pour streamer : <a href="/file/austin.mp3" title="austin.mp3" target="_blank">austin.mp3</a>
 
 
 