<?php session_start();
#	Autoload classes
function __autoload($class){ require_once("../model/".$class.".class.php"); }
#	Controle
include_once("../control/comom.php");


#	Objeto
$U= new Usuario();


#	Parâmetros
$param["id"]= (isset($_REQUEST["id"]) ) ? $_REQUEST["id"] : "";

#	Carrega o objeto
$Obj= $U->getUsuarios($param);
$U= $Obj[0];

//	Carrega as permissões do usuário
$permissoes_usuario= $U->getPermissoes_usuario();
//show($permissoes_usuario);
#	Permissões
$permissoes= array();

//	Sistema
$permissoes["sistema"]= array();
$permissoes["sistema"][0]= array();
$permissoes["sistema"][0]["titulo"]="Permite Acessar Configurações";
$permissoes["sistema"][0]["name"]= 	"sistema_permite_acessar_configuracoes";
$permissoes["sistema"][0]["sim"]= 	($permissoes_usuario["sistema_permite_acessar_configuracoes"] == 1) ? "checked" : "";
$permissoes["sistema"][0]["nao"]= 	($permissoes_usuario["sistema_permite_acessar_configuracoes"] == 0) ? "checked" : "";

$permissoes["sistema"][1]["titulo"]="Permite Acessar Dashboard";
$permissoes["sistema"][1]["name"]= 	"sistema_permite_acessar_dashboard";
$permissoes["sistema"][1]["sim"]= 	($permissoes_usuario["sistema_permite_acessar_dashboard"] == 1) ? "checked" : "";
$permissoes["sistema"][1]["nao"]= 	($permissoes_usuario["sistema_permite_acessar_dashboard"] == 0) ? "checked" : "";

$permissoes["sistema"][2]["titulo"]="Permite Acessar Empresas";
$permissoes["sistema"][2]["name"]= 	"sistema_permite_acessar_empresas";
$permissoes["sistema"][2]["sim"]= 	($permissoes_usuario["sistema_permite_acessar_empresas"] == 1) ? "checked" : "";
$permissoes["sistema"][2]["nao"]= 	($permissoes_usuario["sistema_permite_acessar_empresas"] == 0) ? "checked" : "";

$permissoes["sistema"][3]["titulo"]="Permite Acessar Usuários";
$permissoes["sistema"][3]["name"]= 	"sistema_permite_acessar_usuarios";
$permissoes["sistema"][3]["sim"]= 	($permissoes_usuario["sistema_permite_acessar_usuarios"] == 1) ? "checked" : "";
$permissoes["sistema"][3]["nao"]= 	($permissoes_usuario["sistema_permite_acessar_usuarios"] == 0) ? "checked" : "";

$permissoes["sistema"][4]["titulo"]="Permite Acessar Clientes";
$permissoes["sistema"][4]["name"]= 	"sistema_permite_acessar_clientes";
$permissoes["sistema"][4]["sim"]= 	($permissoes_usuario["sistema_permite_acessar_clientes"] == 1) ? "checked" : "";
$permissoes["sistema"][4]["nao"]= 	($permissoes_usuario["sistema_permite_acessar_clientes"] == 0) ? "checked" : "";

$permissoes["sistema"][5]["titulo"]="Permite Acessar Contatos";
$permissoes["sistema"][5]["name"]= 	"sistema_permite_acessar_contatos";
$permissoes["sistema"][5]["sim"]= 	($permissoes_usuario["sistema_permite_acessar_contatos"] == 1) ? "checked" : "";
$permissoes["sistema"][5]["nao"]= 	($permissoes_usuario["sistema_permite_acessar_contatos"] == 0) ? "checked" : "";

//	Empresas
$permissoes["empresas"]= array();
$permissoes["emrpesas"][0]= array();
$permissoes["empresas"][0]["titulo"]=	"Permite Cadastrar";
$permissoes["empresas"][0]["name"]= 	"empresas_permite_cadastrar";
$permissoes["empresas"][0]["sim"]= 		($permissoes_usuario["empresas_permite_cadastrar"] == 1) ? "checked" : "";
$permissoes["empresas"][0]["nao"]= 		($permissoes_usuario["empresas_permite_cadastrar"] == 0) ? "checked" : "";

$permissoes["empresas"][1]["titulo"]=	"Permite Exibir Detalhes";
$permissoes["empresas"][1]["name"]= 	"empresas_permite_exibir_detalhes";
$permissoes["empresas"][1]["sim"]= 		($permissoes_usuario["empresas_permite_exibir_detalhes"] == 1) ? "checked" : "";
$permissoes["empresas"][1]["nao"]= 		($permissoes_usuario["empresas_permite_exibir_detalhes"] == 0) ? "checked" : "";

$permissoes["empresas"][2]["titulo"]=	"Permite Editar";
$permissoes["empresas"][2]["name"]= 	"empresas_permite_editar";
$permissoes["empresas"][2]["sim"]= 		($permissoes_usuario["empresas_permite_editar"] == 1) ? "checked" : "";
$permissoes["empresas"][2]["nao"]= 		($permissoes_usuario["empresas_permite_editar"] == 0) ? "checked" : "";

$permissoes["empresas"][3]["titulo"]=	"Permite Ativar";
$permissoes["empresas"][3]["name"]= 	"empresas_permite_ativar";
$permissoes["empresas"][3]["sim"]= 		($permissoes_usuario["empresas_permite_ativar"] == 1) ? "checked" : "";
$permissoes["empresas"][3]["nao"]= 		($permissoes_usuario["empresas_permite_ativar"] == 0) ? "checked" : "";

$permissoes["empresas"][4]["titulo"]=	"Permite Inativar";
$permissoes["empresas"][4]["name"]= 	"empresas_permite_inativar";
$permissoes["empresas"][4]["sim"]= 		($permissoes_usuario["empresas_permite_inativar"] == 1) ? "checked" : "";
$permissoes["empresas"][4]["nao"]= 		($permissoes_usuario["empresas_permite_inativar"] == 0) ? "checked" : "";

$permissoes["empresas"][5]["titulo"]=	"Permite Excluir";
$permissoes["empresas"][5]["name"]= 	"empresas_permite_excluir";
$permissoes["empresas"][5]["sim"]= 		($permissoes_usuario["empresas_permite_excluir"] == 1) ? "checked" : "";
$permissoes["empresas"][5]["nao"]= 		($permissoes_usuario["empresas_permite_excluir"] == 0) ? "checked" : "";

$permissoes["empresas"][6]["titulo"]=	"Permite Gerenciar";
$permissoes["empresas"][6]["name"]= 	"empresas_permite_gerenciar";
$permissoes["empresas"][6]["sim"]= 		($permissoes_usuario["empresas_permite_gerenciar"] == 1) ? "checked" : "";
$permissoes["empresas"][6]["nao"]= 		($permissoes_usuario["empresas_permite_gerenciar"] == 0) ? "checked" : "";


//	Usuários
$permissoes["usuarios"]= array();
$permissoes["usuarios"][0]= array();
$permissoes["usuarios"][0]["titulo"]=	"Permite Cadastrar";
$permissoes["usuarios"][0]["name"]= 	"usuarios_permite_cadastrar";
$permissoes["usuarios"][0]["sim"]= 		($permissoes_usuario["usuarios_permite_cadastrar"] == 1) ? "checked" : "";
$permissoes["usuarios"][0]["nao"]= 		($permissoes_usuario["usuarios_permite_cadastrar"] == 0) ? "checked" : "";

$permissoes["usuarios"][1]["titulo"]=	"Permite Exibir Detalhes";
$permissoes["usuarios"][1]["name"]= 	"usuarios_permite_exibir_detalhes";
$permissoes["usuarios"][1]["sim"]= 		($permissoes_usuario["usuarios_permite_exibir_detalhes"] == 1) ? "checked" : "";
$permissoes["usuarios"][1]["nao"]= 		($permissoes_usuario["usuarios_permite_exibir_detalhes"] == 0) ? "checked" : "";

$permissoes["usuarios"][2]["titulo"]=	"Permite Editar";
$permissoes["usuarios"][2]["name"]= 	"usuarios_permite_editar";
$permissoes["usuarios"][2]["sim"]= 		($permissoes_usuario["usuarios_permite_editar"] == 1) ? "checked" : "";
$permissoes["usuarios"][2]["nao"]= 		($permissoes_usuario["usuarios_permite_editar"] == 0) ? "checked" : "";

$permissoes["usuarios"][3]["titulo"]=	"Permite Resetar Senha";
$permissoes["usuarios"][3]["name"]= 	"usuarios_permite_resetar_senha";
$permissoes["usuarios"][3]["sim"]= 		($permissoes_usuario["usuarios_permite_resetar_senha"] == 1) ? "checked" : "";
$permissoes["usuarios"][3]["nao"]= 		($permissoes_usuario["usuarios_permite_resetar_senha"] == 0) ? "checked" : "";

$permissoes["usuarios"][4]["titulo"]=	"Permite Duplicar";
$permissoes["usuarios"][4]["name"]= 	"usuarios_permite_duplicar";
$permissoes["usuarios"][4]["sim"]= 		($permissoes_usuario["usuarios_permite_duplicar"] == 1) ? "checked" : "";
$permissoes["usuarios"][4]["nao"]= 		($permissoes_usuario["usuarios_permite_duplicar"] == 0) ? "checked" : "";

$permissoes["usuarios"][5]["titulo"]=	"Permite Alterar Senha";
$permissoes["usuarios"][5]["name"]= 	"usuarios_permite_alterar_senha";
$permissoes["usuarios"][5]["sim"]= 		($permissoes_usuario["usuarios_permite_alterar_senha"] == 1) ? "checked" : "";
$permissoes["usuarios"][5]["nao"]= 		($permissoes_usuario["usuarios_permite_alterar_senha"] == 0) ? "checked" : "";

$permissoes["usuarios"][6]["titulo"]=	"Permite Alterar Permissões";
$permissoes["usuarios"][6]["name"]= 	"usuarios_permite_alterar_permissoes";
$permissoes["usuarios"][6]["sim"]= 		($permissoes_usuario["usuarios_permite_alterar_permissoes"] == 1) ? "checked" : "";
$permissoes["usuarios"][6]["nao"]= 		($permissoes_usuario["usuarios_permite_alterar_permissoes"] == 0) ? "checked" : "";

$permissoes["usuarios"][7]["titulo"]=	"Permite Ativar";
$permissoes["usuarios"][7]["name"]= 	"usuarios_permite_ativar";
$permissoes["usuarios"][7]["sim"]= 		($permissoes_usuario["usuarios_permite_ativar"] == 1) ? "checked" : "";
$permissoes["usuarios"][7]["nao"]= 		($permissoes_usuario["usuarios_permite_ativar"] == 0) ? "checked" : "";

$permissoes["usuarios"][8]["titulo"]=	"Permite Inativar";
$permissoes["usuarios"][8]["name"]= 	"usuarios_permite_inativar";
$permissoes["usuarios"][8]["sim"]= 		($permissoes_usuario["usuarios_permite_inativar"] == 1) ? "checked" : "";
$permissoes["usuarios"][8]["nao"]= 		($permissoes_usuario["usuarios_permite_inativar"] == 0) ? "checked" : "";

$permissoes["usuarios"][9]["titulo"]=	"Permite Excluir";
$permissoes["usuarios"][9]["name"]= 	"usuarios_permite_excluir";
$permissoes["usuarios"][9]["sim"]= 		($permissoes_usuario["usuarios_permite_excluir"] == 1) ? "checked" : "";
$permissoes["usuarios"][9]["nao"]= 		($permissoes_usuario["usuarios_permite_excluir"] == 0) ? "checked" : "";

//	Clientes
$permissoes["clientes"]= array();
$permissoes["clientes"][0]= array();
$permissoes["clientes"][0]["titulo"]=	"Permite Cadastrar";
$permissoes["clientes"][0]["name"]= 	"clientes_permite_cadastrar";
$permissoes["clientes"][0]["sim"]= 		($permissoes_usuario["clientes_permite_cadastrar"] == 1) ? "checked" : "";
$permissoes["clientes"][0]["nao"]= 		($permissoes_usuario["clientes_permite_cadastrar"] == 0) ? "checked" : "";

$permissoes["clientes"][1]["titulo"]=	"Permite Exibir Detalhes";
$permissoes["clientes"][1]["name"]= 	"clientes_permite_exibir_detalhes";
$permissoes["clientes"][1]["sim"]= 		($permissoes_usuario["clientes_permite_exibir_detalhes"] == 1) ? "checked" : "";
$permissoes["clientes"][1]["nao"]= 		($permissoes_usuario["clientes_permite_exibir_detalhes"] == 0) ? "checked" : "";

$permissoes["clientes"][2]["titulo"]=	"Permite Editar";
$permissoes["clientes"][2]["name"]= 	"clientes_permite_editar";
$permissoes["clientes"][2]["sim"]= 		($permissoes_usuario["clientes_permite_editar"] == 1) ? "checked" : "";
$permissoes["clientes"][2]["nao"]= 		($permissoes_usuario["clientes_permite_editar"] == 0) ? "checked" : "";

$permissoes["clientes"][3]["titulo"]=	"Permite Duplicar";
$permissoes["clientes"][3]["name"]= 	"clientes_permite_duplicar";
$permissoes["clientes"][3]["sim"]= 		($permissoes_usuario["clientes_permite_duplicar"] == 1) ? "checked" : "";
$permissoes["clientes"][3]["nao"]= 		($permissoes_usuario["clientes_permite_duplicar"] == 0) ? "checked" : "";

$permissoes["clientes"][4]["titulo"]=	"Permite Ativar";
$permissoes["clientes"][4]["name"]= 	"clientes_permite_ativar";
$permissoes["clientes"][4]["sim"]= 		($permissoes_usuario["clientes_permite_ativar"] == 1) ? "checked" : "";
$permissoes["clientes"][4]["nao"]= 		($permissoes_usuario["clientes_permite_ativar"] == 0) ? "checked" : "";

$permissoes["clientes"][5]["titulo"]=	"Permite Inativar";
$permissoes["clientes"][5]["name"]= 	"clientes_permite_inativar";
$permissoes["clientes"][5]["sim"]= 		($permissoes_usuario["clientes_permite_inativar"] == 1) ? "checked" : "";
$permissoes["clientes"][5]["nao"]= 		($permissoes_usuario["clientes_permite_inativar"] == 0) ? "checked" : "";

$permissoes["clientes"][6]["titulo"]=	"Permite Excluir";
$permissoes["clientes"][6]["name"]= 	"clientes_permite_excluir";
$permissoes["clientes"][6]["sim"]= 		($permissoes_usuario["clientes_permite_excluir"] == 1) ? "checked" : "";
$permissoes["clientes"][6]["nao"]= 		($permissoes_usuario["clientes_permite_excluir"] == 0) ? "checked" : "";

//	Contatos
$permissoes["contatos"]= array();
$permissoes["contatos"][0]= array();
$permissoes["contatos"][0]["titulo"]=	"Permite Cadastrar";
$permissoes["contatos"][0]["name"]= 	"contatos_permite_cadastrar";
$permissoes["contatos"][0]["sim"]= 		($permissoes_usuario["contatos_permite_cadastrar"] == 1) ? "checked" : "";
$permissoes["contatos"][0]["nao"]= 		($permissoes_usuario["contatos_permite_cadastrar"] == 0) ? "checked" : "";

$permissoes["contatos"][1]["titulo"]=	"Permite Exibir Detalhes";
$permissoes["contatos"][1]["name"]= 	"contatos_permite_exibir_detalhes";
$permissoes["contatos"][1]["sim"]= 		($permissoes_usuario["contatos_permite_exibir_detalhes"] == 1) ? "checked" : "";
$permissoes["contatos"][1]["nao"]= 		($permissoes_usuario["contatos_permite_exibir_detalhes"] == 0) ? "checked" : "";

$permissoes["contatos"][2]["titulo"]=	"Permite Editar";
$permissoes["contatos"][2]["name"]= 	"contatos_permite_editar";
$permissoes["contatos"][2]["sim"]= 		($permissoes_usuario["contatos_permite_editar"] == 1) ? "checked" : "";
$permissoes["contatos"][2]["nao"]= 		($permissoes_usuario["contatos_permite_editar"] == 0) ? "checked" : "";

$permissoes["contatos"][3]["titulo"]=	"Permite Duplicar";
$permissoes["contatos"][3]["name"]= 	"contatos_permite_duplicar";
$permissoes["contatos"][3]["sim"]= 		($permissoes_usuario["contatos_permite_duplicar"] == 1) ? "checked" : "";
$permissoes["contatos"][3]["nao"]= 		($permissoes_usuario["contatos_permite_duplicar"] == 0) ? "checked" : "";

$permissoes["contatos"][4]["titulo"]=	"Permite Ativar";
$permissoes["contatos"][4]["name"]= 	"contatos_permite_ativar";
$permissoes["contatos"][4]["sim"]= 		($permissoes_usuario["contatos_permite_ativar"] == 1) ? "checked" : "";
$permissoes["contatos"][4]["nao"]= 		($permissoes_usuario["contatos_permite_ativar"] == 0) ? "checked" : "";

$permissoes["contatos"][5]["titulo"]=	"Permite Inativar";
$permissoes["contatos"][5]["name"]= 	"contatos_permite_inativar";
$permissoes["contatos"][5]["sim"]= 		($permissoes_usuario["contatos_permite_inativar"] == 1) ? "checked" : "";
$permissoes["contatos"][5]["nao"]= 		($permissoes_usuario["contatos_permite_inativar"] == 0) ? "checked" : "";

$permissoes["contatos"][6]["titulo"]=	"Permite Excluir";
$permissoes["contatos"][6]["name"]= 	"contatos_permite_excluir";
$permissoes["contatos"][6]["sim"]= 		($permissoes_usuario["contatos_permite_excluir"] == 1) ? "checked" : "";
$permissoes["contatos"][6]["nao"]= 		($permissoes_usuario["contatos_permite_excluir"] == 0) ? "checked" : "";
?>




<!--	Panel	-->
<div class="panel panel-info text-left">
	<div class="panel-heading">
		<h3 class="panel-title">Detalhes <?php echo get_class($U); ?></h3>
	</div>
	

	<!--	Bt Voltar	-->
	<div class="row">
		<div class="col-md-2">
			<button type="button" class="btn btn-success btn-block" onClick="loadPage('view/<?php echo strtolower(get_class($U)); ?>s_lista.php', '');">Voltar</button>
		</div>
		<?php if($_SESSION["permissoes"]["usuarios_permite_editar"]) {//	clientes editar ?>
			<div class="col-md-2">
				<button type="button" class="btn btn-success btn-block" onClick="loadPage('view/<?php echo strtolower(get_class($U)); ?>s_form.php?act=update&id=<?php echo $Obj[0]->get("id"); ?>', '');">Editar</button>
			</div>
		<?php } ?>
		<div class="text-center" id="retorno"></div>
	</div>


	<!--	TAbs	-->
	<ul id="myTab1" class="nav nav-tabs nav-justified">
		<li class="active"><a href="#detalhes1" data-toggle="tab">Dados Gerais</a></li>
		
		<?php if($_SESSION["permissoes"]["usuarios_permite_alterar_senha"]) {//	usuarios alterar senha ?>
			<li><a href="#acesso1" data-toggle="tab">Dados de Acesso</a></li>
		<?php } ?>
		
		<?php if($_SESSION["permissoes"]["usuarios_permite_alterar_permissoes"]) {//	usuarios alterar permissões ?>
			<li><a href="#permissoes1" data-toggle="tab">Permissões</a></li>
		<?php } ?>
		
		<!--
		<li class="dropdown">
			<a href="#" id="myTabDrop1-1" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
			<ul class="dropdown-menu" role="menu" aria-labelledby="myTabDrop1">
				<li><a href="#dropdown1-1" tabindex="-1" data-toggle="tab">@fat</a></li>
				<li><a href="#dropdown1-2" tabindex="-1" data-toggle="tab">@mdo</a></li>
			</ul>
		</li>
		-->
		
	</ul>

	<!--	Dados gerais	-->
	<div id="myTabContent" class="tab-content">
		<div class="tab-pane fade active in" id="detalhes1">
			<p>
				<table class="table table-bordered">
					<thead>
						<tr>
							<th colspan="2" class="text-center"></</th>
						</tr>
					</thead>

					<tfoot>
						<tr>
							<td colspan="2"></td>
						</tr>
					</tfoot>

					<tbody class="text-left">
						<tr>
							<td class="info col-md-1">ID:</td>
							<td class="col-md-6"><?php echo $Obj[0]->get("id"); ?></td>
						</tr>
						<tr>
							<td class="info">Foto:</td>
							<td>
								<?php if($Obj[0]->get("foto") != "") {#	Se há foto, então mostra a miniatura ?>
									<img src="upload/<?php echo strtolower(get_class($U)); ?>s/miniatura/<?php echo $Obj[0]->get("foto"); ?>?nocache=<?php echo rand(1,100); ?>" />
								<?php }//fim foto ?>
							</td>
						</tr>
						
						<tr>
							<td class="info">Email:</td>
							<td><?php echo $Obj[0]->get("email"); ?></td>
						</tr>
						<tr>
							<td class="info">Senha:</td>
							<td><?php //echo $Obj[0]->get("senha"); ?></td>
						</tr>
						<tr>
							<td class="info">Nome:</td>
							<td><?php echo $Obj[0]->get("nome"); ?></td>
						</tr>
						<tr>
							<td class="info">Data de nascimento:</td>
							<td><?php echo $Obj[0]->get("data_nascimento"); ?></td>
						</tr>
						<tr>
							<td class="info">CPF:</td>
							<td><?php echo $Obj[0]->get("cpf"); ?></td>
						</tr>
						<tr>
							<td class="info">Sexo:</td>
							<td><?php echo $Obj[0]->get("sexo"); ?></td>
						</tr>
						<tr>
							<td class="info">Telefone:</td>
							<td><?php echo $Obj[0]->get("telefone"); ?></td>
						</tr>
						<tr>
							<td class="info">Telefone2:</td>
							<td><?php echo $Obj[0]->get("telefone2"); ?></td>
						</tr>
						<tr>
							<td class="info">Celular:</td>
							<td><?php echo $Obj[0]->get("celular"); ?></td>
						</tr>
						<tr>
							<td class="info">Facebook:</td>
							<td><?php echo $Obj[0]->get("facebook"); ?></td>
						</tr>
						<tr>
							<td class="info">Detalhes:</td>
							<td><?php echo $Obj[0]->get("detalhes"); ?></td>
						</tr>
						<tr>
							<td class="info">Data cadastro:</td>
							<td><?php echo $Obj[0]->get("data_cadastro"); ?></td>
						</tr>
						<tr>
							<td class="info">Data última atualização:</td>
							<td><?php echo $Obj[0]->get("data_ultima_atualizacao"); ?></td>
						</tr>
						<tr>
							<td class="info">Qtd acessos:</td>
							<td><?php echo $Obj[0]->get("qtd_acessos"); ?></td>
						</tr>
						<tr>
							<td class="info">Data último acesso:</td>
							<td><?php echo $Obj[0]->get("data_ultimo_acesso"); ?></td>
						</tr>
						<tr>
							<td class="info">Ativo:</td>
							<td><?php echo ($Obj[0]->get("flag_ativo") == 1) ? "Ativo" : "Inativo"; ?></td>
						</tr>
					</tbody>
				</table>
			</p>
		</div>

		<!--	Dados de acesso	-->
		<div class="tab-pane fade" id="acesso1">
			<p>
				<!--	Form	-->
				<form name="<?php echo strtolower(get_class($U)); ?>-form" role="form" class="form-horizontal" action="control/<?php echo strtolower(get_class($U)); ?>_controle.php?act=passwordUpdate">

					<!--	Foto e nome	-->
					<div class="form-group ">
						<label class="col-md-2 control-label">&nbsp;</label>
						<div class="col-md-2">
							<?php if($Obj[0]->get("foto") != "") {#	Se há foto, então mostra a miniatura ?>
								<img src="upload/<?php echo strtolower(get_class($U)); ?>s/miniatura/<?php echo $Obj[0]->get("foto"); ?>" />
							<?php }//fim foto ?>	
						</div>
						<div class="col-md-2">
							<h5><?php echo $Obj[0]->get("nome"); ?></h5>
						</div>
					</div>
					
					<!--	Inputs	-->
					<div class="form-group hidden">
						<label class="col-md-2 control-label">Id</label>
						<div class="col-md-6">
							<input type="text" name="id" id="id" placeholder="Id" class="form-control" readonly value="<?php echo isset($Obj[0]) ? $Obj[0]->get("id") : ""; ?>">
						</div>
					</div>
					<div class="row">
						<label class="col-md-2 control-label">E-mail</label>
						<div class="col-md-6 has-warning">
							<input type="text" name="email" id="email" required placeholder="E-mail" class="form-control" readonly value="<?php echo isset($Obj[0]) ? $Obj[0]->get("email") : ""; ?>">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label">Nova Senha</label>
						<div class="col-md-6 has-warning">
							<input type="text" name="senha" id="senha" required placeholder="Nova Senha" class="form-control" value="">
						</div>
					</div>
					
					<!--	Bt Alterar Senha	-->
					<div class="row">
						<div class="col-md-2">&nbsp;</div>
						<div class="col-md-2">
							<button type="button" class="btn btn-success btn-block" onClick="save(this.form);">Alterar Senha</button>
						</div>
					</div>
					
				</form><!--	fim form	-->
			</p>
		</div>
		
		
		<!--	Permissões	-->
		<div class="tab-pane fade" id="permissoes1">
			<p>
				<!--	Form	-->
				<form name="<?php echo strtolower(get_class($U)); ?>-form" role="form" class="form-horizontal" action="control/<?php echo strtolower(get_class($U)); ?>_controle.php?act=update_permissoes">
					
					<!--	Bt Salvar	-->
					<div class="row">
						<div class="col-md-2">&nbsp;</div>
						<div class="col-md-2">
							<button type="button" class="btn btn-success btn-block" onClick="save(this.form);">Salvar</button>
						</div>
					</div>
					
					<!--	Inputs	-->
					<div class="form-group hidden">
						<label class="col-md-2 control-label">Id</label>
						<div class="col-md-6">
							<input type="text" name="id_usuario" id="id_usuario" placeholder="Id_usuario" class="form-control" readonly value="<?php echo isset($Obj[0]) ? $Obj[0]->get("id") : ""; ?>">
						</div>
					</div>
					
					<!--	Sistema	-->
					<div class="panel panel-warning col-md-12">
						<div class="panel-heading">
							<h3 class="panel-title">Sistema</h3>
						</div>
						<table class="table">
							<thead>
								<tr>
									<th colspan="2"></th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($permissoes["sistema"] as $item) { ?>
									<tr>
										<td class="col-md-2"><?php echo $item["titulo"]; ?></td>
										<td class="text-center">
											<div class="col-md-2">
												<div class="radio">
													<input type="radio" name="<?php echo $item["name"]; ?>" id="<?php echo $item["name"]; ?>_1" value="1" <?php echo $item["sim"]; ?>>
													<label for="<?php echo $item["name"]; ?>_1">Sim</label>
												</div>
											</div>
											<div class="col-md-2">
												<div class="radio">
													<input type="radio" name="<?php echo $item["name"]; ?>" id="<?php echo $item["name"]; ?>_0" value="0" <?php echo $item["nao"]; ?>>
													<label for="<?php echo $item["name"]; ?>_0">Não</label>
												</div>
											</div>
										</td>
									</tr>
								<?php }  ?>
							</tbody>
						</table>
					</div>


					<!--	Empresas	-->
					<div class="panel panel-danger col-md-12">
						<div class="panel-heading">
							<h3 class="panel-title">Empresas</h3>
						</div>
						<table class="table">
							<thead>
								<tr>
									<th colspan="2"></th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($permissoes["empresas"] as $item) { ?>
									<tr>
										<td class="col-md-2"><?php echo $item["titulo"]; ?></td>
										<td class="text-center">
											<div class="col-md-2">
												<div class="radio">
													<input type="radio" name="<?php echo $item["name"]; ?>" id="<?php echo $item["name"]; ?>_1" value="1" <?php echo $item["sim"]; ?>>
													<label for="<?php echo $item["name"]; ?>_1">Sim</label>
												</div>
											</div>
											<div class="col-md-2">
												<div class="radio">
													<input type="radio" name="<?php echo $item["name"]; ?>" id="<?php echo $item["name"]; ?>_0" value="0" <?php echo $item["nao"]; ?>>
													<label for="<?php echo $item["name"]; ?>_0">Não</label>
												</div>
											</div>
										</td>
									</tr>
								<?php }  ?>
							</tbody>
						</table>
					</div>


					<!--	Usuários	-->
					<div class="panel panel-primary col-md-12">
						<div class="panel-heading">
							<h3 class="panel-title">Usuários</h3>
						</div>
						<table class="table">
							<thead>
								<tr>
									<th colspan="2"></th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($permissoes["usuarios"] as $item) { ?>
									<tr>
										<td class="col-md-2"><?php echo $item["titulo"]; ?></td>
										<td class="text-center">
											<div class="col-md-2">
												<div class="radio">
													<input type="radio" name="<?php echo $item["name"]; ?>" id="<?php echo $item["name"]; ?>_1" value="1" <?php echo $item["sim"]; ?>>
													<label for="<?php echo $item["name"]; ?>_1">Sim</label>
												</div>
											</div>
											<div class="col-md-2">
												<div class="radio">
													<input type="radio" name="<?php echo $item["name"]; ?>" id="<?php echo $item["name"]; ?>_0" value="0" <?php echo $item["nao"]; ?>>
													<label for="<?php echo $item["name"]; ?>_0">Não</label>
												</div>
											</div>
										</td>
									</tr>
								<?php }  ?>
							</tbody>
						</table>
					</div>


					<!--	Clientes	-->
					<div class="panel panel-primary col-md-12">
						<div class="panel-heading">
							<h3 class="panel-title">Clientes</h3>
						</div>
						<table class="table">
							<thead>
								<tr>
									<th colspan="2"></th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($permissoes["clientes"] as $item) { ?>
									<tr>
										<td class="col-md-2"><?php echo $item["titulo"]; ?></td>
										<td class="text-center">
											<div class="col-md-2">
												<div class="radio">
													<input type="radio" name="<?php echo $item["name"]; ?>" id="<?php echo $item["name"]; ?>_1" value="1" <?php echo $item["sim"]; ?>>
													<label for="<?php echo $item["name"]; ?>_1">Sim</label>
												</div>
											</div>
											<div class="col-md-2">
												<div class="radio">
													<input type="radio" name="<?php echo $item["name"]; ?>" id="<?php echo $item["name"]; ?>_0" value="0" <?php echo $item["nao"]; ?>>
													<label for="<?php echo $item["name"]; ?>_0">Não</label>
												</div>
											</div>
										</td>
									</tr>
								<?php }  ?>
							</tbody>
						</table>
					</div>
                    
                    
                    <!--	Contatos	-->
					<div class="panel panel-primary col-md-12">
						<div class="panel-heading">
							<h3 class="panel-title">Contatos</h3>
						</div>
						<table class="table">
							<thead>
								<tr>
									<th colspan="2"></th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($permissoes["contatos"] as $item) { ?>
									<tr>
										<td class="col-md-2"><?php echo $item["titulo"]; ?></td>
										<td class="text-center">
											<div class="col-md-2">
												<div class="radio">
													<input type="radio" name="<?php echo $item["name"]; ?>" id="<?php echo $item["name"]; ?>_1" value="1" <?php echo $item["sim"]; ?>>
													<label for="<?php echo $item["name"]; ?>_1">Sim</label>
												</div>
											</div>
											<div class="col-md-2">
												<div class="radio">
													<input type="radio" name="<?php echo $item["name"]; ?>" id="<?php echo $item["name"]; ?>_0" value="0" <?php echo $item["nao"]; ?>>
													<label for="<?php echo $item["name"]; ?>_0">Não</label>
												</div>
											</div>
										</td>
									</tr>
								<?php }  ?>
							</tbody>
						</table>
					</div>
					
					<!--	Bt Salvar	-->
					<div class="row">
						<div class="col-md-2">&nbsp;</div>
						<div class="col-md-2">
							<button type="button" class="btn btn-success btn-block" onClick="save(this.form);">Salvar</button>
						</div>
					</div>
				
				</form><!--	fim form	-->
			</p>
		</div>
		
		
		<!--
		<div class="tab-pane fade" id="dropdown1-1">
			<p>Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft beer, iphone...</p>
		</div>
		<div class="tab-pane fade" id="dropdown1-2">
			<p>Trust fund seitan letterpress, keytar raw denim keffiyeh etsy art party before they sold out master cleanse gluten-free squid scenester freegan cosby sweater. Fanny pack portland seitan DIY, art party locavore wolf cliche ...</p>
			<p>Trust fund seitan letterpress, keytar raw denim keffiyeh etsy art party before they sold out master cleanse gluten-free squid scenester freegan cosby sweater. Fanny pack portland seitan DIY, art party locavore wolf cliche ...</p>
			<p>Trust fund seitan letterpress, keytar raw denim keffiyeh etsy art party before they sold out master cleanse gluten-free squid scenester freegan cosby sweater. Fanny pack portland seitan DIY, art party locavore wolf cliche ...</p>
			<p>Trust fund seitan letterpress, keytar raw denim keffiyeh etsy art party before they sold out master cleanse gluten-free squid scenester freegan cosby sweater. Fanny pack portland seitan DIY, art party locavore wolf cliche ...</p>
			<p>Trust fund seitan letterpress, keytar raw denim keffiyeh etsy art party before they sold out master cleanse gluten-free squid scenester freegan cosby sweater. Fanny pack portland seitan DIY, art party locavore wolf cliche ...</p>
			<p>Trust fund seitan letterpress, keytar raw denim keffiyeh etsy art party before they sold out master cleanse gluten-free squid scenester freegan cosby sweater. Fanny pack portland seitan DIY, art party locavore wolf cliche ...</p>
			<p>Trust fund seitan letterpress, keytar raw denim keffiyeh etsy art party before they sold out master cleanse gluten-free squid scenester freegan cosby sweater. Fanny pack portland seitan DIY, art party locavore wolf cliche ...</p>
		</div>
		-->
	</div>

	<!--	Bt Voltar	-->
	<div class="row">
		<div class="col-md-2">
			<button type="button" class="btn btn-success btn-block" onClick="loadPage('view/<?php echo strtolower(get_class($U)); ?>s_lista.php', '');">Voltar</button>
		</div>
		<?php if($_SESSION["permissoes"]["usuarios_permite_editar"]) {//	clientes editar ?>
			<div class="col-md-2">
				<button type="button" class="btn btn-success btn-block" onClick="loadPage('view/<?php echo strtolower(get_class($U)); ?>s_form.php?act=update&id=<?php echo $Obj[0]->get("id"); ?>', '');">Editar</button>
			</div>
		<?php } ?>
	</div>


</div><!--	fim Panel	-->