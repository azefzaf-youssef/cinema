<div class="container  p-3 header-block  rounded mb-2  shadow">
    <h4> Titre : <i>{{ $illustration->titre }} </i></h4>
    <div style="font-size: 13px">
        Langue par défaut : <span>{{ $illustration->langue->langue ?? '--'  }}</span><br>
        Domaine : <span>{{ $illustration->domaine->domaine ?? '--'  }}</span><br>
        Crée par : <span>{{ $illustration->user->name ?? '--' }}</span><br>
    </div>
</div>
