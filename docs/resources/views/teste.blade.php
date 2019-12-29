@extends ('layout')

@section('content')

    <div class="container-fluid mt--7">
      <!-- Table -->
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header bg-transparent border-1">
                        <h3 class="mb-0">Usuários</h3>
                    </div>
                    <div class="container" style="margin-top:10px;">
                        <form autocomplete="off">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="nome" required="" autocomplete="off" class="form-control" placeholder="Digite o nome do usuário">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="email" name="email" required="" autocomplete="off" class="form-control" placeholder="Digite um email válido" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="password" name="senha" required="" autocomplete="off" class="form-control" placeholder="Digite uma senha válida">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="password" name="senha_ver" required="" autocomplete="off" class="form-control" placeholder="Redigite a senha" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" name="dica" required="" autocomplete="off" class="form-control" placeholder="Digite uma dica para lembrar sua senha">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer py-4">
                        <div style="text-align: right">
                            <a href="#" role="button" class="btn btn-primary">Cadastrar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection