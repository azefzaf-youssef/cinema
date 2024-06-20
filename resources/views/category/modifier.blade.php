<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Modifier une categorie</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <!-- Modal content goes here -->
    <div class="col-xxl">

        <div class="card-body">
            <form action="{{ route('GESTION-CATEGORY-POST') }}" method="POST" enctype="multipart/form-data"
                id="post-edit-category">
                @csrf
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label" for="basic-default-name">catégorie</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="category" id="basic-default-name"
                            placeholder="Nom" value="{{ $category->category }}" />
                    </div>
                </div>


                <div class="row justify-content-end">

                </div>

                <input type="hidden" value="{{ $category->id }}" name="id">

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
