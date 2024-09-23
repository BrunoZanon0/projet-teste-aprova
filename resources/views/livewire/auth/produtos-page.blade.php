<div class="p-4">
@if (Session::has('message'))
    <div class="alert alert-success border-0 bg-success alert-dismissible fade show py-1 col-xl-12 mx-auto w-25">
        <div class="d-flex align-items-center">
            <div class="font-35 text-white">
                <i class='bx bxs-check-circle'></i>
            </div>
            <div class="ms-3">
                <h6 class="mb-0 text-white">Aviso</h6>
                <div class="text-white">{{ session('message') }}</div>
            </div>
        </div>
    </div>
    @elseif (Session::has('message_erro'))
    <div class="alert alert-danger border-0 bg-danger alert-dismissible fade show py-1 col-xl-12 w-25 mx-auto">
        <div class="d-flex align-items-center">
            <div class="font-35 text-white">
                <i class='bx bx-error-circle'></i>
            </div>
            <div class="ms-3">
                <h6 class="mb-0 text-white">Aviso</h6>
                <div class="text-white">{{ session('message_erro') }}</div>
            </div>
        </div>
    </div>
@endif
    <div class="card col-11 m-auto">
        <div class="card-body">
            <div class="text-center mb-4">
                <a href="{{ route('produto-cadastro') }}" class="btn btn-sm btn-success"><i class="bi bi-plus-square"></i></a>
            </div>
            <div class="text-center mb-4">
                <h6 class="">Listagem dos produtos</h6>
            </div>
            <div class="form-body">
                <table class="table table-striped table-bordered text-center">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Descrição</th>
                            <th>Imagem</th>
                            <th>Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (isset($produtos))
                            @foreach ($produtos as $produto)
                            <tr>
                                <td>{{ $produto->id }}</td>
                                <td>{{ $produto->name }}</td>
                                <td>{{ $produto->descricao }}</td>
                                <td>
                                    @if ($produto->imagem)
                                        <img src="{{ asset('storage/imagens/produtos/' . $produto->imagem) }}" alt="Imagem do Produto" style="max-width: 50px; max-height: 50px; object-fit: cover;">
                                    @else
                                        Sem imagem
                                    @endif
                                </td>
                                <td>
                                    <a class="btn btn-sm btn-info" title="Visualizar" href="/produtos-editar/{{ $produto->id }}"><i class="bi bi-box-arrow-in-up-right"></i></a>
                                    <a class="btn btn-sm btn-danger" title="Excluir" href="/produtos-delete/{{ $produto->id }}"><i class="bi bi-trash"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        @else
                        <tr>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
