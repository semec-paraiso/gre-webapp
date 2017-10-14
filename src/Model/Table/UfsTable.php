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
     * @return array
     */
    public function getOptions(array $options = []) : array
    {
        $defaultOptions = [
            'order' => 'Ufs.sigla ASC',
        ];
        $options = array_merge($defaultOptions, $options);
        
        return parent::getOptions($options);
    }
}
