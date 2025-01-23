<div class="card">
    <!-- En-tête de la carte avec le titre et un bouton pour ajouter un nouveau film -->
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4>Liste des films</h4>
        <!-- Lien pour ajouter un nouveau film -->
        <a href="<?= base_url('/admin/movie/new'); ?>"><i class="fa-solid fa-plus"></i></a>
    </div>
    <div class="card-body">
        <!-- Table pour afficher la liste des films -->
        <table id="tablemovies" class="table table-hover">
            <thead>
            <tr>
                <th>ID</th>
                <th>Affiche</th>
                <th>Titre</th>
                <th>Date de sortie</th>
                <th>Durée</th>
                <th>Rating</th>
                <th>Modifier</th>
                <th>Activer</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>

<script>
    $(document).ready(function () {
        // Base URL pour les requêtes et ressources
        var baseUrl = "<?= base_url(); ?>";

        // Initialisation de la DataTable avec des options spécifiques
        var dataTable = $('#tablemovies').DataTable({
            "responsive": true, // Rend la table adaptative pour différents écrans
            "processing": true, // Affiche un indicateur de traitement
            "serverSide": true, // Active le mode serveur pour les données
            "pageLength": 10, // Nombre d'éléments par page
            "language": {
                // Chargement de la traduction française pour la DataTable
                url: baseUrl + 'js/datatable/datatable-2.1.4-fr-FR.json',
            },
            "ajax": {
                // URL pour récupérer les données dynamiques
                "url": baseUrl + "admin/movie/SearchMovies",
                "type": "POST"
            },
            "columns": [
                {"data": "id"}, // Colonne pour l'ID
                {
                    // Colonne pour l'affiche du film
                    data: 'affiche_url',
                    sortable: false, // Désactive le tri pour cette colonne
                    render: function(data) {
                        if (data) {
                            // Affiche l'image si l'URL est présente
                            return `<img src="${baseUrl}${data}" alt="Affiche" style="max-width: 20px; height: auto;">`;
                        } else {
                            // Affiche une image par défaut si aucune URL n'est disponible
                            return '<img src="' + baseUrl + 'assets/img/affiche/hp2.jpg" alt="Default Affiche" style="max-width: 50px; height: auto;">';
                        }
                    }
                },
                {"data": "title"}, // Colonne pour le titre du film
                {"data": "release_date"}, // Colonne pour la date de sortie
                {"data": "duration"}, // Colonne pour la durée du film
                {"data": "rating"}, // Colonne pour la note du film
                {
                    // Colonne pour le lien de modification
                    data: 'id',
                    sortable: false, // Désactive le tri pour cette colonne
                    render: function(data) {
                        // Ajoute un lien avec une icône pour modifier le film
                        return `<a href="${baseUrl}admin/movie/${data}"><i class="fa-solid fa-pencil"></i></a>`;
                    }
                },
                {
                    // Colonne pour activer/désactiver un film
                    data: 'id',
                    sortable: false, // Désactive le tri pour cette colonne
                    render: function (data, type, row) {
                        // Vérifie si le film est actif ou désactivé et affiche l'icône appropriée
                        return (row.deleted_at === null ?
                            `<a title="Désactiver le film" href="${baseUrl}admin/movie/deactivate/${row.id}"><i class="fa-solid fa-xl fa-toggle-on text-success"></i></a>` :
                            `<a title="Activer le film" href="${baseUrl}admin/movie/activate/${row.id}"><i class="fa-solid fa-toggle-off fa-xl text-danger"></i></a>`);
                    }
                }
            ]
        });
    });
</script>
