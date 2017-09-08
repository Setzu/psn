<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 07/09/17
 * Time: 17:09
 */

namespace Ozyris\Model;


class TrophyModel extends AbstractModel
{

    const BRONZE = 'bronze';
    const SILVER = 'silver';
    const GOLD = 'gold';
    const PLATINUM = 'platinum';

    /**
     * @param $psnId
     * @param \stdClass $oTrophy
     * @return bool
     */
    public function insertTrophy($psnId, \stdClass $oTrophy)
    {
        $sql = "INSERT INTO trophies (id_psn, game, trophy_icon, platform, trophy_type, date_obtention)
VALUES (:id_psn, :game, :trophy_icon, :platform, 'platinum', :date_obtention)";
        $stmt = $this->bdd->prepare($sql);

        try {
            $stmt->bindParam(':id_psn', $psnId);
            $stmt->bindParam(':trophy_icon', $oTrophy->trophyTitleIconUrl);
            $stmt->bindParam(':game', $oTrophy->trophyTitleName);
            $stmt->bindParam(':platform', $oTrophy->trophyTitlePlatfrom);
            $stmt->bindParam(':date_obtention', $oTrophy->lastUpdateDate);

            if (!$stmt->execute()) {
//                echo'<pre>';var_dump($stmt->errorInfo());die;
                throw new \Exception(parent::SQL_ERROR);
            }
        } catch(\Exception $e) {
            die($e->getMessage());
        }

        return $stmt->closeCursor();
    }

    public function selectTrophyById($id) {

    }

    /**
     * @return array
     */
    public function selectThreeLastPlatinumTrophies()
    {
        $sql = 'SELECT * FROM trophies WHERE trophy_type = :trophy_type ORDER BY date_obtention DESC LIMIT 3';
        $stmt = $this->bdd->prepare($sql);
        $sTrophyType = self::PLATINUM;

        try {
            $stmt->bindParam(':trophy_type', $sTrophyType);
            if (!$stmt->execute()) {
//                echo'<pre>';var_dump($stmt->errorInfo());die;
                throw new \Exception(parent::SQL_ERROR);
            }

        } catch (\Exception $e) {
            die($e->getMessage());
        }

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}