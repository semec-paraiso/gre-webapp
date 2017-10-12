<?php

namespace GRE\Model\Table;

class MunicipiosTable extends Table
{
    public function initialize(array $config)
    {
        parent::initialize($config);
        
        $this->belongsTo('Ufs');
    }
}