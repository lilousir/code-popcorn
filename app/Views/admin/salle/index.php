<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <!-- Titre de la carte pour la liste des salles -->
        <h4>Liste des salles</h4>
        <!-- Lien pour ajouter une nouvelle salle, qui redirige vers la page de création -->
        <a href="<?= base_url('/admin/salle/new'); ?>"><i class="fa-solid fa-user-plus"></i></a>
    </div>
    <div class="card-body">
        <!-- Table pour afficher la liste des salles -->
        <table id="tableSalle" class="table table-hover">
            <thead>
            <tr>
                <!-- En-têtes de colonnes de la table -->
                <th>ID</th>
                <th>Nom</th>
                <th>Capacité</th>
                <th>Cinéma</th>
                <th>Modifier</th>
                <th>Activer/Désactiver</th>
            </tr>
            </thead>
            <tbody>
            <!-- Le corps de la table sera rempli par DataTables avec des données dynamiques -->
            </tbody>
        </table>
    </div>
</div>

<script>
    $(document).ready(function () {
        // Définition de l'URL de base (pour utiliser dans les requêtes AJAX)
        var baseUrl = "<?= base_url(); ?>";

        // Initialisation de DataTables pour la table des salles
        var dataTable = $('#tableSalle').DataTable({
            "responsive": true, // Permet à la table de s'ajuster automatiquement aux différentes tailles d'écran
            "processing": true, // Affiche une animation pendant le traitement des données
            "serverSide": true, // Utilisation du serveur pour traiter les données (au lieu de charger toutes les données côté client)
            "pageLength": 10, // Nombre d'éléments par page
            "language": {
                // Chargement du fichier de langue pour afficher les textes en français
                url: baseUrl + 'js/datatable/datatable-2.1.4-fr-FR.json',
            },
            "ajax": {
                // URL pour obtenir les données via AJAX depuis le serveur
                "url": baseUrl + "admin/salle/searchsalle",
                "type": "POST" // Méthode de la requête AJAX (POST)
            },
            "columns": [
                // Définition des colonnes à afficher dans la table
                {"data": "id"}, // ID de la salle
                {"data": "name"}, // Nom de la salle
                {"data": "capacity"}, // Capacité de la salle
                {"data": "theater_id"}, // Identifiant du cinéma auquel appartient la salle
                {
                    data : 'id',
                    sortable : false, // Désactive le tri pour cette colonne
                    render : function(data) {
                        // Génère un lien de modification avec l'ID de la salle
                        return `<a href="${baseUrl}admin/salle/${data}"><i class="fa-solid fa-pencil"></i></a>`;
                    }
                },
                {
                    data: 'id',
                    sortable: false, // Désactive le tri pour cette colonne
                    render: function (data, type, row) {
                        // Vérifie si la salle est activée ou désactivée et génère un lien avec l'icône correspondante
                        return (row.deleted_at === null ?
                            `<a title="Désactiver la salle" href="${baseUrl}admin/salle/deactivate/${row.id}"><i class="fa-solid fa-xl fa-toggle-on text-success"></i></a>` :
                            `<a title="Activer la salle" href="${baseUrl}admin/salle/activate/${row.id}"><i class="fa-solid fa-toggle-off fa-xl text-danger"></i></a>`);
                    }
                }
            ]
        });
    });
</script>
