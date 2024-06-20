@extends('layout.master')

@section('content')
    @include('illustration.header')

    @if (Auth::user())
        @include('illustration.traduction.index_traduction_composant')
    @endif
    <div class="container bg-white p-5 rounded shadow ">
        <div class="d-flex justify-content-md-between">

            <h4 class="pb-4">Termenoligie</h4>


            <div class="btn-group" role="group">


                <x-carbon-translate class="icon-info-btn btn  dropdown-toggle " id="btnGroupDrop1" data-toggle="dropdown"
                    aria-haspopup="true" data-bs-toggle="dropdown" aria-expanded="false" />
                <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                    @if (count($illustration->getIllustrationTraduction()))
                        @foreach ($illustration->getIllustrationTraduction() as $langue)
                            <li><a class="dropdown-item get-tarduction @if ($langue->id == $illustration->id_langue) active @endif"
                                    data-idlangue="{{ $langue->id_langue }}"
                                    data-url="{{ route('USER-LOGGED-GET-ILUSTRATION-TRADUCTION') }}">{{ $langue->langue }}</a>
                            </li>
                        @endforeach
                    @else
                        <li><a class="dropdown-item get-tarduction  active " data-idlangue="{{ $illustration->id_langue }}"
                                data-url="{{ route('USER-LOGGED-GET-ILUSTRATION-TRADUCTION') }}">{{ $illustration->langue->langue }}</a>
                        </li>
                    @endif


                </ul>
            </div>

        </div>

        <div class="row ">
            <div class="col"></div>

            <div class=" col ">
                <div class="card card-img ">
                    <div id="lines">
                        <img id="images" src="{{ asset($illustration->path_illustration) }}" alt="">
                    </div>
                </div>
            </div>

            <div class="col"></div>

        </div>
    </div>
    </div>

    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                ...
            </div>
        </div>
    </div>



    @include('illustration.traduction.ajouter_tarduction');

    </div>
@endsection

@section('styles')
    <style>
        .line {
            position: absolute;
            cursor: default;
            text-align: inherit;
        }

        #images {
            width: 40rem;

        }

        .card-img {
            background: none;
            border: none;
        }

        .dot {
            height: 5px;
            width: 5px;
            background-color: rgb(0, 0, 0);
            border-radius: 50%;
            display: inline-block;

        }
    </style>
@endsection

@section('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            var composant = @json($composants);
            let old_lines = document.getElementById("lines");
            let image = document.getElementById("images");
            showComposant(old_lines, image, composant);

            var convertToTraductions = document.getElementsByClassName('get-tarduction');

            for (let langue of convertToTraductions) {
                langue.addEventListener('click', function(e) {

                    e.preventDefault();

                    var formData = new FormData();
                    formData.append('titre', "{{ $illustration->titre }}");
                    formData.append('id_langue', this.dataset.idlangue);

                    console.log(this.dataset.idlangue);
                    var xhr = new XMLHttpRequest();
                    var url = this.dataset.url;

                    xhr.open('POST', url, true);
                    xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
                    xhr.onreadystatechange = function() {
                        if (xhr.readyState == 4) {
                            console.log(xhr.status);

                            if (xhr.status == 200) {

                                composant = JSON.parse(xhr.response);
                                let old_lines = document.getElementById("lines");
                                let image = document.getElementById("images");
                                showComposant(old_lines, image, composant);


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

            var traductions = document.getElementsByClassName('delete-traduction');

            for (let traduction of traductions) {
                traduction.addEventListener('click', function(e) {

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

                            console.log(this.dataset.url);

                            var url = this.dataset.url;


                            console.log(url);
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
        });
    </script>
@endsection
