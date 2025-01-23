<div class="card">
    <!-- En-tête de la carte avec le titre et le lien pour créer un nouveau cinéma -->
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4>Liste des cinémas</h4>
        <a href="<?= base_url('/admin/cinema/new'); ?>"><i class="fa-solid fa-film"></i></a>
    </div>
    <div class="card-body">
        <!-- Tableau pour afficher les cinémas -->
        <table id="tablecinemas" class="table table-hover">
            <thead>
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Nom</th>
                <th>Adresse</th>
                <th>Ville</th>
                <th>Téléphone</th>
                <th>Email</th>
                <th>Modifier</th>
            </tr>
            </thead>
            <tbody>
            <!-- Le contenu du tableau sera rempli dynamiquement avec DataTables -->
            </tbody>
        </table>
    </div>
</div>

<script>
    $(document).ready(function () {
        // Base URL du site
        var baseUrl = "<?= base_url(); ?>";

        // Initialisation de DataTables
        var dataTable = $('#tablecinemas').DataTable({
            // Configuration de DataTables
            "responsive": true, // Rendre le tableau adaptatif
            "processing": true, // Afficher une animation de chargement pendant le traitement
            "serverSide": true, // Activer le mode serveur
            "pageLength": 10, // Nombre de lignes affichées par page
            "language": {
                // Charger les traductions en français pour DataTables
                url: baseUrl + 'js/datatable/datatable-2.1.4-fr-FR.json',
            },
            "ajax": {
                // URL pour récupérer les données dynamiquement via une requête POST
                "url": baseUrl + "admin/cinema/SearchCinema",
                "type": "POST"
            },
            // Définition des colonnes du tableau
            "columns": [
                {"data": "id"}, // Colonne pour l'ID
                {
                    // Colonne pour l'image
                    data: 'photo_url',
                    sortable: false, // Désactiver le tri pour cette colonne
                    render: function(data) {
                        if (data) {
                            // Si une URL d'image est disponible, l'afficher
                            return `<img src="${baseUrl}${data}" alt="Avatar" style="max-width: 20px; height: auto;">`;
                        } else {
                            // Sinon, afficher une image par défaut
                            return '<img src="' + baseUrl + 'assets/img/affiche/Ecole-poudlard.jpg" alt="Default Avatar" style="max-width: 50px; height: auto;">';
                        }
                    }
                },
                {"data": "name"}, // Colonne pour le nom
                {"data": "address"}, // Colonne pour l'adresse
                {"data": "label"}, // Colonne pour la ville
                {"data": "phone"}, // Colonne pour le téléphone
                {"data": "email"}, // Colonne pour l'email
                {
                    // Colonne pour l'icône de modification
                    data: 'id',
                    sortable: false, // Désactiver le tri pour cette colonne
                    render: function(data) {
                        // Générer un lien pour modifier l'entrée correspondante
                        return `<a href="${baseUrl}admin/cinema/${data}"><i class="fa-solid fa-pencil"></i></a>`;
                    }
                }
            ]
        });
    });
</script>
