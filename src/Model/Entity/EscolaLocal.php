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

    /**
     * Obtém a quantidade de compartilhamentos definidos na entidade EscolaLocal
     * 
     * @return int
     */
    protected function _getQtdeCompartilhamentos()
    {
        $qtde = 0;
        if (isset($this->escola_local_compartilhamentos)) {
            $qtde += count($this->escola_local_compartilhamentos);
        } else {
            trigger_error("A contagem de compartilhamentos pode estar incorreta.", E_USER_WARNING);
        }
        return $qtde; 
    }
}
