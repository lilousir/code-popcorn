<?php
$router = service('router');
$controller = strtolower(basename(str_replace('\\', '/', $router->controllerName())));
?>
<div class="row">

    <div class="col">
        <div class="card h-100">
            <div class="card-header d-flex justify-content-center align-items-center text-center fw-bold fs-3 bg-warning text-dark" style="height: 60px;">Film a l'affiche

            </div>
            <div class="card-body">
                <?php foreach(array_chunk($movies, 4) as $chunk) : // Diviser les éléments en groupes de 4 ?>
                    <div class="row shelf-row px-4 ">
                        <?php foreach($chunk as $movie) : ?>
                            <div class="col-md-3 col-6">
                                <div class="card h-100">
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
                    </div>
                <?php endforeach; ?>
                <div class="row">
                    <div class="col">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .shelf-row {
        position: relative; /* Positionnement nécessaire pour le pseudo-élément */
        margin-bottom: 50px; /* Assurez-vous d'avoir un espace en bas pour l'étagère */
    }

    .shelf-row::after {
        content: '';
        display: block; /* Rendre le pseudo-élément un bloc pour pouvoir ajuster la largeur */
        background-image: url("https://www4-static.gog-statics.com/bundles/gogwebsiteaccount/img/shelf/wood.png"); /* Lien vers l'image de l'étagère */
        background-size: cover; /* S'assurer que l'image couvre toute la largeur */
        background-repeat: no-repeat; /* Éviter que l'image se répète */
        position: absolute; /* Positionnement absolu par rapport au conteneur */
        bottom: -57px; /* Positionner l'étagère en bas du conteneur */
        left: 0; /* Aligné à gauche */
        width: 100%; /* Largeur de l'étagère à 100% */
        height: 85px; /* Ajuster la hauteur de l'étagère selon vos besoins */
        z-index: 0; /* Mettre l'étagère derrière les cartes */
    }
    @media(max-width: 768px) {
        .shelf-row::after {
            content: none;
        }
        .shelf-row {
            margin-bottom: 0;
        }
        .shelf-row .col-6 {
            margin-bottom: 1em;
        }
    }
    .shelf-row .col-md-3 {
        z-index: 1;
    }
    .shelf-row .card {
        box-shadow: 0 1px 5px rgba(0,0,0,.15);
        overflow: hidden;
    }

    .shelf-row .card-footer {
        position: absolute; /* Nécessaire pour l'effet */
        bottom: -50px; /* Ajustez cette valeur pour que le footer soit hors de la carte initialement */
        left: 0;
        right: 0;
        opacity: 0; /* Caché par défaut */
        transition: opacity 0.3s ease; /* Effet de transition pour la visibilité */
    }


</style>
<script>
    $(document).ready(function() {
        $('.shelf-row .card').on('mouseenter', function() {
            // Lorsque la souris entre dans la carte
            $(this).find('.card-footer').stop().animate({
                bottom: '0',   // Faites remonter le footer
                opacity: '1'   // Rendre le footer visible
            }, 300); // Durée de l'animation
        }).on('mouseleave', function() {
            // Lorsque la souris quitte la carte
            $(this).find('.card-footer').stop().animate({
                bottom: '-50px', // Faites descendre le footer pour qu'il disparaisse
                opacity: '0'     // Rendre le footer invisible
            }, 300);
        });
        $('#movie').select2({
                theme: 'bootstrap-5',
                placeholder: 'Rechercher un film',
                allowClear: true
            }
        );

</script>

