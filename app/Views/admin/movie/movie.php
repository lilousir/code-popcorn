
<div class="row">
    <div class="col">
        <form action="<?= isset($movie) ? base_url("/admin/movie/update") : base_url("/admin/movie/create") ?>" method="POST" enctype="multipart/form-data">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-salle-center">
                    <h4 class="card-title">
                        <?= isset($movie) ? "Editer " . $movie['title'] : "Créer un film" ?>
                    </h4>
                </div>
                <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="profil-tab" data-bs-toggle="tab" data-bs-target="#profil" type="button" role="tab" aria-controls="profil" aria-selected="true">Film</button>
                        </li>
                    </ul>

                    <!-- Tab panes -->

                    <div class="tab-content border p-3">
                        <div class="tab-pane active" id="profil" role="tabpanel" aria-labelledby="profil-tab" tabindex="0">
                            <div class="mb-3">

                                <label for="name" class="form-label">Titre du film</label>
                                <input type="text" class="form-control" id="title" placeholder="title" value="<?= isset($movie) ? $movie['title'] : ""; ?>" name="title">
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea
                                        class="form-control"
                                        id="description"
                                        name="description"
                                        placeholder="Entrez une description"
                                        rows="5"><?= isset($movie['description']) ? htmlspecialchars($movie['description']) : ""; ?></textarea>

                                
                            </div>

                            <div class="mb-3">
                                <label for="release_date" class="form-label">Date de sortie :</label>
                                <input type="date" class="form-control" id="release_date" placeholder="release_date" value="<?= isset($movie) ? $movie['release_date'] : ""; ?>" name="release_date">
                            </div>
                            <div class="mb-3">
                                <label for="duration" class="form-label">Durée du film :</label>
                                <input type="text" class="form-control" id="duration" placeholder="durée" value="<?= isset($movie) ? $movie['duration'] : ""; ?>" name="duration"  >
                            </div>

                         <div class="mb-3">
                               <label for="rating" class="form-label">Pegi</label>

                             <select class="form-select" name="rating">
                                 <option value="none" selected>Aucun</option>
                                 <option value="Tous publics"<?= (isset($movie) && $movie['rating'] == "Tous publics") ? "selected"  : ""; ?>>Tous publics</option>
                                 <option value="-12"<?= (isset($movie) && $movie['rating'] == "-12") ? "selected"  : ""; ?>>-12</option>
                                 <option value="-16"<?= (isset($movie) && $movie['rating'] == "-16") ? "selected"  : ""; ?>>-16</option>
                                 <option value="-18"<?= (isset($movie) && $movie['rating'] == "-18") ? "selected"  : ""; ?>>-18</option>
                             </select>


                         </div>
                            <div class="mb-3 d-flex align-items-center">
                                <label for="image" class="form-label me-2">Affiche</label>
                                <div id="preview">
                                    <?php
                                    $profileImageUrl = isset($movie['affiche_url']) ? base_url($movie['affiche_url']) : "#";
                                    ?>
                                    <img class="img-thumbnail me-2"alt="Aperçu de l'image"
                                         style="display: <?= isset($movie['affiche_url']) ? "block" : "none" ?>; max-width: 100px;"
                                         src="<?= $profileImageUrl ?>">
                                </div>
                                <input class="form-control" type="file" name="affiche_image" id="image">
                            </div>
                            <div class="row row-cols-4" id="genre-list">

                            </div>

                        </div>
                    </div>

                    <div class="tab-pane" id="onglet" role="tabpanel" aria-labelledby="onglet-tab" tabindex="0">

                    </div>

                </div>
            </div>

            <div class="card-footer text-end">
                <?php if (isset($movie)): ?>
                    <input type="hidden" name="id" value="<?= $movie['id']; ?>">
                <?php endif; ?>
                <button type="submit" class="btn btn-primary">
                    <?= isset($movie) ? "Sauvegarder" : "Enregistrer" ?>
                </button>
            </div>
        </form>
    </div>

</div>


<?php
function buildTree(array $elements, $column_parent_name, $parentId = null) {
    $branch = [];
    foreach ($elements as $element) {
        if ($element['id_type_parent'] == $parentId) {
            $children = buildTree($elements, $column_parent_name, $element['id']);
            if ($children) {
                $element['children'] = $children;
            }
            $branch[] = $element;
        }
    }
    return $branch;
}

function displayTreeAsRadios(array $tree, $contextId, $selectedId = null) {
    foreach ($tree as $node) {
        // Créer un ID unique pour chaque catégorie pour relier le bouton radio et la div collapsible
        $uniqueId = $contextId . '_category_' . $node['id'];
        $collapseId = $contextId . '_collapse_' . $node['id'];

        // Déterminer si cet élément est sélectionné
        $isSelected = ($node['id'] == $selectedId) ? 'checked' : '';
        $isExpanded = ($node['id'] == $selectedId || hasSelectedChild($node, $selectedId)) ? 'show' : '';

        // Créer l'input radio
        echo '<div class="form-check">';
        echo '<input class="form-check-input" type="radio" name="id_' . $contextId . '" id="' . $uniqueId . '" value="' . $node['id'] . '" ' . $isSelected . ' data-bs-toggle="collapse" data-bs-target="#' . $collapseId . '" aria-expanded="false" aria-controls="' . $collapseId . '">';
        echo '<label class="form-check-label" for="' . $uniqueId . '">' . $node['name'] . '</label>';

        // Si la catégorie a des enfants, on les affiche dans une section collapsible
        if (isset($node['children'])) {
            echo '<div id="' . $collapseId . '" class="collapse ' . $isExpanded . '">';
            displayTreeAsRadios($node['children'], $contextId, $selectedId);
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


