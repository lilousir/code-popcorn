<div class="row">
    <div class="col">
        <?php if (isset($movie) && $movie != null): ?>
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <!-- Tu peux mettre ici des informations comme le titre du film ou des actions -->
                </div>
                <div class="card-body">
                    <div class="row">

                            <?php
                            $img_src = !empty($movie['affiche_url']) ? base_url($movie['affiche_url']) : base_url('assets/img/full.jpg');
                            ?>

                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="alert alert-info" role="alert">
                Le film que vous souhaitez consulter n'existe pas ou n'est pas accessible.
            </div>
        <?php endif; ?>
    </div>
</div>
