<?php

use App\Http\Controllers\Admin\CategoriaEventoController;
use App\Http\Controllers\Admin\ConfiguracaoController;
use App\Http\Controllers\Admin\PainelAdminController;
use App\Http\Controllers\Admin\RelatoriosController;
use App\Http\Controllers\Admin\UsuarioController;
use App\Http\Controllers\Admin\UsuarioPremiumController;
use App\Http\Controllers\Admin\UsuariosOnlineController;
use App\Http\Controllers\Auth\EditarCadastroUsuario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\ContatoController;
use App\Http\Controllers\PixUsuarioController;
use App\Http\Controllers\Auth\LoginOAuthController;
use App\Http\Controllers\Auth\RegisterAdmController;
use App\Http\Controllers\ConvidadoController;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\LandingPageEventosController;
use App\Http\Controllers\PagamentoPremiumController;
use App\Http\Controllers\PainelUsuarioController;
use App\Http\Controllers\PresenteController;
use App\Http\Controllers\SobreController;
use App\Http\Controllers\VisitasController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// Início
Route::get('/', [InicioController::class, 'index'])->name('index-home');
/* Sobre */
Route::get('/sobre', [SobreController::class, 'index'])->name('sobre');

/* Autenticações */
Auth::routes();

/* Painle de controle do usuário */
Route::get('/painel-de-controle', [PainelUsuarioController::class, 'painel'])->name('painel-de-controle');

/* Cadastro para adm */
Route::get('/cadastro-adm', [RegisterAdmController::class, 'index'])->name('auth.cadastro-adm');
Route::post('/cadastro-adm', [RegisterAdmController::class, 'store'])->name('auth.cadastro-adm');

/* Contatos */
Route::get('/contato', [ContatoController::class, 'contato'])->name('contato');
Route::post('/contato', [ContatoController::class, 'enviarContato'])->name('contato');
Route::delete('/contato/{contato}', [ContatoController::class, 'deletar'])->name('contato.deletar');

/* Laravel Socialite */
Route::get('/login/{provider}', [LoginOAuthController::class, 'login'])->name('login.redirect.socialite');
Route::get('/login-callback/{provider}', [LoginOAuthController::class, 'loginCallback'])->name('login.callback.socialite');

/* Eventos */
Route::get('/painel-evento', [EventoController::class, 'painelEvento'])->name('painel-evento');
Route::get('/cadastro-evento', [EventoController::class, 'create'])->name('cadastro-evento');
Route::post('/cadastro-evento', [EventoController::class, 'store'])->name('cadastro-evento.store');
Route::get('/selecionar-evento-editar', [EventoController::class, 'selecionarEventoEditar'])->name('editar-evento-selecionar');
Route::get('/editar-evento/{evento}', [EventoController::class, 'edit'])->name('editar-evento');
Route::put('/editar-evento/{evento}', [EventoController::class, 'update'])->name('editar-evento.update');
Route::get('/lista-de-eventos', [EventoController::class, 'listaEventos'])->name('lista-de-eventos');
Route::delete('/deletar-evento', [EventoController::class, 'destroy'])->name('deletar-evento');

/* Pix Usuários */
Route::get('/painel-pix', [PixUsuarioController::class, 'painelPix'])->name('painel-pix');
Route::post('/painel-pix', [PixUsuarioController::class, 'salvarPix'])->name('salvar-pix-usuario');
Route::get('/painel-pix/colaboradores', [PixUsuarioController::class, 'colaboradores'])->name('painel-pix.colaboradores');
Route::get('/painel-pix/colaboradores/aprovar/{colaboradorpix}', [PixUsuarioController::class, 'aprovar'])->name('painel-pix.colaboradores.aprovar');
Route::get('/painel-pix/colaboradores/negar/{colaboradorpix}', [PixUsuarioController::class, 'negar'])->name('painel-pix.colaboradores.negar');
Route::delete('/painel-pix/colaboradores/deletar', [PixUsuarioController::class, 'deletar'])->name('painel-pix.colaboradores.deletar');

/* Lista de presentes */
Route::get('/lista-de-presentes/selecionar-evento', [PresenteController::class, 'selecionarEvento'])->name('lista-de-presentes.selecionar-evento');
Route::post('/lista-de-presentes/salvar/{evento}', [PresenteController::class, 'salvarLista'])->name('lista-de-presentes.salvar');
Route::put('/lista-de-presentes/atualizar', [PresenteController::class, 'atualizarLista'])->name('lista-de-presentes.atualizar');
Route::get('/lista-de-presentes/exportar-excel/{evento_id}', [PresenteController::class, 'excel'])->name('lista-presentes.exportar-excel');
Route::get('/lista-de-presentes/exportar-pdf/{evento_id}', [PresenteController::class, 'pdf'])->name('lista-presentes.exportar-pdf');
Route::get('/lista-de-presentes/{evento}', [PresenteController::class, 'listaPresentes'])->name('recebidos');

/* Convidados */
Route::get('/convidados/evento/{evento}', [ConvidadoController::class, 'listaConvidados'])->name('convidados');
Route::get('/convidados/selecionar-evento', [ConvidadoController::class, 'selecionarEvento'])->name('convidados.selecionar-evento');
Route::get('/convidados/aceitar-convite/{convidado}', [ConvidadoController::class, 'aceitarPedidoConvite'])->name('convidados.aceitar-convite');
Route::get('/convidados/negar-convite/{convidado}', [ConvidadoController::class, 'negarPedidoConvite'])->name('convidados.negar-convite');
Route::delete('/convidados/remover-convidado', [ConvidadoController::class, 'removerConvidado'])->name('convidados.remover-convidado');
Route::post('/convidados/adicionar-convidado/{evento}', [ConvidadoController::class, 'adicionarConvidado'])->name('convidados.adicionar-convidado');
Route::get('/convidados/exportar-excel/{evento_id}', [ConvidadoController::class, 'excel'])->name('convidados.exportar-excel');
Route::get('/convidados/exportar-pdf/{evento}', [ConvidadoController::class, 'pdf'])->name('convidados.exportar-pdf');

/* Landing Pages */
Route::get('/lp1/{slug}', [LandingPageEventosController::class, 'landingPage1'])->name('landing-page-one');
Route::get('/lp2/{slug}', [LandingPageEventosController::class, 'landingPage2'])->name('landing-page-two');
Route::get('/lp3/{slug}', [LandingPageEventosController::class, 'landingPage3'])->name('landing-page-three');
Route::post('/landing-page/{evento}/presentear', [LandingPageEventosController::class, 'presentear'])->name('landing-page.presentear');
Route::post('/landing-page/{evento}/colaborar-com-pix', [LandingPageEventosController::class, 'colaborarPix'])->name('landing-page.colaborar-pix');

/* Edita cadastro */
Route::get('/editar/cadastro', [EditarCadastroUsuario::class, 'editar'])->name('editar_cadastro');
Route::put('/editar/cadastro', [EditarCadastroUsuario::class, 'salvar'])->name('editar-cadastro.salvar');
Route::delete('/excluir-cadastro', [EditarCadastroUsuario::class, 'excluir'])->name('excluir-cadastro');

/* Pagamento premium */
Route::get('/pagamento-premium', [PagamentoPremiumController::class, 'realizarPagamento'])->name('pagamento-premium');
Route::get('/pagamento-concluido', [PagamentoPremiumController::class, 'pagamentoConcluido'])->name('pagamento-premium-concluido');

/* Inserir visitas */
Route::post('/inserir-visita', [VisitasController::class, 'inserirVisita'])->name('inserir-visita');


/* ================== Painel Administrador ================== */
Route::get('/admin', [PainelAdminController::class, 'painel'])->name('admin');

/* Usuarios */
Route::get('/admin/usuarios', [UsuarioController::class, 'usuarios'])->name('usuarios');
Route::get('/admin/usuarios/novo', [UsuarioController::class, 'novoUsuario'])->name('usuarios.novo');
Route::post('/admin/usuarios/novo', [UsuarioController::class, 'salvarNovoUsuario'])->name('usuarios.salvar-novo-usuario');
Route::get('/admin/usuarios/config/{user}', [UsuarioController::class, 'configUsuario'])->name('usuarios.config-usuario');
Route::put('/admin/usuarios/config/{user}', [UsuarioController::class, 'configUsuarioSalvar'])->name('usuarios.config-usuario-salvar');
Route::delete('/admin/usuarios/excluir', [UsuarioController::class, 'excluirUsuario'])->name('usuarios.excluir-usuario');
Route::get('/admin/usuarios/exportar-excel', [UsuarioController::class, 'excel'])->name('usuarios.exportar-excel');

/* Contatos */
Route::get('/admin/contatos', [ContatoController::class, 'listaContatos'])->name('contatos');
Route::delete('/admin/contatos', [ContatoController::class, 'excluir'])->name('contatos.excluir');

/* Categoria Eventos */
Route::get('/admin/eventos', [CategoriaEventoController::class, 'eventos'])->name('admin.eventos');
Route::get('/admin/eventos/novo', [CategoriaEventoController::class, 'novoEvento'])->name('admin.eventos.novo');
Route::post('/admin/eventos/novo', [CategoriaEventoController::class, 'salvarNovoEvento'])->name('admin.eventos.salvar-novo');
Route::delete('/admin/eventos/excluir', [CategoriaEventoController::class, 'excluir'])->name('admin.eventos.excluir');
Route::get('/admin/eventos/{categoria_evento}/config', [CategoriaEventoController::class, 'editarEvento'])->name('admin.eventos.editar-evento');
Route::put('/admin/eventos/{categoria_evento}/config', [CategoriaEventoController::class, 'salvarEditarEvento'])->name('admin.eventos.salvar-evento');

/* Relatórios */
Route::get('/admin/relatorios', [RelatoriosController::class, 'relatorios'])->name('relatorios');
Route::get('/admin/relatorios/excel-visitas-total', [RelatoriosController::class, 'exportarVisitasTotalExcel'])->name('relatorios.exportar-visitas-total');
Route::get('/admin/relatorios/excel-visitas-mes', [RelatoriosController::class, 'exportarVisitasPorMesExcel'])->name('relatorios.exportar-visitas-mes');
Route::get('/admin/relatorios/excel-visitas-dia', [RelatoriosController::class, 'exportarVisitasPorDiaExcel'])->name('relatorios.exportar-visitas-dia');
Route::get('/admin/relatorios/excel-tipos-de-acesso', [RelatoriosController::class, 'exportarTiposDeAcessoExcel'])->name('relatorios.exportar-tipos-de-acesso');
Route::get('/admin/relatorios/excel-eventos-escolhidos', [RelatoriosController::class, 'exportarEventosMaisEscolhidosExcel'])->name('relatorios.exportar-eventos-escolhidos');
Route::post('/admin/relatorios/pdf-visitas-total', [RelatoriosController::class, 'pdfVisitasTotal'])->name('relatorios.pdf-visitas-total');
Route::post('/admin/relatorios/pdf-visitas-por-mes', [RelatoriosController::class, 'pdfVisitasPorMes'])->name('relatorios.pdf-visitas-por-mes');
Route::post('/admin/relatorios/pdf-visitas-por-dia', [RelatoriosController::class, 'pdfVisitasPorDia'])->name('relatorios.pdf-visitas-por-dia');
Route::get('/admin/relatorios/pdf-tipos-de-acesso', [RelatoriosController::class, 'pdfTiposAcesso'])->name('relatorios.pdf-tipos-de-acesso');
Route::get('/admin/relatorios/pdf-eventos-mais-escolhidos', [RelatoriosController::class, 'pdfEventosMaisEscolhidos'])->name('relatorios.pdf-eventos-mais-escolhidos');

/* Configurações */
Route::get('/admin/configuracoes', [ConfiguracaoController::class, 'config'])->name('configuracoes');
Route::post('/admin/configuracoes', [ConfiguracaoController::class, 'alterarStatusManutencao'])->name('configuracoes.alterar-status');
Route::get('/manutencao', [ConfiguracaoController::class, 'manutencao'])->name('configuracoes.manutencao');

/* Usuários premium */
Route::get('/admin/usuarios-premium', [UsuarioPremiumController::class, 'usuarios'])->name('admin.usuarios-premium');
Route::get('/admin/usuarios-premium/aprovar/{user}', [UsuarioPremiumController::class, 'aprovarPagamento'])->name('admin.usuarios-premium.aprovar');
Route::get('/admin/usuarios-premium/negar/{user}', [UsuarioPremiumController::class, 'negarPagamento'])->name('admin.usuarios-premium.negar');
Route::post('/admin/usuarios-premium/salvar-pix', [UsuarioPremiumController::class, 'salvarPix'])->name('admin.usuarios-premium.salvar-pix');

/* Usuários Online */
Route::get('/usuarios-online', [UsuariosOnlineController::class, 'usuariosOnline'])->name('admin.usuarios-online');
