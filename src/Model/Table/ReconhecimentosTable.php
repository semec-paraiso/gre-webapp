<?php

namespace GRE\Model\Table;

/**
 * Repositório `Reconhecimentos`
 * 
 */
class ReconhecimentosTable extends Table
{
    /**
     * Instruções de inicialização da classe
     * 
     * @param array $config
     */
    public function initialize(array $config)
    {
        parent::initialize($config);
        
        $this->setEntityClass('Reconhecimento');
    }
}
