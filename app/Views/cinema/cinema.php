
<div class="row">
    <div class="col">
        <?php if (isset($cinema) && $cinema != null): ?>
            <div class="card">
                <div  class="card-header d-flex justify-content-center align-items-center text-center text-dark">
                    <p><strong style="font-size: 35px;"><?php if ($cinema['name']) {
                                echo $cinema['name'];
                            } else {
                                echo "-";
                            } ?></strong></p>
                </div>

                <div class="card-body">
                    <div class="row align-items-center">
                        <!-- Colonne pour l'image -->
                        <div class="col-md-4">
                            <img class="img-thumbnail me-2" alt="Aperçu de l'image"
                                 style="display: <?= isset($cinema['photo_url']) ? "block" : "none" ?>; max-width: 100%;"
                                 src="<?= base_url($cinema['photo_url']) ?>">
                        </div>
                        <!-- Colonne pour le texte -->
                        <div class="col-15">
                            <div class="card p-3">
                                <p><strong> Address: </strong>
                                    <?php if ($cinema['address']) {
                                        echo $cinema['address'];
                                    } else {
                                        echo "-";
                                    } ?>
                                </p>
                                <p><strong>Phone : </strong>
                                    <?php if ($cinema['phone']) {
                                        echo $cinema['phone'];
                                    } else {
                                        echo "-";
                                    } ?>
                                </p>
                                <p><strong>Email : </strong>
                                    <?php if ($cinema['email']) {
                                        echo $cinema['email'];
                                    } else {
                                        echo "-";
                                    } ?>
                                </p>

                            </div>
                        </div>
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
