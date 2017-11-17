<?php

namespace GRE\View\Helper;

use Exception;
use Cake\View\Helper;
use GRE\Formatting\Masker;

/**
 * Helper para aplicação de máscaras em strings
 */
class MaskHelper extends Helper
{
    /**
     * Conjunto de mascaras a serem utilizadas
     *
     * @var array
     */
    protected $_masks = [
        'cep' => '#####-###',
        'inepEscola' => '##.#####-#',
    ];
    
    /**
     * Aplica uma máscara
     *
     * @param string $value
     * @param string $mask
     * @return string
     */
    public function mask(string $value, string $mask) : string
    {
        return Masker::mask($value, $mask);
    }
    
    /**
     * Chamada de dinâmica para aplicação de uma máscara
     *
     * @param string $method
     * @param string $params
     * @return string
     */
    public function __call($method, $params)
    {
        if (!isset($this->_masks[$method])) {
            throw new Exception("Invalid mask '{$method}'");
        }
        
        if (!isset($params[0]) || !is_string($params[0])) {
            throw new Exception("Invalid parameter 1 for MaskHelper::{$method}()");
        }
        
        return $this->mask($params[0], $this->_masks[$method]);
    }
}
