<?php

namespace GRE\Test\TestCase\Controller;

use GRE\Test\IntegrationTestCase;
use Cake\ORM\TableRegistry;

/**
 * Caso de teste para o controller Escolas
 * 
 * @cover \GRE\Controller\EscolasController
 */
class EscolasControllerTest extends IntegrationTestCase
{
    /**
     * Fixtures utilizadas
     *
     * @var array
     */
    public $fixtures = [
        'app.escolas',
        'app.escola_situacoes',
        'app.distritos',
        'app.municipios',
        'app.ufs',
    ];
    
    /**
     * Configurações pós testes
     */
    public function tearDown()
    {
        parent::tearDown();
        TableRegistry::clear();
    }
            
    /**
     * Teste da action index
     * 
     * @cover \GRE\Controller\EscolasController::index
     */
    public function testIndex()
    {
        $this->get([
            'controller' => 'escolas'
        ]);
        $this->assertRedirect([
            'controller' => 'escolas',
            'action' => 'listar',
        ]);
    }
    
    /**
     * Teste da action listar
     * 
     * @cover \GRE\Controller\EscolasController::listar
     */
    public function testListar()
    {
        $this->get([
            'controller' => 'escolas',
            'action' => 'listar',
        ]);
        $this->assertResponseOk();
        $this->assertResponseContains('NOME_CURTO_1');
        $this->assertResponseContains('NOME_CURTO_2');
        $this->assertResponseNotContains('NOME_CURTO_3');
        $this->assertResponseNotContains('NOME_CURTO_4');
        $this->assertResponseNotContains('NOME_CURTO_5');
        $this->assertResponseNotContains('NOME_CURTO_6');
    }
    
    /**
     * Teste da action listar, aplicando filtro por nome
     * 
     * @cover \GRE\Controller\EscolasController::listar
     */
    public function testListarComFiltroPorNome()
    {
        $this->get([
            'controller' => 'escolas',
            'action' => 'listar',
            '?' => [
                'nome' => 'RTO_1',
            ],
        ]);
        $this->assertResponseOk();
        $this->assertResponseContains('NOME_CURTO_1');
        $this->assertResponseNotContains('NOME_CURTO_2');
        $this->assertResponseNotContains('NOME_CURTO_3');
        $this->assertResponseNotContains('NOME_CURTO_4');
    }
    
    /**
     * Teste da action listar, aplicando filtro por situacao
     * 
     * @cover \GRE\Controller\EscolasController::listar
     */
    public function testListarComFiltroPorSituacao()
    {
        $this->get([
            'controller' => 'escolas',
            'action' => 'listar',
            '?' => [
                'situacao_id' => '2',
            ],
        ]);
        $this->assertResponseOk();
        $this->assertResponseNotContains('NOME_CURTO_1');
        $this->assertResponseContains('NOME_CURTO_2');
        $this->assertResponseNotContains('NOME_CURTO_3');
        $this->assertResponseNotContains('NOME_CURTO_4');
        $this->assertResponseNotContains('NOME_CURTO_5');
        $this->assertResponseNotContains('NOME_CURTO_6');
    }
    
    /**
     * Teste da action listar, aplicando filtro por rede
     * 
     * @cover \GRE\Controller\EscolasController::listar
     */
    public function testListarComFiltroPorRede()
    {
        $this->get([
            'controller' => 'escolas',
            'action' => 'listar',
            '?' => [
                'rede' => '0',
            ],
        ]);
        $this->assertResponseOk();
        $this->assertResponseContains('NOME_CURTO_1');
        $this->assertResponseContains('NOME_CURTO_2');
        $this->assertResponseNotContains('NOME_CURTO_3');
        $this->assertResponseContains('NOME_CURTO_4');
        $this->assertResponseContains('NOME_CURTO_5');
        $this->assertResponseNotContains('NOME_CURTO_6');
    }
    
    /**
     * Teste da action listar, limpando os filtros definidos
     * 
     * @cover \GRE\Controller\EscolasController::listar
     */
    public function testListarLimparFiltro()
    {
        $this->get([
            'controller' => 'escolas',
            'action' => 'listar',
            '?' => [
                'nome' => 'RTO_1',
                'situacao_id' => '2',
                'rede' => '0',
            ],
        ]);
        $this->assertResponseOk();
        $this->get([
            'controller' => 'escolas',
            'action' => 'listar',
            'limpar',
        ]);
        $this->assertRedirect([
            'controller' => 'escolas',
            'action' => 'listar',
        ]);
        $this->get([
            'controller' => 'escolas',
            'action' => 'listar',
        ]);
        $this->assertResponseOk();
        $this->assertResponseContains('NOME_CURTO_1');
        $this->assertResponseContains('NOME_CURTO_2');
        $this->assertResponseNotContains('NOME_CURTO_3');
        $this->assertResponseNotContains('NOME_CURTO_4');
        $this->assertResponseNotContains('NOME_CURTO_5');
        $this->assertResponseNotContains('NOME_CURTO_6');
    }
    
    /**
     * Teste da action listar_por_municipio
     * 
     * @cover \GRE\Controller\EscolasController::listarPorMunicipio
     */
    public function testListarPorMunicipio()
    {
        $this->get([
            'controller' => 'escolas',
            'action' => 'listarPorMunicipio',
            1,
        ]);
        $this->assertRedirect([
            'controller' => 'escolas',
            'action' => 'listar',
        ]);
    }
    
    /**
     * Teste da action listar_por_municipio, via ajax
     * 
     * @cover \GRE\Controller\EscolasController::listarPorMunicipio
     */
    public function testListarPorMunicipioViaAjax()
    {
        $this->configAjaxRequest();
        $this->get([
            'controller' => 'escolas',
            'action' => 'listarPorMunicipio',
            1,
        ]);
        $this->assertResponseOk();
        $this->assertResponseContains('NOME_CURTO_1');
        $this->assertResponseContains('NOME_CURTO_2');
        $this->assertResponseNotContains('NOME_CURTO_3');
        $this->assertResponseNotContains('NOME_CURTO_4');
        $this->assertResponseNotContains('NOME_CURTO_5');
        $this->assertResponseNotContains('NOME_CURTO_6');
    }
    
    /**
     * Teste da action cadastrar
     * 
     * @cover \GRE\Controller\EscolasController::cadastrar
     */
    public function testCadastrar()
    {
        $this->get([
            'controller' => 'escolas',
            'action' => 'cadastrar',
        ]);
        $this->assertResponseSuccess();
    }
    
    /**
     * Teste da action cadastrar com sucesso
     * 
     * @cover \GRE\Controller\EscolasController::cadastrar
     */
    public function testCadastrarComSucesso()
    {
        $data = [
            'situacao_id' => 1,
            'inep_codigo' => '11111',
            'nome_curto' => 'NOME_CURTO',
            'nome_longo' => 'NOME_LONGO',
            'nome_juridico' => 'NOME_JURIDICO',
            'endereco_cep' => '77777777',
            'endereco_distrito_id' => 1,
            'endereco_logradouro' => 'LOGRADOURO',
            'endereco_numero' => '111',
            'endereco_complemento' => 'COMPLEMENTO',
            'endereco_bairro' => 'BAIRRO',
        ];
        $this->post([
            'controller' => 'escolas',
            'action' => 'cadastrar',
        ], $data);
        $url = [
            'controller' => 'escolas',
            'action' => 'identificacaoExibir',
            TableRegistry::get('Escolas')->find()->last()->id,
        ];
        $this->assertRedirect($url);
    }
    
    /**
     * Teste da action cadastrar com erro
     * 
     * @cover \GRE\Controller\EscolasController::cadastrar
     */
    public function testCadastrarComErro()
    {
        $data = [];
        $this->post([
            'controller' => 'escolas',
            'action' => 'cadastrar',
        ], $data);
        $this->assertResponseSuccess();
        $this->assertResponseContains('[E-01002]');
    }
    
    /**
     * Teste da action gre-retirar, com escola válida e sucesso na operação
     */
    public function testGreRetirar()
    {
        $escolaId = 1;
        $this->get([
            'controller' => 'escolas',
            'action' => 'greRetirar',
            $escolaId,
        ]);
        $escola = TableRegistry::get('Escolas')->get($escolaId);
        $this->assertEquals($escola->rede, 0);
        $this->assertRedirect([
            'controller' => 'escolas',
            'action' => 'identificacaoExibir',
            $escolaId,
        ]);
    }
    
    /**
     * Teste da action gre-retirar, com escola válida e falha na operação
     */
    public function testGreRetirarComFalha()
    {
        $escolaId = 1;
        $escola = TableRegistry::get('Escolas')->get($escolaId);
        $escolasTable = $this->getMockForModel('Escolas');
        $escolasTable->method('greRetirar')
                     ->will($this->returnValue(false));
        $escolasTable->method('getIdentificacao')
                     ->will($this->returnValue($escola));
        TableRegistry::set('Escolas', $escolasTable);
        $this->get([
            'controller' => 'escolas',
            'action' => 'greRetirar',
            $escolaId,
        ]);
        $this->assertRedirect([
            'controller' => 'escolas',
            'action' => 'identificacaoExibir',
            $escolaId,
        ]);
    }
    
    /**
     * Teste da action gre-retirar, com escola inexistente
     */
    public function testGreRetirarEscolaInexistente()
    {
        $this->get([
            'controller' => 'escolas',
            'action' => 'greRetirar',
            999999,
        ]);
        $this->assertRedirect([
            'controller' => 'escolas',
            'action' => 'listar',
        ]);
    }
    
    /**
     * Teste da action gre-retirar, omitindo o id da escola
     */
    public function testGreRetirarEscolaIdNull()
    {
        $this->get([
            'controller' => 'escolas',
            'action' => 'greRetirar',
        ]);
        $this->assertRedirect([
            'controller' => 'escolas',
            'action' => 'listar',
        ]);
    }
    
    /**
     * Teste da action gre-retirar, com escola excluída
     */
    public function testGreRetirarEscolaExcluida()
    {
        $this->get([
            'controller' => 'escolas',
            'action' => 'greRetirar',
            3,
        ]);
        $this->assertRedirect([
            'controller' => 'escolas',
            'action' => 'listar',
        ]);
    }
    
    /**
     * Teste da action gre-integrar, com escola válida e sucesso na operação
     */
    public function testGreIntegrar()
    {
        $escolaId = 1;
        $this->get([
            'controller' => 'escolas',
            'action' => 'greIntegrar',
            $escolaId,
        ]);
        $escola = TableRegistry::get('Escolas')->get($escolaId);
        $this->assertEquals($escola->rede, 1);
        $this->assertRedirect([
            'controller' => 'escolas',
            'action' => 'identificacaoExibir',
            $escolaId,
        ]);
    }
    
    /**
     * Teste da action gre-integrar, com escola válida e falha na operação
     */
    public function testGreIntegrarComFalha()
    {
        $escolaId = 1;
        $escola = TableRegistry::get('Escolas')->get($escolaId);
        $escolasTable = $this->getMockForModel('Escolas');
        $escolasTable->method('greIntegrar')
                     ->will($this->returnValue(false));
        $escolasTable->method('getIdentificacao')
                     ->will($this->returnValue($escola));
        TableRegistry::set('Escolas', $escolasTable);
        $this->get([
            'controller' => 'escolas',
            'action' => 'greIntegrar',
            $escolaId,
        ]);
        $this->assertRedirect([
            'controller' => 'escolas',
            'action' => 'identificacaoExibir',
            $escolaId,
        ]);
    }
    
    /**
     * Teste da action gre-integrar, com escola inexistente
     */
    public function testGreIntegrarEscolaInexistente()
    {
        $this->get([
            'controller' => 'escolas',
            'action' => 'greIntegrar',
            999999,
        ]);
        $this->assertRedirect([
            'controller' => 'escolas',
            'action' => 'listar',
        ]);
    }
    
    /**
     * Teste da action gre-integrar, omitindo o id da escola
     */
    public function testGreIntegrarEscolaIdNull()
    {
        $this->get([
            'controller' => 'escolas',
            'action' => 'greIntegrar',
        ]);
        $this->assertRedirect([
            'controller' => 'escolas',
            'action' => 'listar',
        ]);
    }
    
    /**
     * Teste da action gre-integrar, com escola válida excluída
     */
    public function testGreIntegrarEscolaExcluida()
    {
        $this->get([
            'controller' => 'escolas',
            'action' => 'greIntegrar',
            3,
        ]);
        $this->assertRedirect([
            'controller' => 'escolas',
            'action' => 'listar',
        ]);
    }
    
    /**
     * Teste da action identificacao-exibir, com escola válida e sucesso na operação
     */
    public function testIdentificacaoExibir()
    {
        $this->get([
            'controller' => 'escolas',
            'action' => 'identificacaoExibir',
            1,
        ]);
        $this->assertResponseSuccess();
        $this->assertResponseContains('NOME_CURTO_1');
    }
    
    /**
     * Teste da action identificacao-exibir, com escola válida inexistente
     */
    public function testIdentificacaoExibirEscolaInexistente()
    {
        $this->get([
            'controller' => 'escolas',
            'action' => 'identificacaoExibir',
            99999,
        ]);
        $this->assertRedirect([
            'controller' => 'escolas',
            'action' => 'listar',
        ]);
    }
    
    /**
     * Teste da action identificacao-exibir, com escola excluída
     */
    public function testIdentificacaoExibirEscolaExcluida()
    {
        $this->get([
            'controller' => 'escolas',
            'action' => 'identificacaoExibir',
            99999,
        ]);
        $this->assertRedirect([
            'controller' => 'escolas',
            'action' => 'listar',
        ]);
    }
    
    /**
     * Teste da action identificacao-exibir, omitindo o id da escola
     */
    public function testIdentificacaoExibirEscolaIdNull()
    {
        $this->get([
            'controller' => 'escolas',
            'action' => 'greIntegrar',
        ]);
        $this->assertRedirect([
            'controller' => 'escolas',
            'action' => 'listar',
        ]);
    }
    
    /**
     * Teste da action identificacao-editar, solicitando o formulario de edição
     */
    public function testIdentificacaoEditar()
    {
        $this->get([
            'controller' => 'escolas',
            'action' => 'identificacaoEditar',
            1
        ]);
        $this->assertResponseSuccess();
    }
    
    /**
     * Teste da action identificacao-editar, com sucesso
     */
    public function testIdentificacaoEditarComSucesso()
    {
        $escolaId = 1;
        $data = [
            'situacao_id' => 2,
            'inep_codigo' => 'MODIFICADO',
            'nome_curto' => 'MODIFICADO',
            'nome_longo' => 'MODIFICADO',
            'nome_juridico' => 'MODIFICADO',
            'endereco_cep' => 'MOD',
            'endereco_distrito_id' => 2,
            'endereco_logradouro' => 'MODIFICADO',
            'endereco_numero' => 'MODIFICADO',
            'endereco_complemento' => 'MODIFICADO',
            'endereco_bairro' => 'MODIFICADO',
        ];
        $this->put([
            'controller' => 'escolas',
            'action' => 'identificacaoEditar',
            $escolaId,
        ], $data);
        $this->assertResponseSuccess();
        $escola = TableRegistry::get('Escolas')->getIdentificacao($escolaId)
                                               ->toArray();
        $this->assertEquals($escola['situacao_id'], $data['situacao_id']);
        $this->assertEquals($escola['nome_curto'], $data['nome_curto']);
        $this->assertEquals($escola['endereco_numero'], $data['endereco_numero']);
        $this->assertRedirect([
            'controller' => 'escolas',
            'action' => 'identificacaoExibir',
            $escolaId,
        ]);
    }
    
    /**
     * Teste da action identificacao-editar, com erro de validação dos dados
     * submetidos
     */
    public function testIdentificacaoEditarComFalhaDeValidacao()
    {
        $escolaId = 1;
        $escolasTable = TableRegistry::get('Escolas');
        $escolaOriginal = $escolasTable->getIdentificacao($escolaId)
                                       ->toArray();
        $data = [
            'nome_curto' => '',
            'nome_longo' => '',
            'nome_juridico' => '',
        ];
        $this->put([
            'controller' => 'escolas',
            'action' => 'identificacaoEditar',
            $escolaId,
        ], $data);
        $escola = $escolasTable->getIdentificacao($escolaId)
                               ->toArray();
        $this->assertEquals($escola['nome_curto'], $escolaOriginal['nome_curto']);
        $this->assertEquals($escola['nome_longo'], $escolaOriginal['nome_longo']);
        $this->assertEquals($escola['nome_juridico'], $escolaOriginal['nome_juridico']);
        $this->assertResponseContains('[E-01011]');
    }
    
    /**
     * Teste da action identificacao-editar, com escola inexistente
     */
    public function testIdentificacaoEditarEscolaInexistente()
    {
        $this->get([
            'controller' => 'escolas',
            'action' => 'identificacaoEditar',
            99999,
        ]);
        $this->assertRedirect([
            'controller' => 'escolas',
            'action' => 'listar',
        ]);
    }
    
    /**
     * Teste da action identificacao-editar, com escola excluída
     */
    public function testIdentificacaoEditarEscolaExcluida()
    {
        $this->get([
            'controller' => 'escolas',
            'action' => 'identificacaoEditar',
            3,
        ]);
        $this->assertRedirect([
            'controller' => 'escolas',
            'action' => 'listar',
        ]);
    }
    
    /**
     * Teste da action identificacao-editar, omitindo o id da escola
     */
    public function testIdentificacaoEditarEscolaIdNull()
    {
        $this->get([
            'controller' => 'escolas',
            'action' => 'identificacaoEditar',
        ]);
        $this->assertRedirect([
            'controller' => 'escolas',
            'action' => 'listar',
        ]);
    }
}
