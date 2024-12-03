
<div class="row">
    <div class="col">
        <form action="<?= isset($movie) ? base_url("/admin/movie/update") : base_url("/admin/movie/create") ?>" method="POST" enctype="multipart/form-data">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">
                        <?= isset($movie) ? "Editer " . $movie['title'] : "Créer un film" ?>
                    </h4>
                </div>
                <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="profil-tab" data-bs-toggle="tab" data-bs-target="#profil" type="button" role="tab" aria-controls="profil" aria-selected="true">Film</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="onglet-tab" data-bs-toggle="tab"
                                    data-bs-target="#onglet" type="button" role="tab" aria-controls="onglet"
                                    aria-selected="false">Image</button>
                        </li>
                    </ul>

                    <!-- Tab panes -->

                    <div class="tab-content border p-3">
                        <div class="tab-pane active" id="profil" role="tabpanel" aria-labelledby="profil-tab" tabindex="0">
                            <div class="mb-3">
                                <label for="title" class="form-label">Titre du film :</label>
                                <input type="text" class="form-control" id="title" placeholder="title" value="<?= isset($movie) ? $movie['title'] : ""; ?>" name="title">
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
                                <label for="description" class="form-label">Description :</label>
                                <textarea class="form-control" id="description" name="description" placeholder="Description du film"><?= isset($movie) ? $movie['description'] : ""; ?></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="rating" class="form-label">Pegi :</label>
                                <input type="text" class="form-control" id="rating" placeholder="pegi" value="" name="email">
                            </div>
                            <div class="row row-cols-4" id="genre-list">
                                <label for="category" class="form-label">Catégorie du film :</label>
                                <?php
                                foreach ($categorys as $category) { // Utiliser $category pour itérer
                                    if (isset($category_movie)) {
                                        $category_ids = array_column($category_movie, 'id');
                                    }
                                    $isChecked = isset($category_ids) && in_array($category['id'], $category_ids) ? 'checked' : ''; // Référer à $category
                                    ?>
                                    <div class="col genre-item">
                                        <input class="form-check-input"
                                               type="checkbox"
                                               value="<?= htmlspecialchars($category['id']) ?>"
                                               id="chk-<?= htmlspecialchars($category['slug']) ?>"
                                               name="category_movie[]" <?= $isChecked ?>>
                                        <label class="form-check-label"
                                               for="chk-<?= htmlspecialchars($category['slug']) ?>">
                                            <?= htmlspecialchars($category['name']) ?>
                                        </label>
                                    </div>
                                <?php } ?>
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

?>
