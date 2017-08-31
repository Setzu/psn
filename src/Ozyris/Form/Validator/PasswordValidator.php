<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 30/05/16
 * Time: 15:32
 */

namespace Ozyris\Form\Validator;

class PasswordValidator extends StandardValidator
{
    const IS_EMPTY = 'Vous devez saisir un mot de passe et le confirmer.';
    const INVALID = 'Le mot de passe saisi n\'est pas valide';
    const DO_NOT_MATCH = 'Les mots de passe que vous avez saisis ne correspondent pas.';

    const PASSWORD_PATTERN = '/^[a-zA-Z0-9èéçàùâêîôûäëïöüÈÉÇÀÙÂÊÎÔÛÄËÏÖÜ_-]{8,255}$/';
    const UPPERCASE_PATTERN = '@[a-zèéçàùâêîôûäëïöü]@';
    const LOWERCASE_PATTERN = '@[A-ZÈÉÇÀÙÂÊÎÔÛÄËÏÖÜ]@';
    const NUMBER_PATTERN = '@[0-9]@';

    public $errorMessage = '';

    /**
     * @param string $value
     * @param string $confirm
     * @return bool
     */
    public function isValid($value = '', $confirm = '')
    {
        if ((string) $value !== (string) $confirm) {
            $this->errorMessage = self::DO_NOT_MATCH;

            return false;
        }

        $isContainLowerCase = preg_match(self::LOWERCASE_PATTERN, $value);
        $isContainUpperCase = preg_match(self::UPPERCASE_PATTERN, $value);
        $isContainNumber = preg_match(self::NUMBER_PATTERN, $value);
        $isPasswordMatch = preg_match(self::PASSWORD_PATTERN, $value);
        
        if (!$isContainLowerCase || !$isContainUpperCase || !$isContainNumber || !$isPasswordMatch) {
            $this->errorMessage = self::INVALID;

            return false;
        }

        return true;
    }
}