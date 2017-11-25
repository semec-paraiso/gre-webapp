<?php

namespace GRE\Model\Entity;

use Exception;

/**
 * Entidade Escola
 * 
 * @property int $qtdeSalas Quantidade de salas de aula da escola
 * @property int $qtdeCompartilhamentos Quantidade de compartilhamentos de locais
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
        if (!isset($this->escola_locais)) {
            throw new Exception("Os locais de funcionamento não estão carregados na entidade.");
        }
        foreach ($this->escola_locais as $escolaLocal) {
            $qtde += $escolaLocal->qtdeSalas;
        } 
        return $qtde;
    }

    /**
     * Obtém a quantidade de compartilhamentos de local definidos na entidade Escola
     * 
     * @return int
     */
    protected function _getQtdeCompartilhamentos()
    {
        $qtde = 0;
        if (!isset($this->escola_locais)) {
            throw new Exception("Os locais de funcionamento não estão carregados na entidade.");
        }
        foreach ($this->escola_locais as $escolaLocal) {
            $qtde += $escolaLocal->qtdeCompartilhamentos;
        }
        return $qtde;
    }
}
