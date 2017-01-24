<?php include_once('../../controllers/cityController.php'); ?>

<?php if (isset($errors)): ?>
	<div class="row bg-danger errors bold">
		<?php foreach ($errors as $error): ?>
			<p class="text-danger"><?php echo $error; ?></p>
		<?php endforeach ?>
	</div>
<?php endif; ?>

<?php if (isset($confirmation) && $confirmation): ?>
	<p class="success">La ville <?php echo $cityModel->name ?> a bien été ajoutée.</p>
<?php endif ?>

<form action="#" method="post">

	<label for="country">
		<select name="country" id="country">
			<option value="0">Séléctionnez un pays</option>
			<?php foreach ($countries as $index => $country): ?>
				<option value="<?php echo $country->id ?>"><?php echo $country->name ?></option>
			<?php endforeach ?>
		</select>
	</label>

	<label for="name">Nom de la ville</label>
	<input type="text" name="name" id="name" placeholder="Nom de la ville" value="<?php if (isset($_POST['name'])) echo $_POST['name']; ?>">

	<input type="submit" value="Créer l'album" name="submit-city">
</form>
