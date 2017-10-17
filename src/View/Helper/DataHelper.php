<?php

namespace GRE\View\Helper;

use Cake\View\Helper;

class DataHelper extends Helper
{
    public $helpers = ['Html', 'Icon'];
    
    public function display($key = '', $value = '', array $options = []) : string
    {
        $defaultOptions = [
            'class'  => '',
            'key'    => [],
            'value'  => [],
            'escape' => false,
        ];
        $options = array_merge($defaultOptions, $options);
        
        $options = $this->addClass($options, 'gre-data');
        
        $defaultKeyOptions = [
            'class' => '',
        ];
        $keyOptions = array_merge($defaultKeyOptions, $options['key']);
        $keyOptions = $this->addClass($keyOptions, 'gre-data-key');
        unset($options['key']);
        
        $defaultValueOptions = [
            'class' => '',
        ];
        $valueOptions = array_merge($defaultValueOptions, $options['value']);
        $valueOptions = $this->addClass($valueOptions, 'gre-data-value');
        unset($options['value']);
        
        $output  = $this->Html->tag('div', $key, $keyOptions);
        $output .= $this->Html->tag('div', $value, $valueOptions);
        
        return $this->Html->tag('div', $output, $options);
    }
    
    /**
     * Apresetenda um valor booleando na forma de "Sim" ou "Não", ou conforme
     * estiver definido na chave `values` do parâmetro `options`
     * 
     * @param string $key
     * @param int $value
     * @param array $options
     * @return string
     */
    public function yesOrNo($key = '', $value = 0, array $options = []) : string
    {
        $defaultOptions = [
            'values' => [
                0 => $this->Icon->render('nao', ['class' => 'text-danger']) . ' Não',
                1 => $this->Icon->render('sim', ['class' => 'text-success']) . ' Sim',
            ],
            'escape' => false,
        ];
        $options = array_merge($defaultOptions, $options);
        
        $value = $options['values'][$value];
        unset($options['values']);
        
        return $this->display($key, $value, $options);
    }
}
