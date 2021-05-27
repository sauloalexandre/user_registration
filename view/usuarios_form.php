<?php session_start();
#	Autoload classes
function __autoload($class){ require_once("../model/".$class.".class.php"); }
#	Controle
include_once("../control/comom.php");


#	Objeto
$U= new Usuario();



#	Parâmetros
$param["qtd"]= 0;
$param["act"]= isset($_REQUEST["act"]) ? $_REQUEST["act"] : "";

//	Se há act
if($param["act"] != "") {

	
	// escolhe a act
	switch($param["act"]) {
	
		case "add":
			//
			break;
		
		case "update":
			#	Carrega o Obj
			$param["id"]= (int)$_REQUEST["id"];
			$lista= $U->getUsuarios($param);
			$param["qtd"]= count($lista);
			//show($lista);
			break;
	
	}//fim escolhe act

} else {//	senão, aborta o script
	
	exit("!");

}//	fim act
?>








<!--	Panel	-->
<div class="panel panel-info text-left">
	<div class="panel-heading">
		<h3 class="panel-title"><?php echo ($param["act"] == "add") ? "Cadastrar" : "Atualizar"; ?> <?php echo get_class($U); ?></h3>
	</div>
	<div id="retorno"></div>

	<!--	Form	-->
	<form novalidate name="<?php echo strtolower(get_class($U)); ?>-form" id="form" role="form" class="form-horizontal" action="control/<?php echo strtolower(get_class($U)); ?>_controle.php?act=<?php echo $param["act"]; ?>" method="post" enctype="multipart/form-data">

		<!--	Bt Voltar e Salvar	-->
		<div class="row">
			<div class="col-md-2">
				<button type="button" class="btn btn-success btn-block" onClick="loadPage('view/<?php echo strtolower(get_class($U)); ?>s_lista.php', '');">Voltar</button>
			</div>
			<div class="col-md-2">
				<button type="button" class="btn btn-success btn-block" onClick="save(this.form);">Salvar</button>
			</div>
		</div>
		<br>
	
		<!--	Inputs	-->
		<div class="form-group ">
			<label class="col-md-2 control-label">Id</label>
			<div class="col-md-6">
				<input type="text" name="id" id="id" placeholder="Id" class="form-control" readonly value="<?php echo isset($lista[0]) ? $lista[0]->get("id") : ""; ?>">
				<input type="hidden" name="empresa_id" id="empresa_id" placeholder="empresa_id" class="form-control" readonly value="<?php echo isset($lista[0]) ? $lista[0]->get("empresa_id") : $_SESSION["login"]["empresa_id"]; ?>">
				<input type="hidden" name="flag_usuario" id="flag_usuario" placeholder="flag_usuario" class="form-control" readonly value="1">
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label">Foto</label>
			<div class="col-md-4">
				<div id="pre">
					<?php if(isset($lista[0]) && $lista[0]->get("foto") != "") {#	Se há foto, então mostra a miniatura ?>
						<img src="upload/<?php echo strtolower(get_class($U)); ?>s/miniatura/<?php echo $lista[0]->get("foto"); ?>?nocache=<?php echo rand(1,100); ?>" />
					<?php }//fim foto ?>
				</div>
				<input type="file" name="foto_arquivo" id="foto_arquivo">
				<input type="hidden" name="foto" id="foto" placeholder="Foto" class="form-control" value="<?php echo isset($lista[0]) ? $lista[0]->get("foto") : ""; ?>">
				<p class="help-block text-left">Tamanho ideal 640x480. Formatos aceitos jpg, jpeg ou png</p>
			</div>
			<div class="col-md-2">
				<progress value="0" max="100"></progress><span id="porcentagem">0%</span>
				<br><input type="submit" value="Enviar foto">
			</div>
		</div>
		<div class="row">
			<label class="col-md-2 control-label">E-mail</label>
			<div class="col-md-6 has-warning">
				<input type="text" name="email" id="email" required placeholder="E-mail" class="form-control" value="<?php echo isset($lista[0]) ? $lista[0]->get("email") : ""; ?>">
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label">Senha</label>
			<div class="col-md-6 has-warning">
				<input type="text" name="senha" id="senha" required placeholder="Senha" class="form-control" value="<?php echo isset($lista[0]) ? decrypta($lista[0]->get("senha") ) : ""; ?>">
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label">Nome</label>
			<div class="col-md-6 has-warning">
				<input type="text" name="nome" id="nome" required placeholder="Nome" class="form-control required" value="<?php echo isset($lista[0]) ? $lista[0]->get("nome") : ""; ?>">
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label">Data de nascimento</label>
			<div class="col-md-6">
				<input type="text" name="data_nascimento" id="data_nascimento" placeholder="Data de nascimento" class="form-control datepicker data" value="<?php echo isset($lista[0]) ? inverteData($lista[0]->get("data_nascimento") ) : ""; ?>" ondblclick="getData(this);">
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label">Cpf</label>
			<div class="col-md-6">
				<input type="text" name="cpf" id="cpf" placeholder="Cpf" class="form-control cpf" value="<?php echo isset($lista[0]) ? $lista[0]->get("cpf") : ""; ?>">
			</div>
		</div>
		
		<!--	Sexo	-->
		<div class="form-group text-center">
			<label class="col-md-2 control-label">Sexo</label>
			<div class="col-md-2">
				<div class="radio">
					<input type="radio" name="sexo" id="sexo_m" value="M" <?php echo (isset($lista[0]) && $lista[0]->get("sexo") == 'M') ? "checked='checked'" : "" ; ?>>
					<label for="sexo_m">Masculino</label>
				</div>
			</div>
			<div class="col-md-2">
				<div class="radio">
					<input type="radio" name="sexo" id="sexo_f" value="F" <?php echo (isset($lista[0]) && $lista[0]->get("sexo") == 'F') ? "checked='checked'" : "" ; ?>>
					<label for="sexo_f">Feminino</label>
				</div>
			</div>
		</div>
		
		<div class="form-group">
			<label class="col-md-2 control-label">Telefone</label>
			<div class="col-md-6">
				<input type="text" name="telefone" id="telefone" placeholder="Telefone" class="form-control telefone" value="<?php echo isset($lista[0]) ? $lista[0]->get("telefone") : ""; ?>">
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label">Telefone2</label>
			<div class="col-md-6">
				<input type="text" name="telefone2" id="telefone2" placeholder="Telefone2"  class="form-control telefone" value="<?php echo isset($lista[0]) ? $lista[0]->get("telefone2") : ""; ?>">
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label">Celular</label>
			<div class="col-md-6">
				<input type="text" name="celular" id="celular" placeholder="Celular" class="form-control celular" value="<?php echo isset($lista[0]) ? $lista[0]->get("celular") : ""; ?>">
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label">Facebook</label>
			<div class="col-md-6">
				<input type="text" name="facebook" id="facebook" placeholder="Facebook" class="form-control" value="<?php echo isset($lista[0]) ? $lista[0]->get("facebook") : ""; ?>">
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label">Detalhes</label>
			<div class="col-md-6">
				<textarea rows="5" cols="30" name="detalhes" id="detalhes" placeholder="Detalhes" class="form-control"><?php echo isset($lista[0]) ? $lista[0]->get("detalhes") : ""; ?></textarea>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label">Data de cadastro</label>
			<div class="col-md-6">
				<input type="text" name="data_cadastro" id="data_cadastro" placeholder="Data de cadastro" class="form-control data" readonly value="<?php echo isset($lista[0]) ? inverteData($lista[0]->get("data_cadastro") ) : "" ?>">
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label">Data última atualização</label>
			<div class="col-md-6">
				<input type="text" name="data_ultima_atualizacao" id="data_ultima_atualizacao" placeholder="Data última atualização" class="form-control data" readonly value="<?php echo isset($lista[0]) ? inverteData($lista[0]->get("data_ultima_atualizacao") ) : ""; ?>">
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label">Qtd acessos</label>
			<div class="col-md-6">
				<input type="text" name="qtd_acessos" id="qtd_acessos" placeholder="Qtd acessos" class="form-control" readonly value="<?php echo isset($lista[0]) ? $lista[0]->get("qtd_acessos") : ""; ?>">
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label">Data último acesso</label>
			<div class="col-md-6">
				<input type="text" name="data_ultimo_acesso" id="data_ultimo_acesso" placeholder="Data último acesso" class="form-control datepicker data" readonly value="<?php echo isset($lista[0]) ? inverteData($lista[0]->get("data_ultimo_acesso") ) : ""; ?>">
			</div>
		</div>
		
		<!--	Flag ativo	-->
		<div class="form-group text-center">
			<label class="col-md-2 control-label">Flag ativo</label>
			<div class="col-md-2">
				<div class="radio">
					<input type="radio" name="flag_ativo" id="flag_ativo_s" value="1" <?php echo (!isset($lista[0]) || (isset($lista[0]) && $lista[0]->get("flag_ativo") == '1') ) ? "checked='checked'" : "" ; ?>>
					<label for="flag_ativo_s">Sim</label>
				</div>
			</div>
			<div class="col-md-2">
				<div class="radio">
					<input type="radio" name="flag_ativo" id="flag_ativo_n" value="0" <?php echo (isset($lista[0]) && $lista[0]->get("flag_ativo") == '0') ? "checked='checked'" : "" ; ?>>
					<label for="flag_ativo_n">Não</label>
				</div>
			</div>
		</div>
		
		<!--	Bt Voltar e Salvar	-->
		<div class="row">
			<div class="col-md-2">
				<button type="button" class="btn btn-success btn-block" onClick="loadPage('view/<?php echo strtolower(get_class($U)); ?>s_lista.php', '');">Voltar</button>
			</div>
			<div class="col-md-2">
				<button type="button" class="btn btn-success btn-block" onClick="save(this.form);">Salvar</button>
			</div>
		</div>

	</form><!--	fim form	-->
	
</div><!--	fim Panel	-->




<script type="text/javascript">
	<?php if(isset($lista[0]) ) {//	Se está editando, então apaga os placeholder os inputs ?>
		apagaPlaceholder();
	<?php } ?>

	$(document).ready(function(){
		
		//	Máscaras
		$(".cep").mask("99999-999");
		$(".cnpj").mask("99.999.999/9999-99");
		$(".cpf").mask("999.999.999-99");
		$(".data").mask("99/99/9999");
		$(".telefone").mask("(99) 9999-9999");
		$(".celular").mask("(99) 99999-9999");
		
		//	Data
		$(".datepicker").datepicker({
			yearRange: "-100:+100",
			changeMonth: true,
			changeYear: true
		});
		
	});


	//	FAz upload da foto via Ajax
	$('#form').ajaxForm({
		url: "control/<?php echo strtolower(get_class($U) ); ?>_controle.php?act=upload&nocache=" + Math.floor((Math.random() * 100) + 1),
		uploadProgress: function(event, position, total, percentComplete) {
			$('progress').attr('value',percentComplete);
      $('#porcentagem').html(percentComplete+'%');
		},
			success: function(data) {
				$('progress').attr('value','100');
        $('#porcentagem').html('100%');
        $('#pre').html(data);
			}
	});
</script>