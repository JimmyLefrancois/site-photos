<?php include_once('../../controllers/albumController.php'); ?>

<?php if (isset($errors)): ?>
	<div class="row bg-danger errors bold">
		<?php foreach ($errors as $error): ?>
			<p class="text-danger"><?php echo $error; ?></p>
		<?php endforeach ?>
	</div>
<?php endif; ?>

<?php if (isset($confirmation) && $confirmation): ?>
	<p class="success">L'album <?php echo $albumModel->name ?> a bien été crée.</p>
<?php endif ?>

<form action="#" method="post">
	<label for="name">Nom de l'album</label>
	<input type="text" name="name" id="name" placeholder="Nom de l'album" value="<?php if (isset($_POST['name'])) echo $_POST['name']; ?>">

	<input type="submit" value="Créer l'album" name="submit-album">
</form>
