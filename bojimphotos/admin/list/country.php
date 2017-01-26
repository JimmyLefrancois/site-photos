<?php
	include_once('../../controllers/listController.php');
	$countries = getAllCountries();
?>

<?php include_once('../../templates/header.html'); ?>

<?php include_once('../../templates/sidebar.html'); ?>

<h1 class="page-header">Gestion des pays</h1>

<a href="../add/country.php" title="Ajouter un pays" class="btn btn-info">Ajouter un nouveau pays</a>

<h2 class="sub-header">Liste des pays</h2>

<div class="table-responsive">
	<table class="table table-striped">
		<thead>
			<tr>
				<th>#</th>
				<th>Nom du pays</th>
				<th>Date de création</th>
				<th>Modifier</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($countries as $key => $country): ?>
				<tr>
					<td><?php echo $key +1; ?></td>
					<td><?php echo $country->name; ?></td>
					<td><?php echo $country->date ?></td>
					<td><a href="../edit.php?id=<?php echo $country->id; ?>" title="Modifier le pays '<?php echo $country->name ?>'">Modifier</a></td>
				</tr>
			<?php endforeach ?>
		</tbody>
	</table>
</div>

<?php include_once('../../templates/footer.html'); ?>
