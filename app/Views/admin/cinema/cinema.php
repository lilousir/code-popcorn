<div class="row">
    <!-- Formulaire pour créer ou éditer un cinéma -->
    <div class="col">
        <form action="<?= isset($cinema) ? base_url("/admin/cinema/update") : base_url("/admin/cinema/create") ?>" method="POST" enctype="multipart/form-data">
            <div class="card">
                <!-- En-tête de la carte avec le titre -->
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">
                        <?= isset($cinema) ? "Editer " . $cinema['name'] : "Créer un cinéma" ?>
                    </h4>
                </div>
                <div class="card-body">
                    <!-- Navigation pour les onglets -->
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <!-- Onglet "Cinéma" -->
                            <button class="nav-link active" id="profil-tab" data-bs-toggle="tab" data-bs-target="#profil" type="button" role="tab" aria-controls="profil" aria-selected="true">Cinéma</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <!-- Onglet "ONGLET" (vide pour l'instant) -->
                            <button class="nav-link" id="onglet-tab" data-bs-toggle="tab"
                                    data-bs-target="#onglet" type="button" role="tab" aria-controls="onglet"
                                    aria-selected="false">ONGLET</button>
                        </li>
                    </ul>

                    <!-- Contenu des onglets -->
                    <div class="tab-content border p-3">
                        <!-- Contenu de l'onglet "Cinéma" -->
                        <div class="tab-pane active" id="profil" role="tabpanel" aria-labelledby="profil-tab" tabindex="0">
                            <!-- Champ pour le nom du cinéma -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Nom du cinéma</label>
                                <input type="text" class="form-control" id="name" placeholder="Nom" value="<?= isset($cinema) ? $cinema['name'] : ""; ?>" name="name">
                            </div>
                            <!-- Champ pour l'adresse -->
                            <div class="mb-3">
                                <label for="address" class="form-label">Adresse</label>
                                <input type="text" class="form-control" id="address" placeholder="Adresse" value="<?= isset($cinema) ? $cinema['address'] : ""; ?>" name="address">
                            </div>
                            <!-- Champ pour le téléphone -->
                            <div class="mb-3">
                                <label for="phone" class="form-label">Téléphone</label>
                                <input type="text" class="form-control" id="phone" placeholder="Téléphone" value="<?= isset($cinema) ? $cinema['phone'] : ""; ?>" name="phone"  >
                            </div>
                            <!-- Champ pour l'email -->
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" placeholder="Email" value="<?= isset($cinema) ? $cinema['email'] : ""; ?>" name="email">
                            </div>
                            <!-- Sélecteur pour la ville -->
                            <div>
                                <label for="city" class="form-label">Ville</label>
                                <select id="search-city-head" class="form-control me-2" name="id_city">
                                    <!-- Remplir dynamiquement avec des villes -->
                                    ville
                                </select>
                            </div>
                            <!-- Champ pour l'image -->
                            <div class="mb-3 d-flex align-items-center">
                                <label for="image" class="form-label me-2">Image du cinéma</label>
                                <div id="preview">
                                    <?php
                                    // Prévisualisation de l'image si elle existe
                                    $profileImageUrl = isset($cinema['photo_url']) ? base_url($cinema['photo_url']) : "#";
                                    ?>
                                    <img class="img-thumbnail me-2" alt="Aperçu de l'image"
                                         style="display: <?= isset($cinema['photo_url']) ? "block" : "none" ?>; max-width: 100px;"
                                         src="<?= $profileImageUrl ?>">
                                </div>
                                <input class="form-control" type="file" name="photo_image" id="image">
                            </div>
                        </div>
                        <!-- Contenu de l'onglet "ONGLET" (vide pour l'instant) -->
                        <div class="tab-pane" id="onglet" role="tabpanel" aria-labelledby="onglet-tab" tabindex="0">

                        </div>
                    </div>
                </div>

                <!-- Pied de page de la carte -->
                <div class="card-footer text-end">
                    <!-- Champ caché pour l'ID (utilisé en mode édition) -->
                    <?php if (isset($cinema)): ?>
                        <input type="hidden" name="id" value="<?= $cinema['id']; ?>">
                    <?php endif; ?>
                    <!-- Bouton de validation -->
                    <button type="submit" class="btn btn-primary">
                        <?= isset($cinema) ? "Sauvegarder" : "Enregistrer" ?>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
