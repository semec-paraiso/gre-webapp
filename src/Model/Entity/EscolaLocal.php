<?php

namespace GRE\Model\Entity;

/**
 * Entidade EscolaLocal
 * 
 * @property int $qtdeSalas Quantidade de salas de aula da escola
 */
class EscolaLocal extends Entity
{
    /**
     * Retorna a quantidade de salas de aula do local
     * 
     * @return int
     */
    protected function _getQtdeSalas()
    {
        $qtde = 0;
        if (isset($this->escola_salas)) {
            $qtde += count($this->escola_salas);
        }
        return $qtde; 
    }
}
