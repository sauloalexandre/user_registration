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
		<div class="col-md-2">
			<button type="button" class="btn btn-success btn-block" onClick="loadPage('view/<?php echo strtolower(get_class($U)); ?>s_form.php?act=update&id=<?php echo $Obj[0]->get("id"); ?>', '');">Editar</button>
		</div>
		<div class="text-center" id="retorno"></div>
	</div>


	<!--	TAbs	-->
	<ul id="myTab1" class="nav nav-tabs nav-justified">
		<li class="active"><a href="#detalhes1" data-toggle="tab">Dados Gerais</a></li>
        <li><a href="#acesso1" data-toggle="tab">Dados de Acesso</a></li>
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
	</div>

	<!--	Bt Voltar	-->
	<div class="row">
		<div class="col-md-2">
			<button type="button" class="btn btn-success btn-block" onClick="loadPage('view/<?php echo strtolower(get_class($U)); ?>s_lista.php', '');">Voltar</button>
		</div>
		<div class="col-md-2">
			<button type="button" class="btn btn-success btn-block" onClick="loadPage('view/<?php echo strtolower(get_class($U)); ?>s_form.php?act=update&id=<?php echo $Obj[0]->get("id"); ?>', '');">Editar</button>
		</div>
	</div>


</div><!--	fim Panel	-->