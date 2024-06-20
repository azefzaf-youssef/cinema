@extends('layout.master')
@section('content')
    <div class="container header-block p-2 mb-3  rounded text-center shadow ">
        <h5>Liste des Catégories </h5>
    </div>
    <div class="container bg-white p-5 rounded shadow ">

        <div class="d-flex justify-content-md-between">

            <h4 class="pb-4">Liste des Catégories</h4>

        </div>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col" class="w-100">Catégorie</th>
                    <th scope="col">Action(s)</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->category }}</td>
                        <td>
                            <x-gmdi-edit class="icon-style-btn icon-success edit-category"
                                data-url="{{ route('GESTION-CATEGORY-EDIT', $category->id) }}" data-bs-toggle="modal"
                                data-bs-target="#modal" />
                            <x-carbon-close data-url="{{ route('GESTION-CATEGORY-DELETE', $category->id) }}"
                                class="icon-style-btn icon-danger delete-category" />
                        </td>
                    </tr>
                @endforeach


            </tbody>
        </table>


        {!! $categories->links() !!}



        <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content" id="modal-content">


                </div>
            </div>
        </div>




    </div>
    <div class="md-fab-wrapper">

        <x-carbon-add-filled class="icon-style-btn-Large btn-primary-float  " data-bs-toggle="modal"
            data-bs-target="#exampleModal" />

    </div>




    @include('category.ajouter');
@endsection

@section('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            function submitForm() {

                document.getElementById('post-edit-category').addEventListener('submit', function(e) {

                    console.log("test");
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
                                    icon: "success",
                                    showConfirmButton: false,
                                    timer:1000
                            }).then((result) => {
                                /* Read more about handling dismissals below */
                                myModal.hide();
                                if (result.dismiss === Swal.DismissReason.timer) {
                                window.location.reload();

                                }
                            });



                            } else {

                                var response = JSON.parse(xhr.responseText);

                                var string_error =
                                    '<b>Les données fournies ne sont pas valides </b><br>';

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
            }


            var myModal = new Modal(document.getElementById('modal'), {
                keyboard: false
            });



            var utilisateurs = document.getElementsByClassName('delete-category')

            for (let utilisateur of utilisateurs) {
                utilisateur.addEventListener('click', function(e) {

                    Swal.fire({
                        title: "Êtes-vous sûr?",
                        icon: "question",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Oui, supprimez-le!",
                        cancelButtonText: "Annuler",
                    }).then((result) => {

                        if (result.value) {


                            var url = this.dataset.url;


                            var xhr = new XMLHttpRequest();

                            // Configure it: DELETE request for a specific URL
                            xhr.open('DELETE', url, true);
                            xhr.setRequestHeader('Content-Type', 'application/json');
                            xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');

                            xhr.onload = function() {
                                if (xhr.readyState == 4) {
                                    console.log(xhr.status);

                                    if (xhr.status == 200) {

                                        console.log(xhr.responseText);
                                        var response = JSON.parse(xhr.responseText);

                                        window.location.reload()





                                    } else {

                                        var response = JSON.parse(xhr.responseText);

                                        var string_error =
                                            '<b>Les données fournies ne sont pas valides </b><br>';

                                        for (var key in response) {
                                            if (response.hasOwnProperty(key)) {
                                                string_error += '<br>' + response[key][0];
                                            }
                                        }

                                        Swal.fire({
                                            title: "Erreur!",
                                            html: string_error,
                                            icon: "error"
                                        });


                                    }
                                }
                            };

                            // Send the request
                            xhr.send();
                        }

                    })
                });
            }


            var edits = document.getElementsByClassName('edit-category')

            for (let edit of edits) {
                edit.addEventListener('click', function(e) {


                    console.log(this.dataset.url);

                    var url = this.dataset.url;
                    var xhr = new XMLHttpRequest();
                    xhr.open('GET', url, true);
                    xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');

                    xhr.onload = function() {
                        if (xhr.readyState == 4) {
                            console.log(xhr.status);

                            if (xhr.status == 200) {

                                document.getElementById('modal-content').innerHTML = xhr.responseText;
                                submitForm();
                                myModal.show();



                            } else {

                                var response = JSON.parse(xhr.responseText);

                                var string_error =
                                    '<b>Les données fournies ne sont pas valides </b><br>';

                                for (var key in response) {
                                    if (response.hasOwnProperty(key)) {
                                        string_error += '<br>' + response[key][0];
                                    }
                                }

                                Swal.fire({
                                    title: "Erreur!",
                                    html: string_error,
                                    icon: "error"
                                });


                            }
                        }
                    };

                    // Send the request
                    xhr.send();

                });
            }

        });
    </script>
@endsection

@section('styles')
    <style>

    </style>
@endsection
