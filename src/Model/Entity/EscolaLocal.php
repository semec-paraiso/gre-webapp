<?php

namespace GRE\Model\Entity;

use Exception;

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
        if (!isset($this->escola_salas)) {
            throw new Exception('As salas de aula não estão definidas na entidade.');
        }
        return count($this->escola_salas); 
    }

    /**
     * Obtém a quantidade de compartilhamentos definidos na entidade EscolaLocal
     * 
     * @return int
     * @throws Exception
     */
    protected function _getQtdeCompartilhamentos()
    {
        if (!isset($this->escola_local_compartilhamentos)) {
            throw new Exception("Os compartilhamentos não estão definidos na entidade.");
        } 
        return count($this->escola_local_compartilhamentos); 
    }
}
