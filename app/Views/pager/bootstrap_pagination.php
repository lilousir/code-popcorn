<?php if ($pager->getPageCount() > 1) : ?> <!-- Si le nombre total de pages est supérieur à 1, alors afficher la pagination -->
    <nav aria-label="Page navigation example"> <!-- Début du bloc de navigation de pagination -->
        <ul class="pagination pagination-sm justify-content-center"> <!-- Liste des éléments de pagination, avec une taille de pagination petite et centrée -->

            <!-- Previous Button -->
            <li class="page-item <?= $pager->hasPreviousPage() ? '' : 'disabled' ?>"> <!-- Si il y a une page précédente, le bouton est activé, sinon il est désactivé -->
                <a class="page-link" href="<?= $pager->hasPreviousPage() ? $pager->getPreviousPage() : '#' ?>" aria-label="Précédent"> <!-- Lien vers la page précédente, ou '#' si le bouton est désactivé -->
                    <span aria-hidden="true">Précédent</span> <!-- Texte pour le bouton précédent -->
                </a>
            </li>

            <!-- Page Numbers -->
            <?php foreach ($pager->links() as $link) : ?> <!-- Pour chaque lien de pagination généré -->
                <li class="page-item <?= $link['active'] ? 'active' : '' ?>"> <!-- Si la page est active, on lui ajoute la classe 'active' -->
                    <a class="page-link" href="<?= $link['uri'] ?>"> <!-- Lien vers la page correspondante -->
                        <?= $link['title'] ?> <!-- Affiche le numéro de la page -->
                    </a>
                </li>
            <?php endforeach ?> <!-- Fin de la boucle sur les liens de pagination -->

            <!-- Next Button -->
            <li class="page-item <?= $pager->hasNextPage() ? '' : 'disabled' ?>"> <!-- Si il y a une page suivante, le bouton est activé, sinon il est désactivé -->
                <a class="page-link" href="<?= $pager->hasNextPage() ? $pager->getNextPage() : '#' ?>" aria-label="Suivant"> <!-- Lien vers la page suivante, ou '#' si le bouton est désactivé -->
                    <span aria-hidden="true">Suivant</span> <!-- Texte pour le bouton suivant -->
                </a>
            </li>
        </ul>
    </nav>
<?php endif ?> <!-- Fin de la condition pour afficher la pagination si le nombre de pages est supérieur à 1 -->
