<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 31/05/16
 * Time: 11:56
 */
?>
<div class="col-md-6 col-md-offset-2">
    <div class="row">
        <div class="col-md-12">
            <h4>Derniers trophées platine obtenus :</h4>
            <?php if (count($this->aListeActualites) > 0) { ?>
                <?php for ($i = 0; $i < 3; $i++) { ?>
                    <ul class="list-group">
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-md-4">
                                    <img src="<?= $this->aListeActualites['avatar' . $i]; ?>" alt="avatar" style="border-right: 1px solid #dddddd;">
                                </div>
                                <div class="col-md-8">
                                    <?= $this->aListeActualites['psn_id' . $i]; ?>
                                    <span style="float: right">
                                    <?= $this->aListeActualites['date_obtention' . $i]; ?>
                                </span>
                                    <hr>
                                    <img src="/img/icons/<?= $this->aListeActualites['trophy_type' . $i]; ?>.png" alt="platine" style="margin: 0 20px 0 0; display: inline-block;">
                                    <p style="display: inline-block;"><?= $this->aListeActualites['trophy_name' . $i]; ?></p>
                                </div>
                            </div>
                        </li>
                    </ul>
                <?php } ?>
            <?php } ?>
        </div>
    </div>
</div>