<?php

namespace GRE\Model\Entity;

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
        if (isset($this->escola_locais)) {
            foreach ($this->escola_locais as $escolaLocal) {
                $qtde += $escolaLocal->qtdeSalas;
            } 
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
        if (isset($this->escola_locais)) {
            foreach ($this->escola_locais as $escolaLocal) {
                $qtde += $escolaLocal->qtdeCompartilhamentos;
            }
        } else {
            trigger_error("A contagem de compartilhamentos pode estar incorreta.", E_USER_WARNING);
        }
        return $qtde;
    }
}
