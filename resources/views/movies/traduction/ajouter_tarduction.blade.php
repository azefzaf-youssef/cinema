<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ajouter une traduction</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Modal content goes here -->
                <div class="col-xxl">

                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data" id="post-traduction">
                            @csrf
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="basic-default-phone">Langue</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="langue" id="langue"
                                        aria-placeholder="Chosir langue de traduction">
                                        @foreach ($langues as $langue)
                                            <option value="{{ $langue->id }}">{{ $langue->langue }}</option>
                                        @endforeach

                                    </select>
                                </div>
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


        document.getElementById('post-traduction').addEventListener('submit', function(e) {

            e.preventDefault();

            var langue = document.getElementById("langue");
            var id = langue.value;
            window.location.href =
                        "{{ route('USER-LOGGED-ADD-TRADUCTION-COMPOSANT-ILUSTRATION') }}" +"/" +"{{ $illustration->titre }}" + "/" + id;




            myModal.hide();

            console.log(id);

            return true;

        });
    });
</script>
