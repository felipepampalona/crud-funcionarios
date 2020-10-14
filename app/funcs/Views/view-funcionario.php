<?php
if (isset($this->Dados['dados_func'])) {
    extract($this->Dados['dados_func'][0]);
}
?>
<div class="row">
    <div class="col-md-12">
        <h2 class="display-4 titulo">Funcionário</h2>
        <div class="pull-right">
            <a href="<?php echo URL . 'edit-funcionario/' . $id; ?>" class="btn btn-outline-warning">
                <i class="fa fa-pencil"></i> Editar
            </a>
        </div>
    </div>
</div>
<div class="list-group-item">
    <dl class="row">
        <dt class="col-sm-3">Foto</dt>
        <dd class="col-sm-9">
            <img src="<?php echo URL . 'assets/imagens/funcionario/' . $id . '/' . $foto ?>" alt="..." class="img-thumbnail" style="border-radius: 50%; height: 100px;width: 130px;">
        </dd>
        <dt class="col-sm-2">Nome </dt>
        <dd class="col-sm-9"><?php echo $nome; ?></dd>

        <dt class="col-sm-2">CPF</dt>
        <dd class="col-sm-9"><?php echo $cpf; ?></dd>

        <dt class="col-sm-2">RG</dt>
        <dd class="col-sm-9"><?php echo $rg; ?></dd>

        <dt class="col-sm-2">Nascimento</dt>
        <dd class="col-sm-9"><?php echo date("d/m/Y", strtotime($data_nascimento)); ?></dd>

        <dt class="col-sm-2">E-mail</dt>
        <dd class="col-sm-9"><?php echo $email; ?></dd>

        <dt class="col-sm-2">Cargo</dt>
        <dd class="col-sm-9"><?php echo $cargo; ?></dd>
        <dt class="col-sm-2">Novo Telefone</dt>
        <dd class="col-sm-9"><button type="button" class="btn btn-success" data-toggle="modal" data-target="#newTel">
                <i class="fa fa-plus"></i>
            </button></dd>
        <?php
        if (isset($this->Dados['contatos'])) {
            foreach ($this->Dados['contatos'] as $conts):
                extract($conts);
                ?>
                <dt class="col-sm-2">Telefone</dt>
                <dd class="col-sm-9"><?php echo $telefone; ?><a class="btn btn-danger"href="<?php echo URL; ?>apagar-cel/<?php echo $id; ?>?id=<?php echo $funcionario_id; ?>" onclick="if (!confirm('tem certeza que deseja excluir este item?')) {
                            return false
                        }"><i class="fa fa-trash"></i></a></dd>
                                                                <?php
                                                            endforeach;
                                                        }
                                                        ?>

    </dl>
</div>
<form method="POST">
    <!-- Modal -->
    <div class="modal fade" id="newTel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Novo Telefone</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" value="<?php echo $funcionario_id; ?>" name="funcionario_id">
                    <div class="form-row">
                        <div class="col-md-12">
                            <label><span class="text-danger">*</span> Telefone</label>
                            <input name="telefone" formato="tel" type="text" class="form-control" placeholder="(00) 00000-0000">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                    <input type="submit" class="btn btn-success" name="NovoCel" value="Salvar">
                </div>
            </div>
        </div>
    </div>
</form>