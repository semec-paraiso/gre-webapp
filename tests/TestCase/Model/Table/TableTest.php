<?php

namespace GRE\Test\TestCase\Model\Table;

use Cake\TestSuite\TestCase;
use Cake\ORM\TableRegistry;

/**
 * Caso de teste para o repositório \GRE\Model\Table\Table
 */
class TableTest extends TestCase
{
    /**
     * Repositório a ser testado
     *
     * @var \GRE\Model\Table\Table
     */
    public $Table;
    
    /**
     * Configuração dos testes
     */
    public function setUp()
    {
        parent::setUp();
        $this->Table = TableRegistry::get('GRE\Model\Table\Table');
    }
    
    /**
     * Teste dos métodos setFilter() e getFilter()
     */
    public function testGetAndSetFilters()
    {
        $filters = [
            'foo' => 'bar',
            'test' => 'example',
        ];
        $this->Table->setFilters($filters);
        
        $this->assertEquals($this->Table->getFilters(), $filters);
    }
    
    /**
     * Teste do método filterData()
     */
    public function testFilterData()
    {
        $keys = [
            'foo',
            'bar',
        ];
        $data = [
            'another' => 'another-value',
            'foo' => 'foo-value',
            'test2' => 'test-value',
            'bar' => 'bar-value',
            'test' => 'test-value',
        ];
        $expected = [
            'foo' => 'foo-value',
            'bar' => 'bar-value',
        ];
        $this->assertEquals($this->Table->filterData($data, $keys), $expected);
    }
}
