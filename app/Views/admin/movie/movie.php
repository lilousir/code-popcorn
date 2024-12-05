<div class="row">
    <div class="col">
        <form action="<?= isset($movie) ? base_url("/admin/movie/update") : base_url("/admin/movie/create") ?>" method="POST" enctype="multipart/form-data">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-salle-center">
                    <h4 class="card-title">
                        <?= isset($movie) ? "Editer " . $movie['title'] : "Créer un film" ?>
                    </h4>
                </div>
                <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="profil-tab" data-bs-toggle="tab" data-bs-target="#profil" type="button" role="tab" aria-controls="profil" aria-selected="true">Film</button>
                        </li>
                    </ul>

                    <!-- Tab panes -->

                    <div class="tab-content border p-3">
                        <div class="tab-pane active" id="profil" role="tabpanel" aria-labelledby="profil-tab" tabindex="0">
                            <div class="mb-3">
                                <label for="name" class="form-label">Titre du film</label>
                                <input type="text" class="form-control" id="title" placeholder="title" value="<?= isset($movie) ? $movie['title'] : ""; ?>" name="title">
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea
                                        class="form-control"
                                        id="description"
                                        name="description"
                                        placeholder="Entrez une description"
                                        rows="5"><?= isset($movie['description']) ? htmlspecialchars($movie['description']) : ""; ?></textarea>
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
                             <select class="form-select" name="rating">
                                 <option value="none" selected>Aucun</option>
                                 <option value="1">Tous public</option>
                                 <option value="2">-16</option>
                                 <option value="3">-12</option>
                                 <option value="3">-18</option>
                             </select>


                         </div>
                            <div class="mb-3 d-flex align-items-center">
                                <label for="image" class="form-label me-2">Affiche</label>
                                <div id="preview">
                                    <?php
                                    $profileImageUrl = isset($movie['affiche_url']) ? base_url($movie['affiche_url']) : "#";
                                    ?>
                                    <img class="img-thumbnail me-2"alt="Aperçu de l'image"
                                         style="display: <?= isset($movie['affiche_url']) ? "block" : "none" ?>; max-width: 100px;"
                                         src="<?= $profileImageUrl ?>">
                                </div>

                                <input class="form-control" type="file" name="affiche_image" id="image">
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane" id="onglet" role="tabpanel" aria-labelledby="onglet-tab" tabindex="0">

                    </div>

                </div>
            </div>

            <div class="card-footer text-end">
                <?php if (isset($movie)): ?>
                    <input type="hidden" name="id" value="<?= $movie['id']; ?>">
                <?php endif; ?>
                <button type="submit" class="btn btn-primary">
                    <?= isset($movie) ? "Sauvegarder" : "Enregistrer" ?>
                </button>
            </div>
        </form>
    </div>

</div>

