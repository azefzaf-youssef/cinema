<div class="container bg-white p-5 my-2 rounded shadow">
    <div class="d-flex justify-content-md-between">

        <h4 class="pb-4">Liste des traductions</h4>
        @if (Auth::user())
            @if (!Auth::user()->is_admin)
                <x-ri-add-fill class=" icon-info-btn btn   " style=" margin-right:3px; " data-bs-toggle="modal"
                    data-bs-target="#exampleModal" />
            @endif
        @endif

    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col" class="w-50">Langue</th>
                <th scope="col" class="w-50">Crée par</th>
                <th scope="col">Action(s)</th>
            </tr>
        </thead>
        <tbody>

            @if (count($traductions))
                @foreach ($traductions as $traduction)
                    <tr>
                        <td>{{ $traduction->langue }}</td>
                        <td>{{ $traduction->name }}</td>
                        <td>
                            @if (Auth::user())
                                @if (!Auth::user()->is_admin && Auth::user()->id == $traduction->id_user)
                                    <a
                                        href="{{ route('USER-LOGGED-EDIT-TRADUCTION-COMPOSANT-ILUSTRATION', [$illustration->titre, $traduction->id_langue]) }}"><x-gmdi-edit
                                            class="icon-style-btn icon-success" /></a>
                                @endif
                            @endif
                            @if (Auth::user())
                                @if (Auth::user()->is_admin || Auth::user()->id == $traduction->id_user)
                            <x-carbon-close
                                data-url="{{ route('USER-LOGGED-DELETE-ILUSTRATION-TRADUCTION', $traduction->id) }}"
                                class="icon-style-btn icon-danger delete-traduction" />
                                @endif
                            @endif
                        </td>
                    </tr>
                @endforeach
            @else
                <tr class="text-center" style="font-size: 12px">
                    <td colspan="3">Aucune donnée disponible </td>
                </tr>
            @endif



        </tbody>
    </table>
</div>
