<?php
class Pessoa
{
	/*	Atributos */	
	protected $id;
	protected $empresa_id;
	protected $email;
	protected $senha;
	protected $nome;
	protected $nome_social;
	protected $fantasia;
	protected $data_nascimento;
	protected $tipo_pessoa;
	protected $nivel_decisao;
	protected $favoravel_empresa;
	protected $cpf;
	protected $cnpj;
	protected $sexo;
	protected $endereco;
	protected $complemento;
	protected $bairro;
	protected $cidade;
	protected $estado;
	protected $pais;
	protected $cep;
	protected $telefone;
	protected $telefone2;
	protected $celular;
	protected $facebook;
	protected $linkedin;
	protected $site;
	protected $detalhes;
	protected $foto;
	protected $data_cadastro;
	protected $data_ultima_atualizacao;
	protected $qtd_acessos;
	protected $data_ultimo_acesso;
	protected $flag_ativo;
	protected $flag_status;
	protected $flag_usuario;
	protected $flag_cliente;
	protected $flag_contato;
	/*	Constantes	*/
	const DATE_ATRIBS = array("data_nascimento", "data_cadastro", "data_ultima_atualizacao", "data_ultimo_acesso");
	const PASSWORD_ATRIBS = "senha";

	/*	Construtor */
	function __construct()
	{
		$atribs = get_class_vars(get_class($this) );
		$json = getValuesByJson();
		foreach($atribs as $atrib=>$val){
			$val = isset($json->$atrib) ? $json->$atrib : "";
			$this->set($atrib, $val);	
		}
	}


	/*	Set */
	function set($atr, $val)
	{
		$this->$atr = $val;
	}

	
	/*	Get */
	function get($atr)
	{
		return $this->$atr;
	}		


	/***********************************************************************/
	//
	//								GET
	//
	/***********************************************************************/
	/*	
		FUNÇÃO: 		getPessoas
								Faz a listagem dos registros
		PARÂMETROS: param
		RETORNO: 		array de objetos
	*/
	function getPessoas($param)
	{
		$mySQL = New MySQL();
		$sql =	"SELECT
					id
					, empresa_id
					, email
					, senha
					, nome
					, nome_social
					, fantasia
					, data_nascimento
					, tipo_pessoa
					, nivel_decisao
					, favoravel_empresa
					, cpf
					, cnpj
					, sexo
					, endereco
					, complemento
					, bairro
					, cidade
					, estado
					, pais
					, cep
					, telefone
					, telefone2
					, celular
					, facebook
					, linkedin
					, site
					, detalhes
					, foto
					, data_cadastro
					, data_ultima_atualizacao
					, qtd_acessos
					, data_ultimo_acesso
					, flag_ativo
					, flag_status
					, flag_usuario
					, flag_cliente
					, flag_contato
				FROM
					pessoas
				WHERE
					id > 0";
		
		$sql .=	(isset($param["id"]) ) ? " AND id=".$param["id"] : "";#	id
		$sql .=	(isset($param["empresa_id"]) ) ? " AND empresa_id=".$param["empresa_id"] : "";#	empresa_id
		$sql .=	(isset($param["flag_usuario"]) ) ? " AND flag_usuario=".$param["flag_usuario"] : "";#	flag_usuario
		$sql .=	(isset($param["flag_cliente"]) ) ? " AND flag_cliente=".$param["flag_cliente"] : "";#	flag_cliente
		$sql .=	(isset($param["flag_contato"]) ) ? " AND flag_contato=".$param["flag_contato"] : "";#	flag_contato
		$sql .=	(isset($param["email"]) ) ? " AND email='".$param["email"]."'" : "";#	email
		$sql .=	(isset($param["senha"]) ) ? " AND senha='".$param["senha"]."'" : "";#	senha
		$sql .=	(isset($param["flag_ativo"]) ) ? " AND flag_ativo='".$param["flag_ativo"]."'" : "";#	flag_ativo
		$sql .=	(isset($param["nome"]) ) ? " AND (nome LIKE '%".$param["nome"]."%' OR fantasia LIKE '%".$param["nome"]."%')" : "";#	nome
		$sql .=	(isset($param["cpf"]) ) ? " AND (cpf LIKE '%".$param["cpf"]."%' OR cnpj LIKE '%".$param["cpf"]."%' )" : "";#	cpf ou cnpj
		
		$sql .=	(isset($param["search"]) ) ? " AND (
													LOWER(nome) LIKE '%".$param["search"]."%'
													OR LOWER(nome_social) LIKE '%".$param["search"]."%'
													OR LOWER(fantasia) LIKE '%".$param["search"]."%'
													OR LOWER(email) LIKE '%".$param["search"]."%'
													OR LOWER(endereco) LIKE '%".$param["search"]."%'
													OR LOWER(bairro) LIKE '%".$param["search"]."%'
													OR LOWER(cidade) LIKE '%".$param["search"]."%'
													OR LOWER(estado) LIKE '%".$param["search"]."%'
													OR LOWER(detalhes) LIKE '%".$param["search"]."%'
													OR LOWER(cpf) LIKE '%".$param["search"]."%'
													OR LOWER(cnpj) LIKE '%".$param["search"]."%'
											 	)" : "";#	search
		
		$sql .=	(isset($param["order"]) ) ? " ORDER BY ".$param["order"] : "";#	Order

		$rs = $mySQL->runQuery($sql);
		$lista= array();
		
		while ($row = mysqli_fetch_assoc($rs) ) {
		
			$Obj = new $this();
			$atribs = get_class_vars(get_class($this) );
			
			foreach ($atribs as $atrib=>$val) {
				$Obj->set($atrib, $row[$atrib]);
			}
			
			array_push($lista, $Obj);
		
		}
		
		return $lista;
	}



	/***********************************************************************/
	//
	//								DO
	//
	/***********************************************************************/
	/*	
		FUNÇÃO:		beforeSave
		PARÂMETROS:	void
		RETORNO:	void
		DESCRIÇÃO:	Executa funções antes de salvar os dados no banco
	*/
	function beforeSave()
	{
		$this->formatAtribs();
	}


	/*	
		FUNÇÃO:		formatAtribs
		PARÂMETROS:	void
		RETORNO:	void
		DESCRIÇÃO:	Formata os valores dos campos data e senha no objeto
	*/
	function formatAtribs()
	{
		$atribs = get_class_vars(get_class($this) );
		foreach ($atribs as $atrib=>$val){
            toDateUs($atrib);
			if (in_array($atrib, $this::DATE_ATRIBS))
				$this->set($atrib, $this->get($atrib));
			if ($atrib == $this::PASSWORD_ATRIBS)
				$this->set($atrib, encrypta($this->get($atrib) ) );
			$this->set($atrib, $this->get($atrib) );
		}
	}


	/*	
		FUNÇÃO:		afterSave
		PARÂMETROS:	void
		RETORNO:	void
		DESCRIÇÃO:	Executa funções depois de salvar os dados no banco
	*/
	function afterSave()
	{
		switch($_REQUEST["act"]) {
			case "add":
				$this->printMsgAddOk();
				$this->formAction_fromAdd_toUpdate();
				break;
			case "update":
				$this->printMsgUpdateOk();
				break;
			default: "";
				//$this->printMsgError();
				logMe("Erro no afterSave!");
				break;
		}
	}


	/*	
		FUNÇÃO:		printMsgAddOk
		PARÂMETROS:	void
		RETORNO:	void
		DESCRIÇÃO:	Imprime mensagem de retorno
	*/
	function printMsgAddOk()
	{
		echo $msg =	'<div class="alert alert-success alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<strong>(id:'.$this->get("id").' - '.get_class($this).') cadastrado com sucesso!</strong>
					</div>';
	}


	/*	
		FUNÇÃO:		formAction_fromAdd_toUpdate
		PARÂMETROS:	void
		RETORNO:	void
		DESCRIÇÃO:	Atualiza o action do form 
	*/
	function formAction_fromAdd_toUpdate()
	{
		echo $msg=	'<script type="text/javascript">
						document.getElementById("id").value= '.$_SESSION["last_insert_id"].';
						document.getElementById("form").action= "control/'.strtolower(get_class($this) ).'_controle.php?act=update";
					</script>';
	}


	/*	
		FUNÇÃO:		printMsgUpdateOk
		PARÂMETROS:	void
		RETORNO:	void
		DESCRIÇÃO:	Imprime mensagem de retorno
	*/
	function printMsgUpdateOk()
	{
		echo $msg=	'<div class="alert alert-success alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<strong>(id:'.$this->get("id").' - '.get_class($this).') atualizado com sucesso!</strong>
					</div>';
	}


	/*	
		FUNÇÃO:		add
		PARÂMETROS:	void
		RETORNO:	void
		DESCRIÇÃO:	Cadastra Pessoa
	*/
	function add()
	{
		$mySQL = New MySQL();
		$sql =	"INSERT INTO pessoas (
					empresa_id
					, email
					, senha
					, nome
					, nome_social
					, fantasia
					, data_nascimento
					, tipo_pessoa
					, nivel_decisao
					, favoravel_empresa
					, cpf
					, cnpj
					, sexo
					, endereco
					, complemento
					, bairro
					, cidade
					, estado
					, pais
					, cep
					, telefone
					, telefone2
					, celular
					, facebook
					, linkedin
					, site
					, detalhes
					, foto
					, data_cadastro
					, data_ultima_atualizacao
					, qtd_acessos
					, data_ultimo_acesso
					, flag_ativo
					, flag_status
					, flag_usuario
					, flag_cliente
					, flag_contato
				) VALUES (
					'".$this->get("empresa_id")."'
					, '".$this->get("email")."'
					, '".$this->get("senha")."'
					, '".$this->get("nome")."'
					, '".$this->get("nome_social")."'
					, '".$this->get("fantasia")."'
					, '".$this->get("data_nascimento")."'
					, '".$this->get("tipo_pessoa")."'
					, '".$this->get("nivel_decisao")."'
					, '".$this->get("favoravel_empresa")."'
					, '".$this->get("cpf")."'
					, '".$this->get("cnpj")."'
					, '".$this->get("sexo")."'
					, '".$this->get("endereco")."'
					, '".$this->get("complemento")."'
					, '".$this->get("bairro")."'
					, '".$this->get("cidade")."'
					, '".$this->get("estado")."'
					, '".$this->get("pais")."'
					, '".$this->get("cep")."'
					, '".$this->get("telefone")."'
					, '".$this->get("telefone2")."'
					, '".$this->get("celular")."'
					, '".$this->get("facebook")."'
					, '".$this->get("linkedin")."'
					, '".$this->get("site")."'
					, '".$this->get("detalhes")."'
					, '".$this->get("foto")."'
					, '".$this->get("data_cadastro")."'
					, '".$this->get("foto")."'
					, '".$this->get("qtd_acessos")."'
					, '".$this->get("data_ultimo_acesso")."'
					, '".$this->get("data_ultima_atualizacao")."'
					, '".$this->get("flag_status")."'
					, '".$this->get("flag_usuario")."'
					, '".$this->get("flag_cliente")."'
					, '".$this->get("flag_contato")."'
				)";
		$mySQL->runQuery($sql);
	}


	/*	
		FUNÇÃO:		update
		PARÂMETROS:	void
		RETORNO:	void
		DESCRIÇÃO:	Altera Pessoa
	*/
	function update()
	{
		$mySQL = New MySQL();
		$sql =	"UPDATE pessoas
				SET empresa_id = '".$this->get("empresa_id")."'
					, email = '".$this->get("email")."'
					, senha = '".$this->get("senha")."'
					, nome = '".$this->get("nome")."'
					, nome_social = '".$this->get("nome_social")."'
					, fantasia = '".$this->get("fantasia")."'
					, data_nascimento = '".$this->get("data_nascimento")."'
					, tipo_pessoa = '".$this->get("tipo_pessoa")."'
					, nivel_decisao = '".$this->get("nivel_decisao")."'
					, favoravel_empresa = '".$this->get("favoravel_empresa")."'
					, cpf = '".$this->get("cpf")."'
					, cnpj = '".$this->get("cnpj")."'
					, sexo = '".$this->get("sexo")."'
					, endereco = '".$this->get("endereco")."'
					, complemento = '".$this->get("complemento")."'
					, bairro = '".$this->get("bairro")."'
					, cidade = '".$this->get("cidade")."'
					, estado = '".$this->get("estado")."'
					, pais = '".$this->get("pais")."'
					, cep = '".$this->get("cep")."'
					, telefone = '".$this->get("telefone")."'
					, telefone2 = '".$this->get("telefone2")."'
					, celular = '".$this->get("celular")."'
					, facebook = '".$this->get("facebook")."'
					, linkedin = '".$this->get("linkedin")."'
					, site = '".$this->get("site")."'
					, detalhes = '".$this->get("detalhes")."'
					, foto = '".$this->get("foto")."'
					, data_cadastro = '".$this->get("data_cadastro")."'
					, data_ultima_atualizacao = '".$this->get("data_ultima_atualizacao")."'
					, qtd_acessos = '".$this->get("qtd_acessos")."'
					, data_ultimo_acesso = '".$this->get("data_ultimo_acesso")."'
					, flag_ativo = '".$this->get("flag_ativo")."'
					, flag_status = '".$this->get("flag_status")."'
					, flag_usuario = '".$this->get("flag_usuario")."'
					, flag_cliente = '".$this->get("flag_cliente")."'
					, flag_contato = '".$this->get("flag_contato")."'
				WHERE
					id = ".$this->get("id").";";
		$mySQL->runQuery($sql);
	}
	
	
	/*	
		FUNÇÃO:		delete
		PARÂMETROS:	void
		RETORNO:	void
		DESCRIÇÃO:	Deleta Pessoa
	*/
	function delete()
	{	
		$mySQL = New MySQL();	
		$sql =	"DELETE FROM pessoas
				WHERE id = '".$this->id."';";	
		$mySQL->runQuery($sql);
	}


	/*	
		FUNÇÃO:		afterDelete
		PARÂMETROS:	void
		RETORNO:	void
		DESCRIÇÃO:	Executa funções depois de deletar do banco
	*/
	function afterDelete()
	{
		$this->printMsgDeleteOk();
	}


	/*	
		FUNÇÃO:		printMsgDeleteOk
		PARÂMETROS:	void
		RETORNO:	void
		DESCRIÇÃO:	Imprime mensagem de retorno
	*/
	function printMsgDeleteOk()
	{
		echo $msg =	'<script>
						loadPage("view/'.strtolower(get_class($this) ).'s_lista.php?retorno=ok&msg=(id:'.$this->get("id").' - '.get_class($this).') excluído com sucesso!", "");
					</script>';
	}
	

}	//fim da classe
?>