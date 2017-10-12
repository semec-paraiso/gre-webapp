<?php

namespace GRE\View\Helper;

use Cake\View\Helper;

class DataHelper extends Helper
{
    public $helpers = ['Html'];
    
    public function display(string $key, string $value, array $options = []) : string
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
}
