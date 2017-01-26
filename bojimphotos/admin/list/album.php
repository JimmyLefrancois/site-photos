<?php
	include_once('../../controllers/listController.php');
	$albums = getAllAlbums();
?>

<?php include_once('../../templates/header.html'); ?>

<?php include_once('../../templates/sidebar.html'); ?>

<h1 class="page-header">Gestion des albums</h1>

<a href="../add/album.php" title="Créer un album" class="btn btn-info">Créer un nouvel album</a>

<h2 class="sub-header">Liste des albums</h2>

<div class="table-responsive">
	<table class="table table-striped">
		<thead>
			<tr>
				<th>#</th>
				<th>Nom de l'album</th>
				<th>Date de création</th>
				<th>Modifier</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($albums as $key => $album): ?>
				<tr>
					<td><?php echo $key +1; ?></td>
					<td><?php echo $album->name; ?></td>
					<td><?php echo $album->date ?></td>
					<td><a href="../edit.php?id=<?php echo $album->id; ?>" title="Modifier le pays '<?php echo $album->name ?>'">Modifier</a></td>
				</tr>
			<?php endforeach ?>
		</tbody>
	</table>
</div>

<?php include_once('../../templates/footer.html'); ?>
