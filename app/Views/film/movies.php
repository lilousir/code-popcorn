<?php
$router = service('router');
$controller = strtolower(basename(str_replace('\\', '/', $router->controllerName())));
?>
<div class="row">
    <div class="col">
        <div class="card h-100">
            <div class="card-header d-flex justify-content-center align-items-center text-center fw-bold fs-3 text-dark">
                Films à l'affiche
            </div>
            <div class="card-body">
                <div class="row">
                    <?php foreach ($movies as $movie): ?>
                        <?php
                        $title = isset($movie['title']) ? $movie['title'] : 'Titre inconnu';
                        $slug = isset($movie['slug']) ? $movie['slug'] : '#';
                        $img_src = !empty($movie['affiche_url']) ? base_url($movie['affiche_url']) : base_url('assets/img/full.jpg');
                        ?>
                        <div class="col-md-3 col-6 mb-3">
                            <div class="card h-100 card-movie">
                                <img src="<?= $img_src ?>" class="card-img-top" alt="<?= esc($title); ?>">
                                <div class="card-body">
                                    <div class="card-title">
                                        <a href="<?= base_url('film/public/' . $slug) ?>"><?= esc($title); ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
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
    .card-movie {
        background-color: #fff;
        border-radius: 16px;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        transform: scale(1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        overflow: hidden;
        opacity: 0;
        animation: fadeIn 0.5s ease forwards;
    }
    @keyframes fadeIn {
        0% {
            opacity: 0;
            transform: scale(0.9);
        }
        100% {
            opacity: 1;
            transform: scale(1);
        }
    }
    .card-movie:hover {
        transform: scale(1.05); /* Légère augmentation de taille au survol */
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2); /* Ombre renforcée au survol */
    }
</style>
