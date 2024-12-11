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
                        <div class="col-md-6">
                            <div class="card p-3">

                                <div
                                        class="card-header d-flex justify-content-center align-items-center text-center text-dark"
                                        style="background-color: #556b2f; color: white; font-weight: bold; padding: 15px; font-size: 24px;">
                                    Séance
                                </div>
                                        Dans une contrée lointaine, nichée entre des montagnes majestueuses et des vallées verdoyantes, un petit village prospérait dans la paix et l'harmonie. Les habitants vivaient en communion avec la nature, cultivant leurs champs et élevant leurs animaux avec soin.

                                        Cependant, une menace sourde pesait sur leur avenir. Une légende ancienne racontait qu'un dragon endormi dans les montagnes pourrait se réveiller, semant la terreur et le chaos. Les anciens du village avaient mis en garde les plus jeunes : il ne fallait jamais déranger le sommeil du gardien des cimes.

                                        Un jour, un jeune garçon du village, curieux et intrépide, décida d'explorer les grottes des montagnes. Il était attiré par les récits des anciens et rêvait de percer le mystère du dragon. Armé de courage et d'une simple lampe, il s'aventura dans l'obscurité.
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
