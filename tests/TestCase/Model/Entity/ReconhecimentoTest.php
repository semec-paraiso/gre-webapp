<?php

namespace GRE\Test\TestCase\Model\Entity;

use Cake\TestSuite\TestCase;
use Cake\ORM\TableRegistry;
use Cake\I18n\Date;

/**
 * Caso de teste para a entidade \GRE\Model\Entity\Reconhecimento
 */
class ReconhecimentoTest extends TestCase
{
    /**
     * Fixtures utilizadas
     *
     * @var array
     */
    public $fixtures = [
        'app.reconhecimentos',
        'app.escolas',
    ];
    
    /**
     * Repositório Reconhecimentos
     *
     * @var \GRE\Model\Table\ReconhecimentosTable
     */
    public $Reconhecimentos;
    
    /**
     * Configurações dos testes
     */
    public function setUp()
    {
        parent::setUp();
        $this->Reconhecimentos = TableRegistry::get('Reconhecimentos');
    }
    
    /**
     * Teste do getter e setter da propriedade today
     */
    public function testSetAndGetToday()
    {
        $reconhecimento = $this->Reconhecimentos->get(1);
        $today = new Date('2017-11-25');
        $reconhecimento->setToday($today);
        $this->assertEquals($reconhecimento->getToday(), $today);
    }
    
    /**
     * Teste do método vencido()
     */
    public function testVencido()
    {
        $reconhecimento = $this->Reconhecimentos->get(1);
        $reconhecimento->setToday(new Date('2017-11-25'));
        $this->assertTrue($reconhecimento->vencido());
        
        $reconhecimento = $this->Reconhecimentos->get(2);
        $reconhecimento->setToday(new Date('2017-11-25'));
        $this->assertFalse($reconhecimento->vencido());
    }
}
