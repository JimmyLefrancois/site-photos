<?php include_once('../../controllers/albumController.php'); ?>

<?php include_once('../../templates/header.html'); ?>

<?php include_once('../../templates/sidebar.html'); ?>

<h1 class="page-header">Création d'un nouvel album</h1>

<?php if (isset($errors)): ?>
	<div class="row bg-danger errors bold">
		<?php foreach ($errors as $error): ?>
			<p class="text-danger"><?php echo $error; ?></p>
		<?php endforeach ?>
	</div>
<?php endif; ?>

<?php if (isset($confirmation) && $confirmation): ?>
	<fieldset class="success">
		<p class="success">L'album <?php echo $albumModel->name ?> a bien été crée.</p>
		<a href="../list/album.php" title="Retour à la liste des albums" class="btn btn-success">Retour à la liste des albums</a>
	</fieldset>
<?php endif ?>

<fieldset>
	<legend>Créer un nouvel album</legend>
	<form action="#" method="post">
		<label for="name">Nom de l'album</label>
		<input type="text" class="form-control" name="name" id="name" placeholder="Nom de l'album" value="<?php if (isset($_POST['name'])) echo $_POST['name']; ?>">
		<br />
		<input type="submit" class="btn btn-info pull-right" value="Créer l'album" name="submit-album">
	</form>
</fieldset>
