<?php

namespace GRE\Model\Table;

/**
 * Repositório da entidade EscolaSituacao
 * 
 */
class EscolaSituacoesTable extends Table
{
    /**
     * Instruções de inicialização
     * 
     * @param array $config
     */
    public function initialize(array $config)
    {
        parent::initialize($config);
        
        $this->setDisplayField('nome');
    }
}
