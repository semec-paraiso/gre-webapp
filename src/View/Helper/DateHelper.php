<?php

namespace GRE\View\Helper;

use Cake\View\Helper;
use Cake\I18n\FrozenDate;

/**
 * Helper para formatação de datas
 */
class DateHelper extends Helper
{
    /**
     * Retorna uma data no formato brasileiro: `dd/mm/yyyy`
     * 
     * @param FrozenDate $date
     * @return string
     */
    public function br($date)
    {
        if ($date instanceof FrozenDate) {
            return $date->format('d/m/Y');
        }
        return $date;
    }
}
