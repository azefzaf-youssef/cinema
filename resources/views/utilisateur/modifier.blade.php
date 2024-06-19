<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Modifier un utilisateur</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <!-- Modal content goes here -->
    <div class="col-xxl">

        <div class="card-body">
            <form action="{{ route('GESTION-UTILISATEUR-POST') }}" method="POST" enctype="multipart/form-data"
                id="post-edit-utilisateur">
                @csrf
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label" for="basic-default-name">Nom</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="name" id="basic-default-name"
                            placeholder="Nom" value="{{ $user->name }}" />
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label" for="basic-default-name">Email</label>
                    <div class="col-sm-9">
                        <input type="email" class="form-control" name="email" id="basic-default-name"
                            placeholder="Email" value="{{ $user->email }}" />
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label" for="basic-default-name">Mot de passe</label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control" name="password" id="basic-default-name"
                            placeholder="Mot de passe" />
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label" for="basic-default-name">Confirmation mot de passe</label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control" name="password_conf" id="basic-default-name"
                            placeholder="Confirmation mot de passe" />
                    </div>
                </div>

                <div class="row justify-content-end">

                </div>

                <input type="hidden" value="{{ $user->id }}" name="id">

                <div class="modal-footer">

                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fermer</button>
                    <button type="submit" id="post-btn" class="btn btn-primary">Modifier</button>

                </div>
            </form>
        </div>
    </div>
</div>





<script>


document.addEventListener("DOMContentLoaded", function() {

    var myModal = new Modal(document.getElementById('modal'), {
            keyboard: false
        });


    });
</script>
