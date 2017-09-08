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
     * @param $sPsnEmail
     * @param array $aPsn
     * @return bool
     * @throws \Exception
     */
    public function addPsn($userId, $sPsnEmail, array $aPsn)
    {
        $sql = "INSERT INTO psn (user_id, psn_email, psn_id, country, avatar_xl, avatar_m, friends_count, trophy_level, progress, bronze, silver, gold, platinum)
VALUES (:user_id, :psn_email, :psn_id, :country, :avatar_xl, :avatar_m, :friends_count, :trophy_level, :progress, :bronze, :silver, :gold, :platinum)";
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

        if (array_key_exists('avatarUrls', $aPsn['profile'])) {
            foreach ($aPsn['profile']['avatarUrls'] as $aValue) {
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
            $stmt->bindParam(':psn_id', $aPsn['profile']['onlineId']);
            $stmt->bindParam(':psn_email', $sPsnEmail);
            $stmt->bindParam(':country', $aPsn['profile']['languagesUsed'][0]);
            $stmt->bindParam(':avatar_xl', $sAvatarXl);
            $stmt->bindParam(':avatar_m', $sAvatarM);
            $stmt->bindParam(':friends_count', $aPsn['profile']['friendsCount']);
            $stmt->bindParam(':trophy_level', $aPsn['profile']['trophySummary']['level']);
            $stmt->bindParam(':progress', $aPsn['profile']['trophySummary']['progress']);
            $stmt->bindParam(':bronze', $aPsn['profile']['trophySummary']['earnedTrophies']['bronze']);
            $stmt->bindParam(':silver', $aPsn['profile']['trophySummary']['earnedTrophies']['silver']);
            $stmt->bindParam(':gold', $aPsn['profile']['trophySummary']['earnedTrophies']['gold']);
            $stmt->bindParam(':platinum', $aPsn['profile']['trophySummary']['earnedTrophies']['platinum']);
//            $stmt->bindParam(':serialized_psn_infos', $sSerializedPsnInfos);

            if (!$stmt->execute()) {
//                echo'<pre>';var_dump($stmt->errorInfo());die;
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

    /**
     * @param int $id
     * @return string
     */
    public function selectPsnIdById($id)
    {
        $sql = "SELECT psn_id FROM psn WHERE id = :id";
        $stmt = $this->bdd->prepare($sql);
        $iId = (int) $id;

        try {
            $stmt->bindParam(':id', $iId);

            if (!$stmt->execute()) {
//                echo'<pre>';var_dump($stmt->errorInfo());die;
                throw new \Exception(parent::SQL_ERROR);
            }

        } catch (\Exception $e) {
            die($e->getMessage());
        }

        return $stmt->fetchColumn();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function selectAvatarMById($id)
    {
        $sql = "SELECT avatar_m FROM psn WHERE id = :id";
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

        return $stmt->fetchColumn();
    }

    public function updatePsnInfos(array $aPsnInfos)
    {
        $sql = "UPDATE psn 
SET avatar_xl = :avatar_xl, avatar_m = :avatar_m, friends_count = :friends_count, trophy_level = :trophy_level, 
progress = :progress, bronze = :bronze, silver = :silver, gold = :gold, platinum = :platinum, last_update = :last_update
WHERE psn_id = :psn_id";

        $stmt = $this->bdd->prepare($sql);

        try {
            $stmt->bindParam(':psn_id', $aPsnInfos['profile']['onlindeId']);
            $stmt->bindParam(':avatar_xl', $aPsnInfos['profile']['avatarUrls'][0]['avatar_xl']);
            $stmt->bindParam(':avatar_m', $aPsnInfos['profile']['avatarUrls'][1]['avatar_m']);
            $stmt->bindParam(':friends_count', $aPsnInfos['profile']['friends_count']);
            $stmt->bindParam(':trophy_level', $aPsnInfos['profile']['trophySummary']['level']);
            $stmt->bindParam(':progress', $aPsnInfos['profile']['trophySummary']['progress']);
            $stmt->bindParam(':bronze', $aPsnInfos['profile']['trophySummary']['earnedTrophies']['bronze']);
            $stmt->bindParam(':silver', $aPsnInfos['profile']['trophySummary']['earnedTrophies']['silver']);
            $stmt->bindParam(':gold', $aPsnInfos['profile']['trophySummary']['earnedTrophies']['gold']);
            $stmt->bindParam(':platinum', $aPsnInfos['profile']['trophySummary']['earnedTrophies']['platinum']);
            $stmt->bindParam(':last_update', date('d-m-Y H:i:s'));

            if (!$stmt->execute()) {
//                $aSqlErrors = $stmt->errorInfo();
                throw new \Exception(parent::SQL_ERROR);
            }

        } catch (\Exception $e) {
            die($e->getMessage());
        }

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

}