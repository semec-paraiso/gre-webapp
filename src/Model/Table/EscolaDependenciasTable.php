<?php

namespace GRE\Model\Table;

class EscolaDependenciasTable extends Table
{
    public function initialize(array $config)
    {
        $this->belongsTo('EscolaDependenciaTipos');
    }
}
