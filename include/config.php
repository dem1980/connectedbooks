<?php

	include('include/connexion.php');
	
	// Connexion � la base de donn�es
	try{$bdd = new PDO('mysql:host='.$hote.';dbname='.$base.'', ''.$user.'', ''.$pass.'');}
	catch(Exception $e){die('Erreur : ' . $e->getMessage());}
	
	// Insertion des biblioth�ques
	require_once('include/function.inc.php');
	require_once('class/livre.class.php');
	
	// Pr�f�rences du site
	$q = $bdd->query('SELECT * FROM preferences');
	$pref = $q->fetchAll();
	$site = $pref[1]['value'];
	$nombre = Livre::numberBook($bdd);
	$livres_recents = ($nombre > $pref[2]['value']) ? ($pref[2]['value']) : ($nombre);
	$nombre_livre_mieux_notes = ($nombre > $pref[3]['value']) ? ($pref[3]['value']) : ($nombre);
	$livre_une = $pref[4]['value'];
	$nb = Livre::getFavorite($bdd,100000);
	$favorite_books = ($nb > $pref[5]['value']) ? ($pref[5]['value']) : ($nombre);
	
	// Messages d'erreurs
	$message = array(
		1 => 'Votre r�servation a bien �t� enregistr�e',
		2 => 'Vous �tes maintenant d�connect�',
		3 => 'D�sol�, mais vous ne pouvez pas acc�der � cette page...',
		4 => 'Votre compte est d�sormais cr��',
		5 => 'Le livre a bien �t� enregistr� !',
		6 => 'La modification a bien �t� enregistr�e',
		7 => 'Vous �tes maintenant connect�',
		8 => 'Les mots cl�s ont bien �t� mis � jour !',
		9 => 'Une erreur a �t� rencontr�e... Merci de recommencer',
		10 => 'Le livre a bien �t� supprim� !',
		11 => 'La base de donn�es a correctement �t� vid�e !'
	);
	
	// Affichage des messages d'erreur
	if(!empty($_GET['message']) && $_GET['message'] > 0 && array_key_exists($_GET['message'], $message)){
		echo "<script> $(document).ready(function(){ $.sticky(' ";
		echo $message[$_GET['message']];
		echo "');});</script>";
	}
	
	
?>