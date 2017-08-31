<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 29/08/17
 * Time: 15:56
 */

namespace Ozyris\Form\Validator;


class UsernameValidator
{
    const IS_EMPTY = 'Vous devez saisir un mot de passe et le confirmer.';
    const INVALID = 'Le nom d\'utilisateur doit contenir entre 8 et 50 caractères alphanumériques. ';

    const USERNAME_PATTERN = '/^[a-zA-Z0-9]{8,50}$/';

    public $errorMessage = '';

    /**
     * @param string $value
     * @return bool
     */
    public function isValid($value = '')
    {

        if (!preg_match(self::USERNAME_PATTERN, $value)) {
            $this->errorMessage = self::INVALID;

            return false;
        }

        return true;
    }
}