<?php

namespace GRE\View\Helper;

use Cake\View\Helper;

class ToolbarHelper extends Helper
{
    public $helpers = ['Html', 'ButtonGroup'] ;
    
    public function render(array $options = []) : string
    {
        $defaultOptions = [
            'groups'  => [],
            'options' => [],
        ];
        $options = array_merge($defaultOptions, $options);
        
        $groups  = $options['groups'];
        $options = $options['options'];
        
        $options = $this->addClass($options, 'btn-toolbar');
        
        $groupsHtml = '';
        
        foreach ($groups as $group) {
            $groupsHtml .= $this->ButtonGroup->render($group);
        }
        
        return $this->Html->tag('div', $groupsHtml, $options);
    }
}
