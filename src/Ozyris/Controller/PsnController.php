<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 25/08/17
 * Time: 16:59
 */

namespace Ozyris\Controller;

use Ozyris\Form\Form;
use Ozyris\Model\PsnModel;
use Ozyris\Model\TokensModel;
use Ozyris\Model\TrophyModel;
use \PSN\Auth;
use \PSN\User;
use \PSN\Trophy;
use \PSN\AuthException;

class PsnController extends AbstractController
{

    /**
     * Affiche les informations du psn de l'utilisateur
     *
     * @return mixed
     */
    public function indexAction()
    {
        if (!array_key_exists('isAuthentified', $this->getSession()) || !$this->getSessionValue('isAuthentified')) {
            return $this->redirect();
        }

        $oUser = $this->getUser();
        $oPsnModel = new PsnModel();

        if (array_key_exists('psn', $this->getSession())) {
            $aPsnInfos = $this->getSessionValue('psn');
        } else {
            $aPsnInfos = $oPsnModel->selectPsnById($oUser->getId());
        }

        $this->setVariables([
            'aPsnInfos' => $aPsnInfos,
        ]);

        return $this->render('psn');
    }

    /**
     * @return mixed
     */
    public function addPsnAction()
    {
        // Test si l'utilisateur est bien authentifié
        if (!array_key_exists('isAuthentified', $_SESSION) && !$_SESSION['isAuthentified']) {
            return $this->redirect();
        }

        if (!empty($_POST)) {
            $aFormValues = Form::getFormValues();
            $oUser = $this->getUser();

            try {
                $account = new Auth($aFormValues['psnid'], $aFormValues['password']);
                $oTokensModel = new TokensModel();
                $oTokensModel->insertTokens($oUser->getId(), $account->GetTokens());
                $oTrophies = new Trophy($account->GetTokens());
                $oUserTrophies = $oTrophies->GetMyTrophies();
                $oTrophyModel = new TrophyModel();

                if (property_exists($oUserTrophies, 'trophyTitles') && count($oUserTrophies->trophyTitles) > 0) {
                    foreach ($oUserTrophies->trophyTitles as $oTrophy) {
                        if ($oTrophy->fromUser->earnedTrophies->platinum == 1) {
                            $oTrophyModel->insertTrophy($aFormValues['psnid'], $oTrophy);
                        }
                    }
                }

                $oPsnUser = new User($account->GetTokens());
                $oPsnModel = new PsnModel();

                // On enregistre en BDD les infos venant du PlayStation Network
                $oPsnModel->addPsn($oUser->getId(), $aFormValues['psnid'], $oPsnUser->Me());

                // On enregistre en session les informations liées au PSN de l'utilisateur
                $this->setSessionValues([
                    'psn' => $oPsnModel->selectPsnById($oUser->getId())
                ]);

            } catch (AuthException $e) {
//                header("Content-Type: application/json");
//                echo '<pre>' . $e->GetError() . '</pre>';
                $this->setFlashMessage("Le couple adresse email et mot de passe saisi est incorrect", false);

                return $this->redirect('psn', 'addPsn');
            }

            $this->setFlashMessage('Votre compte a été ajouté avec succès', false);

            return $this->redirect();
        }

        return $this->render('psn', 'addPsn');
    }

    public function updatePsnAction()
    {
        if (is_null($this->getSessionValue('isAuthentified')) || is_null($this->getSessionValue('psn'))) {
            return $this->redirect();
        }

        if (!empty($_POST)) {
            $aFormValues = Form::getFormValues();
            $aPsn = $this->getSessionValue('psn');

            try {
                Auth::GrabNewTokens($aPsn['refresh_token']);
                $account = new Auth($aPsn['psn_email'], $aFormValues['password']);
                $oPsnUser = new User($account->GetTokens());
                $oPsnModel = new PsnModel();
                $oPsnModel->updatePsnInfos($oPsnUser->Me());
            } catch (AuthException $e) {
//                header("Content-Type: application/json");
//                echo '<pre>' . $e->GetError() . '</pre>';
                $this->setFlashMessage('Le mot de passe saisi est incorrect', false);

                return $this->redirect('psn', 'updatePsn');
            }

            $this->setFlashMessage('Vos informations ont été mises à jour avec succès', false);

            return $this->redirect('psn');
        }

        return $this->render('psn', 'updatePsn');
    }
}