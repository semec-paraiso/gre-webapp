<?php

namespace GRE\Formatting;

/**
 * Classe para mascaramento de expressões
 *
 */
class Masker
{
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
}
