<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 08/06/16
 * Time: 13:01
 */

namespace Ozyris\Controller;

use Ozyris\Model\PsnModel;

class IndexController extends AbstractController
{

    public function indexAction()
    {
        // @TODO : Récupérer cookie de session
        $aPsnInfos = [];
        $isAuth = false;

        if (array_key_exists('isAuthentified', $_SESSION) && $_SESSION['isAuthentified']) {

            $isAuth = true;
            $oUser = $this->getUser();
            $oPsnModel = new PsnModel();
            $aPsnInfos = $oPsnModel->selectPsnById($oUser->getId());
            $this->setSessionValues(['psn' => $aPsnInfos]);

        }

        $this->setVariables([
            'aPsnInfos' => $aPsnInfos,
            'isAuthentified' => $isAuth
        ]);

        return $this->render();
    }
}
