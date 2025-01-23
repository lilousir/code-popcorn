<div class="row"> <!-- Début d'une ligne dans une grille Bootstrap -->
    <div class="col-mb3"> <!-- Début d'une colonne (avec un petit espace, mais la classe 'col-mb3' semble incorrecte, probablement 'col-md-3' ou une autre classe valide) -->
        <form action="<?= isset($user) ? base_url("user/update") : base_url("/admin/user/create")?>" method="POST" enctype="multipart/form-data">
            <!-- Formulaire qui envoie les données par POST à l'URL appropriée. Si un utilisateur est défini (modification d'un utilisateur), l'action sera 'update', sinon 'create' pour l'ajout d'un nouvel utilisateur -->
            <div class="card"> <!-- Carte contenant le formulaire -->
                <div class="card-body"> <!-- Corps de la carte -->
                    <ul class="nav nav-tabs" id="myTab" role="tablist"> <!-- Navigation par onglets -->
                        <li class="nav-item" role="presentation"> <!-- Premier onglet pour Profil -->
                            <button class="nav-link active" id="profil-tab" data-bs-toggle="tab" data-bs-target="#profil" type="button" role="tab" aria-controls="profil" aria-selected="true">Profil</button>
                        </li>
                        <li class="nav-item" role="presentation"> <!-- Deuxième onglet pour Image -->
                            <button class="nav-link" id="image-tab" data-bs-toggle="tab" data-bs-target="#image" type="button" role="tab" aria-controls="image" aria-selected="false">Image</button>
                        </li>
                    </ul>
                    <!-- Contenu des onglets -->
                    <div class="tab-content border p-3">
                        <div class="tab-pane active" id="profil" role="tabpanel" aria-labelledby="profil-tab" tabindex="0"> <!-- Contenu de l'onglet Profil -->
                            <!-- Champs du formulaire pour les informations utilisateur -->
                            <div class="mb-3">
                                <label for="username" class="form-label">Pseudo</label>
                                <input type="text" class="form-control" id="username" placeholder="username" value="<?= isset($user) ? htmlspecialchars($user['username']) : ""; ?>" name="username">
                            </div>
                            <div class="mb-3">
                                <label for="firstname" class="form-label">Prénom</label>
                                <input type="text" class="form-control" id="firstname" placeholder="firstname" value="<?= isset($user) ? htmlspecialchars($user['firstname']) : ""; ?>" name="firstname">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" placeholder="email" value="<?= isset($user) ? htmlspecialchars($user['email']) : ""; ?>" name="email">
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Nom</label>
                                <input type="text" class="form-control" id="name" placeholder="name" value="<?= isset($user) ? htmlspecialchars($user['name']) : ""; ?>" name="name">
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Tel</label>
                                <input type="text" class="form-control" id="phone" placeholder="phone" value="<?= isset($user) ? htmlspecialchars($user['phone']) : ""; ?>" name="phone">
                            </div>
                            <div class="mb-3">
                                <label for="dob" class="form-label">Date de naissance</label>
                                <input type="date" class="form-control" id="dob" placeholder="dob" value="<?= isset($user) ? htmlspecialchars($user['dob']) : ""; ?>" name="dob">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Mot de passe</label>
                                <input type="password" class="form-control" id="password" placeholder="password" value="" name="password">
                            </div>
                        </div>
                    </div>
                    <div class="tab-content border p-3">
                        <div class="tab-pane" id="image" role="tabpanel" aria-labelledby="image-tab" tabindex="0"> <!-- Contenu de l'onglet Image -->
                            <div class="mb-3 d-flex align-items-center">
                                <label for="image" class="form-label me-2">Avatar</label>
                                <div id="preview"> <!-- Conteneur pour afficher l'image d'avatar prévisualisée -->
                                    <?php
                                    $profileImageUrl = isset($user['avatar_url']) ? base_url($user['avatar_url']) : "#";
                                    ?> <!-- Si l'URL de l'avatar existe, l'image sera affichée, sinon on utilise un # -->
                                    <img class="img-thumbnail me-2" alt="Aperçu de l'image" style="display: <?= isset($user['avatar_url']) ? "block" : "none" ?>; max-width: 100px;" src="<?= htmlspecialchars($profileImageUrl) ?>"> <!-- Affichage de l'image d'avatar, avec prévisualisation si disponible -->
                                </div>
                                <input class="form-control" type="file" name="profile_image" id="image"> <!-- Champ de téléchargement d'image pour l'avatar -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-end"> <!-- Pied de la carte contenant le bouton d'enregistrement -->
                    <?php if (isset($user)): ?> <!-- Si l'utilisateur est défini, un champ caché pour l'ID de l'utilisateur est ajouté -->
                        <input type="hidden" name="id" value="<?= htmlspecialchars($user['id']); ?>">
                    <?php endif; ?>
                    <button type="submit" class="btn btn-primary">
                        <?= isset($user) ? "Sauvegarder" : "Enregistrer" ?> <!-- Le texte du bouton change selon que l'utilisateur existe ou non -->
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
