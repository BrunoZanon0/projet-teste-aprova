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
            <div class="card-body ">
                <div class="text-center">
                    <h6 class="">Ediçã do produto</h6>
                </div>
                <div class="form-body">
                    <form class="row g-3" enctype="multipart/form-data">
                        <div class="col-12 mb-4">
                            <label for="inputName" class="form-label">Nome</label>
                            <input type="email" class="form-control" wire:model.defer="name" id="inputName" placeholder="Nome do produto">
                        </div>
                        <div class="col-12 mb-4">
                            <label for="inputDesc" class="form-label">Descrição</label>
                            <div class="input-group" id="show_hide_password">
                                <input type="text" wire:model.defer="descricao" class="form-control border-end-0" id="inputDesc" placeholder="Descrição do produto">
                            </div>
                        </div>
                        <div class="col-12 mb-4">
                            <label for="inputDesc" class="form-label">Preço</label>
                            <div class="input-group" id="show_hide_password">
                                <input type="number" wire:model.defer="preco" class="form-control border-end-0" id="inputDesc" placeholder="Preço do produto">
                            </div>
                        </div>
                        <div class="col-12 mb-4">
                            <label for="inputDesc" class="form-label">Imagem</label>
                            <div class="input-group" id="show_hide_password">
                                <input type="file" wire:model.defer="imagem" accept="image/jpeg, image/png, image/jpg, image/gif" class="form-control border-end-0" id="inputDesc" placeholder="Imagem do produto?">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-grid text-right">
                                <button type="button" wire:click="save" class="btn btn-primary"><i class="bi bi-check2-square"></i> Cadastrar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
