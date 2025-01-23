<?php
$router = service('router');
$controller = strtolower(basename(str_replace('\\', '/', $router->controllerName())));
?>
<div class="row">
    <div class="col">
        <div class="card" style="background-color: #b5d199">
            <div class="card-header d-flex justify-content-center align-items-center text-center fw-bold fs-3  text-dark">
                Cinema
            </div>
            <div class="card-body" style="background-color: #b5d199">
                <?php foreach (array_chunk($cinemas, 4) as $chunk) : // Diviser les éléments en groupes de 4 ?>
                    <div class="row shelf-row px-4">
                        <?php foreach ($chunk as $cinema) : // Utiliser $cinema pour le singulier ?>
                            <div class="col mb-3">
                                <div class="card h-100" style="background-color: #3dad5b">
                                    <?php
                                    // Vérifie si une image existe, sinon prend l'image par défaut
                                    $photo_url = !empty($cinema['photo_image']) ? base_url('cinema/' . $cinema['photo_image']) : base_url('assets/img/background-pro.jpg');
                                    ?>
                                    <a href="<?= base_url('cinema/' . $cinema['id']) ?>">
                                        <img src="<?= $photo_url ?>" alt="Image de <?= htmlspecialchars($cinema['name'], ENT_QUOTES, 'UTF-8'); ?>" class="card-img-top">
                                    </a>
                                    <div class="card-body" style="background-color: #b5b6b7">
                                        <h5 class="card-title"><?= htmlspecialchars($cinema['name'], ENT_QUOTES, 'UTF-8'); ?></h5>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>

                <div class="row">
                    <div class="col">
                        <div class="pagination justify-content-center">
                            <?= $pager->links('default', 'bootstrap_pagination'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<style>
    .shelf-row {
        position: relative;
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        gap: 30px;
        margin-bottom: 50px;
    }

    .shelf-row::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: #eee;
        opacity: 0.1; /* Fond discret pour ne pas distraire de l'effet principal */
        z-index: -1;
    }

    .shelf-row .card {
        background-color: #fff;
        border-radius: 16px;
        width: 100%; /* Largeur de chaque carte, adaptée pour 4 cartes par ligne */
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        transform: perspective(600px) rotateY(0deg); /* Effet de perspective 3D */
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        overflow: hidden;
        opacity: 0;
        animation: fadeIn 0.5s ease forwards;
    }

    @keyframes fadeIn {
        0% {
            opacity: 0;
            transform: perspective(600px) rotateY(-15deg);
        }
        100% {
            opacity: 1;
            transform: perspective(600px) rotateY(0deg);
        }
    }

    .shelf-row .card:hover {
        transform: perspective(600px) rotateY(15deg); /* Légère rotation au survol */
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2); /* Ombre renforcée au survol */
    }

    .shelf-row .card-footer {
        padding: 15px;
        background-color: #333;
        color: #fff;
        text-align: center;
        font-size: 1.1em;
        opacity: 0;
        transition: opacity 0.3s ease;
        transform: translateY(20px);
    }

    .shelf-row .card:hover .card-footer {
        opacity: 1; /* Le footer devient visible au survol */
        transform: translateY(0); /* Le footer se déplace pour apparaître */
    }

    /* Adaptation pour les petits écrans */
    @media (max-width: 1024px) {
        .shelf-row .card {
            width: 48%; /* Deux cartes par ligne sur les tablettes */
        }
    }

    @media (max-width: 768px) {
        .shelf-row .card {
            width: 98%; /* Une carte par ligne sur les téléphones */
        }
    }
</style>

