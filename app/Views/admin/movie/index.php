<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4>Liste des films</h4>
        <a href="<?= base_url('/admin/movie/new'); ?>"><i class="fa-solid fa-plus"></i></a>
    </div>
    <div class="card-body">
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
                <th>activer</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>

<script>
    $(document).ready(function () {
        var baseUrl = "<?= base_url(); ?>";
        var dataTable = $('#tablemovies').DataTable({
            "responsive": true,
            "processing": true,
            "serverSide": true,
            "pageLength": 10,
            "language": {
                url: baseUrl + 'js/datatable/datatable-2.1.4-fr-FR.json', // Chemin du fichier JSON de traduction
            },
            "ajax": {
                "url": baseUrl + "admin/movie/SearchMovies", // Corrigé l'URL de la requête Ajax
                "type": "POST"
            },
            "columns": [
                {"data": "id"},
                {
                    data : 'affiche_url',
                    sortable : false,
                    render : function(data) {
                        if (data) {
                            return `<img src="${baseUrl}${data}" alt="Avatar" style="max-width: 20px; height: auto;">`;
                        } else {
                            // Retourne une image par défaut si data est vide
                            return '<img src="' + baseUrl + 'assets/img/affiche/hp2.jpg" alt="Default Avatar" style="max-width: 50px; height: auto;">';
                        }
                    }
                },
                {"data": "title"},
                {"data": "release_date"},
                {"data": "duration"},
                {"data": "rating"},

              



                {
                    data: 'id',
                    sortable: false,
                    render: function(data) {
                        return `<a href="${baseUrl}admin/movie/${data}"><i class="fa-solid fa-pencil"></i></a>`;
                    }
                },
                {
                    data: 'id',
                    sortable: false,
                    render: function (data, type, row) {
                        return (row.deleted_at === null ?
                            `<a title="Désactiver la salle" href="${baseUrl}admin/movie/deactivate/${row.id}"><i class="fa-solid fa-xl fa-toggle-on text-success"></i></a>` : `<a title="Activer le film" href="${baseUrl}admin/movie/activate/${row.id}"><i class="fa-solid fa-toggle-off fa-xl text-danger"></i></a>`);
                    }
                }
            ]
        });
    });
</script>
