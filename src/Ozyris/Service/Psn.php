<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 29/08/17
 * Time: 14:59
 */

namespace Ozyris\Service;


class Psn extends AbstractService
{
    protected $id;
    protected $userId;
    protected $psnId;
//    protected $psnPassword;
    protected $country;
    protected $avatarM;
    protected $avatarXL;
    protected $bronze;
    protected $silver;
    protected $gold;
    protected $platinum;
    protected $date_creation;
    protected $last_update;

    /*******************/
    /*     METHODS     */
    /*******************/

    /**
     * Psn constructor.
     * @param array $aDonnees
     */
    public function __construct(array $aDonnees)
    {
        if (!empty($aDonnees)) {
            try {
                $this->hydrate($this, $aDonnees);
            } catch(\Exception $e) {
                echo $e->getMessage();
            }
        }
    }

    /*******************/
    /*    ACCESSERS    */
    /*******************/

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param mixed $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    /**
     * @return mixed
     */
    public function getPsnId()
    {
        return $this->psnId;
    }

    /**
     * @param mixed $psnId
     */
    public function setPsnId($psnId)
    {
        $this->psnId = $psnId;
    }

    /**
     * @return mixed
     */
//    public function getPsnPassword()
//    {
//        return $this->psnPassword;
//    }

    /**
     * @param mixed $psnPassword
     */
//    public function setPsnPassword($psnPassword)
//    {
//        $this->psnPassword = $psnPassword;
//    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param mixed $country
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }

    /**
     * @return mixed
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * @param mixed $avatar
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;
    }

    /**
     * @return mixed
     */
    public function getDateCreation()
    {
        return $this->date_creation;
    }

    /**
     * @param mixed $date_creation
     */
    public function setDateCreation($date_creation)
    {
        $this->date_creation = $date_creation;
    }

    /**
     * @return mixed
     */
    public function getLastUpdate()
    {
        return $this->last_update;
    }

    /**
     * @param mixed $last_update
     */
    public function setLastUpdate($last_update)
    {
        $this->last_update = $last_update;
    }
}