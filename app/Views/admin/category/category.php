<div class="row mb-4">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h3>Catégory</h3>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <form action="<?= base_url('/admin/movie/createcategory'); ?>" method="POST">
            <div class="card">
                <div class="card-header">
                    <h5>Ajouter une catégory</h5>
                </div>
                <div class="card-body">
                    <label class="form-label">Nom de la catégory</label>
                    <input type="text" class="form-control" name="name">
                </div>
                <div class="card-footer text-end">
                    <button type="submit" class="btn btn-primary">Valider</button>
                </div>
            </div>
        </form>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5>Liste des catégory</h5>
            </div>
            <div class="card-body">
                <table class="table table-sm table-hover" id="tableCategory">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Slug</th>
                        <th>Modif.</th>
                        <th>Supp.</th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
            <div class="card-footer">

            </div>
        </div>
    </div>
</div>
<div class="modal" tabindex="-1" id="modalCategory">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modifier ma category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="<?= base_url('/admin/movie/updateCategory'); ?>" id="formModal">
                <div class="modal-body">
                    <input type="hidden" name="id" value="">
                    <label class="form-label">Nom de la category</label>
                    <input type="text" name="name" class="form-control">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    <input type="submit" class="btn btn-primary" value="Valider">
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        const modalCategory = new bootstrap.Modal('#modalCategory');
        var baseUrl = "<?= base_url(); ?>";
        var dataTable = $('#tableCategory').DataTable({
            "responsive": true,
            "pageLength": 10,
            "processing": true,
            "serverSide": true,
            "language": {
                url: baseUrl + 'js/datatable/datatable-2.1.4-fr-FR.json',
            },
            "ajax" : {
                "url" : baseUrl + "admin/movie/searchcategory",
                "type" : "POST",
                "data" : { 'model' : 'CategoryModel'}

            },
            "columns": [
                {"data": "id"},
                {"data": "name"},
                {"data": "slug"},

                {
                    data : 'id',
                    sortable : false,
                    render : function(data) {
                        return `<a class="swal2-category-update" id="${data}"
                        href="${baseUrl}/admin/movie/updateCategory/${data}"><i class="fa-solid fa-pencil
                        text-success"></i></a>`;
                    }
                },
                {
                    data : 'id',
                    sortable : false,
                    render : function(data) {
                        return `<a class="link-underline link-underline-opacity-0" class="link-underline link-underline-opacity-0" href="${baseUrl}admin/movie/deletecategory/${data}"><i class="fa-solid fa-trash text-danger"></i></a>`;
                    }
                }
            ]
        });
        $("body").on('click', '.swal2-category-update', function(event) {
            event.preventDefault();
            modalCategory.show();
            let id_category = $(this).attr('id');
            let name = $(this).closest('tr').find(".name-category").html();
            $('.modal input[name="id"]').val(id_category);
            $('.modal input[name="name"]').val(name);
        });
        $("#formModal").on('submit', function(event) {
            event.preventDefault();
            let id_category = $('.modal input[name="id"]').val();
            let name_category = $('.modal input[name="name"]').val();
            $.ajax({
                type: "POST",
                url: $(this).attr("action"),
                data : {
                    id : id_category,
                    name : name_category,
                },
                success: function (data) {
                    console.log(data);
                    //je transforme mon contenu pour l'utiliser en javascript
                    var json = JSON.parse(data);
                    //déclaration de ma ligne pour l'utiliser plusieurs fois
                    const ligne = $('#'+id_category).closest('tr');
                    //modification des differents champs
                    ligne.find('.slug-category').html(json.slug);
                    ligne.find('.name-category').html(json.name);
                    //fermeture de la modal
                    modalCategory.hide();
                }
            });
        });
    })
</script>