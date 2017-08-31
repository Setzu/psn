<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 25/08/17
 * Time: 17:02
 */

?>
<div class="col-md-6 col-md-offset-3">
    <h2><img src="/img/icons/ps_ico_white_48x48.png" alt="Playstation icon">PlayStation Network : </h2>
    <br>
</div>
<div class="col-md-4 col-md-offset-3">
    <form action="/psn/addPsn" method="post" role="form">
        <div class="form-group">
            <label for="psnid">ID PSN (adresse email ou pseudo) :
                <input type="text" name="psnid" required="required" placeholder="id psn" class="form-control">
            </label>
            <label for="password">Mot de passe :
                <input type="password" name="password" required="required" class="form-control">
            </label>
        </div>
        <input type="submit" class="btn btn-primary loader" value="Lier mon compte">
    </form>
</div>