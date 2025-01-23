<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <!-- Titre de la carte : Liste des séances -->
        <h4>Liste des séances</h4>
        <!-- Lien pour ajouter une nouvelle séance -->
        <a href="<?= base_url('/admin/showing/new'); ?>"><i class="fa-solid fa-user-plus"></i></a>
    </div>
    <div class="card-body">
        <!-- Table pour afficher les séances -->
        <table id="tableshowing" class="table table-hover">
            <thead>
            <tr>
                <!-- Entêtes de colonne pour la liste des séances -->
                <th>ID</th>
                <th>Date et heure</th>
                <th>Description</th>
                <th>Version</th>
                <th>Film</th>
                <th>Modifier</th>
                <th>Active</th>
            </tr>
            </thead>
            <tbody>
            <!-- Le corps de la table sera rempli par les données via DataTables -->
            </tbody>
        </table>
    </div>
</div>

<script>
    $(document).ready(function () {
        var baseUrl = "<?= base_url(); ?>";
        // Initialisation de DataTable pour la table #tableshowing
        var dataTable = $('#tableshowing').DataTable({
            "responsive": true, // Permet à la table de s'ajuster sur différents écrans
            "processing": true, // Affiche un indicateur de chargement pendant le traitement
            "serverSide": true, // Indique que les données viennent du serveur
            "pageLength": 10, // Définit le nombre de lignes affichées par page
            "language": {
                url: baseUrl + 'js/datatable/datatable-2.1.4-fr-FR.json', // Chemin du fichier de traduction en français pour DataTable
            },
            "ajax": {
                // L'URL pour récupérer les données via une requête POST
                "url": baseUrl + "admin/showing/SearchShowing",
                "type": "POST"
            },
            "columns": [
                // Définition des colonnes pour chaque donnée
                {"data": "id"}, // ID de la séance
                {"data": "date"}, // Date et heure de la séance
                {"data": "description"}, // Description de la séance
                {"data": "version"}, // Version du film
                {"data": "id_movie"}, // ID du film associé à la séance
                {
                    // Colonne pour l'icône de modification
                    data: 'id',
                    sortable: false, // Désactiver le tri pour cette colonne
                    render: function(data) {
                        // Générer un lien pour modifier l'entrée correspondante
                        return `<a href="${baseUrl}admin/showing/${data}"><i class="fa-solid fa-pencil"></i></a>`;
                    }
                },

                // Colonne pour activer/désactiver la séance
                {
                    data: 'id',
                    sortable: false, // On désactive le tri sur cette colonne
                    render: function (data, type, row) {
                        // Vérification de l'état de la séance : si 'deleted_at' est null, cela signifie que la séance est active
                        return (row.deleted_at === null ?
                            // Si active, affiche le bouton pour désactiver la séance
                            `<a title="Désactiver la séance" href="${baseUrl}admin/showing/deactivate/${row.id}"><i class="fa-solid fa-xl fa-toggle-on text-warning"></i></a>` :
                            // Si désactivée, affiche le bouton pour activer la séance
                            `<a title="Activer la séance" href="${baseUrl}admin/showing/activate/${row.id}"><i class="fa-solid fa-toggle-off fa-xl text-danger"></i></a>`);
                    }
                }
            ]
        });
    });
</script>
