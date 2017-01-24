<?php include_once('../../controllers/photoController.php'); ?>
<?php include_once('../../templates/header.html') ?>

<?php if (isset($errors)): ?>
	<div class="row bg-danger errors bold">
		<?php foreach ($errors as $error): ?>
			<p class="text-danger"><?php echo $error; ?></p>
		<?php endforeach ?>
	</div>
<?php endif; ?>

<!-- <?php if (!$number && !isset($_POST['submit-post'])): ?>
	<form action="#" method="post">
		<label for="number">
			<input type="number" placeholder="Combien de photos voulez-vous ajouter" name="number" id="number">
		</label>
		<input type="submit" value="Valider" name="submit-number">
	</form>
<?php else: ?> -->

	<div class="row">
		<div class="col-md-12">
			<form action="#" method="post" class="form" enctype="multipart/form-data">
				<?php $i = 0;?>

				<label for="album">
					<select name="album" id="album">
						<option value="0">Séléctionnez un album</option>
						<?php foreach ($albums as $index => $album): ?>
							<option value="<?php echo $album->id ?>"><?php echo $album->name ?></option>
						<?php endforeach ?>
					</select>
				</label>

				<label for="category">
					<select name="category" id="category">
						<option value="0">Séléctionnez une catégorie</option>
						<?php foreach ($categories as $index => $category): ?>
							<option value="<?php echo $category->id ?>"><?php echo $category->name ?></option>
						<?php endforeach ?>
					</select>
				</label>

				<label for="country">
					<select name="country" id="country">
						<option value="0">Séléctionnez un pays</option>
						<?php foreach ($countries as $index => $country): ?>
							<option value="<?php echo $country->id ?>"><?php echo $country->name ?></option>
						<?php endforeach ?>
					</select>
				</label>

				<label for="city">
					<select name="city" id="city">
						<option value="0">Séléctionnez une ville</option>
						<?php foreach ($cities as $index => $city): ?>
							<option value="<?php echo $city->id ?>"><?php echo $city->name ?></option>
						<?php endforeach ?>
					</select>
				</label>


				<?php while ($i < $number ): ?>
					<div class="photo_container col-md-3">
						<div class="form-group">
							<input type="file" name="photos[]" data-input="<?php echo $i ?>" class="input_file hidden">
							<button class="button_file" data-file="<?php echo $i ?>">Ajouter une photo</button>
						</div>
					</div>

					<div class="col-md-9">
						<div class="form-group">
							<label>Titre de votre photo
								<input type="text" class="form-control" name="name[]" placeholder="Titre" value="<?php if(isset($_POST['name'])) echo $_POST['name']; ?>">
							</label>
						</div>

						<div class="form-group">
							<label>Description de votre photo
								<input type="text" class="form-control" name="description[]" placeholder="Description de votre photo" value="<?php if(isset($_POST['description'])) echo $description; ?>">
							</label>
						</div>
					</div>

					<?php $i++; ?>
				<?php endwhile ?>
				<input type="submit" value="Valider" name="submit-post">
			</form>
		</div>
	</div>


<!-- <?php endif ?>

 -->
<?php include_once('../../templates/footer.html') ?>
<!-- <form action="#" method="post">
	<label for="name">Nom de l'album</label>
	<input type="text" name="name" id="name" placeholder="Nom de l'album" value="<?php if (isset($_POST['name'])) echo $_POST['name']; ?>">

	<input type="submit" value="Créer l'album" name="submit-album">
</form> -->
