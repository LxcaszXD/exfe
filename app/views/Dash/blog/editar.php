<form method="POST" action="<?php echo BASE_URL ?>blog/editar/<?php echo $blog['id_blog']; ?>" enctype="multipart/form-data">
    <div class="container-fluid py-4 glass-container">
        <div class="row">
            <div class="col-md-4 text-center mb-3 mb-md-0">
                <div class="image-container">
                    <?php
                    $fotoBlog = $blog['foto_blog'];
                    $fotoPath = BASE_URL . "uploads/" . $fotoBlog;
                    $fotoDefault = BASE_URL . "assets/img/blog_default.jpg";
                    // Verificação de existência do arquivo (ajuste o caminho se necessário)
                    $imagePath = (!empty($fotoBlog)) ? $fotoPath : $fotoDefault;
                    ?>
                    <img src="<?php echo $imagePath ?>" alt="Preview" class="img-fluid" id="preview-img" style="cursor:pointer; border-radius:12px; max-height: 300px;">
                </div>
                <p class="text-sm mt-2">Clique na imagem para alterar</p>
                <input type="file" name="foto_blog" id="foto_blog" style="display: none;" accept="image/*">
            </div>

            <div class="col-md-8">
                <div class="card glass-card">
                    <div class="card-header pb-0 glass-header">
                        <p class="mb-0 fw-bold text-dark">Editar Postagem</p>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="titulo_blog" class="form-control-label">Título</label>
                                    <input class="form-control" type="text" id="titulo_blog" name="titulo_blog" value="<?php echo $blog['titulo_blog']; ?>" required>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="descricao_blog" class="form-control-label">Conteúdo/Descrição</label>
                                    <textarea class="form-control" id="descricao_blog" name="descricao_blog" rows="5" required><?php echo $blog['descricao_blog']; ?></textarea>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="alt_foto_blog" class="form-control-label">Texto Alt da Imagem</label>
                                    <input class="form-control" type="text" id="alt_foto_blog" name="alt_foto_blog" value="<?php echo $blog['alt_foto_blog']; ?>">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="data_postagem_blog" class="form-control-label">Data da Postagem</label>
                                    <input class="form-control" type="date" id="data_postagem_blog" name="data_postagem_blog" value="<?php echo $blog['data_postagem_blog']; ?>" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="status_blog" class="form-control-label">Status</label>
                                    <select class="form-control" name="status_blog" id="status_blog">
                                        <option value="Ativo" <?php echo ($blog['status_blog'] == 'Ativo') ? 'selected' : ''; ?>>Ativo</option>
                                        <option value="Inativo" <?php echo ($blog['status_blog'] == 'Inativo') ? 'selected' : ''; ?>>Inativo</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label">Autor Detectado</label>
                                    <input type="text" class="form-control" value="<?php echo $funcionario_logado['nome_funcionario'] ?? 'Erro ao carregar'; ?>" readonly>
                                    <input type="hidden" name="id_funcionario" value="<?php echo $funcionario_logado['id_funcionario'] ?? ''; ?>">
                                </div>
                            </div>

                            <div class="mt-4 text-center">
                                <button type="submit" class="btn btn-primary btn-lg" style="background: #371406; border: none;">Atualizar Postagem</button>
                                <a href="<?php echo BASE_URL ?>blog/listar" class="btn btn-secondary btn-lg">Voltar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    document.getElementById('preview-img').addEventListener('click', () => document.getElementById('foto_blog').click());
    document.getElementById('foto_blog').addEventListener('change', function() {
        if (this.files && this.files[0]) {
            const reader = new FileReader();
            reader.onload = e => document.getElementById('preview-img').src = e.target.result;
            reader.readAsDataURL(this.files[0]);
        }
    });
</script>