@extends('layout.master')

@section('content')
    @include('illustration.header')

    <div class="container  p-2 header-block  rounded mb-0  shadow">
        <span>
            Modification des composants :
        </span>
    </div>
    <div class="container-sm   rounded   ">
        <span></span>

        <div class="row  bg-white ">
            <div class="col  p-2  ">
                <ul class="list-group  ">
                    @foreach ($composants as $composant)
                        <li class="list-group-item hover-composant li-composants rounded-0 "><span class="composant-to-edit"
                                id="composant-{{ $composant->id }}" data-id="{{ $composant->id }}"
                                contenteditable="false">{{ $composant->description }}</span><x-carbon-edit
                                class="icon-style-btn icon-secondary edit" data-id="{{ $composant->id }}" /></li>
                    @endforeach

                </ul>
            </div>



            <div class=" col-9  bg-white border p-2   ">
                <div class="card card-img " style="left: 16% ;width: fit-content;">
                    <div id="lines" class="container-fluide">
                        <img id="images" onclick="getXandY()" src="{{ asset($illustration->path_illustration) }}"
                            alt="">
                    </div>
                </div>
            </div>


        </div>
    </div>

    <div class="md-fab-wrapper">

        <x-heroicon-s-check-circle class="icon-style-btn-Large btn-primary-float  " id="post-edit-composant"
            data-url="{{ route('USER-LOGGED-POST-EDIT-COMPOSANT-ILUSTRATION') }}"  />


    </div>

    </div>
    @include('illustration.ajouter_composant_pop_up');
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
            width: 100%;
        }

        .dot {
            height: 5px;
            width: 5px;
            background-color: rgb(0, 0, 0);
            border-radius: 50%;
            display: inline-block;

        }

        .li-composants {
            display: flex;
            justify-content: space-between;
        }
    </style>
@endsection

@section('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {



            function changeDescriptionComposantById(id_composant, description) {
                return composant.filter(function(obj) {
                    if (obj.id == parseInt(id_composant)) {
                        obj.description = description;
                    }
                    return true;
                });
            }

            var composant = @json($composants);
            let old_lines = document.getElementById("lines");
            let image = document.getElementById("images");
            showComposant(old_lines, image, composant);

            var btn_edits = document.getElementsByClassName('edit');

            for (let index = 0; index < btn_edits.length; index++) {
                btn_edits[index].addEventListener('click', function(e) {

                    var composant_spans = document.getElementsByClassName('composant-to-edit');

                    for (let index = 0; index < composant_spans.length; index++) {
                        composant_spans[index].contentEditable = false;
                    }

                    let id = this.dataset.id;
                    let span = document.getElementById('composant-' + id);
                    span.contentEditable = true;
                    span.focus();
                    span.addEventListener('input', function(e) {
                        let description = document.getElementById('description-' + id);
                        description.innerHTML = span.textContent;
                        composant = changeDescriptionComposantById(id, span.textContent);
                    })
                });

            }

            document.getElementById('post-edit-composant').addEventListener('click', function(e) {

                e.preventDefault();


                var formData = new FormData();
                formData.append('composants', JSON.stringify(composant));
                formData.append('titre', "{{ $illustration->titre }}");
                var xhr = new XMLHttpRequest();
                var url = this.dataset.url;
                xhr.open('POST', url, true);
                xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');

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
                                timer: 1000
                            }).then((result) => {
                                if (result.dismiss === Swal.DismissReason.timer) {
                                    window.location.href = "{{ route('USER-LOGGED-INDEX') }}"
                                }
                            });;



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
@endsection
