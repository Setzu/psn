<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 31/08/17
 * Time: 16:34
 */
?>
<div class="col-md-6 col-md-offset-3">
    <h2><img src="/img/icons/ps_ico_white_48x48.png" alt="Playstation">PlayStation Network : </h2>
    <br>
</div>
<div class="col-md-4 col-md-offset-3">
    <p>Actualiser mes informationss provenant du PSN</p>
    <form action="/psn/updatePsn" method="post" role="form">
        <div class="form-group">
            <label for="password">Mot de passe :
                <input type="password" name="password" required="required" class="form-control">
            </label>
        </div>
        <input type="submit" class="btn btn-primary loader" value="Valider">
    </form>
</div>