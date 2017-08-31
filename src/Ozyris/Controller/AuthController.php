<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 26/05/16
 * Time: 14:52
 */

namespace Ozyris\Controller;

use Ozyris\Form\Form;
use Ozyris\Model\PsnModel;
use Ozyris\Model\UserModel;
use Ozyris\Form\Validator\EmailValidator;
use Ozyris\Form\Validator\PasswordValidator;
use Ozyris\Form\Validator\StandardValidator;
use Ozyris\Service\Users;

class AuthController extends AbstractController
{

    /**
     * Connecte l'utilisateur, stocke l'objet Users en session, puis redirige sur l'accueil
     *
     * @return $this|bool
     */
    public function indexAction()
    {
        if (!empty($_POST)) {
            $aFormValues = Form::getFormValues();
            $oModelUser = new UserModel();
            $aDonneesUser = $oModelUser->selectUserByUsernameOrEmail($aFormValues['username']);

            if (count($aDonneesUser) == 0 || !password_verify($aFormValues['password'], $aDonneesUser['password'])) {
                $this->setFlashMessage('Identifiant ou mot de passe incorrect.');

                return $this->redirect('auth');
            }

            $oUser = new Users($aDonneesUser);
            $oPsnModel = new PsnModel();
            $aPsnInfos = $oPsnModel->selectPsnById($oUser->getId());

            $this->setSessionValues([
                'user' => $oUser,
                'psn' => $aPsnInfos,
                'isAuthentified' => true
            ]);

            return $this->redirect();
        }

        return $this->render('auth', 'index');
    }

    /**
     * Créée un nouvel utilisateur, stocke l'objet Users en session puis redirige sur l'accueil
     *
     * @return $this
     */
    public function registrationAction()
    {
        if (!empty($_POST)) {
            $aInfosUser = [];
            $sUserEmail = (string) htmlspecialchars(trim($_POST['email']));
            $oEmailValidator = new EmailValidator();
            $bEmailIsValid = $oEmailValidator->isValid($sUserEmail);

            if (!$bEmailIsValid) {
                $this->setFlashMessage($oEmailValidator->errorMessage);

                return $this->redirect('auth', 'registration');
            }

            $oModelUser = new UserModel();

            if ($oModelUser->ifUserAlreadyExist($sUserEmail)) {
                $this->setFlashMessage("Un compte a déjà été crée avec cette adresse email.");

                return $this->redirect('auth', 'registration');
            }

            $this->startSession();
            $this->setSessionValues(['email' => $sUserEmail]);

            $sUsername = (string) htmlspecialchars(trim($_POST['username']));
            $oStandarValidator = new StandardValidator();
            $bUsernameIsValid = $oStandarValidator->stringLenght($sUsername, 3, 50);

            if (!$bUsernameIsValid) {
                $this->setFlashMessage($oStandarValidator->errorMessage);

                return $this->redirect('auth', 'registration');
            }

            if ($oModelUser->selectUserByUsernameOrEmail($sUsername)) {
                $this->setFlashMessage("Ce nom d'utilisateur est déjà utilisé, veuillez en choisir un autre.");

                return $this->redirect('auth', 'registration');
            }

            $_SESSION['username'] = $sUsername;

            $sPassword = (string) htmlspecialchars(trim($_POST['password']));
            $sConfirmPassword = (string) htmlspecialchars(trim($_POST['confirm-password']));
            $oPasswordValidator = new PasswordValidator();
            $bPasswordIsValid = $oPasswordValidator->isValid($sPassword, $sConfirmPassword);

            if (!$bPasswordIsValid) {
                $this->setFlashMessage($oPasswordValidator->errorMessage);

                return $this->redirect('auth', 'registration');
            }

            $sHashPassword = password_hash($sPassword, PASSWORD_BCRYPT);

            $aInfosUser['email'] = $sUserEmail;
            $aInfosUser['username'] = $sUsername;
            $aInfosUser['password'] = $sHashPassword;

            $oModelUser->insertUserByInfosUser($aInfosUser);
            $aUser = $oModelUser->selectUserByUsernameOrEmail($aInfosUser['email']);
            $oUser = new Users($aUser);

            $_SESSION['user'] = $oUser;
            $_SESSION['isAuthentified'] = true;
            $this->setFlashMessage('Votre compte a été crée avec succès.', false);

            return $this->redirect();
        }

        return $this->render('auth', 'registration');
    }

    /**
     * Détruit la session puis redirige sur l'accueil
     *
     * @return $this
     */
    public function disconnectAction()
    {
        $this->destroySession();

        return $this->redirect();
    }

}
