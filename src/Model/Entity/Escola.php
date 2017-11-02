<?php

namespace GRE\Model\Entity;

/**
 * Entidade Escola
 * 
 * @property int $qtdeSalas Quantidade de salas de aula da escola
 */
class Escola extends Entity
{
    /**
     * Retorna a quantidade de salas de aula da escola
     * 
     * @return int
     */
    protected function _getQtdeSalas()
    {
        $qtde = 0;
        if (isset($this->escola_locais)) {
            foreach ($this->escola_locais as $escolaLocal) {
                $qtde += $escolaLocal->qtdeSalas;
            } 
        }
        return $qtde;
    }
}
