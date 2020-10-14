<?php
if (isset($this->Dados['form'])) {
    $valorForm = $this->Dados['form'];
}
if (isset($this->Dados['form'][0])) {
    $valorForm = $this->Dados['form'][0];
}
//var_dump($this->Dados['select']);
?>
<div class="content p-1">
    <?php
        if(isset($_SESSION['msg'])){
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
    ?>
	<div class="row">
	    <div class="col-md-12">
	        <h2 class="display-4 titulo">Cadastrar Funcionário</h2>
	    </div>
    </div>
    <div class="list-group-item">
        <form method="POST" action="" enctype="multipart/form-data"> 

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label><span class="text-danger">*</span> Nome</label>
                    <input name="nome" type="text" class="form-control" placeholder="Nome..." value="<?php
                    if (isset($valorForm['nome'])) {
                        echo $valorForm['nome'];
                    }
                    ?>">
                </div>
                <div class="form-group col-md-4">
                    <label><span class="text-danger">*</span> E-mail</label>
                    <input name="email" type="text" class="form-control" placeholder="E-mail..." value="<?php
                    if (isset($valorForm['email'])) {
                        echo $valorForm['email'];
                    }
                    ?>">
                </div>
                <div class="form-group col-md-4">
                    <label><span class="text-danger">*</span> Data de nascimento</label>
                    <input name="data_nascimento" type="date" class="form-control" placeholder="dd/mm/aaaa" value="<?php
                    if (isset($valorForm['data_nascimento'])) {
                        echo $valorForm['data_nascimento'];
                    }
                    ?>">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label><span class="text-danger">*</span> CPF</label>
                    <input name="cpf" type="text" class="form-control" placeholder="999.999.999-99" value="<?php
                    if (isset($valorForm['cpf'])) {
                        echo $valorForm['cpf'];
                    }
                    ?>">
                </div>
                <div class="form-group col-md-4">
                    <label><span class="text-danger">*</span> RG</label>
                    <input name="rg" type="text" class="form-control" placeholder="RG..." value="<?php
                    if (isset($valorForm['rg'])) {
                        echo $valorForm['rg'];
                    }
                    ?>">
                </div>
                <div class="form-group col-md-4">
                    <label><span class="text-danger">*</span> Cargo</label>
                    <input name="cargo" type="text" class="form-control" placeholder="Cargo..." value="<?php
                    if (isset($valorForm['cargo'])) {
                        echo $valorForm['cargo'];
                    }
                    ?>">
                </div>
            </div>


            
            <div class="form-row">                
                <div class="form-group col-md-12">
                    <label><span class="text-danger">*</span> Status</label>
                    <select name="status" id="status" class="form-control">
                        <option value=''>Selecione</option>
                        <option <?php isset($valorForm['status']) == 1 ?  'selected' :  '' ?> value='1'>Ativo</option>
                        <option <?php isset($valorForm['status']) == 2 ?  'selected' :  '' ?> value='2'>Inativo</option>
                    </select>
                </div>
                </div>

                <div id="tels">
                <div class="form-row">
                <div class="col-md-4">
                    <label><span class="text-danger">*</span> Telefone</label>
                    <div class="input-group">
                        <input name="telefone[]" type="text" class="form-control" placeholder="(00) 00000-0000">
                        <div class="input-group-append">
                            <button class="btn btn-success" type="button" id="add-campo">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            
            <div class="form-row">
                <div class="form-group col-md-6">

                    <label><span class="text-danger">*</span> Foto </label>
                    <input name="imagem_nova" type="file" onchange="previewImagem();">
                </div>
                <div class="form-group col-md-6">
                    <?php
                    $imagem_antiga = URL . 'assets/imagens/pagina/preview_img.jpg';
                    ?>
                    <img src="<?php echo $imagem_antiga; ?>" alt="Imagem do slide" id="preview-user" class="img-thumbnail" style="width: 300px; height: 150px;">
                </div>
            </div>

             

            <p>
                <span class="text-danger">* </span>Campo obrigatório
            </p>
            <input name="CadFunc" type="submit" class="btn btn-warning" value="Salvar">
        </form>
</div>
