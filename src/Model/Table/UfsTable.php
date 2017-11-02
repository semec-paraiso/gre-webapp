<?php

namespace GRE\Model\Table;

/**
 * Repositório da entidade Uf
 * 
 */
class UfsTable extends Table
{
    /**
     * Instruções de inicialização
     * 
     * @param array $config
     */
    public function initialize(array $config)
    {
        parent::initialize($config);
        
        $this->setDisplayField('sigla');
    }
    
    /**
     * Retorna a relação de UFs para popular um select
     * 
     * @param array $options
     * @return array Array com as siglas para população de selects
     */
    public function getList() : array
    {
        return $this->find('list', [
            'order' => 'Ufs.sigla ASC',
        ])->toArray();
    }
}
