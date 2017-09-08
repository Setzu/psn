<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 08/06/16
 * Time: 13:01
 */

namespace Ozyris\Controller;

use Ozyris\Model\PsnModel;
use Ozyris\Model\TrophyModel;

class IndexController extends AbstractController
{

    public function indexAction()
    {
        // @TODO : Récupérer cookie de session
        $aPsnInfos = $aListeActualites =[];
        $isAuth = false;
        $oPsnModel = new PsnModel();

        if (array_key_exists('isAuthentified', $_SESSION) && $_SESSION['isAuthentified']) {
            $isAuth = true;
            $oUser = $this->getUser();
            $aPsnInfos = $oPsnModel->selectPsnById($oUser->getId());
            $this->setSessionValues(['psn' => $aPsnInfos]);
        }

        $oTrophyModel = new TrophyModel();
        $aLastPlatinumTrophies = $oTrophyModel->selectThreeLastPlatinumTrophies();

        if (count($aLastPlatinumTrophies) > 0) {
            for ($i = 0; count($aLastPlatinumTrophies) > $i; $i++) {
                $aListeActualites['psn_id' . $i] = $oPsnModel->selectPsnIdById($aLastPlatinumTrophies[$i]['id_psn']);
                $aListeActualites['avatar' . $i] = $oPsnModel->selectAvatarMById($aLastPlatinumTrophies[$i]['id_psn']);
                $aListeActualites['trophy_type' . $i] = $aLastPlatinumTrophies[$i]['trophy_type'];
                $aListeActualites['trophy_name' . $i] = $aLastPlatinumTrophies[$i]['trophy_name'];
                $aListeActualites['date_obtention' . $i] = $aLastPlatinumTrophies[$i]['date_obtention'];
            }
        }
echo'<pre>';var_dump($aListeActualites);die;
        $this->setVariables([
            'aPsnInfos' => $aPsnInfos,
            'aListeActualites' => $aListeActualites,
            'isAuthentified' => $isAuth
        ]);

        return $this->render();
    }
}
