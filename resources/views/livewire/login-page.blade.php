<div>
    <style>
        .card_login{
            position: absolute;

            left: 50%;
            top: 50%;

            transform: translate(-50%,-50%)
        }
    </style>
    <div class="card card_login">
        <div class="card-body">
            <div class=" p-4 rounded">
                <div class="text-center">
                    <h3 class="">Logar</h3>
                </div>
                <div class="form-body">
                    <form class="row g-3">
                        <div class="col-12">
                            <label for="inputEmailAddress" class="form-label">Email Address</label>
                            <input type="email" class="form-control" wire:model.defer="email" id="inputEmailAddress" placeholder="Email Address">
                        </div>
                        <div class="col-12 mb-4">
                            <label for="inputChoosePassword" class="form-label">Enter Password</label>
                            <div class="input-group" id="show_hide_password">
                                <input type="password" wire:model.defer="password" class="form-control border-end-0" id="inputChoosePassword" placeholder="Enter Password">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-grid text-right">
                                <button type="button" wire:click="enviar" class="btn btn-primary"><i class="bi bi-check2-square"></i>  Logar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
