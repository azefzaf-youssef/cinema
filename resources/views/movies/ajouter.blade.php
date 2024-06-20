<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ajouter un film</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Modal content goes here -->
                <div class="col-xxl">

                    <div class="card-body">
                        <form action="{{ route('MOVIE-ADD-POST') }}" method="POST" enctype="multipart/form-data"
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
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Déscription</label>
                                <div class="col-sm-10">


                                        <textarea class="form-control" id="Description" name="description" rows="3"></textarea>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Date de sortie</label>
                                <div class="col-sm-4">
                                    <input type="date" class="form-control" name="date" id="date"
                                        placeholder="Date" />
                                </div>
                                <label class="col-sm-2 col-form-label" for="basic-default-name">Heure </label>
                                <div class="col-sm-4">
                                    <input type="time" class="form-control" name="heure" id="heure"
                                        placeholder="heure" />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-phone">Catégory</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="category" id="exampleFormControlSelect1">
                                        @foreach ($categories as $categorie)
                                            <option value="{{ $categorie->id }}">{{ $categorie->category }}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>



                            <div class="row mb-3">

                                <label class="col-sm-2 col-form-label" for="trailer">Trailer</label>

                                <div class="col-sm-10">
                                    <input type="file" class="custom-file-input"  max="2"  name="trailer"
                                        id="trailer">
                                </div>

                            </div>

                            <div class="row mb-3">

                                <label class="col-sm-2 col-form-label" for="trailer">Fiche</label>

                                <div class="col-sm-10">
                                    <input type="file" class="custom-file-input"  max="2"  name="fiche"
                                        id="fiche">
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

        $('#datepicker').datepicker({
            format: 'mm/dd/yyyy',
            todayHighlight: true,
            autoclose: true
        });

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
