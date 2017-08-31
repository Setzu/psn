<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 31/05/16
 * Time: 11:56
 */
?>
<div class="col-md-6 col-md-offset-2">
    <?php if ($this->aPsnInfos != false) { ?>
        <h3>Mon PSN :</h3>
        <p>Niveau : <?= $this->aPsnInfos['trophy_level']; ?></p>
        <div class="progress">
            <div class="progress-bar" role="progressbar" aria-valuenow="<?= $this->aPsnInfos['progress']; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $this->aPsnInfos['progress']; ?>%;">
                <?= $this->aPsnInfos['progress']; ?>%
            </div>
        </div>
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
    <?php } ?>
    <div class="row">
        <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
            Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
            Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
            Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
        </p>
        <p>
            At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.
            Et harum quidem rerum facilis est et expedita distinctio.
            Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus.
            Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae.
            Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.
        </p>
        <p>Homines enim eruditos et sobrios ut infaustos et inutiles vitant, eo quoque accedente quod et nomenclatores adsueti haec et talia venditare, mercede accepta lucris quosdam et prandiis inserunt subditicios ignobiles et obscuros.</p>
        <p>Quaestione igitur per multiplices dilatata fortunas cum ambigerentur quaedam, non nulla levius actitata constaret, post multorum clades Apollinares ambo pater et filius in exilium acti cum ad locum Crateras nomine pervenissent, villam scilicet suam quae ab Antiochia vicensimo et quarto disiungitur lapide, ut mandatum est, fractis cruribus occiduntur.</p>
    </div>
</div>