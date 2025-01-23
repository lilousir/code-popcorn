<div class="row">
    <div class="col">
        <!-- Début du formulaire, l'action dépend si une salle existe (modification) ou non (création) -->
        <form action="<?= isset($salle) ? base_url("/admin/salle/update") : base_url("/admin/salle/create") ?>" method="POST" enctype="multipart/form-data">
            <?php if (isset($salle)): ?>
                <!-- Si une salle existe, on ajoute un champ caché avec l'ID de la salle pour l'édition -->
                <input type="hidden" name="id" value="<?= $salle['id']; ?>">
            <?php endif; ?>
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <!-- Titre de la carte : "Editer salle" si une salle est définie, sinon "Créer une salle" -->
                    <h4 class="card-title">
                        <?= isset($salle) ? "Editer " . $salle['name'] : "Créer une salle" ?>
                    </h4>
                </div>
                <div class="card-body">
                    <!-- Tabs pour séparer les sections du formulaire -->
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="profil-tab" data-bs-toggle="tab" data-bs-target="#profil" type="button" role="tab" aria-controls="profil" aria-selected="true">Salle</button>
                        </li>
                    </ul>

                    <!-- Panneaux de tabulation -->
                    <div class="tab-content border p-3">
                        <div class="tab-pane active" id="profil" role="tabpanel" aria-labelledby="profil-tab" tabindex="0">
                            <!-- Champ pour le nom de la salle -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Salle</label>
                                <input type="text" class="form-control" id="name" placeholder="Nom de la salle" value="<?= isset($salle) ? $salle['name'] : ""; ?>" name="name">
                            </div>

                            <!-- Champ pour la capacité de la salle -->
                            <div class="mb-3">
                                <label for="capacity" class="form-label">Capacité de la salle</label>
                                <input type="text" class="form-control" id="capacity" placeholder="Capacité" value="<?= isset($salle) ? $salle['capacity'] : ""; ?>" name="capacity"  >
                            </div>

                            <!-- Sélection du cinéma auquel la salle appartient -->
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
                    </div>

                    <!-- Un autre onglet (actuellement vide) pourrait être utilisé pour d'autres informations de la salle -->
                    <div class="tab-pane" id="onglet" role="tabpanel" aria-labelledby="onglet-tab" tabindex="0">

                    </div>

                </div>
            </div>

            <div class="card-footer text-end">
                <!-- Bouton pour soumettre le formulaire. Le texte change en fonction de l'action (création ou modification) -->
                <button type="submit" class="btn btn-primary">
                    <?= isset($salle) ? "Sauvegarder" : "Enregistrer" ?>
                </button>
            </div>
    </div>
    </form>
</div>
</div>
