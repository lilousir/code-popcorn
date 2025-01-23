<div class="row">
    <!-- Première carte : Statistiques des utilisateurs -->
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <?php
                // Calcul du total des utilisateurs à partir des données fournies
                $totalUsers = array_sum(array_column($infosUser, 'count'));
                ?>
                <!-- Affichage du nombre total d'utilisateurs -->
                <h4 class="card-title">Utilisateurs (<?= $totalUsers ?>) </h4>
            </div>
            <div class="card-body">
                <!-- Conteneur pour le graphique en secteurs -->
                <canvas id="userPieChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Deuxième carte : Bibliothèques utilisées -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5>Bibliothèque</h5>
            </div>
            <div class="card-body">
                <!-- Liste des outils et bibliothèques utilisés dans le projet -->
                Thème utilisé : CoreUi. <br>
                Framework CSS : <a href="https://getbootstrap.com/docs/5.3/getting-started/introduction/" target="_blank">Boostrap</a>.<br>
                Bibliothèque d'icônes : <a href="https://fontawesome.com/search?m=free&o=r" target="_blank">FontAwesome</a>.<br>
                Bibliothèque JavaScript :
                <ul>
                    <!-- Liste avec des liens vers les documentations des bibliothèques utilisées -->
                    <li><a href="https://www.chartjs.org/docs/latest/" target="_blank">ChartJS</a></li>
                    <li><a href="https://api.jquery.com/" target="_blank">jQuery</a></li>
                    <li><a href="https://codeseven.github.io/toastr/" target="_blank">Toastr</a></li>
                    <li><a href="https://www.tiny.cloud/docs/tinymce/latest/" target="_blank">Tinymce</a></li>
                    <li><a href="https://datatables.net/manual/" target="_blank">Datatable</a></li>
                    <li><a href="https://sweetalert2.github.io/#examples" target="_blank">SweetAlert2</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
    // Convertir le tableau PHP en un objet JavaScript pour l'utiliser dans le graphique
    var data = <?php echo json_encode($infosUser); ?>;

    // Extraire les noms des utilisateurs (labels) et leurs comptes respectifs (counts)
    var labels = data.map(function(item) {
        return item.name; // Récupère le champ 'name' de chaque élément
    });

    var counts = data.map(function(item) {
        return item.count; // Récupère le champ 'count' de chaque élément
    });

    // Configuration et initialisation du graphique en secteurs avec Chart.js
    var ctx = document.getElementById('userPieChart').getContext('2d');
    var myPieChart = new Chart(ctx, {
        type: 'pie', // Type de graphique (secteurs)
        data: {
            labels: labels, // Noms des utilisateurs
            datasets: [{
                data: counts, // Données correspondant aux utilisateurs
            }]
        },
        options: {
            responsive: true, // Rend le graphique adaptatif
            plugins: {
                legend: {
                    position: 'bottom', // Place la légende en bas du graphique
                },
            }
        }
    });
</script>
