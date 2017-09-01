<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 01/09/17
 * Time: 16:48
 */

namespace Ozyris\Model;


class TokensModel extends AbstractModel
{

    /**
     * @param int $userId
     * @param array $aTokens
     * @return bool
     */
    public function insertTokens($userId, array $aTokens)
    {
        $sql = "INSERT INTO psn_tokens (user_id, oauth, refresh, npsso) VALUES (:user_id, :oauth, :refresh, :npsso)";
        $stmt = $this->bdd->prepare($sql);

        $iUserId = (int) $userId;

        try {
            $stmt->bindParam(':user_id', $iUserId);
            $stmt->bindParam(':oauth', $aTokens['oauth']);
            $stmt->bindParam(':refresh', $aTokens['refresh']);
            $stmt->bindParam(':npsso', $aTokens['npsso']);
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
     * @param int $userId
     * @return mixed
     */
    public function selectTokensByUserId($userId)
    {
        $sql = "SELECT * FROM psn_tokens WHERE user_id = :user_id";
        $stmt = $this->bdd->prepare($sql);

        $iUserId = (int) $userId;

        try {
            $stmt->bindParam(':user_id', $iUserId);

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