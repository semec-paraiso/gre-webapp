<?php

namespace GRE\View\Helper;

use Cake\View\Helper;

class ButtonGroupHelper extends Helper
{
    public $helpers = ['Html', 'Button'];
    
    public function render(array $options = []) : string
    {
        $defaultOptions = [
            'buttons' => [],
            'options' => [],
        ];
        $options = array_merge($defaultOptions, $options);
        
        $buttons = $options['buttons'];
        $options = $options['options'];
        
        $options = $this->addClass($options, 'btn-group');
        
        $buttonsHtml = '';
        
        foreach ($buttons as $button) {
            $buttonsHtml .= $this->Button->render($button);
        }
        
        return $this->Html->tag('div', $buttonsHtml, $options);
    }
}