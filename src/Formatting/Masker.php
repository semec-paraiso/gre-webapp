<?php

namespace GRE\Formatting;

/**
 * Classe para mascaramento de expressões
 *
 */
class Masker
{
    /**
     * Máscaras pré definidas
     *
     * @var array
     */
    protected $_masks = [
        'cep' => '#####-###',
    ];

    /**
     * Aplica uma máscara específica
     *
     * @param string $value
     * @param string $mask
     * @return string
     */
    public static function mask(string $value, string $mask) : string
    {
        $maskared = '';
        $k = 0;
        for ($i = 0; $i <= strlen($mask) - 1; $i++) {
            if ($mask[$i] == '#') {
                if (isset($value[$k])) {
                    $maskared .= $value[$k++];
                }
            } else {
                if (isset($mask[$i])) {
                    $maskared .= $mask[$i];
                }
            }
        }
        return $maskared;
    }

    /**
     * Aplica uma máscara por chamada dinâmica. O nome do método a ser invocado
     * deve ser uma chava no array `_maks`
     *
     * @param string $name
     * @param array $arguments
     * @return string
     */
    public function __call(string $name, array $arguments = []) : string
    {
        if (!isset($this->_masks[$name])) {
            return trigger_error("Undefined mask '{$name}'", E_USER_WARNING);
        }
        if (!isset($arguments[0]) || !is_string($arguments['0'])) {
            return trigger_error('Invalid value for masking', E_USER_WARNING);
        }
        return $this->mask($arguments[0], $this->_masks[$name]);
    }
}
