<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 25/08/17
 * Time: 17:02
 */
?>

<?php if ($this->aPsnInfos == false) { ?>
    <p>Vous n'avez pas encore ajouté votre compte PSN.<br>
        Vous pouvez l'ajouter en cliquant sur le bouton ci-dessous :</p>
    <a href="/psn/addPsn" class="btn btn-primary">Ajouter mon compte PSN</a>
<?php } else { ?>

<div class="col-md-2">
    <strong><?= $this->aPsnInfos['psn_id']; ?></strong>
    <br>
    <?= "<img src='" . $this->aPsnInfos['avatar_m'] . "' alt='avatar'/>"; ?>
</div>
<div class="col-md-6">
    <h3>Mon PSN :</h3>
    <p>Niveau : <?= $this->aPsnInfos['trophy_level']; ?></p>
    <div class="progress">
        <div class="progress-bar" role="progressbar" aria-valuenow="<?= $this->aPsnInfos['progress']; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $this->aPsnInfos['progress']; ?>%;">
            <?= $this->aPsnInfos['progress']; ?>%
        </div>
    </div>
    <p>Amis : <?= $this->aPsnInfos['friends_count']; ?></p>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Platine</th>
            <th>Or</th>
            <th>Argent</th>
            <th>Bronze</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td><?= $this->aPsnInfos['platinum'];?></td>
            <td><?= $this->aPsnInfos['gold'];?></td>
            <td><?= $this->aPsnInfos['silver'];?></td>
            <td><?= $this->aPsnInfos['bronze'];?></td>
        </tr>
        </tbody>
    </table>
    <p>Dernière mise à jour le : <?= $this->aPsnInfos['last_update']; ?></p>
    <a href="/psn/updatePsn" class="btn btn-info">Actualiser mes infos<a>
</div>
<?php } ?>