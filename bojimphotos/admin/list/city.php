<?php
    include_once('../../controllers/listController.php');
    $cities = getAllCities();
?>

<?php include_once('../../templates/header.html'); ?>

<?php include_once('../../templates/sidebar.html'); ?>

<h1 class="page-header">Gestion des villes</h1>

<a href="../add/city.php" title="Ajouter une ville" class="btn btn-info">Ajouter une nouvelle ville</a>

<h2 class="sub-header">Liste des ville</h2>

<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Nom de la ville</th>
                <th>Pays rattaché</th>
                <th>Date de création</th>
                <th>Modifier</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cities as $key => $city): ?>
                <tr>
                    <td><?php echo $key +1; ?></td>
                    <td><?php echo $city->name; ?></td>
                    <td><?php echo $city->country; ?></td>
                    <td><?php echo $city->date ?></td>
                    <td><a href="../edit.php?id=<?php echo $city->id; ?>" title="Modifier le pays '<?php echo $city->name ?>'">Modifier</a></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>

<?php include_once('../../templates/footer.html'); ?>
