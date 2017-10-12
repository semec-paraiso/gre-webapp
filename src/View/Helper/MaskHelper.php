<?php

namespace GRE\View\Helper;

use Cake\View\Helper;
use GRE\Formatting\Masker;

class MaskHelper extends Helper
{
    protected $_masker;

    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->_masker = new Masker();
    }

    public function cep(string $cep) : string
    {
        return $this->_masker->cep($cep);
    }
}
