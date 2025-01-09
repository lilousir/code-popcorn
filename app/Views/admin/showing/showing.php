<div class="row">
    <div class="col">
        <form action="<?= base_url('admin/showing/create'); ?>" method="POST">

        <div class="card">
                <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="profil-tab" data-bs-toggle="tab" data-bs-target="#profil" type="button" role="tab" aria-controls="profil" aria-selected="true">Séance</button>
                        </li>
                    </ul>

                    <!-- Tab panes -->

                    <div class="tab-content border p-3">
                        <div class="tab-pane active" id="profil" role="tabpanel" aria-labelledby="profil-tab" tabindex="0">
                            <div class="mb-3">
                                <label for="cinema" class="form-label">Film</label>
                                <select class="form-select" id="movie" name="movie_id" required>
                                    <option value="">-- Sélectionnez un film --</option>
                                    <?php foreach ($movies as $movie): ?>
                                        <option value="<?= htmlspecialchars($movie['id']) ?>">
                                            <?= htmlspecialchars($movie['title']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="date" class="form-label">Date de sortie :</label>
                                <input type="date" class="form-control" id="date" placeholder="date" value="" name="date">
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea
                                        class="form-control"
                                        id="description"
                                        name="description"
                                        placeholder="Entrez une description"
                                        rows="5"></textarea>
                            </div>
                            <div>
                                <label for="version" class="form-label">Version du film</label>
                                <select class="form-select" name="version">
                                    <option value="none" selected>Aucun</option>
                                    <option value="vf">vf</option>
                                    <option value="vostfr">vostfr</option>
                                    <option value="audiodescription">audiodescription</option>
                                    <option value="vfstfr">vfstfr</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="rating" class="form-label">Pegi</label>

                                <select class="form-select" name="rating">
                                    <option value="none" selected>Aucun</option>
                                    <option value="Tous publics">Tous publics</option>
                                    <option value="-12">-12</option>
                                    <option value="-16">-16</option>
                                    <option value="-18">-18</option>
                                </select>


                            </div>
                            <div class="mb-3">
                                <label for="cinema" class="form-label">Cinéma</label>
                                <select class="form-select" name="theater_id" id="theater_id">
                                    <option value="">Aucun Cinéma Sélectionné</option>
                                    <?php foreach($theaters as $t){ ?>
                                        <option value="<?= $t['id']; ?>" <?= isset($theater) && $theater['id']==$t['id'] ? "selected" : ""; ?>><?= $t['name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="type-showing" class="form-label">Cinéma</label>
                                <select class="form-select" name="theater_id" id="theater_id">
                                    <option value="">Aucun Cinéma Sélectionné</option>
                                    <?php foreach($theaters as $t){ ?>
                                        <option value="<?= $t['id']; ?>" <?= isset($theater) && $theater['id']==$t['id'] ? "selected" : ""; ?>><?= $t['name']; ?></option>
                                    <?php } ?>
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
                    <?= isset($showing) ? "Sauvegarder" : "Enregistrer" ?>
                </button>
            </div>
    </div>
    </form>
</div>
</div>
