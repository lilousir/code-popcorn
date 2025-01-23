<div class="row">
    <div class="col">
        <!-- Vérifie si le film est défini et non nul -->
        <?php if (isset($movie) && $movie != null): ?>
            <div class="card">
                <!-- En-tête de la carte avec le titre du film -->
                <div class="card-header d-flex justify-content-center align-items-center text-center text-dark">
                    <!-- Affichage du titre du film avec une taille de police de 35px -->
                    <p><strong style="font-size: 35px;"><?php
                            echo $movie['title'] ? $movie['title'] : "-";  // Si le titre existe, l'afficher, sinon afficher "-"
                            ?></strong></p>
                </div>

                <div class="card-body">
                    <div class="row align-items-center">
                        <!-- Colonne pour l'image du film -->
                        <div class="col-md-4">
                            <?php
                            // Vérifie si l'affiche du film existe, sinon utilise une image par défaut
                            $affiche_url = !empty($movie['affiche_url']) ? base_url($movie['affiche_url']) : base_url('assets/img/background-pro-yellow.jpg');
                            ?>
                            <!-- Affiche l'image du film avec une taille maximale de 100% -->
                            <img class="img-thumbnail me-2" alt="Aperçu de l'affiche du film"
                                 style="max-width: 100%;" src="<?= $affiche_url ?>">
                        </div>

                        <!-- Colonne pour les séances -->
                        <div class="col-md-7">
                            <div class="card">
                                <!-- En-tête de la carte pour les séances -->
                                <div class="card-header d-flex justify-content-center align-items-center text-center text-dark"
                                     style="background-color: #556b2f; color: white; font-weight: bold; padding: 15px; font-size: 24px;">
                                    Séance
                                </div>
                                <div>
                                    <div class="card-body">
                                        <!-- Liste des jours de la semaine avec un système d'onglets -->
                                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <!-- Onglet pour Lundi -->
                                                <button class="nav-link active" id="lundi-tab" data-bs-toggle="tab" data-bs-target="#lundi-pane" type="button" role="tab" aria-controls="lundi" aria-selected="true">Lundi</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <!-- Onglet pour Mardi -->
                                                <button class="nav-link" id="mardi-tab" data-bs-toggle="tab" data-bs-target="#mardi-pane" type="button" role="tab" aria-controls="mardi" aria-selected="false">Mardi</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <!-- Onglet pour Mercredi -->
                                                <button class="nav-link" id="mercredi-tab" data-bs-toggle="tab" data-bs-target="#mercredi-pane" type="button" role="tab" aria-controls="mercredi" aria-selected="false">Mercredi</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <!-- Onglet pour Jeudi -->
                                                <button class="nav-link" id="jeudi-tab" data-bs-toggle="tab" data-bs-target="#jeudi-pane" type="button" role="tab" aria-controls="jeudi" aria-selected="false">Jeudi</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <!-- Onglet pour Vendredi -->
                                                <button class="nav-link" id="vendredi-tab" data-bs-toggle="tab" data-bs-target="#vendredi-pane" type="button" role="tab" aria-controls="vendredi" aria-selected="false">Vendredi</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <!-- Onglet pour Samedi -->
                                                <button class="nav-link" id="samedi-tab" data-bs-toggle="tab" data-bs-target="#samedi-pane" type="button" role="tab" aria-controls="samedi" aria-selected="false">Samedi</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <!-- Onglet pour Dimanche -->
                                                <button class="nav-link" id="dimanche-tab" data-bs-toggle="tab" data-bs-target="#dimanche-pane" type="button" role="tab" aria-controls="dimanche" aria-selected="false">Dimanche</button>
                                            </li>
                                        </ul>
                                        <!-- Contenu des onglets -->
                                        <div class="tab-content border p-3">
                                            <!-- Contenu pour Lundi -->
                                            <div class="tab-pane fade show active" id="lundi-pane" role="tabpanel" aria-labelledby="lundi-tab" tabindex="0">

                                            </div>
                                            <!-- Contenu pour Mardi -->
                                            <div class="tab-pane fade" id="mardi-pane" role="tabpanel" aria-labelledby="mardi-tab" tabindex="0">
                                                2
                                            </div>
                                            <!-- Contenu pour Mercredi -->
                                            <div class="tab-pane fade" id="mercredi-pane" role="tabpanel" aria-labelledby="mercredi-tab" tabindex="0">
                                                3
                                            </div>
                                            <!-- Contenu pour Jeudi -->
                                            <div class="tab-pane fade" id="jeudi-pane" role="tabpanel" aria-labelledby="jeudi-tab" tabindex="0">
                                                4
                                            </div>
                                            <!-- Contenu pour Vendredi -->
                                            <div class="tab-pane fade" id="vendredi-pane" role="tabpanel" aria-labelledby="vendredi-tab" tabindex="0">
                                                5
                                            </div>
                                            <!-- Contenu pour Samedi -->
                                            <div class="tab-pane fade" id="samedi-pane" role="tabpanel" aria-labelledby="samedi-tab" tabindex="0">
                                                6
                                            </div>
                                            <!-- Contenu pour Dimanche -->
                                            <div class="tab-pane fade" id="dimanche-pane" role="tabpanel" aria-labelledby="dimanche-tab" tabindex="0">
                                                7
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Colonne pour les informations du film -->
                        <div class="col-15">
                            <div class="card p-3">
                                <!-- Affichage de la durée du film -->
                                <p><strong>Durée du film : </strong>
                                    <?php
                                    if (isset($movie['duration']) && is_numeric($movie['duration']) && $movie['duration'] > 0) {
                                        // Conversion de la durée en heures et minutes
                                        $hours = floor($movie['duration'] / 60);
                                        $minutes = $movie['duration'] % 60;
                                        echo $hours . " h " . $minutes . " m";
                                    } else {
                                        echo "-"; // Si la durée est invalide
                                    }
                                    ?>
                                </p>
                                <!-- Affichage de la note du film -->
                                <p><strong>Rating : </strong>
                                    <?php echo $movie['rating'] ?: "-"; ?>
                                </p>
                                <!-- Affichage de la date de sortie -->
                                <p><strong>Date de sortie : </strong>
                                    <?php echo $movie['release_date'] != '0000-00-00' ? $movie['release_date'] : "-"; ?>
                                </p>
                                <!-- Affichage du résumé du film -->
                                <p><strong>Résumé : </strong>
                                    <?php echo $movie['description'] ?: "-"; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <!-- Message d'erreur si le film n'est pas trouvé -->
            <div class="alert alert-info" role="alert">
                Le film que vous souhaitez consulter n'existe pas ou n'est pas accessible.
            </div>
        <?php endif; ?>
    </div>
</div>
