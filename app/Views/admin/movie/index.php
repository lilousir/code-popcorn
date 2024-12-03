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
                <th>Titre</th>
                <th>Date de sortie</th>
                <th>Durée</th>
                <th>Rating</th>
                <th>Modifier</th>
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
                }
            ]
        });
    });
</script>
