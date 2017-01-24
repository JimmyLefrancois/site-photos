<?php
	require __DIR__ . '/../application/autoload.php';
	require __DIR__ . '/../vendor/autoload.php';

	$modelShare = new ShareModel();

	$mailUser = new Mail();
	$mailDig = new Mail();

	// CONFIG EMAIL
	const MAILFROM = "webmaster@ca-sudrhonealpes.fr";
	//const MAILFROM = "jimmylefrancois38@gmail.com";

	if (isset($_POST['submit'])) {

		if (isset($_POST["title"])) $modelShare->title = $_POST["title"];
			else $modelShare->title = NULL;

		if (isset($_POST["description"])) $modelShare->description = $_POST["description"];
			else $modelShare->description = NULL;

		if (isset($_POST["link"])) $modelShare->link = $_POST["link"];
			else $modelShare->link = NULL;

		if (isset($_POST["email"])) {
			$modelShare->email = $_POST["email"];
			$pattern = "#^[\w.-]+@ca-sudrhonealpes+\.fr$#i";
			$checkEmail = preg_match($pattern, $modelShare->email);
			if ($checkEmail == 0) $modelShare->errorFormatEmail = true;
		}else $modelShare->email = NULL;

		if ($modelShare->isValid()) {

			$message = "Bonjour,<br /><br />" . $modelShare->email . " a proposé une information à partager sur nos réseaux sociaux";

			$message .= "<h2>Informations : </h2>";
			$message .= "<ul>";
			$message .= "<li>Titre : " . $modelShare->title . "</li>";
			if ($modelShare->description != NULL) $message .= "<li>Description : " . $modelShare->description . "</li>";
			if ($modelShare->link != NULL) $message .= "<li>Link : " . $modelShare->link . "</li>";
			$message .= "<li>Adresse e-mail : " . $modelShare->email . "</li>";
			$message .= "</ul>";
			$message .= "<br /><p>Au plaisir d'échanger prochainement avec vous prochainement.</p>
			<p style='text-align:left'><img src='https://www.ca-sudrhonealpes.fr/Vitrine/ObjCommun/Fic/SudRhoneAlpes/emailing/2016/gabarit/logo-casra-gabaritUNICA.gif' /></p>";

			$userMessage =
			"
				<table width='600' cellpadding='0' cellspacing='0' align='center' style='width:600px; font-family:Tahoma; font-size:14px; color:black'>
					<tr>
						<td align='right' width='600' style='background-color:#fff;'>
							<img src='IMAGE A REMPLACER' width='600' height='170' alt='Logo e-mail' />
						</td>
					</tr>

					<tr>
						<td colspan='2' bgcolor='#008B92' style='padding:12px; font-size:14px; text-align:center; color:#ffffff;'>
							<b>Confirmation de l'envoi de votre information à partager.</b>
						</td>
					</tr>

					<tr>
						<td colspan='2' style='padding:20px 12px; background-color:#fff; color:black;'>
							<h2>
								Bonjour,
							</h2>

							<p>Nous vous remercions pour le partage de l'information ayant pour titre '" . $modelShare->title . "'.</p>
							<p>Un e-mail vous sera envoyé si nous publions l'information sur un ou plusieurs de nos réseaux sociaux.</p>";

			$userMessage .= "<p style='color:black'>
								A très bientôt sur <a href='https://www.ca-sudrhonealpes.fr/?ctx_emailing=true'>https://www.ca-sudrhonealpes.fr/</a>
								<p style='text-align:left'><img src='https://www.ca-sudrhonealpes.fr/Vitrine/ObjCommun/Fic/SudRhoneAlpes/emailing/2016/gabarit/logo-casra-gabaritUNICA.gif' /></p>
							</p>
						</td>
					</tr>
				</table>";


			//if ($user['email'] == MAIL_AGENCE_HABITAT) $user['email'] = 'wmcasra@gmail.com';
			$mailUser->setDatas('Votre proposition d\'information à partager.', 'Crédit Agricole Sud Rhône Alpes',MAILFROM, $modelShare->email, $userMessage, 'webmaster@ca-sudrhonealpes.fr');

			//if ($now < $dateTeasing || $now > $dateFin) $adrDest_com = 'jimmylefrancois38@gmail.com';
			$mailDig->setDatas('Une nouvelle proposition d\'information a été ajoutée.', 'Crédit Agricole Sud Rhône Alpes', $modelShare->email, MAILFROM, $message, 'webmaster@ca-sudrhonealpes.fr');

			//$mailAEL->setDatas(OFFRENAME . ' - ' . utf8_encode($user['lastname']) . " " . utf8_encode($user['firstname']), 'Crédit Agricole Sud Rhône Alpes', $user['email'], $adrDest_ael, $message, $user, 'webmaster@ca-sudrhonealpes.fr');

			// $info += ['from' => $user['email']];


			//
			//


			$folder = 'uploads/';
			$files = $_FILES['media'];

			$extensions = array('.png', '.gif', '.jpg', '.jpeg', 'JPG', 'JPEG', 'PNG', 'GIF', 'pdf');

			$countMedia = 0;
			$state = [];
			$errorState = [];
			$medias = [];

			// var_dump('test');

			foreach ($files['name'] as $file) {
				if ($file != "") $countMedia++;
			}

			//$count = count($files['name']);

			for ($i=0; $i < $countMedia; $i++) {
				$modelMedia = new MediaModel();
				$filename[$i] = $_FILES['media']['name'][$i];
				$filename[$i] = setFilename($filename[$i]);
				$extension = strrchr($_FILES['media']['name'][$i], '.');
				if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
				{
					$errorExtention = true;
				}

				$modelMedia->path = $filename[$i];

				if ($errorExtention) $modelMedia->errorExtention = true;

				if ($modelMedia->isValid()) {
					$medias[$i] = $modelMedia;
					// if(move_uploaded_file($_FILES['media']['tmp_name'][$i], $folder . $filename)) {
					// 	$state[$i]['upload'] = true;
					// 	$modelMedia->save();
					// } else {
					// 	$state[$i]['upload'] = false;
					// }
					// $confirmation = true;
				} else {
					$errorState[$i]['errorMedia'] = true;
					$mediaErrors = $modelMedia->getErrors();
					// $confirmation = false;
				}
			}

			if (!in_array(true, $errorState)) {
				//var_dump('OK');
				$modelShare->save();
				$shareID = $modelShare->id;

				if (!empty($medias)) {
					foreach ($medias as $index => $media) {
						//var_dump($_FILES['media']['tmp_name'][$index]);
						move_uploaded_file($_FILES['media']['tmp_name'][$index], $folder . $filename[$index]);
						$media->share_id = $shareID;
						//var_dump($media);
						$media->save();
					}
				}
				$confirmation = true;
				$mailUser->sendMail();
				$mailDig->sendMail();
				$_POST = array();
			} else {
				//var_dump('PAS OK');
				$confirmation = false;
			}

			//$confirmation = uploadFile($shareID);



		} else {
			$errors = $modelShare->getErrors();
		}
	}

function uploadFile($shareID)
{
	$modelMedia = new MediaModel();

	$folder = 'uploads/';
	$files = $_FILES['media'];

	$extensions = array('.png', '.gif', '.jpg', '.jpeg', 'JPG', 'JPEG', 'PNG', 'GIF', 'pdf');

	$state = [];

	$count = count($files['name']);

	for ($i=0; $i < $count; $i++) {
		$filename = $_FILES['media']['name'][$i];
		$filename = setFilename($filename);
		$extension = strrchr($_FILES['media']['name'][$i], '.');
		if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
		{
			$errorExtention = true;
		}

		$modelMedia->path = $filename;
		$modelMedia->share_id = $shareID;
		if ($errorExtention) $modelMedia->errorExtention = true;

		if ($modelMedia->isValid()) {
			if(move_uploaded_file($_FILES['media']['tmp_name'][$i], $folder . $filename)) {
				$state[$i]['upload'] = true;
				$modelMedia->save();
			} else {
				$state[$i]['upload'] = false;
			}
			$confirmation = true;
		} else {
			$mediaErrors = $modelMedia->getErrors();
			$confirmation = false;
		}
	}

	return $confirmation;
}

function setFilename($filename)
{
	$rand = substr(md5(microtime()),rand(0,26),10);
	$filenameProcess = strtr($filename, 'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüùýÿ _°¨^$£%*µ;:/!§+=', 'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuuyy-----------------');
	$filename = $rand . "_" . preg_replace('/([^.a-z0-9]+)/i', '-', $filenameProcess);
	return $filename;
}

?>
