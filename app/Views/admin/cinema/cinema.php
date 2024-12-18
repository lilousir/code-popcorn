<div class="row">
    <div class="col">
        <form action="<?= isset($cinema) ? base_url("/admin/cinema/update") : base_url("/admin/cinema/create") ?>" method="POST" enctype="multipart/form-data">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">
                        <?= isset($cinema) ? "Editer " . $cinema['name'] : "Créer un cinema" ?>
                    </h4>
                </div>
                <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="profil-tab" data-bs-toggle="tab" data-bs-target="#profil" type="button" role="tab" aria-controls="profil" aria-selected="true">Cinéma</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="onglet-tab" data-bs-toggle="tab"
                                    data-bs-target="#onglet" type="button" role="tab" aria-controls="onglet"
                                    aria-selected="false">ONGLET</button>
                        </li>
                    </ul>

                    <!-- Tab panes -->

                    <div class="tab-content border p-3">
                        <div class="tab-pane active" id="profil" role="tabpanel" aria-labelledby="profil-tab" tabindex="0">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nom du cinema</label>
                                <input type="text" class="form-control" id="name" placeholder="name" value="<?= isset($cinema) ? $cinema['name'] : ""; ?>" name="name">
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control" id="address" placeholder="address" value="<?= isset($cinema) ? $cinema['address'] : ""; ?>" name="address">
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Tel</label>
                                <input type="text" class="form-control" id="phone" placeholder="phone" value="<?= isset($cinema) ? $cinema['phone'] : ""; ?>" name="phone"  >
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">email</label>
                                <input type="email" class="form-control" id="email" placeholder="email" value="<?= isset($cinema) ? $cinema['email'] : ""; ?>" name="email">
                            </div>
                            <div>
                            <label for="city" class="form-label">City</label>
                            <select id="search-city-head" class="form-control me-2"  name="id_city">ville</select>
                        </div>


                            <div class="mb-3 d-flex align-items-center">
                                <label for="image" class="form-label me-2">Image du cinéma</label>
                                <div id="preview">
                                    <?php
                                    $profileImageUrl = isset($cinema['photo_url']) ? base_url($cinema['photo_url']) : "#";
                                    ?>
                                    <img class="img-thumbnail me-2" alt="Aperçu de l'image"
                                         style="display: <?= isset($cinema['photo_url']) ? "block" : "none" ?>; max-width: 100px;"
                                         src="<?= $profileImageUrl ?>">
                                </div>
                                <input class="form-control" type="file" name="photo_image" id="image">
                            </div>
                        </div>
                        <div class="tab-pane" id="onglet" role="tabpanel" aria-labelledby="onglet-tab" tabindex="0">

                        </div>

                    </div>
                </div>

                <div class="card-footer text-end">
                    <?php if (isset($cinema)): ?>
                        <input type="hidden" name="id" value="<?= $cinema['id']; ?>">
                    <?php endif; ?>
                    <button type="submit" class="btn btn-primary">
                        <?= isset($cinema) ? "Sauvegarder" : "Enregistrer" ?>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
