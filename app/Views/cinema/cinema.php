<div class="row">
    <div class="col">
        <!-- Vérifie si la variable $cinema existe et n'est pas nulle -->
        <?php if (isset($cinema) && $cinema != null): ?>
            <div class="card">
                <div class="card-header d-flex justify-content-center align-items-center text-center text-dark">
                    <!-- Affichage du nom du cinéma -->
                    <p><strong style="font-size: 35px;"><?php
                            echo $cinema['name'] ? $cinema['name'] : "-"; // Affiche le nom du cinéma ou "-" s'il est vide
                            ?></strong></p>
                </div>

                <div class="card-body">
                    <div class="row align-items-center">
                        <!-- Colonne pour l'image -->
                        <div class="col-md-4">
                            <?php
                            // Vérifie si une photo est disponible, sinon utilise une image par défaut
                            $photo_url = !empty($cinema['photo_url']) ? base_url($cinema['photo_url']) : base_url('assets/img/background-pro.jpg');
                            ?>
                            <img class="img-thumbnail me-2" alt="Aperçu de l'image"
                                 style="max-width: 100%;" src="<?= $photo_url ?>"> <!-- Affiche l'image du cinéma -->
                        </div>
                        <!-- Colonne pour les informations texte -->
                        <div class="col-15">
                            <div class="card p-3">
                                <!-- Affiche l'adresse du cinéma -->
                                <p><strong> Address: </strong>
                                    <?= $cinema['address'] ? $cinema['address'] : "-"; ?> <!-- Si l'adresse existe, l'affiche, sinon affiche "-" -->
                                </p>
                                <!-- Affiche le numéro de téléphone du cinéma -->
                                <p><strong>Phone : </strong>
                                    <?= $cinema['phone'] ? $cinema['phone'] : "-"; ?> <!-- Affiche le téléphone, sinon "-" -->
                                </p>
                                <!-- Affiche l'email du cinéma -->
                                <p><strong>Email : </strong>
                                    <?= $cinema['email'] ? $cinema['email'] : "-"; ?> <!-- Affiche l'email, sinon "-" -->
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <!-- Message d'erreur si le cinéma n'existe pas ou n'est pas accessible -->
            <div class="alert alert-info" role="alert">
                Le cinéma que vous souhaitez consulter n'existe pas ou n'est pas accessible.
            </div>
        <?php endif; ?>
    </div>
</div>
