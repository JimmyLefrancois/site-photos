<?php
	include_once('../../controllers/listController.php');
	$photos = getAllPhotos();
?>

<?php include_once('../../templates/header.html'); ?>

<?php include_once('../../templates/sidebar.html'); ?>

<h1 class="page-header">Gestion des photos</h1>

<a href="../add/photo.php" title="Ajouter de nouvelles photos" class="btn btn-info">Ajouter de nouvelles photos</a>

<h2 class="sub-header">Liste des photos</h2>

<div class="table-responsive">
	<table class="table table-striped">
		<thead>
			<tr>
				<th>#</th>
				<th>Nom de la photo</th>
				<th>Description de la photo</th>
				<th>Album de la photo</th>
				<th>Pays de la photo</th>
				<th>Ville de la photo</th>
				<th>Categorie de la photo</th>
				<th>EXIF</th>
				<th>Date d'ajout</th>
				<!--<th>Modifier</th>-->
			</tr>
		</thead>
		<tbody>
			<?php foreach ($photos as $key => $photo): ?>
				<?php
					if ($photo->aperture != NULL) $exif .= "<p>Ouverture : " . $photo->aperture . "</p>";
					if ($photo->focal_length != NULL) $exif .= "<p>Focale : " . $photo->focal_length . "</p>";
					if ($photo->exposure_time != NULL) $exif .= "<p>Vitesse : " . $photo->exposure_time . "</p>";
					if ($photo->iso != NULL) $exif .= "<p>ISO : " . $photo->iso . "</p>";

					if (isset($exif) && $exif == "" || !isset($exif)) $exif = NULL;
				?>

				<tr>
					<td><?php echo $key +1; ?></td>
					<td><?php echo $photo->name; ?></td>
					<td><?php echo $photo->description; ?></td>
					<td><?php echo $photo->album ?></td>
					<td><?php echo $photo->country; ?></td>
					<td><?php echo $photo->city; ?></td>
					<td><?php echo $photo->category ?></td>
					<?php if ($exif): ?>
						<td>
							<button type="button" class="btn btn-lg btn-success" data-toggle="popover" title="EXIF :" data-content="<?php echo $exif; ?>">Voir</button>
						</td>
					<?php else: ?>
						<td>Aucun</td>
					<?php endif ?>
					<!-- <td><?php echo $photo->date ?></td> -->
					<td><?php echo $photo->date ?></td>
					<!--<td><a href="../edit.php?id=<?php echo $city->id; ?>" title="Modifier le pays '<?php echo $city->name ?>'">Modifier</a></td>-->
				</tr>
			<?php endforeach ?>
		</tbody>
	</table>
</div>

<?php include_once('../../templates/footer.html'); ?>
