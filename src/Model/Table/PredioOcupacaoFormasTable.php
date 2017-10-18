<?php

namespace GRE\Model\Table;

/**
 * Repositório PredioOcupacaoFormas
 * 
 */
class PredioOcupacaoFormasTable extends Table
{
    /**
     * Instruções de inicialização
     * 
     * @param array $config
     */
    public function initialize(array $config)
    {
        $this->setDisplayField('nome');
    }
}
