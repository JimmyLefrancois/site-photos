<?php include_once('../../controllers/countryController.php'); ?>

<?php if (isset($errors)): ?>
	<div class="row bg-danger errors bold">
		<?php foreach ($errors as $error): ?>
			<p class="text-danger"><?php echo $error; ?></p>
		<?php endforeach ?>
	</div>
<?php endif; ?>

<?php if (isset($confirmation) && $confirmation): ?>
	<p class="success">Le pays <?php echo $countryModel->name ?> a bien été ajouté.</p>
<?php endif ?>

<form action="#" method="post">
	<label for="name">Nom du pays</label>
	<input type="text" name="name" id="name" placeholder="Nom du pays" value="<?php if (isset($_POST['name'])) echo $_POST['name']; ?>">

	<input type="submit" value="Ajouter ce pays" name="submit-country">
</form>
