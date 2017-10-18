<?php

namespace GRE\Model\Table;

/**
 * Repositório EscolaLocalTipos
 * 
 */
class EscolaLocalTiposTable extends Table
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
