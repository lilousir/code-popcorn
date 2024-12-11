<?php
$router = service('router');
$controller = strtolower(basename(str_replace('\\', '/', $router->controllerName())));
?>
<div class="row">

    <div class="col">
        <div class="card h-100">
            <div class="card-header d-flex justify-content-center align-items-center text-center fw-bold fs-3  text-dark">Film a l'affiche

            </div>
            <div class="card-body">
                <div class="row">
                    <?php foreach($movies as $movie) : // Diviser les éléments en groupes de 4 ?>

                        <div class="col-md-3 col-6 mb-3">
                            <div class="card h-100 card-movie">
                                <?php
                                $img_src = !empty($movie['affiche_url']) ? base_url($movie['affiche_url']) : base_url('assets/img/full.jpg');
                                ?>
                                <a href="<?= base_url('film/' . $movie['slug']) ?>">
                                    <img src="<?= $img_src ?>" class="card-img-top" alt="<?= $movie['title']; ?>">
                                </a>
                                <div class="card-body">
                                    <div class="card-title"><?= $movie['title']; ?></div>
                                </div>
                            </div>

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
</div>
<style>
    .card-movie {
        background-color: #fff;
        border-radius: 16px;
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
    .card-movie:hover {
        transform: perspective(600px) rotateY(15deg); /* Légère rotation au survol */
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2); /* Ombre renforcée au survol */
    }
</style>
