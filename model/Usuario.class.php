<?php
//Classe Usuario
class Usuario extends Pessoa {
	
	/**	Atributos herdados
	
	+ int id									+ varchar email	
	+ empresa_id								+ varchar senha	
	+ varchar nome								+ varchar nome_social									
	+ varchar fantasia							+ varchar data_nascimento
	+ varchar tipo_pessoa						+ varchar nivel_decisao
	+ varchar cpf
	+ varchar cnpj								+ varchar sexo
	+ varchar endereco							+ varchar complemento
	+ varchar bairro							+ varchar cidade
	+ varchar estado							+ varchar pais
	+ varchar cep								+ varchar telefone;
	+ varchar telefone2							+ varchar celular;
	+ varchar facebook							+ varchar site;
	+ varchar linkedin
	+ varchar detalhes							+ varchar foto;
	+ date data_cadastro						+ date data_ultima_atualizacao
	+ int qtd_acessos							+ date data_ultimo_acesso
	+ varchar flag_ativo						+ varchar flag_status
	+ int flag_usuario							+ int flag_cliente
	+ int flag_contato
	*/
	
	
	/**	Métodos herdados
	
		- set($atr, $valor)						- get($atr)
		- getPessoas($param)					- add($Obj)
		- update($Obj)							- delete($param)
		
	*/
	
	
	
	/***********************************************************************/
	//
	//								GET
	//
	/***********************************************************************/
	/*	
		FUNÇÃO: 	getUsuarios
					Lista os usuários
		PARÂMETROS: param
		RETORNO: 	array de objetos
	*/
	function getUsuarios($param) {
	
		$param["flag_usuario"]= 1;
		return $this->getPessoas($param);

	}
	
	
	
	/*	
		FUNÇÃO: 	getPermissoes_usuario
					Carrega as permissões do usuário
		PARÂMETROS: void
		RETORNO: 	lista
	*/
	function getPermissoes_usuario()
	{
		$mySQL = New MySQL();
		$sql =	"SELECT
					id
					, id_usuario
					, sistema_permite_acessar_configuracoes
					, sistema_permite_acessar_dashboard
					, sistema_permite_acessar_empresas
					, sistema_permite_acessar_usuarios
					, sistema_permite_acessar_clientes
					, sistema_permite_acessar_contatos
					
					, empresas_permite_cadastrar
					, empresas_permite_exibir_detalhes
					, empresas_permite_editar
					, empresas_permite_ativar
					, empresas_permite_inativar
					, empresas_permite_excluir
					, empresas_permite_gerenciar
					
					, usuarios_permite_cadastrar
					, usuarios_permite_exibir_detalhes
					, usuarios_permite_editar
					, usuarios_permite_resetar_senha
					, usuarios_permite_duplicar
					, usuarios_permite_alterar_senha
					, usuarios_permite_alterar_permissoes
					, usuarios_permite_ativar
					, usuarios_permite_inativar
					, usuarios_permite_excluir
					
					, clientes_permite_cadastrar
					, clientes_permite_exibir_detalhes
					, clientes_permite_editar
					, clientes_permite_duplicar
					, clientes_permite_ativar
					, clientes_permite_inativar
					, clientes_permite_excluir
					
					, contatos_permite_cadastrar
					, contatos_permite_exibir_detalhes
					, contatos_permite_editar
					, contatos_permite_duplicar
					, contatos_permite_ativar
					, contatos_permite_inativar
					, contatos_permite_excluir
				FROM
					permissoes_usuario
				WHERE
					id_usuario = ".$this->get("id");
		$rs = $mySQL->runQuery($sql);
		$lista = array();		
		while($row = mysqli_fetch_assoc($rs) ) {
			
			$lista["id"] = $row["id"];
			$lista["id_usuario"] = $row["id_usuario"];
			$lista["sistema_permite_acessar_configuracoes"] = $row["sistema_permite_acessar_configuracoes"];
			$lista["sistema_permite_acessar_dashboard"] = $row["sistema_permite_acessar_dashboard"];
			$lista["sistema_permite_acessar_empresas"] = $row["sistema_permite_acessar_empresas"];
			$lista["sistema_permite_acessar_usuarios"] = $row["sistema_permite_acessar_usuarios"];
			$lista["sistema_permite_acessar_clientes"] = $row["sistema_permite_acessar_clientes"];
			$lista["sistema_permite_acessar_contatos"] = $row["sistema_permite_acessar_contatos"];
			
			$lista["empresas_permite_cadastrar"] = $row["empresas_permite_cadastrar"];
			$lista["empresas_permite_exibir_detalhes"] = $row["empresas_permite_exibir_detalhes"];
			$lista["empresas_permite_editar"] = $row["empresas_permite_editar"];
			$lista["empresas_permite_ativar"] = $row["empresas_permite_ativar"];
			$lista["empresas_permite_inativar"] = $row["empresas_permite_inativar"];
			$lista["empresas_permite_excluir"] = $row["empresas_permite_excluir"];
			$lista["empresas_permite_gerenciar"] = $row["empresas_permite_gerenciar"];
			
			$lista["usuarios_permite_cadastrar"] = $row["usuarios_permite_cadastrar"];
			$lista["usuarios_permite_exibir_detalhes"] = $row["usuarios_permite_exibir_detalhes"];
			$lista["usuarios_permite_editar"] = $row["usuarios_permite_editar"];
			$lista["usuarios_permite_resetar_senha"] = $row["usuarios_permite_resetar_senha"];
			$lista["usuarios_permite_duplicar"] = $row["usuarios_permite_duplicar"];
			$lista["usuarios_permite_alterar_senha"] = $row["usuarios_permite_alterar_senha"];
			$lista["usuarios_permite_alterar_permissoes"] = $row["usuarios_permite_alterar_permissoes"];
			$lista["usuarios_permite_ativar"] = $row["usuarios_permite_ativar"];
			$lista["usuarios_permite_inativar"] = $row["usuarios_permite_inativar"];
			$lista["usuarios_permite_excluir"] = $row["usuarios_permite_excluir"];
			
			$lista["clientes_permite_cadastrar"] = $row["clientes_permite_cadastrar"];
			$lista["clientes_permite_exibir_detalhes"] = $row["clientes_permite_exibir_detalhes"];
			$lista["clientes_permite_editar"] = $row["clientes_permite_editar"];
			$lista["clientes_permite_duplicar"] = $row["clientes_permite_duplicar"];
			$lista["clientes_permite_ativar"] = $row["clientes_permite_ativar"];
			$lista["clientes_permite_inativar"] = $row["clientes_permite_inativar"];
			$lista["clientes_permite_excluir"] = $row["clientes_permite_excluir"];
			
			$lista["contatos_permite_cadastrar"] = $row["contatos_permite_cadastrar"];
			$lista["contatos_permite_exibir_detalhes"] = $row["contatos_permite_exibir_detalhes"];
			$lista["contatos_permite_editar"] = $row["contatos_permite_editar"];
			$lista["contatos_permite_duplicar"] = $row["contatos_permite_duplicar"];
			$lista["contatos_permite_ativar"] = $row["contatos_permite_ativar"];
			$lista["contatos_permite_inativar"] = $row["contatos_permite_inativar"];
			$lista["contatos_permite_excluir"] = $row["contatos_permite_excluir"];
			
		}

		return $lista;
	}
	
	
	/***********************************************************************/
	//
	//								DO
	//
	/***********************************************************************/
	/*	
		FUNÇÃO:		afterActivate
		PARÂMETROS:	void
		RETORNO:	void
		DESCRIÇÃO:	Executa funções depois de ativar/desativar Usuário
	*/
	function afterActivate()
	{
		switch($_REQUEST["activate"]) {
			case "ON":
				$this->printMsgActivateOn();
				break;
			case "OFF":
				$this->printMsgActivateOff();
				break;
			default: "";
				//$this->printMsgError();
				logMe("Erro no afterActivate!");
				break;
		}
	}


	/*	
		FUNÇÃO:		printMsgActivateOn
		PARÂMETROS:	void
		RETORNO:	void
		DESCRIÇÃO:	Imprime mensagem de retorno
	*/
	function printMsgActivateOn()
	{
		echo $msg = "<script>
						loadPage('view/".strtolower(get_class($this) )."s_lista.php?retorno=ok&msg=(id:".$this->get("id")." - ".get_class($this).") ativado com sucesso!', '');
			 		</script>";
	}


	/*	
		FUNÇÃO:		printMsgActivateOff
		PARÂMETROS:	void
		RETORNO:	void
		DESCRIÇÃO:	Imprime mensagem de retorno
	*/
	function printMsgActivateOff()
	{
		echo $msg = "<script>
						loadPage('view/".strtolower(get_class($this) )."s_lista.php?retorno=ok&msg=(id:".$this->get("id")." - ".get_class($this).") inativado com sucesso!', '');
			 		</script>";
	}


	/*
		FUNÇÃO:		afterClone
		PARÂMETROS:	void
		RETORNO:	void
		DESCRIÇÃO:	Executa funções depois de clonar Usuário
	*/
	function afterClone()
	{
		$this->printMsgClone();
	}
	

	/*	
		FUNÇÃO:		printMsgClone
		PARÂMETROS:	void
		RETORNO:	void
		DESCRIÇÃO:	Imprime mensagem de retorno
	*/
	function printMsgClone()
	{
		echo $msg = "<script>
						loadPage('view/".strtolower(get_class($this) )."s_lista.php?retorno=ok&msg=(id:".$this->get("id")." - ".get_class($this).") duplicado com sucesso!', '');
			 		</script>";
	}


	/*
		FUNÇÃO:		afterPasswordReset
		PARÂMETROS:	void
		RETORNO:	void
		DESCRIÇÃO:	Executa funções depois de resetar a senha do Usuário
	*/
	function afterPasswordReset()
	{
		$this->printMsgPasswordReset();
	}
	

	/*	
		FUNÇÃO:		printMsgPasswordReset
		PARÂMETROS:	void
		RETORNO:	void
		DESCRIÇÃO:	Imprime mensagem de retorno
	*/
	function printMsgPasswordReset()
	{
		echo $msg =	'<div class="alert alert-success alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<strong>(id:'.$this->get("id").' - '.get_class($this).') senha resetada com sucesso!</strong>
					</div>';
	}


	/*
		FUNÇÃO:		afterPasswordUpdate
		PARÂMETROS:	void
		RETORNO:	void
		DESCRIÇÃO:	Executa funções depois de atualizar a senha do Usuário
	*/
	function afterPasswordUpdate()
	{
		$this->printMsgPasswordUpdate();
	}
	

	/*	
		FUNÇÃO:		printMsgPasswordUpdate
		PARÂMETROS:	void
		RETORNO:	void
		DESCRIÇÃO:	Imprime mensagem de retorno
	*/
	function printMsgPasswordUpdate()
	{
		echo $msg =	'<div class="alert alert-success alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<strong>(id:'.$this->get("id").' - '.get_class($this).') senha atualizada com sucesso!</strong>
					</div>';
	}


	/*	
		FUNÇÃO: 	update_permissoes
					Lista
		PARÂMETROS: param
		RETORNO: 	void
	*/
	function update_permissoes($param) {
	
	
		$mySQL = New MySQL();
		
		#	Busca as permissões do usuário
		$sql= "SELECT * FROM permissoes_usuario WHERE id_usuario = ".$param["id_usuario"];
		$rs= $mySQL->runQuery($sql);
		$qtd= mysqli_num_rows($rs);
		
		
		if($qtd > 0) {//	UPDATE
		
			$sql=	"UPDATE permissoes_usuario
					SET
						sistema_permite_acessar_configuracoes = ".$param["sistema_permite_acessar_configuracoes"]."
						, sistema_permite_acessar_dashboard = ".$param["sistema_permite_acessar_dashboard"]."
						, sistema_permite_acessar_empresas = ".$param["sistema_permite_acessar_empresas"]."
						, sistema_permite_acessar_usuarios = ".$param["sistema_permite_acessar_usuarios"]."
						, sistema_permite_acessar_clientes = ".$param["sistema_permite_acessar_clientes"]."
						, sistema_permite_acessar_contatos = ".$param["sistema_permite_acessar_contatos"]."
						
						, empresas_permite_cadastrar = ".$param["empresas_permite_cadastrar"]."
						, empresas_permite_exibir_detalhes = ".$param["empresas_permite_exibir_detalhes"]."
						, empresas_permite_editar = ".$param["empresas_permite_editar"]."
						, empresas_permite_ativar = ".$param["empresas_permite_ativar"]."
						, empresas_permite_inativar = ".$param["empresas_permite_inativar"]."
						, empresas_permite_excluir = ".$param["empresas_permite_excluir"]."
						, empresas_permite_gerenciar = ".$param["empresas_permite_gerenciar"]."
						
						, usuarios_permite_cadastrar = ".$param["usuarios_permite_cadastrar"]."
						, usuarios_permite_exibir_detalhes = ".$param["usuarios_permite_exibir_detalhes"]."
						, usuarios_permite_editar = ".$param["usuarios_permite_editar"]."
						, usuarios_permite_resetar_senha = ".$param["usuarios_permite_resetar_senha"]."
						, usuarios_permite_duplicar = ".$param["usuarios_permite_duplicar"]."
						, usuarios_permite_alterar_senha = ".$param["usuarios_permite_alterar_senha"]."
						, usuarios_permite_alterar_permissoes = ".$param["usuarios_permite_alterar_permissoes"]."
						, usuarios_permite_ativar = ".$param["usuarios_permite_ativar"]."
						, usuarios_permite_inativar = ".$param["usuarios_permite_inativar"]."
						, usuarios_permite_excluir = ".$param["usuarios_permite_excluir"]."
						
						, clientes_permite_cadastrar = ".$param["clientes_permite_cadastrar"]."
						, clientes_permite_exibir_detalhes = ".$param["clientes_permite_exibir_detalhes"]."
						, clientes_permite_editar = ".$param["clientes_permite_editar"]."
						, clientes_permite_duplicar = ".$param["clientes_permite_duplicar"]."
						, clientes_permite_ativar = ".$param["clientes_permite_ativar"]."
						, clientes_permite_inativar = ".$param["clientes_permite_inativar"]."
						, clientes_permite_excluir = ".$param["clientes_permite_excluir"]."
						
						, contatos_permite_cadastrar = ".$param["contatos_permite_cadastrar"]."
						, contatos_permite_exibir_detalhes = ".$param["contatos_permite_exibir_detalhes"]."
						, contatos_permite_editar = ".$param["contatos_permite_editar"]."
						, contatos_permite_duplicar = ".$param["contatos_permite_duplicar"]."
						, contatos_permite_ativar = ".$param["contatos_permite_ativar"]."
						, contatos_permite_inativar = ".$param["contatos_permite_inativar"]."
						, contatos_permite_excluir = ".$param["contatos_permite_excluir"]."
					WHERE
						id_usuario = ".$param["id_usuario"];
		
		} else {//	ADD
		
			#	Cadastra novamente as permissões
			$sql=	"INSERT INTO permissoes_usuario
					(				
						id_usuario
						, sistema_permite_acessar_configuracoes
						, sistema_permite_acessar_dashboard
						, sistema_permite_acessar_empresas
						, sistema_permite_acessar_usuarios
						, sistema_permite_acessar_clientes
						, sistema_permite_acessar_contatos
						
						, empresas_permite_cadastrar
						, empresas_permite_exibir_detalhes
						, empresas_permite_editar
						, empresas_permite_ativar
						, empresas_permite_inativar
						, empresas_permite_excluir
						, empresas_permite_gerenciar
						
						, usuarios_permite_cadastrar
						, usuarios_permite_exibir_detalhes
						, usuarios_permite_editar
						, usuarios_permite_resetar_senha
						, usuarios_permite_duplicar
						, usuarios_permite_alterar_senha
						, usuarios_permite_alterar_permissoes
						, usuarios_permite_ativar
						, usuarios_permite_inativar
						, usuarios_permite_excluir
						
						, clientes_permite_cadastrar
						, clientes_permite_exibir_detalhes
						, clientes_permite_editar
						, clientes_permite_duplicar
						, clientes_permite_ativar
						, clientes_permite_inativar
						, clientes_permite_excluir
						
						, contatos_permite_cadastrar
						, contatos_permite_exibir_detalhes
						, contatos_permite_editar
						, contatos_permite_duplicar
						, contatos_permite_ativar
						, contatos_permite_inativar
						, contatos_permite_excluir
					) VALUES (
						".$param["id_usuario"]."
						, ".$param["sistema_permite_acessar_configuracoes"]."
						, ".$param["sistema_permite_acessar_dashboard"]."
						, ".$param["sistema_permite_acessar_empresas"]."
						, ".$param["sistema_permite_acessar_usuarios"]."
						, ".$param["sistema_permite_acessar_clientes"]."
						, ".$param["sistema_permite_acessar_contatos"]."
						
						, ".$param["empresas_permite_cadastrar"]."
						, ".$param["empresas_permite_exibir_detalhes"]."
						, ".$param["empresas_permite_editar"]."
						, ".$param["empresas_permite_ativar"]."
						, ".$param["empresas_permite_inativar"]."
						, ".$param["empresas_permite_excluir"]."
						, ".$param["empresas_permite_gerenciar"]."
						
						, ".$param["usuarios_permite_cadastrar"]."
						, ".$param["usuarios_permite_exibir_detalhes"]."
						, ".$param["usuarios_permite_editar"]."
						, ".$param["usuarios_permite_resetar_senha"]."
						, ".$param["usuarios_permite_duplicar"]."
						, ".$param["usuarios_permite_alterar_senha"]."
						, ".$param["usuarios_permite_alterar_permissoes"]."
						, ".$param["usuarios_permite_ativar"]."
						, ".$param["usuarios_permite_inativar"]."
						, ".$param["usuarios_permite_excluir"]."
						
						, ".$param["clientes_permite_cadastrar"]."
						, ".$param["clientes_permite_exibir_detalhes"]."
						, ".$param["clientes_permite_editar"]."
						, ".$param["clientes_permite_duplicar"]."
						, ".$param["clientes_permite_ativar"]."
						, ".$param["clientes_permite_inativar"]."
						, ".$param["clientes_permite_excluir"]."
						
						, ".$param["contatos_permite_cadastrar"]."
						, ".$param["contatos_permite_exibir_detalhes"]."
						, ".$param["contatos_permite_editar"]."
						, ".$param["contatos_permite_duplicar"]."
						, ".$param["contatos_permite_ativar"]."
						, ".$param["contatos_permite_inativar"]."
						, ".$param["contatos_permite_excluir"]."
				)";
		
		}//fim ADD
		
		$mySQL->runQuery($sql);
		
	}
	
	
}	//fim da classe
?>