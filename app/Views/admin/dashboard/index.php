<div class="row">
    <!-- Première carte -->
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <?php
                $totalUsers = array_sum(array_column($infosUser, 'count'));
                ?>
                <h4 class="card-title">Utilisateurs (<?= $totalUsers ?>) </h4>
            </div>
            <div class="card-body">
                <canvas id="userPieChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Deuxième carte -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5>Bibliothèque</h5>
            </div>
            <div class="card-body">
                Thème utilisé : CoreUi. <br>
                Framework CSS : <a href="https://getbootstrap.com/docs/5.3/getting-started/introduction/" target="_blank">Boostrap</a>.<br>
                Bibliothèque d'icônes : <a href="https://fontawesome.com/search?m=free&o=r" target="_blank">FontAwesome</a>.<br>
                Bibliothèque JavaScript :
                <ul>
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
    // Convertir le tableau PHP en un objet JavaScript
    var data = <?php echo json_encode($infosUser); ?>;

    // Extraire les labels (noms) et les données (counts) pour le graphique
    var labels = data.map(function(item) {
        return item.name;
    });

    var counts = data.map(function(item) {
        return item.count;
    });

    // Configuration du graphique en secteurs
    var ctx = document.getElementById('userPieChart').getContext('2d');
    var myPieChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: labels,
            datasets: [{
                data: counts,
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                },
            }
        }
    });
</script>
