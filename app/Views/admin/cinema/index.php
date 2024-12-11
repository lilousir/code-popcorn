<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4>Liste des cinémas</h4>
        <a href="<?= base_url('/admin/cinema/new'); ?>"><i class="fa-solid fa-film"></i></a>
    </div>
    <div class="card-body">
        <table id="tablecinemas" class="table table-hover">
            <thead>
            <tr>
                <th>ID</th>
                <th>image</th>
                <th>name</th>
                <th>address</th>
                <th>ville</th>
                <th>Phone</th>
                <th>Mail</th>
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
        var dataTable = $('#tablecinemas').DataTable({
            "responsive": true,
            "processing": true,
            "serverSide": true,
            "pageLength": 10,
            "language": {
                url: baseUrl + 'js/datatable/datatable-2.1.4-fr-FR.json',
            },
            "ajax": {
                "url": baseUrl + "admin/cinema/SearchCinema",
                "type": "POST"
            },
            "columns": [
                {"data": "id"},
                {
                    data : 'photo_url',
                    sortable : false,
                    render : function(data) {
                        if (data) {
                            return `<img src="${baseUrl}${data}" alt="Avatar" style="max-width: 20px; height: auto;">`;
                        } else {
                            // Retourne une image par défaut si data est vide
                            return '<img src="' + baseUrl + 'assets/img/affiche/Ecole-poudlard.jpg" alt="Default Avatar" style="max-width: 50px; height: auto;">';
                        }
                    }
                },
                {"data": "name"},
                {"data": "address"},
                {"data": "label"},
                {"data": "phone"},
                {"data": "email"},
                {
                    data: 'id',
                    sortable: false,
                    render: function(data) {
                        return `<a href="${baseUrl}admin/cinema/${data}"><i class="fa-solid fa-pencil"></i></a>`;
                    }
                }
            ]

        });
    });

</script>