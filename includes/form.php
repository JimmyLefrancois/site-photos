<?php include_once('includes/notifications.php'); ?>

<?php if (isset($errors)): ?>
	<div class="row bg-danger errors bold">
		<?php foreach ($errors as $error): ?>
			<p class="text-danger"><?php echo $error; ?></p>
		<?php endforeach ?>
	</div>
<?php endif; ?>

<div class="row form">

	<?php if (isset($mediaErrors, $mediaErrors['extention'])): ?>
		<div class="bg-danger errors bold">
			<p class="text-danger"><?php echo $mediaErrors['extention']; ?></p>
		</div>
	<?php endif; ?>

	<form action="#" method="post" class="form_vente" novalidate enctype="multipart/form-data">
		<div class="col-md-6">
			<!-- TITLE FIELD -->
			<div class="form-group">
				<?php if (isset($errors, $errors['title'])): ?>
					<p class="text-danger"><?php echo $errors['title']; ?></p>
				<?php endif; ?>

				<label for="title">Titre de l'information*</label>
				<input type="text" required name="title" id="title" class="form-control" placeholder="Titre de votre information" value="<?php if (isset($_POST["title"])) echo $_POST["title"] ?>">
			</div>
			<!-- TITLE FIELD -->
		</div>

		<div class="col-md-6">
			<!-- LINK FIELD -->
			<div class="form-group">
				<?php if (isset($errors, $errors['link'])): ?>
					<p class="text-danger"><?php echo $errors['link']; ?></p>
				<?php endif; ?>

				<label for="link">Adresse du site internet si disponible</label>
				<input type="text" name="link" id="link" class="form-control" placeholder="Lien de l'information" value="<?php if (isset($_POST["link"])) echo $_POST["link"] ?>">
			</div>
			<!-- LINK FIELD -->
		</div>

		<div class="col-md-12">
			<!-- DESCRIPTION FIELD -->
			<div class="form-group">
				<?php if (isset($errors, $errors['description'])): ?>
					<p class="text-danger"><?php echo $errors['description']; ?></p>
				<?php endif; ?>

				<label for="description">Description de l'information*</label>
				<textarea class="form-control" rows="3" name="description" id="description"><?php if (isset($_POST["description"])) echo $_POST["description"] ?></textarea>
				<!-- <input type="text" name="description" id="description" class="form-control" placeholder="Description de l'information" value="<?php if (isset($_POST["description"])) echo $_POST["description"] ?>"> -->
			</div>
			<!-- DESCRIPTION FIELD -->
		</div>

		<div class="col-md-12">
			<!-- EMAIL FIELD -->
			<div class="form-group">
				<?php if (isset($errors, $errors['email'])): ?>
					<p class="text-danger"><?php echo $errors['email']; ?></p>
				<?php endif; ?>

				<label for="email">Votre adresse e-mail professionnelle*</label>
				<input type="text" name="email" id="email" required class="form-control" placeholder="Votre adresse e-mail @ca-sudrhonealpes.fr" value="<?php if (isset($_POST["email"])) echo $_POST["email"] ?>">
			</div>
			<!-- EMAIL FIELD -->
		</div>

		<div class="col-md-12">
			<div class="form-group">

				<?php if (isset($mediaErrors, $mediaErrors['extention'])): ?>
					<div class="bg-danger errors bold">
						<p class="text-danger"><?php echo $mediaErrors['extention']; ?></p>
					</div>
				<?php endif; ?>

				<p class="image_label">Vous pouvez envoyer jusqu'à 3 documents. (.jpg, .png, .pdf, .gif, .jpeg)</p>
				<input class="input_file" data-input="0" type="file" name="media[]" id="media">
				<input class="input_file" data-input="1" type="file" name="media[]" id="media">
				<input class="input_file" data-input="2" type="file" name="media[]" id="media">

				<div class="upload_image">
					<button class="button_file" data-file="0">Document N°1</button>
					<div id="thumb-output0"></div>
				</div>

				<div class="upload_image">
					<button class="button_file" data-file="1">Document N°2</button>
					<div id="thumb-output1"></div>
				</div>

				<div class="upload_image">
					<button class="button_file" data-file="2">Document N°3</button>
					<div id="thumb-output2"></div>
				</div>

				<!-- <div id="thumb-output0"></div> -->
				<!-- <div id="thumb-output1"></div> -->
				<!-- <div id="thumb-output2"></div> -->
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<span style="color:#22aebc; float:right; margin-right: 15px;">* Champs obligatoires</span>
				<div class="clearfix"></div>
				<br />
				<div class="text-center">
					<input type="submit" name="submit" value="Partager !" class="btn bgblue submit submit_form" style="font-weight:bold; font-size:1.2em;" />
				</div>
			</div>
		</div>
	</form>
</div>
