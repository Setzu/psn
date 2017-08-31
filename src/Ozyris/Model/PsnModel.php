<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 29/08/17
 * Time: 16:53
 */

namespace Ozyris\Model;


class PsnModel extends AbstractModel
{

    /**
     * @param int $userId
     * @param array $aPsn
     * @return bool
     * @throws \Exception
     */
    public function addPsn($userId, array $aPsn)
    {
        $sql = "INSERT INTO psn (user_id, psn_id, country, avatar_xl, avatar_m, friends_count, trophy_level, progress, bronze, silver, gold, platinum)
VALUES (:user_id, :psn_id, :country, :avatar_xl, :avatar_m, :friends_count, :trophy_level, :progress, :bronze, :silver, :gold, :platinum)";
        $stmt = $this->bdd->prepare($sql);

        if (
            !array_key_exists('profile', $aPsn) ||
            !array_key_exists('onlineId', $aPsn['profile']) ||
            !array_key_exists('friendsCount', $aPsn['profile']) ||
            !array_key_exists('trophySummary', $aPsn['profile'])
        ) {
            throw new \Exception('Une clé est manquante dans les infos liées au PSN.');
        }

        $sAvatarXl = $sAvatarM = '';
        $aUserProfil = $aPsn['profile'];
        $sPsnId = $aUserProfil['onlineId'];
        $sCountry = array_key_exists('languagesUsed', $aUserProfil) ? $aUserProfil['languagesUsed'][0] : null;
        $iFriendsCount = $aPsn['profile']['friendsCount'];
        $iLevel = $aPsn['profile']['trophySummary']['level'];
        $iProgress = $aPsn['profile']['trophySummary']['progress'];
        $iBronze = $aPsn['profile']['trophySummary']['earnedTrophies']['bronze'];
        $iSilver = $aPsn['profile']['trophySummary']['earnedTrophies']['silver'];
        $iGold = $aPsn['profile']['trophySummary']['earnedTrophies']['gold'];
        $iPlatinum = $aPsn['profile']['trophySummary']['earnedTrophies']['platinum'];

        if (array_key_exists('avatarUrls', $aUserProfil)) {
            foreach ($aUserProfil['avatarUrls'] as $aValue) {
                if ($aValue['size'] == 'xl') {
                    $sAvatarXl = $aValue['avatarUrl'];
                } else {
                    $sAvatarM = $aValue['avatarUrl'];
                }
            }
        }

//        $sSerializedPsnInfos = serialize($aPsn);
        $iUserId = (int) $userId;

        try {
            $stmt->bindParam(':user_id', $iUserId);
            $stmt->bindParam(':psn_id', $sPsnId);
            $stmt->bindParam(':country', $sCountry);
            $stmt->bindParam(':avatar_xl', $sAvatarXl);
            $stmt->bindParam(':avatar_m', $sAvatarM);
            $stmt->bindParam(':friends_count', $iFriendsCount);
            $stmt->bindParam(':trophy_level', $iLevel);
            $stmt->bindParam(':progress', $iProgress);
            $stmt->bindParam(':bronze', $iBronze);
            $stmt->bindParam(':silver', $iSilver);
            $stmt->bindParam(':gold', $iGold);
            $stmt->bindParam(':platinum', $iPlatinum);
//            $stmt->bindParam(':serialized_psn_infos', $sSerializedPsnInfos);

            if (!$stmt->execute()) {
//                $aSqlError = $stmt->errorInfo();
                throw new \Exception(parent::SQL_ERROR);
            }
        } catch(\Exception $e) {
            die($e->getMessage());
        }

        return $stmt->closeCursor();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function selectPsnById($id)
    {
        $sql = "SELECT * FROM psn WHERE id = :id";
        $stmt = $this->bdd->prepare($sql);
        $iId = (int) $id;

        try {
            $stmt->bindParam(':id', $iId);

            if (!$stmt->execute()) {
//                $aSqlErrors = $stmt->errorInfo();
                throw new \Exception(parent::SQL_ERROR);
            }

        } catch (\Exception $e) {
            die($e->getMessage());
        }

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function updatePsnInfos()
    {

    }

}