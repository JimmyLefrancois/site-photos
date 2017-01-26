<?php include_once('../../controllers/countryController.php'); ?>

<?php include_once('../../templates/header.html'); ?>

<?php include_once('../../templates/sidebar.html'); ?>

<h1 class="page-header">Ajout d'un nouveau pays</h1>

<?php if (isset($errors)): ?>
	<div class="row bg-danger errors bold">
		<?php foreach ($errors as $error): ?>
			<p class="text-danger"><?php echo $error; ?></p>
		<?php endforeach ?>
	</div>
<?php endif; ?>

<?php if (isset($confirmation) && $confirmation): ?>
	<fieldset class="success">
		<p class="success">Le pays <?php echo $countryModel->name ?> a bien été ajouté.</p>
		<a href="../list/country.php" title="Retour à la liste des pays" class="btn btn-success">Retour à la liste des pays</a>
	</fieldset>
<?php endif ?>

<form action="#" method="post">
	<label for="name">Nom du pays</label>
	<input type="text" class="form-control" name="name" id="name" placeholder="Nom du pays" value="<?php if (isset($_POST['name'])) echo $_POST['name']; ?>">
	<br />
	<input type="submit" class="btn btn-info pull-right" value="Ajouter ce pays" name="submit-country">
</form>
