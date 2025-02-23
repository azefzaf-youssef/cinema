<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ajouter une catégorie</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Modal content goes here -->
                <div class="col-xxl">

                    <div class="card-body">
                        <form action="{{ route('GESTION-CATEGORY-POST') }}" method="POST" enctype="multipart/form-data"
                            id="post-category">
                            @csrf
                            <div class="row mb-3">
                                <label class="col-sm-3 col-form-label" for="basic-default-name">Catégorie</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="category" id="category"
                                        placeholder="Categorie" />
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


        document.getElementById('post-category').addEventListener('submit', function(e) {

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


                        document.getElementById('category').value ='';


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
