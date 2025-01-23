<div class="row">
    <div class="col">
        <form action="<?= isset($showing) ? base_url("/admin/showing/update") : base_url("admin/showing/create") ?>" method="post" enctype="multipart/form-data">
        <div class="card">
            <div class="car">
            <div class="card-header d-flex justify-content-between align-salle-center">
                <h4 class="card-title">
                   séance
                </h4>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="release_date" class="form-label">Date de sortie :</label>
                    <!-- Affichage de la date de sortie si définie, sinon champ vide -->
                    <input type="datetime-local" class="form-control" id="date" value="">
                </div>

                <div class="mb-3">
                    <label for="cinema" class="form-label">Cinéma</label>
                    <select
                            class="form-select"
                            id="cinema"
                            name="theater_id"
                            required>
                        <!-- Option "Aucun" si aucune salle n'est assignée à un cinéma -->
                        <option value="" <?= !isset($salle['theater_id']) ? 'selected' : ''; ?>>Aucun</option>
                        <?php foreach ($cinema as $c): ?>
                            <!-- On liste tous les cinémas disponibles et on sélectionne celui associé à la salle -->
                            <option
                                    value="<?= $c['id']; ?>"
                                <?= (isset($salle['theater_id']) && $salle['theater_id'] == $c['id']) ? 'selected' : ''; ?>>
                                <?= htmlspecialchars($c['name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
                <div class="mb-3" >
                    <label for="description" class="form-label">Description</label>
                    <!-- Affichage de la description si définie, sinon champ vide -->
                    <textarea class="form-control" id="description" name="description" placeholder="Entrez une description" rows="5"><?= isset($showing['description']) ? htmlspecialchars($showing['description']) : ""; ?></textarea>
                </div>
    </div>

</div>