<?php

namespace GRE\View\Helper;

use Cake\View\Helper;
use Cake\Core\Configure;
use GRE\Formatting\Masker;

class MaskHelper extends Helper
{
    /**
     * Conjunto de mascaras a serem utilizadas
     *
     * @var array
     */
    protected $_masks = [];

    /**
     * 
     * @param array $config
     * Utilize a chave 'masks' para definir o arquivo de configuração
     * com as máscaras a serem utilizadas
     */
    public function initialize(array $config)
    {
        parent::initialize($config);
        
        $defaultConfig = [
            'masks' => null,
        ];
        $config = array_merge($defaultConfig, $config);
        
        Configure::load($config['masks']);
        $this->_masks = Configure::read('Masks');
    }
    
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
            return trigger_error("Invalid mask '{$method}'");
        }
        if (!isset($params[0]) || !is_string($params[0])) {
            return trigger_error("Invalid parameter 1 for MaskHelper::{$method}()");
        }
        return $this->mask($params[0], $this->_masks[$method]);
    }
}
