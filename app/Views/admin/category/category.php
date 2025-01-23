
<!-- Section principale pour afficher la catégorie -->
<div class="row mb-4">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h3>Catégory</h3> <!-- Titre principal, corrigez "Catégory" par "Catégorie" -->
            </div>
        </div>
    </div>
</div>

<!-- Formulaire pour ajouter une nouvelle catégorie -->
<div class="row">
    <div class="col-md-4">
        <form action="<?= base_url('/admin/movie/createcategory'); ?>" method="POST">
            <div class="card">
                <div class="card-header">
                    <h5>Ajouter une catégory</h5> <!-- Corrigez "catégory" par "catégorie" -->
                </div>
                <div class="card-body">
                    <label class="form-label">Nom de la catégory</label> <!-- Corrigez "catégory" par "catégorie" -->
                    <input type="text" class="form-control" name="name" required> <!-- Ajoutez "required" pour valider le champ -->
                </div>
                <div class="card-footer text-end">
                    <button type="submit" class="btn btn-primary">Valider</button>
                </div>
            </div>
        </form>
    </div>

    <!-- Table pour lister les catégories existantes -->
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5>Liste des catégory</h5> <!-- Corrigez "catégory" par "catégorie" -->
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
                    <!-- Les données seront ajoutées dynamiquement -->
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <!-- Footer vide, ajoutez un contenu si nécessaire -->
            </div>
        </div>
    </div>
</div>

<!-- Modal pour modifier une catégorie -->
<div class="modal" tabindex="-1" id="modalCategory">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modifier ma catégorie</h5> <!-- Corrigez "category" par "catégorie" -->
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="<?= base_url('/admin/movie/updateCategory'); ?>" id="formModal">
                <div class="modal-body">
                    <input type="hidden" name="id" value=""> <!-- ID caché pour l'édition -->
                    <label class="form-label">Nom de la catégorie</label> <!-- Corrigez "category" par "catégorie" -->
                    <input type="text" name="name" class="form-control" required> <!-- Ajoutez "required" -->
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
        const modalCategory = new bootstrap.Modal('#modalCategory'); // Initialise la modal Bootstrap
        var baseUrl = "<?= base_url(); ?>"; // Base URL dynamique

        // Initialisation de DataTable avec des options spécifiques
        var dataTable = $('#tableCategory').DataTable({
            "responsive": true,
            "pageLength": 10,
            "processing": true,
            "serverSide": true,
            "language": {
                url: baseUrl + 'js/datatable/datatable-2.1.4-fr-FR.json', // Fichier de traduction
            },
            "ajax": {
                "url": baseUrl + "admin/movie/searchcategory", // API pour charger les catégories
                "type": "POST",
                "data": { 'model': 'CategoryModel' } // Paramètres envoyés au serveur
            },
            "columns": [
                {"data": "id"},
                {"data": "name"},
                {"data": "slug"},
                {
                    data: 'id',
                    sortable: false,
                    render: function(data) {
                        return `<a class="swal2-category-update" id="${data}" href="${baseUrl}/admin/movie/updateCategory/${data}"><i class="fa-solid fa-pencil text-success"></i></a>`; // Bouton modifier
                    }
                },
                {
                    data: 'id',
                    sortable: false,
                    render: function(data) {
                        return `<a class="link-underline link-underline-opacity-0" href="${baseUrl}admin/movie/deletecategory/${data}"><i class="fa-solid fa-trash text-danger"></i></a>`; // Bouton supprimer
                    }
                }
            ]
        });

        // Gestion du clic sur "Modifier une catégorie"
        $("body").on('click', '.swal2-category-update', function(event) {
            event.preventDefault();
            modalCategory.show();
            let id_category = $(this).attr('id'); // Récupération de l'ID
            let name = $(this).closest('tr').find(".name-category").html(); // Récupération du nom
            $('.modal input[name="id"]').val(id_category);
            $('.modal input[name="name"]').val(name);
        });

        // Gestion de l'envoi du formulaire pour modifier une catégorie
        $("#formModal").on('submit', function(event) {
            event.preventDefault();
            let id_category = $('.modal input[name="id"]').val();
            let name_category = $('.modal input[name="name"]').val();
            $.ajax({
                type: "POST",
                url: $(this).attr("action"),
                data: {
                    id: id_category,
                    name: name_category,
                },
                success: function (data) {
                    console.log(data); // Log pour débogage
                    var json = JSON.parse(data); // Analyse de la réponse
                    const ligne = $('#' + id_category).closest('tr');
                    ligne.find('.slug-category').html(json.slug); // Mise à jour du slug
                    ligne.find('.name-category').html(json.name); // Mise à jour du nom
                    modalCategory.hide(); // Fermeture de la modal
                }
            });
        });
    });
</script>
