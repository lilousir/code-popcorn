prout
<div class="row">
    <div class="col">
        <form action="<?= isset($movie) ? base_url("/admin/movie/update") : base_url("/admin/movie/create") ?>" method="POST" enctype="multipart/form-data">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">
                        <?= isset($movie) ? "Editer " . $movie['name'] : "Créer un film" ?>
                    </h4>
                </div>
                <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="profil-tab" data-bs-toggle="tab" data-bs-target="#profil" type="button" role="tab" aria-controls="profil" aria-selected="true">Film</button>
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
                                <label for="name" class="form-label">Titre du film</label>
                                <input type="text" class="form-control" id="title" placeholder="title" value="<?= isset($movie) ? $movie['titre'] : ""; ?>" name="title">
                            </div>
                            <div class="mb-3">
                                <label for="release_date" class="form-label">Date de sortie</label>
                                <input type="date" class="form-control" id="release_date" placeholder="release_date" value="<?= isset($movie) ? $movie['release_date'] : ""; ?>" name="release_date">
                            </div>
                            <div class="mb-3">
                                <label for="duration" class="form-label">Durée du film</label>
                                <input type="text" class="form-control" id="duration" placeholder="durée" value="<?= isset($movie) ? $movie['duration'] : ""; ?>" name="duration"  >
                            </div>
                            <div class="mb-3">
                                <label for="rating" class="form-label">Pegi</label>
                                <input type="text" class="form-control" id="rating" placeholder="pegi" value="" name="email">
                                <select class="form-select" name="rating">
                                    <option value="none" selected>Aucun</option>
                                        <option value="<?= $rating['id']; ?>">
                                            <?= $rating['name']; ?>
                                        </option>
                                </select>
                            </div>
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
