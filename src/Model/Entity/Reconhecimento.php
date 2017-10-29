<?php

namespace GRE\Model\Entity;

use Cake\I18n\Date;

/**
 * Entidade `Reconhecimento`
 * 
 */
class Reconhecimento extends Entity
{
    /**
     * Verifica se a data de vencimento do Reconhecimento é menor que a data
     * atual definida no sistema
     * 
     * @return bool
     */
    public function vencido() : bool
    {
        return Date::today()->gt($this->validade);
    }
}
