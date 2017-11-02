<?php

namespace GRE\Model\Table;

/**
 * Repositório EscolaSalas
 *
 */
class EscolaSalasTable extends Table
{
    /**
     * Instruções de inicialização
     *
     * @param array $config
     */
    public function initialize(array $config)
    {
        $this->belongsTo('EscolaLocais');
    }
}
