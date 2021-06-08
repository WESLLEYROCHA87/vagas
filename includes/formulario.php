<main>

    <section>
        <a href="index.php">
            <button class="btn btn-success">Voltar</button>
        </a>
    </section>
    <h2 class="my-3 text-center">Cadastrar Vaga</h2>

    <form method="post">

        <div class="form-group">
            <label for="">Título</label>
            <input type="text" class="form-control" name="titulo">
        </div>

        <div class="form-group">
            <label for="">Descrição</label>
            <textarea class="form-control" name="descricao" rows="3"></textarea>
        </div>

        <div class="form-group">
            <label for="">Status</label>

            <div>
                <div class="form-check form-check-inline">
                    <label class="form-control">
                        <input type="radio" name="ativo" value="s" checked> Ativo
                    </label>
                </div>

                <div class="form-check form-check-inline">
                    <label class="form-control">
                        <input type="radio" name="ativo" value="n"> Inativo
                    </label>
                </div>

            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-success">Enviar</button>
        </div>

    </form>

</main>