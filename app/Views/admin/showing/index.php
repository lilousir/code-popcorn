
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4>Liste des séance</h4>
        <a href="<?= base_url('/admin/showing/new'); ?>"><i class="fa-solid fa-user-plus"></i></a>
    </div>
    <div class="card-body">
        <table id="tableshowing" class="table table-hover">
            <thead>
            <tr>
                <th>ID</th>
                <th>Date et heure</th>
                <th>Déscription</th>
                <th>Version</th>
                <th>Type</th>
                <th>Film</th>

                <th>active</th>

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
        var dataTable = $('#tableshowing').DataTable({
            "responsive": true,
            "processing": true,
            "serverSide": true,
            "pageLength": 10,
            "language": {
                url: baseUrl + 'js/datatable/datatable-2.1.4-fr-FR.json',
            },
            "ajax": {
                "url": baseUrl + "admin/showing/SearchShowing",
                "type": "POST"
            },
            "columns": [
                {"data": "id"},
                {"data": "date"},
                {"data": "description"},
                {"data": "version"},
                {"data": "id_type_showing"},
                {"data": "id_movie"},

                {
                    data: 'id',
                    sortable: false,
                    render: function (data, type, row) {
                        return (row.deleted_at === null ?
                            `<a title="Désactiver la séance" href="${baseUrl}admin/showing/deactivate/${row.id}"><i class="fa-solid fa-xl fa-toggle-on text-success"></i></a>` : `<a title="Activer la salle" href="${baseUrl}admin/showing/activate/${row.id}"><i class="fa-solid fa-toggle-off fa-xl text-danger"></i></a>`);
                    }
                }

            ]
        });
    });

</script>
