<div class="row">
    <div class="col">
        <form action="<?= isset($utilisateur) ? base_url("/admin/user/update") : base_url("/admin/user/create") ?>" method="POST" enctype="multipart/form-data">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">
                        <?= isset($utilisateur) ? "Editer " . $utilisateur['username'] : "Créer un utilisateur" ?>
                    </h4>
                    <?php
                    if (isset($utilisateur)) {
                    if (isset($utilisateur) && $utilisateur['deleted_at'] == null) { ?>
                        <a title="Désactiver l'utilisateur" href="<?= base_url('admin/user/deactivate/') . $utilisateur['id']; ?>">
                            <i class="fa-solid fa-xl fa-toggle-on text-success"></i>
                        </a>
                    <?php
                    } else { ?>
                        <a title="Activer un utilisateur"href="<?= base_url('admin/user/activate/') . $utilisateur['id']; ?>">
                            <i class="fa-solid fa-toggle-off fa-xl text-danger"></i>
                        </a>
                    <?php
                    }
                    }
                    ?>
                </div>
                <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="profil-tab" data-bs-toggle="tab" data-bs-target="#profil" type="button" role="tab" aria-controls="profil" aria-selected="true">Profil</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="onglet-tab" data-bs-toggle="tab"
                                    data-bs-target="#onglet" type="button" role="tab" aria-controls="onglet"
                                    aria-selected="false">Image</button>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content border p-3">
                        <div class="tab-pane active" id="profil" role="tabpanel" aria-labelledby="profil-tab" tabindex="0">
                            <div class="mb-3">
                                <label for="username" class="form-label">Pseudo</label>
                                <input type="text" class="form-control" id="username" placeholder="username" value="<?= isset($utilisateur) ? $utilisateur['username'] : ""; ?>" name="username">
                            </div>
                            <div class="mb-3">
                                <label for="firstname" class="form-label">Prénom</label>
                                <input type="text" class="form-control" id="firstname" placeholder="firstname" value="<?= isset($utilisateur) ? $utilisateur['firstname'] : ""; ?>" name="firstname">
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Nom</label>
                                <input type="text" class="form-control" id="name" placeholder="name" value="<?= isset($utilisateur) ? $utilisateur['name'] : ""; ?>" name="name">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">E-mail</label>
                                <input type="text" class="form-control" id="email" placeholder="email" value="<?= isset($utilisateur) ? $utilisateur['email'] : "" ?>" name="email" >
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Tel</label>
                                <input type="text" class="form-control" id="phone" placeholder="phone" value="<?= isset($utilisateur) ? $utilisateur['phone'] : "" ?>" name="phone">
                            </div>
                            <div class="mb-3">
                                <label for="dob" class="form-label">Date de naissance</label>
                                <input type="date" class="form-control" id="dob" placeholder="dob" value="<?= isset($movie) ? $movie['dob'] : ""; ?>" name="dob">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Mot de passe</label>
                                <input type="password" class="form-control" id="password" placeholder="password" value="" name="password">
                            </div>
                            <div class="mb-3">
                                <label for="id_permission" class="form-label">Rôle</label>
                                <select class="form-select" id="id_permission" name="id_permission">
                                    <option disabled <?= !isset($utilisateur) ? "selected":""; ?> >Selectionner un role</option>
                                    <?php foreach($permissions as $p): ?>
                                        <option value="<?= $p['id']; ?>" <?= ( isset($utilisateur) && $p['id'] == $utilisateur['id_permission']) ? "selected" : "" ?> >
                                            <?= $p['name']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-3 d-flex align-items-center">
                                <label for="image" class="form-label me-2">Avatar</label>
                                <div id="preview">
                                    <?php
                                    $profileImageUrl = isset($utilisateur['avatar_url']) ? base_url($utilisateur['avatar_url']) : "#";
                                    ?>
                                    <img class="img-thumbnail me-2"alt="Aperçu de l'image"
                                         style="display: <?= isset($utilisateur['avatar_url']) ? "block" : "none" ?>; max-width: 100px;"
                                         src="<?= $profileImageUrl ?>">
                                </div>
                                <input class="form-control" type="file" name="profile_image" id="image">
                            </div>
                        </div>

                        <div class="tab-pane" id="onglet" role="tabpanel" aria-labelledby="onglet-tab" tabindex="0">

                        </div>

                    </div>
                </div>

                <div class="card-footer text-end">
                    <?php if (isset($utilisateur)): ?>
                        <input type="hidden" name="id" value="<?= $utilisateur['id']; ?>">
                    <?php endif; ?>
                    <button type="submit" class="btn btn-primary">
                        <?= isset($utilisateur) ? "Sauvegarder" : "Enregistrer" ?>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>