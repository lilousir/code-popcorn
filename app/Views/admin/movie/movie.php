<div class="row">
    <div class="col">
        <!-- Formulaire qui s'envoie vers l'action appropriée (création ou mise à jour) -->
        <form action="<?= isset($movie) ? base_url("/admin/movie/update") : base_url("/admin/movie/create") ?>" method="POST" enctype="multipart/form-data">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-salle-center">
                    <h4 class="card-title">
                        <!-- Titre du formulaire qui change en fonction de l'action (édition ou création) -->
                        <?= isset($movie) ? "Éditer " . $movie['title'] : "Créer un film" ?>
                    </h4>
                </div>
                <div class="card-body">
                    <!-- Navigation des onglets -->
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <!-- Onglet actif pour la partie "Film" -->
                            <button class="nav-link active" id="profil-tab" data-bs-toggle="tab" data-bs-target="#profil" type="button" role="tab" aria-controls="profil" aria-selected="true">Film</button>
                        </li>
                    </ul>

                    <div class="tab-content border p-3">
                        <!-- Contenu de l'onglet "Film" -->
                        <div class="tab-pane active" id="profil" role="tabpanel" aria-labelledby="profil-tab" tabindex="0">
                            <!-- Champ pour le titre du film -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Titre du film</label>
                                <!-- Affichage du titre du film si défini, sinon champ vide -->
                                <input type="text" class="form-control" id="title" placeholder="Titre" value="<?= isset($movie) ? $movie['title'] : ""; ?>" name="title">
                            </div>

                            <!-- Champ pour la description du film -->
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <!-- Affichage de la description si définie, sinon champ vide -->
                                <textarea class="form-control" id="description" name="description" placeholder="Entrez une description" rows="5"><?= isset($movie['description']) ? htmlspecialchars($movie['description']) : ""; ?></textarea>
                            </div>

                            <!-- Champ pour la date de sortie -->
                            <div class="mb-3">
                                <label for="release_date" class="form-label">Date de sortie :</label>
                                <!-- Affichage de la date de sortie si définie, sinon champ vide -->
                                <input type="date" class="form-control" id="release_date" value="<?= isset($movie) ? $movie['release_date'] : ""; ?>" name="release_date">
                            </div>

                            <!-- Champ pour la durée du film -->
                            <div class="mb-3">
                                <label for="duration" class="form-label">Durée du film :</label>
                                <!-- Affichage de la durée si définie, sinon champ vide -->
                                <input type="text" class="form-control" id="duration" placeholder="Durée" value="<?= isset($movie) ? $movie['duration'] : ""; ?>" name="duration">
                            </div>

                            <!-- Sélection du Pegi (classification par âge) -->
                            <div class="mb-3">
                                <label for="rating" class="form-label">Pegi</label>
                                <!-- Liste déroulante pour le Pegi, avec une option sélectionnée si définie -->
                                <select class="form-select" name="rating">
                                    <option value="none" selected>Aucun</option>
                                    <option value="Tous publics" <?= (isset($movie) && $movie['rating'] == "Tous publics") ? "selected" : ""; ?>>Tous publics</option>
                                    <option value="-12" <?= (isset($movie) && $movie['rating'] == "-12") ? "selected" : ""; ?>>-12</option>
                                    <option value="-16" <?= (isset($movie) && $movie['rating'] == "-16") ? "selected" : ""; ?>>-16</option>
                                    <option value="-18" <?= (isset($movie) && $movie['rating'] == "-18") ? "selected" : ""; ?>>-18</option>
                                </select>
                            </div>

                            <!-- Affichage de l'affiche du film -->
                            <div class="mb-3 d-flex align-items-center">
                                <label for="image" class="form-label me-2">Affiche</label>
                                <div id="preview">
                                    <?php
                                    // URL de l'affiche si définie, sinon valeur par défaut
                                    $profileImageUrl = isset($movie['affiche_url']) ? base_url($movie['affiche_url']) : "#";
                                    ?>
                                    <!-- Affichage de l'image avec un style conditionnel (afficher si existe) -->
                                    <img class="img-thumbnail me-2" alt="Aperçu de l'image" style="display: <?= isset($movie['affiche_url']) ? 'block' : 'none'; ?>; max-width: 100px;" src="<?= $profileImageUrl ?>">
                                </div>
                                <!-- Champ pour uploader une nouvelle affiche -->
                                <input class="form-control" type="file" name="affiche_image" id="image">
                            </div>

                            <!-- Liste des genres du film (générée dynamiquement) -->
                            <div class="row row-cols-4" id="genre-list">
                                <?php
                                // Exemple de rendu dynamique des genres
                                if (isset($genres)) {
                                    foreach ($genres as $genre) {
                                        echo '<div class="col">';
                                        echo '<input type="checkbox" name="genres[]" value="' . $genre['id'] . '" ' . (isset($movie) && in_array($genre['id'], $movie['genres']) ? 'checked' : '') . '> ' . htmlspecialchars($genre['name']);
                                        echo '</div>';
                                    }
                                }
                                ?>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- Footer du formulaire avec le bouton d'enregistrement -->
                <div class="card-footer text-end">
                    <?php if (isset($movie)): ?>
                        <!-- Si un film existe, ajouter un champ caché avec son ID pour la mise à jour -->
                        <input type="hidden" name="id" value="<?= $movie['id']; ?>">
                    <?php endif; ?>
                    <!-- Bouton de soumission qui affiche "Sauvegarder" ou "Enregistrer" selon l'action -->
                    <button type="submit" class="btn btn-primary">
                        <?= isset($movie) ? "Sauvegarder" : "Enregistrer" ?>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php
// Fonction pour créer un arbre de catégories (avec gestion des sous-catégories)
function buildTree(array $elements, $parentId = null) {
    $branch = [];
    foreach ($elements as $element) {
        // Si l'élément a le parentId correspondant, on le considère comme un enfant
        if ($element['id_type_parent'] == $parentId) {
            $children = buildTree($elements, $element['id']); // Appel récursif pour récupérer les enfants
            if ($children) {
                $element['children'] = $children; // Ajouter les enfants à l'élément
            }
            $branch[] = $element; // Ajouter l'élément à la branche
        }
    }
    return $branch; // Retourner l'arbre des catégories
}

// Fonction pour afficher un arbre sous forme de boutons radio (avec collapsible)
function displayTreeAsRadios(array $tree, $contextId, $selectedId = null) {
    foreach ($tree as $node) {
        // ID unique pour chaque catégorie (utilisé pour le lien entre le radio et le collapsible)
        $uniqueId = $contextId . '_category_' . $node['id'];
        $collapseId = $contextId . '_collapse_' . $node['id'];

        // Vérifier si cet élément est sélectionné
        $isSelected = ($node['id'] == $selectedId) ? 'checked' : '';
        // Vérifier si cet élément ou ses enfants sont sélectionnés
        $isExpanded = ($node['id'] == $selectedId || hasSelectedChild($node, $selectedId)) ? 'show' : '';

        echo '<div class="form-check">';
        echo '<input class="form-check-input" type="radio" name="id_' . $contextId . '" id="' . $uniqueId . '" value="' . $node['id'] . '" ' . $isSelected . ' data-bs-toggle="collapse" data-bs-target="#' . $collapseId . '" aria-expanded="false" aria-controls="' . $collapseId . '">';
        echo '<label class="form-check-label" for="' . $uniqueId . '">' . $node['name'] . '</label>';

        // Si la catégorie a des enfants, afficher une section collapsible
        if (isset($node['children'])) {
            echo '<div id="' . $collapseId . '" class="collapse ' . $isExpanded . '">';
            displayTreeAsRadios($node['children'], $contextId, $selectedId); // Appel récursif pour afficher les enfants
            echo '</div>';
        }

        echo '</div>';
    }
}

// Fonction pour vérifier si un enfant ou un descendant est sélectionné
function hasSelectedChild($node, $selectedId) {
    if ($node['id'] == $selectedId) {
        return true;
    }
    if (isset($node['children'])) {
        foreach ($node['children'] as $child) {
            if (hasSelectedChild($child, $selectedId)) {
                return true;
            }
        }
    }
    return false;
}
?>
