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
    
    /**
     * Obtém a lista de formas de ocupação de prédio escolar
     * 
     * @return array Array para popular selects
     */
    public function getList()
    {
        return $this->find('list')->toArray();
    }
}
