<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ajouter illustration</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Modal content goes here -->
                <div class="col-xxl">

                    <div class="card-body">
                        <form action="{{ route('USER-LOGGED-ADD-POST') }}" method="POST" enctype="multipart/form-data"
                            id="post-illutration">
                            @csrf
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Titre</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="titre" id="titre"
                                        placeholder="Titre" />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-phone">Domaine</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="domaine" id="exampleFormControlSelect1">
                                        @foreach ($domaines as $domaine)
                                            <option value="{{ $domaine->id }}">{{ $domaine->domaine }}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-phone">Langue</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="langue" id="exampleFormControlSelect1">
                                        @foreach ($langues as $langue)
                                            <option value="{{ $langue->id }}">{{ $langue->langue }}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">

                                <label class="col-sm-2 col-form-label" for="illustration">Illustration</label>

                                <div class="col-sm-10">
                                    <input type="file" class="form-control-file" max="2"  name="illustration"
                                        id="illustration">
                                </div>
                            </div>

                            <div class="row justify-content-end">

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fermer</button>
                                <button type="submit" id="post-btn" class="btn btn-primary">Ajouter</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>



<script>

    document.addEventListener("DOMContentLoaded", function() {

        var myModal = new Modal(document.getElementById('exampleModal'), {
            keyboard: false
        });


        document.getElementById('post-illutration').addEventListener('submit', function(e) {

            e.preventDefault();


            var formData = new FormData(this);
            var xhr = new XMLHttpRequest();
            var url = this.action;

            xhr.open('POST', url, true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4) {
                    console.log(xhr.status);

                    if (xhr.status == 200) {

                        console.log(xhr.responseText);
                        var response = JSON.parse(xhr.responseText);

                        Swal.fire({
                            title: "Action effectuée avec succès!",
                            icon: "success"
                        });

                        myModal.hide();

                        document.getElementById('titre').value ='';
                        document.getElementById('illustration').value ='';


                        window.location.reload();

                    } else {

                        var response = JSON.parse(xhr.responseText);

                        var string_error = '<b>Les données fournies ne sont pas valides </b><br>';

                        for (var key in response) {
                            if (response.hasOwnProperty(key)) {
                                string_error += '<br>' + response[key][0];
                            }
                        }

                        console.log(response);
                        Swal.fire({
                            title: "Erreur!",
                            html: string_error,
                            icon: "error"
                        });


                    }
                }
            };

            xhr.send(formData);
        });
    });
</script>
