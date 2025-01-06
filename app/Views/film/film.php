<div class="row">
    <div class="col">
        <?php if (isset($movie) && $movie != null): ?>
            <div class="card">
                <div  class="card-header d-flex justify-content-center align-items-center text-center text-dark">
                    <p><strong style="font-size: 35px;"><?php if ($movie['title']) {
                                echo $movie['title'];
                            } else {
                                echo "-";
                            } ?></strong></p>
                </div>

                <div class="card-body">
                    <div class="row align-items-center">
                        <!-- Colonne pour l'image -->
                        <div class="col-md-4">
                            <img class="img-thumbnail me-2" alt="Aperçu de l'image"
                                 style="display: <?= isset($movie['affiche_url']) ? "block" : "none" ?>; max-width: 100%;"
                                 src="<?= base_url($movie['affiche_url']) ?>">
                        </div>
                        <div class="col-md-7">
                            <div class="card ">

                                <div
                                        class="card-header d-flex justify-content-center align-items-center text-center text-dark"
                                        style="background-color: #556b2f; color: white; font-weight: bold; padding: 15px; font-size: 24px;">
                                    Séance
                                </div>
                                 <div>
                                     <div class="card-body">
                                         <ul class="nav nav-tabs" id="myTab" role="tablist">
                                             <li class="nav-item" role="presentation">
                                                 <button class="nav-link active" id="lundi-tab" data-bs-toggle="tab" data-bs-target="#lundi-pane" type="button" role="tab" aria-controls="lundi" aria-selected="true">Lundi</button>
                                             </li>
                                             <li class="nav-item" role="presentation">
                                                 <button class="nav-link" id="mardi-tab" data-bs-toggle="tab" data-bs-target="#mardi-pane" type="button" role="tab" aria-controls="mardi" aria-selected="false">Mardi</button>
                                             </li>
                                             <li class="nav-item" role="presentation">
                                                 <button class="nav-link" id="mercredi-tab" data-bs-toggle="tab" data-bs-target="#mercredi-pane" type="button" role="tab" aria-controls="mercredi" aria-selected="false">Mercredi</button>
                                             </li>
                                             <li class="nav-item" role="presentation">
                                                 <button class="nav-link" id="jeudi-tab" data-bs-toggle="tab" data-bs-target="#jeudi-pane" type="button" role="tab" aria-controls="jeudi" aria-selected="false">Jeudi</button>
                                             </li>
                                             <li class="nav-item" role="presentation">
                                                 <button class="nav-link" id="vendredi-tab" data-bs-toggle="tab" data-bs-target="#vendredi-pane" type="button" role="tab" aria-controls="vendredi" aria-selected="false">Vendredi</button>
                                             </li>
                                             <li class="nav-item" role="presentation">
                                                 <button class="nav-link" id="samedi-tab" data-bs-toggle="tab" data-bs-target="#samedi-pane" type="button" role="tab" aria-controls="samedi" aria-selected="false">Samedi</button>
                                             </li>
                                             <li class="nav-item" role="presentation">
                                                 <button class="nav-link" id="dimanche-tab" data-bs-toggle="tab" data-bs-target="#dimanche-pane" type="button" role="tab" aria-controls="dimanche" aria-selected="false">Dimanche</button>
                                             </li>
                                         </ul>
                                         <!-- Tab panes -->
                                         <div class="tab-content border p-3">
                                             <div class="tab-pane fade show active" id="lundi-pane" role="tabpanel" aria-labelledby="lundi-tab" tabindex="0">

                                             </div>
                                             <div class="tab-pane fade" id="mardi-pane" role="tabpanel" aria-labelledby="mardi-tab" tabindex="0">
                                                 2

                                             </div>
                                             <div class="tab-pane fade" id="mercredi-pane" role="tabpanel" aria-labelledby="mercredi-tab" tabindex="0">
                                                3
                                             </div>
                                             <div class="tab-pane fade" id="jeudi-pane" role="tabpanel" aria-labelledby="jeudi-tab" tabindex="0">
                                                4
                                             </div>
                                             <div class="tab-pane fade" id="vendredi-pane" role="tabpanel" aria-labelledby="vendredi-tab" tabindex="0">
                                                 5
                                             </div>
                                             <div class="tab-pane fade" id="samedi-pane" role="tabpanel" aria-labelledby="samedi-tab" tabindex="0">
                                                 6
                                             </div>
                                             <div class="tab-pane fade" id="dimanche-pane" role="tabpanel" aria-labelledby="dimanche-tab" tabindex="0">
                                                 7
                                             </div>
                                         </div>


                                     </div>
                               </div>
                            </div>
                        </div>
                        <!-- Colonne pour le texte -->
                        <div class="col-15">
                            <div class="card p-3">
                                <p><strong>Durée du film : </strong>
                                    <?php
                                    if (isset($movie['duration']) && is_numeric($movie['duration']) && $movie['duration'] > 0) {
                                        // Conversion en heures et minutes
                                        $hours = floor($movie['duration'] / 60);
                                        $minutes = $movie['duration'] % 60;
                                        echo $hours . " h " . $minutes . " m";
                                    } else {
                                        echo "-"; // Si la durée est invalide
                                    }
                                    ?>
                                </p>
                                <p><strong>Rating : </strong>
                                    <?php if ($movie['rating']) {
                                        echo $movie['rating'];
                                    } else {
                                        echo "-";
                                    } ?>
                                </p>
                                <p><strong>Date de sortie : </strong>
                                    <?php if ($movie['release_date'] != '0000-00-00') {
                                        echo $movie['release_date'];
                                    } else {
                                        echo "-";
                                    } ?>
                                </p>
                                <p><strong>Résumé : </strong>
                                    <?php if ($movie['description']) {
                                        echo $movie['description'];
                                    } else {
                                        echo "-";
                                    } ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="alert alert-info" role="alert">
                Le film que vous souhaitez consulter n'existe pas ou n'est pas accessible.
            </div>
        <?php endif; ?>
    </div>
</div>
