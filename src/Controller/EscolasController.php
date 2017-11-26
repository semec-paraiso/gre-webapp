<?php

namespace GRE\Controller;

use Cake\Datasource\Exception\RecordNotFoundException;

/**
 * Controller Escolas
 * 
 */
class EscolasController extends AppController
{
    /**
     * Action default
     * 
     * @return void
     */
    public function index()
    {
        return $this->redirect(['action' => 'listar']);
    }

    /**
     * Listagem das escolas cadastradas
     * 
     * @return void
     */
    public function listar($limpar = false)
    {
        $filterName = 'Escolas';
        if ($limpar === 'limpar') {
            $this->Filter->clear($filterName, $this->Escolas->getFilters());
            return $this->redirect(['action' => 'listar']);
        }
        $filters = $this->Filter->build($filterName, $this->Escolas->getFilters());
        $escolas = $this->paginate($this->Escolas->listar($filters));
        $this->loadModel('EscolaSituacoes');
        $this->set(compact('escolas'));
        $this->set(compact('filters'));
        $this->set('escolaSituacoes', $this->EscolaSituacoes->getList());
    }
    
    /**
     * Listagem de escolas por município
     * 
     * Caso a requisição não seja via Ajax, é feito um redirecionamento para a 
     * action `listar`
     * 
     * @param int $municipioId
     * @return void
     */
    public function listarPorMunicipio($municipioId = null)
    {
        if (!$this->request->is('ajax')) {
            return $this->redirect(['action' => 'listar']);
        }
        $escolas = $this->Escolas->listarPorMunicipio($municipioId);
        $this->set(compact('escolas'));
        $this->viewBuilder()->setLayout('ajax');
        $this->viewBuilder()->setTemplate('listar_ajax');
    }
    
    /**
     * Cadastro de nova escola
     * 
     * @return void
     */
    public function cadastrar()
    {
        $escola = $this->Escolas->newEntity();
        if ($this->request->is(['post', 'put'])) {
            $escola = $this->Escolas->patchIdentificacao($escola, $this->request->getData());
            if ($this->Escolas->save($escola)) {
                $this->Flash->success('[S-01001] Escola cadastrada com sucesso!');
                return $this->redirect([
                    'action' => 'identificacaoExibir',
                    h($escola->id),
                ]);
            }
            $this->Flash->error('[E-01002] Não foi possível cadastrar a escola!');
            $escola = $this->Escolas->patchEntity($escola, $this->request->getData());
        }
        $this->loadModel('EscolaSituacoes');
        $this->loadModel('Ufs');
        $this->set(compact('escola'));
        $this->set('escolaSituacoes', $this->EscolaSituacoes->getList());
        $this->set('ufs', $this->Ufs->getList());
    }
    
    /**
     * Retira a escola da rede GRE
     * 
     * @param int $escolaId
     * @return void
     */
    public function greRetirar($escolaId = null)
    {
        try {
            $escola = $this->Escolas->getIdentificacao($escolaId);
            if ($this->Escolas->greRetirar($escola)) {
                $this->Flash->success('[S-01003] A escola foi retirada da rede GRE.');
            } else {
                $this->Flash->error('[E-01004] Ocorreu um erro ao retirar a escola da rede GRE.');
            }
            return $this->redirect([
                'action' => 'identificacaoExibir',
                $escola->id,
            ]); 
        } catch (RecordNotFoundException $e) {
            $this->Flash->error('[E-01005] Escola inválida!');
            return $this->redirect(['action' => 'listar']);
        }
    }
    
    /**
     * Integra a escola à rede GRE
     * 
     * @param int $escolaId
     * @return void
     */
    public function greIntegrar($escolaId = null)
    {
        try {
            $escola = $this->Escolas->getIdentificacao($escolaId);
            if ($this->Escolas->greIntegrar($escola)) {
                $this->Flash->success('[S-01006] A escola foi integrada à rede GRE.');
            } else {
                $this->Flash->error('[E-01007] Ocorreu um erro ao integrar a escola à rede GRE.');
            }
            return $this->redirect([
                'action' => 'identificacaoExibir',
                $escola->id,
            ]);
        } catch (RecordNotFoundException $e) {
            $this->Flash->error('[E-01008] Escola inválida!');
            return $this->redirect(['action' => 'listar']);
        }
    }

    /**
     * Visualização dos dados de identificação de uma escola
     * 
     * @param int $escolaId
     * @return void
     */
    public function identificacaoExibir($escolaId = null)
    {
        try {
            $escola = $this->Escolas->getIdentificacao($escolaId);
            $this->set(compact('escola'));
        } catch (RecordNotFoundException $e) {
            $this->Flash->error('[E-01009] Escola inválida!');
            return $this->redirect(['action' => 'listar']);
        }
    }
    
    /**
     * Edição das informações de identificação da escola
     * 
     * @param int $escolaId
     * @return void
     */
    public function identificacaoEditar($escolaId = null)
    {
        try {
            $escola = $this->Escolas->getIdentificacao($escolaId);
            if ($this->request->is(['post', 'put'])) {
                $escola = $this->Escolas->patchIdentificacao($escola, $this->request->getData());
                $this->Flash->success('[S-01010] As informações da escola foram atualizadas!');
                if ($this->Escolas->save($escola)) {
                    return $this->redirect([
                        'action' => 'identificacaoExibir',
                        h($escola->id),
                    ]);
                }
                $this->Flash->error('[E-01011] Não foi possível salvar as informações da escola!');
                $escola = $this->Escolas->patchEntity($escola, $this->request->getData());
            }
            $this->loadModel('EscolaSituacoes');
            $this->loadModel('Ufs');
            $this->set(compact('escola'));
            $this->set('escolaSituacoes', $this->EscolaSituacoes->getList());
            $this->set('ufs', $this->Ufs->getList());
        } catch (RecordNotFoundException $e) {
            $this->Flash->error('[E-01012] Escola inválida!');
            return $this->redirect(['action' => 'listar']);
        }
    }
    
    /**
     * Exibição da legislação de funcionamento da escola
     * 
     * @param int $escolaId
     * @return void
     */
    public function legislacaoFuncionamentoExibir($escolaId = null)
    {
        try {
            $escola = $this->Escolas->getLegislacaoFuncionamento($escolaId);
            $this->set(compact('escola'));
        } catch (RecordNotFoundException $e) {
            $this->Flash->error('[E-01013] Escola inválida!');
            return $this->redirect(['action' => 'listar']);
        }
    }
    
    /**
     * Edição da legislação de funcionamento da escola
     * 
     * @param int $escolaId
     * @return void
     */
    public function legislacaoFuncionamentoEditar($escolaId = null)
    {
        try {
            $escola = $this->Escolas->getLegislacaoFuncionamento($escolaId);
            if ($this->request->is(['post', 'put'])) {
                $escola = $this->Escolas->patchLegislacaoFuncionamento($escola, $this->request->getData());
                $escola->id = $escolaId;
                if ($this->Escolas->save($escola)) {
                    $this->Flash->success('[S-01014] As informações foram atualizadas.');
                    return $this->redirect([
                        'action' => 'legislacaoFuncionamentoExibir',
                        $escola->id,
                    ]); 
                }
                $this->Flash->error('[E-01015] Ocorreu um erro ao salvar as informações.');
            }
            $this->set(compact('escola'));
        } catch (RecordNotFoundException $e) {
            $this->Flash->error('[E-01016] Escola inválida!');
            return $this->redirect(['action' => 'listar']);
        }
    }
    
    /**
     * Listagem dos atos de reconhecimento de cursos da escola
     * 
     * @param int $escolaId
     * @return void
     */
    public function legislacaoReconhecimentosListar($escolaId = null)
    {
        try {
            $escola = $this->Escolas->getReconhecimentos($escolaId);
            $this->set(compact('escola'));
        } catch (RecordNotFoundException $e) {
            $this->Flash->error('[E-01017] Escola inválida!');
            return $this->redirect(['action' => 'listar']);
        }
    }
    
    /**
     * Cadastro de ato de reconhecimento de curso da escola
     * 
     * @param int $escolaId
     * @return void
     */
    public function legislacaoReconhecimentosCadastrar($escolaId = null)
    {
        try {
            $escola = $this->Escolas->getReconhecimentos($escolaId);
            $this->loadModel('Reconhecimentos');
            $reconhecimento = $this->Reconhecimentos->newEntity();
            if ($this->request->is(['put', 'post'])) {
                $reconhecimento = $this->Reconhecimentos->patchEntity($reconhecimento, $this->request->getData());
                $reconhecimento->escola_id = $escola->id;
                if ($this->Reconhecimentos->save($reconhecimento)) {
                    $this->Flash->success('O ato de reconhecimento foi cadastrado com sucesso.');
                    return $this->redirect([
                        'action' => 'legislacaoReconhecimentosListar',
                        $escola->id,
                    ]);
                }
                $this->Flash->error('Ocorreu um erro ao salvar o ato de reconhecimento.');
            }
            $this->set(compact('reconhecimento'));
            $this->set(compact('escola'));
        } catch (RecordNotFoundException $e) {
            $this->Flash->error('Escola inválida!');
            return $this->redirect(['action' => 'listar']);
        }
    }
    
    /**
     * Edição do ato de reconhecimento de curso da escola
     * 
     * @param int $escolaId
     * @return void
     */
    public function legislacaoReconhecimentosEditar($reconhecimentoId = null)
    {
        try {
            $this->loadModel('Reconhecimentos');
            $reconhecimento = $this->Reconhecimentos->get($reconhecimentoId);
            $escola = $reconhecimento->escola;
            if ($this->request->is(['post', 'put'])) {
                $reconhecimento = $this->Reconhecimentos->patchEntity($reconhecimento, $this->request->getData());
                if ($this->Reconhecimentos->save($reconhecimento)) {
                    $this->Flash->success('As informações do reconhecimento foram atualizadas.');
                    return $this->redirect([
                        'action' => 'legislacaoReconhecimentosListar',
                        $escola->id,
                    ]);
                }
                $this->Flash->error('Ocorreu um erro ao salvar as informações.');
            }
            $this->set(compact('reconhecimento'));
            $this->set(compact('escola'));
        } catch (RecordNotFoundException $e) {
            $this->Flash->error('Escola inválida!');
            return $this->redirect(['action' => 'listar']);
        }
    }
    
    /**
     * Exclusão de um ato de reconhecimento de curso
     * 
     * @param int $reconhecimentoId
     * @return void
     */
    public function legislacaoReconhecimentosExcluir($reconhecimentoId = null)
    {
        try {
            $this->loadModel('Reconhecimentos');
            $reconhecimento = $this->Reconhecimentos->get($reconhecimentoId);
            $escolaId = $reconhecimento->escola->id;
            if ($this->Reconhecimentos->setDeleted($reconhecimento)) {
                $this->Flash->success('Ato de reconhecimento foi excluído!');
            } else {
                $this->Flash->error('Ocorreu um erro ao excluir o ato de reconhecimento.');
            }
            return $this->redirect([
                'action' => 'legislacaoReconhecimentosListar',
                $escolaId,
            ]);
        } catch (RecordNotFoundException $e) {
            $this->Flash->error('Ato de reconhecimento de curso inválido.');
            return $this->redirect(['action' => 'listar']);
        }
    }
    
    /**
     * Visualização das informações gerais da infraestrutura da escola especificada
     * 
     * @param int $escolaId
     * @return void
     */
    public function infraCaracterizacaoExibir($escolaId = null)
    {
        try {
            $escola = $this->Escolas->getCaracterizacao($escolaId);
            $this->set(compact('escola'));
        } catch (RecordNotFoundException $e) {
            $this->Flash->error('Escola inválida!');
            return $this->redirect(['action' => 'listar']);
        }
    }
    
    /**
     * Edição da caracterização da infraestrutura da escola
     * 
     * @param int $escolaId
     * @return void
     */
    public function infraCaracterizacaoEditar($escolaId = null)
    {
        try {
            $escola = $this->Escolas->getCaracterizacao($escolaId);
            if ($this->request->is(['post', 'put'])) {
                $escola = $this->Escolas->patchCaracterizacao($escola, $this->request->getData());
                $escola->id = $escolaId;
                if ($this->Escolas->save($escola)) {
                    $this->Flash->success('As informações da escola foram atualizadas!');
                    return $this->redirect([
                        'action' => 'infraCaracterizacaoExibir',
                        $escolaId,
                    ]);
                }
            }
            $this->set(compact('escola'));
        } catch (RecordNotFoundException $e) {
            $this->Flash->error('Escola inválida!');
            return $this->redirect(['action' => 'listar']);
        }
    }
    
    /**
     * Listagem dos locais de funcionamento da escola especificada
     * 
     * @param int $escolaId
     * @return void
     */
    public function infraLocaisListar($escolaId = null)
    {
        try {
            $escola = $this->Escolas->getLocais($escolaId);
            $this->set(compact('escola'));
        } catch (RecordNotFoundException $e) {
            $this->Flash->error('Escola inválida!');
            return $this->redirect(['action' => 'listar']);
        }
    }
    
    /**
     * Cadastro de local de funcionamento da escola especificada
     * 
     * @param int $escolaId
     * @return void
     */
    public function infraLocaisCadastrar($escolaId = null)
    {
        try {
            $escola = $this->Escolas->getLocais($escolaId);
            $this->loadModel('EscolaLocais');
            $escolaLocal = $this->EscolaLocais->newEntity();
            if($this->request->is(['post', 'put'])) {
                $escolaLocal = $this->EscolaLocais->patchEntity($escolaLocal, $this->request->getData());
                $escolaLocal->escola_id = $escola->id;
                if ($this->EscolaLocais->save($escolaLocal)) {
                    $this->Flash->success('O local foi cadastrado com sucesso!');
                    return $this->redirect([
                        'action' => 'infraLocaisListar',
                        $escola->id,
                    ]);
                }
                $this->Flash->error('Não foi possível salvar as informações!');
            }
            $this->loadModel('PredioOcupacaoFormas');
            $this->loadModel('EscolaLocalTipos');
            $this->set('predioOcupacaoFormas', $this->PredioOcupacaoFormas->getList());
            $this->set('escolaLocalTipos', $this->EscolaLocalTipos->getList());
            $this->set(compact('escolaLocal'));
            $this->set(compact('escola'));
        } catch (RecordNotFoundException $e) {
            $this->Flash->error('Escola inválida!');
            return $this->redirect(['action' => 'listar']);
        }
    }
    
    /**
     * Edição das informações do local de funcionamento da escola
     * 
     * @param int $escolaLocalId
     * @return void
     */
    public function infraLocaisEditar($escolaLocalId = null)
    {
        try {            
            $this->loadModel('EscolaLocais');
            $escolaLocal = $this->EscolaLocais->get($escolaLocalId);
            $escola = $escolaLocal->escola;
            if($this->request->is(['post', 'put'])) {
                $escolaLocal = $this->EscolaLocais->patchEntity($escolaLocal, $this->request->getData());
                $escolaLocal->id = $escolaLocalId;
                $escolaLocal->escola_id = $escola->id;
                if ($this->EscolaLocais->save($escolaLocal)) {
                    $this->Flash->success('As informações do local foram atualizadas.');
                    return $this->redirect([
                        'action' => 'infraLocaisListar',
                        $escolaLocal->escola_id,
                    ]);
                }
                $this->Flash->error('Não foi possível salvar as informações!');
            }
            $this->loadModel('PredioOcupacaoFormas');
            $this->loadModel('EscolaLocalTipos');
            $this->set('predioOcupacaoFormas', $this->PredioOcupacaoFormas->getList());
            $this->set('escolaLocalTipos', $this->EscolaLocalTipos->getList());
            $this->set(compact('escolaLocal'));
            $this->set(compact('escola'));
        } catch (RecordNotFoundException $e) {
            $this->Flash->error('Escola inválida!');
            return $this->redirect(['action' => 'listar']);
        }
    }
    
    /**
     * Exclusão do local de funcionamento da escola
     * 
     * @param int $escolaLocalId
     * @return void
     */
    public function infraLocaisExcluir($escolaLocalId = null)
    {
        try {            
            $this->loadModel('EscolaLocais');
            $escolaLocal = $this->EscolaLocais->get($escolaLocalId);
            $escola = $escolaLocal->escola;
            if($this->request->is(['post', 'put'])) {
                if ($this->EscolaLocais->setDeleted($escolaLocal)) {
                    $this->Flash->success('O local de funcionamento foi excluído do sistema.');
                    return $this->redirect([
                        'action' => 'infraLocaisListar',
                        $escola->id,
                    ]);
                }
                $this->Flash->error('Não foi possível salvar as informações!');
            }
            $this->set(compact('escolaLocal'));
            $this->set(compact('escola'));
        } catch (RecordNotFoundException $e) {
            $this->Flash->error('Local de funcionamento da escola inválido.');
            return $this->redirect(['action' => 'listar']);
        }
    }
    
    /**
     * Listagem das salas de aula da escola
     * 
     * @param int $escolaId
     * @return void
     */
    public function infraSalasListar($escolaId = null, $clear = null)
    {
        try {
            $filterName = 'EscolaSalas';
            $this->loadModel('EscolaSalas');
            $this->loadModel('EscolaLocais');
            $filterFields = $this->EscolaSalas->getFilters();
            $filters = $this->Filter->build($filterName, $filterFields);
            $escola = $this->Escolas->getSalas($escolaId, $filters);
            if ($clear === 'limpar') {
                $this->Filter->clear($filterName, $filterFields);
                return $this->redirect([
                    'action' => 'infraSalasListar',
                    $escola->id,
                ]);
            }
            $this->set(compact('escola'));
            $this->set(compact('filters'));
            $this->set('escolaLocais', $this->EscolaLocais->getList($escola->id));
        } catch (RecordNotFoundException $e) {
            $this->Flash->error('Escola inválida!');
            return $this->redirect(['action' => 'listar']);
        }
    }
    
    /**
     * Cadastro de uma nova sala de aula na escola
     * 
     * @param int $escolaId
     * @return void
     */
    public function infraSalasCadastrar($escolaId = null)
    {
        try {
            $escola = $this->Escolas->getSalas($escolaId);
            $this->loadModel('EscolaSalas');
            $escolaSala = $this->EscolaSalas->newEntity();
            if ($this->request->is(['post', 'put'])) {
                $escolaSala = $this->EscolaSalas->patchEntity($escolaSala, $this->request->getData());
                if ($this->EscolaSalas->save($escolaSala)) {
                    $this->Flash->success('Sala de Aula cadastrada com sucesso');
                    return $this->redirect([
                        'action' => 'infraSalasListar',
                        $escola->id,
                    ]);
                }
                $this->Flash->error('Ocorreu um erro ao salvar as informações.');
            }
            $this->loadModel('EscolaLocais');
            $this->set(compact('escola'));
            $this->set(compact('escolaSala'));
            $this->set('escolaLocais', $this->EscolaLocais->getList($escola->id));
        } catch (RecordNotFoundException $e) {
            $this->Flash->error('Escola inválida!');
            return $this->redirect(['action' => 'listar']);
        }
    }
    
    /**
     * Edição das informações de uma sala de aula
     * 
     * @param int $escolaSalaId
     * @return void
     */
    public function infraSalasEditar($escolaSalaId = null)
    {
        try {
            $this->loadModel('EscolaSalas');
            $escolaSala = $this->EscolaSalas->get($escolaSalaId);
            $escola = $escolaSala->escola_local->escola;
            if ($this->request->is(['post', 'put'])) {
                $escolaSala = $this->EscolaSalas->patchEntity($escolaSala, $this->request->getData());
                if ($this->EscolaSalas->save($escolaSala)) {
                    $this->Flash->success('As informações da sala de aula foram atualizadas.');
                    return $this->redirect([
                        'action' => 'infraSalasListar',
                        $escola->id,
                    ]);
                }
                $this->Flash->error('Ocorreu um erro ao salvar as informações.');
            }
            $this->loadModel('EscolaLocais');
            $this->set(compact('escolaSala'));
            $this->set(compact('escola'));
            $this->set('escolaLocais', $this->EscolaLocais->getList($escola->id));
        } catch (RecordNotFoundException $e) {
            $this->Flash->error('Sala de aula inválida!');
            return $this->redirect(['action' => 'listar']);
        }
    }
    
    /**
     * Exclusão da sala de aula
     * 
     * @param int $escolaSalaId
     * @return void
     */
    public function infraSalasExcluir($escolaSalaId = null)
    {
        try {
            $this->loadModel('EscolaSalas');
            $escolaSala = $this->EscolaSalas->get($escolaSalaId);
            $escola = $escolaSala->escola_local->escola;
            if ($this->request->is(['post', 'put'])) {
                if ($this->EscolaSalas->setDeleted($escolaSala)) {
                    $this->Flash->success('A sala de aula foi excluída.');
                    return $this->redirect([
                        'action' => 'infraSalasListar',
                        $escola->id,
                    ]);
                }
                $this->Flash->error('Ocorreu um erro ao salvar as informações.');
            }
            $this->set(compact('escolaSala'));
            $this->set(compact('escola'));
        } catch (RecordNotFoundException $e) {
            $this->Flash->error('Sala de aula inválida!');
            return $this->redirect(['action' => 'listar']);
        }
    }
    
    /**
     * Listagem de compartilhamento de locais de funcionamento da escola
     * 
     * @param int $escolaId
     * @param string $clear
     * @return void
     */
    public function infraCompartilhamentosListar($escolaId = null, $clear = null)
    {
        try {
            $filterName = 'EscolaLocalCompartilhamentos';
            $this->loadModel('EscolaLocalCompartilhamentos');
            $filterFields = $this->EscolaLocalCompartilhamentos->getFilters();
            $filters = $this->Filter->build('EscolaLocalCompartilhamentos', $filterFields);
            $escola = $this->Escolas->getCompartilhamentos($escolaId, $filters);
            if ($clear === 'limpar') {
                $this->Filter->clear($filterName, $filterFields);
                return $this->redirect([
                    'action' => 'infraCompartilhamentosListar',
                    $escola->id,
                ]);
            }
            $this->loadModel('EscolaLocais');
            $this->set(compact('escola'));
            $this->set(compact('filters'));
            $this->set('escolaLocais', $this->EscolaLocais->getList($escolaId));
        } catch (RecordNotFoundException $e) {
            $this->Flash->error('Escola inválida.');
            return $this->redirect(['action' => 'listar']);
        }
    }
    
    /**
     * Cadastro de compartilhamento de local de funcionamento da escola
     * 
     * @param int $escolaId
     * @return void
     */
    public function infraCompartilhamentosCadastrar($escolaId = null)
    {
        try {
            $escola = $this->Escolas->getIdentificacao($escolaId);
            $this->loadModel('EscolaLocalCompartilhamentos');
            $escolaLocalCompartilhamento = $this->EscolaLocalCompartilhamentos->newEntity();
            if ($this->request->is(['post', 'put'])) {
                $escolaLocalCompartilhamento = $this->EscolaLocalCompartilhamentos->patchEntity($escolaLocalCompartilhamento, $this->request->getData());
                if ($this->EscolaLocalCompartilhamentos->save($escolaLocalCompartilhamento)) {
                    $this->Flash->success('Compartilhamento cadastrado com sucesso.');
                    return $this->redirect([
                        'action' => 'infraCompartilhamentosListar',
                        $escola->id,
                    ]);
                }
                $this->Flash->error('Ocorreu um erro ao salvar o compartilhamento.');    
            }
            $this->loadModel('Ufs');
            $this->loadModel('EscolaLocais');
            $this->set('ufs', $this->Ufs->getList());
            $this->set('escolaLocais', $this->EscolaLocais->getList($escola->id));
            $this->set(compact('escola'));
            $this->set(compact('escolaLocalCompartilhamento'));
        } catch (RecordNotFoundException $e) {
            $this->Flash->error('Escola inválida.');
            return $this->redirect(['action' => 'listar']);
        }
    }
    
    /**
     * Exclusão de compartilhamento de local de funcionamento da escola
     * 
     * @param int $escolaLocalCompartilhamentoId
     * @return void
     */
    public function infraCompartilhamentosExcluir($escolaLocalCompartilhamentoId = null)
    {
        try {
            $this->loadModel('EscolaLocalCompartilhamentos');
            $escolaLocalCompartilhamento = $this->EscolaLocalCompartilhamentos->get($escolaLocalCompartilhamentoId);
            $escola = $escolaLocalCompartilhamento->escola_local->escola;
            if ($this->request->is(['post', 'put'])) {
                if ($this->EscolaLocalCompartilhamentos->setDeleted($escolaLocalCompartilhamento)) {
                    $this->Flash->success('Compartilhamento de local excluído com sucesso.');
                    return $this->redirect([
                        'action' => 'infraCompartilhamentosListar',
                        $escola->id,
                    ]); 
                }
                $this->Flash->error('Ocorreu um erro ao excluir o compartilhamento.');
            }
            $this->set(compact('escolaLocalCompartilhamento'));
            $this->set(compact('escola'));
        } catch (RecordNotFoundException $e) {
            $this->Flash->error('Compartilhamento de local inválido.');
            return $this->redirect(['action' => 'listar']);
        }
    }
    
    /**
     * Exibição das informações de contato da escola
     * 
     * @param int $escolaId
     * @return void
     */
    public function contatosExibir($escolaId = null)
    {
        try {
            $escola = $this->Escolas->getContatos($escolaId);
            $this->set(compact('escola'));
        } catch (RecordNotFoundException $e) {
            $this->Flash->error('Escola inválida.');
            return $this->redirect(['action' => 'listar']);
        }
    }
    
    /**
     * Edição das informações de contato da escola
     * 
     * @param int $escolaId
     * @return void
     */
    public function contatosEditar($escolaId = null)
    {
        try {
            $escola = $this->Escolas->getContatos($escolaId);
            if ($this->request->is(['post', 'put'])) {
                $escola = $this->Escolas->patchContatos($escola, $this->request->getData());
                if ($this->Escolas->save($escola)) {
                    $this->Flash->success('As informações de contato foram atualizadas.');
                    return $this->redirect([
                        'action' => 'contatosExibir',
                        $escola->id,
                    ]);
                    $this->Flash->error('Ocorreu um erro ao salvar as informações de contato da escola');
                }
            }
            $this->set(compact('escola'));
        } catch (RecordNotFoundException $e) {
            $this->Flash->error('Escola inválida.');
            return $this->redirect(['action' => 'listar']);
        }
    }
    
    /**
     * Página com todos os relatórios da gestão de escolas
     * 
     * @param int $escolaId
     * @return void
     */
    public function relatorios($escolaId = null)
    {
        try {
            $escola = $this->Escolas->getIdentificacao($escolaId);
            $this->set(compact('escola'));
        } catch (RecordNotFoundException $e) {
            $this->Flash->error('Escola inválida.');
            return $this->redirect(['action' => 'listar']);
        }
    }

}
