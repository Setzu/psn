<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 26/05/16
 * Time: 14:36
 */
?>

<div class="row">
    <h2>
        <a href="/">
            <span class="glyphicon glyphicon-home" style="float: left; clear: right"></span>
        </a>
    </h2>
    <?php if (array_key_exists('isAuthentified', $_SESSION) && $_SESSION['isAuthentified']) { ?>

        <div class="col-md-offset-8">
            <div class="dropdown">
                <span id="dropdownMenu1" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        <?php if (array_key_exists('psn', $_SESSION) && $_SESSION['psn'] != false) { ?>
                            <?php echo "<img src='" . $_SESSION['psn']['avatar_m'] . "' alt='avatar' style='width: 50px;'/>" . $_SESSION['psn']['psn_id']; ?>
                        <?php } else { ?>
                            <?php
                            /** @var \Ozyris\Service\Users $oUser */
                            $oUser = $_SESSION['user'];
                            echo $oUser->getUsername();
                            ?>
                        <?php } ?>
                    <span class="caret"></span>
                </span>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                    <li><a href="/psn"><span class="glyphicon glyphicon-user">&nbsp;Profil</span></a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="/auth/disconnect"><span class="glyphicon glyphicon-off"></span>&nbsp;Déconnexion</a></li>
                </ul>
            </div>
        </div>

    <?php } else { ?>

        <div class="col-md-offset-4">
            <form class="form-inline" action="/auth" method="post" role="form" id="login-form">
                <fieldset>
                    <div class="form-group">
                        <input type="text" name="username" required="required" placeholder="Identifiant"
                               class="form-control">
                        <input type="password" required="required" name="password" placeholder="Mot de passe"
                               class="form-control">
                        <button type="submit" class="btn btn-primary">Se connecter</button>
                    </div>
                    <a href="/auth/registration" class="btn btn-primary">S'inscrire</a>
                </fieldset>
            </form>
        </div>

    <?php } ?>
</div>

<hr>
