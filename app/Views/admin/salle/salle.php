<div class="row">
    <div class="col">
        <form action="<?= isset($salle) ? base_url("/admin/salle/update") : base_url("/admin/salle/create") ?>" method="POST" enctype="multipart/form-data">
            <?php if (isset($salle)): ?>
                <input type="hidden" name="id" value="<?= $salle['id']; ?>">
            <?php endif; ?>
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">
                        <?= isset($salle) ? "Editer " . $salle['name'] : "Créer une salle" ?>
                    </h4>
                </div>
                <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="profil-tab" data-bs-toggle="tab" data-bs-target="#profil" type="button" role="tab" aria-controls="profil" aria-selected="true">Salle</button>
                        </li>
                    </ul>

                    <!-- Tab panes -->

                    <div class="tab-content border p-3">
                        <div class="tab-pane active" id="profil" role="tabpanel" aria-labelledby="profil-tab" tabindex="0">
                            <div class="mb-3">
                                <label for="name" class="form-label">salle</label>
                                <input type="text" class="form-control" id="name" placeholder="name" value="<?= isset($salle) ? $salle['name'] : ""; ?>" name="name">
                            </div>
                            <div class="mb-3">
                                <label for="capacity" class="form-label">Capacité de la salle</label>
                                <input type="text" class="form-control" id="capacity" placeholder="capacité" value="<?= isset($salle) ? $salle['capacity'] : ""; ?>" name="capacity"  >
                            </div>
                            <div class="mb-3">
                                <label for="cinema" class="form-label">Cinéma</label>
                                <select
                                        class="form-select"
                                        id="cinema"
                                        name="theater_id"
                                        required>
                                    <option value="" <?= !isset($salle['theater_id']) ? 'selected' : ''; ?>>Aucun</option>
                                    <?php foreach ($cinema as $c): ?>
                                        <option
                                                value="<?= $c['id']; ?>"
                                            <?= (isset($salle['theater_id']) && $salle['theater_id'] == $c['id']) ? 'selected' : ''; ?>>
                                            <?= htmlspecialchars($c['name']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                        </div>
                    </div>

                    <div class="tab-pane" id="onglet" role="tabpanel" aria-labelledby="onglet-tab" tabindex="0">

                    </div>

                </div>
            </div>

            <div class="card-footer text-end">

                <button type="submit" class="btn btn-primary">
                    <?= isset($salle) ? "Sauvegarder" : "Enregistrer" ?>
                </button>
            </div>
         </div>
     </form>
    </div>
</div>
