<div class="row">
    <div class="col">
        <!-- Carte principale pour afficher les films à l'affiche -->
        <div class="card h-100">
            <!-- En-tête de la carte avec un titre centré et stylisé -->
            <div class="card-header d-flex justify-content-center align-items-center text-center fw-bold fs-3 text-dark">
                Films à l'affiche
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- Boucle sur tous les films pour les afficher -->
                    <?php foreach ($movies as $movie): ?>
                        <?php
                        // Récupération du titre du film, avec valeur par défaut 'Titre inconnu' si non défini
                        $title = isset($movie['title']) ? $movie['title'] : 'Titre inconn';
                        // Récupération de l'URL de l'affiche du film, avec image par défaut si non définie
                        $img_src = isset($movie['affiche_url']) ? base_url($movie['affiche_url']) : base_url('assets/img/background-pro-yellow.jpg');
                        ?>
                        <!-- Colonne pour chaque film, avec une taille de 3 colonnes sur les écrans larges et 6 colonnes sur les petits écrans -->
                        <div class="col-md-3 col-6 mb-3">
                            <div class="card h-100 card-movie">
                                <!-- Lien vers la page du film avec un slug unique -->
                                <a href="<?= base_url('film/' . $movie['slug']) ?>">
                                    <!-- Image de l'affiche du film -->
                                    <img src="<?= $img_src ?>" alt="Image de <?= htmlspecialchars($movie['title'], ENT_QUOTES, 'UTF-8'); ?>" class="card-img-top">
                                </a>

                                <div class="card-body">
                                    <div class="card-title">

                                        <!-- Titre du film affiché -->
                                        <h5 class="card-title"><?= htmlspecialchars($movie['title'], ENT_QUOTES, 'UTF-8'); ?></h5>

                                       
                   </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="row">
                    <div class="col">
                        <!-- Pagination pour naviguer entre les pages -->
                        <div class="pagination justify-content-center">
                            <?= $pager->links('default', 'bootstrap_pagination'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Styles personnalisés pour les cartes de films -->
<style>
    .card-movie {
        background-color: #fff;
        border-radius: 16px; /* Coins arrondis */
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15); /* Ombre discrète */
        transform: scale(1); /* Taille par défaut */
        transition: transform 0.3s ease, box-shadow 0.3s ease; /* Transition fluide pour l'agrandissement et l'ombre */
        overflow: hidden; /* Masquer tout débordement de contenu */
        opacity: 0; /* L'élément est invisible au départ */
        animation: fadeIn 0.5s ease forwards; /* Animation pour faire apparaître progressivement la carte */
    }

    /* Définition de l'animation fadeIn */
    @keyframes fadeIn {
        0% {
            opacity: 0;
            transform: scale(0.9); /* L'élément commence plus petit */
        }
        100% {
            opacity: 1;
            transform: scale(1); /* L'élément atteint sa taille normale */
        }
    }

    /* Effet de survol de la carte */
    .card-movie:hover {
        transform: scale(1.05); /* Légère augmentation de taille au survol */
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2); /* Ombre renforcée au survol */
    }
</style>
