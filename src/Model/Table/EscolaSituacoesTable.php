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
    
    /**
     * Obtém a lista de situações de funcionamento possíveis para a escola
     * 
     * @return array Array para popular select
     */
    public function getList() : array
    {
        return $this->find('list')->toArray();
    }
}
