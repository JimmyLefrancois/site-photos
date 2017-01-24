<?php include_once(__DIR__.'/../controllers/periodController.php'); ?>
<?php include_once(__DIR__.'/../controllers/venteController.php'); ?>

<p>
	<b>Pour un emprunteur âgé de moins de 36 ans :</b>
</p>
<p>
	Le coût de l'assurance obligatoire est de 8,74 €/mois pour un assuré de moins de 36 ans. Elle est incluse à l'échéance de remboursement du crédit.<br/>
	Le montant total dû par l'emprunteur au titre de l'assurance sur la durée totale du prêt sera de 1 573,20 € pour un Taux Annuel Effectif de l’Assurance (TAEA) de 0,40 %.
</p>


<p>
	Dans le cas où le prêt immobilier Vente Privée de 50 000 € sur une durée de 180 mois est assorti d’une garantie CAMCA d’un montant de 750 €, le TEG annuel fixe, Assurance Décès Invalidité comprise, sera de 1,99 %.
</p>

<p>
	Offre limitée à une réservation par foyer (foyer = personnes résidant à la même adresse).
</p>


<p>
	Offre valable à compter du
	<?php echo str_replace($english_days, $french_days, str_replace($english_months, $french_months, $dateTeasing->format('l d F Y')) . ' à ' . $dateTeasing->format('H\hi')); ?>
	et jusqu'à épuisement du stock de 1000 crédits immobiliers (ou au plus tard le
	<?php echo str_replace($english_days, $french_days, str_replace($english_months, $french_months, $dateFin->format('l d F Y')) . ' à ' . $dateFin->format('H\hi')); ?>),
	à réserver exclusivement sur Internet, non cumulable avec les promotions en cours, limitée à une réservation de crédit par client et par projet. Sous réserve d’acceptation de votre dossier par le Crédit Agricole Sud Rhône Alpes, prêteur. Vous disposez d’un délai de réflexion de 10 jours pour accepter l’offre de prêt. La réalisation de la vente est subordonnée à l’obtention du prêt. Si celui-ci n'est pas obtenu, le vendeur doit vous rembourser les sommes versées.
</p>

<p>
	La CAISSE REGIONALE DE CREDIT AGRICOLE MUTUEL SUD RHONE ALPES, Société Coopérative à capital variable, agréée en tant qu’établissement de crédit, Numéro unique d'identification des entreprises 402.121.958 R.C.S Grenoble – code APE 6419Z - Société de Courtage d'assurance immatriculée au Registre des Intermédiaires en Assurance sous le n°07 023 476, dont le siège social est à 15-17 Rue Paul Claudel – BP 67 - 38041 GRENOBLE Cedex 9.
</p>



<!-- <p>
	Modalités d'exercice de vos droits :
	En application des articles 38 et suivants de la loi Informatique et Libertés du 6 janvier 1978 modifiée, l'Utilisateur dispose d'un droit d'accès, de rectification, de modification, de suppression, d'opposition au traitement de ces données à caractère personnel et à recevoir des messages à caractère commercial. Ce droit peut s'exercer en écrivant par lettre simple à l'adresse suivante : Caisse régionale de Crédit Agricole Mutuel Sud Rhône Alpes - Service Réclamations - 15-17 rue Paul Claudel, 38 041 GRENOBLE CEDEX 9. Les frais de timbre seront remboursés sur simple demande écrite.
</p> -->
