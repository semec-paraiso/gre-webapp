<?php

namespace GRE\Formatting;

/**
 * Formatação de datas
 * 
 */
class Date
{
    /**
     * Converte uma data em formato `dd/mm/yyyy` para o formato `yyyy-mm-dd`
     * 
     * @param string $date
     * @return string
     */
    public static function brToPhp($date)
    {
        return implode('-', array_reverse(explode('/', $date)));
    }
}
