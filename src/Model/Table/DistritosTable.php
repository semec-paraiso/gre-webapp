<?php

namespace GRE\Model\Table;

class DistritosTable extends Table
{
    public function initialize(array $config)
    {
        parent::initialize($config);
        
        $this->belongsTo('Municipios');
    }
}