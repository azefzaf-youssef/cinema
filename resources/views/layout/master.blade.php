<html>
    <head>
        <!-- Common head elements -->
    </head>


    <script src="{{ asset('js/app.js') }}" defer></script>

    @yield('scripts')

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <body>
        <header>
            <!-- Common header content -->
        </header>
        @include('layout.menu')

            <main class="py-4 ">
            @yield('content')
            </main>

        </div>

        <footer>
            <!-- Common footer content -->
        </footer>
    </body>
</html>



@yield('styles')
<style>

body {
    background-color: #e6e6e6;
    color: #212529;
    font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif ;
}

.tmp-color-white {
    color: #fffefb;

}

.tmp-color-bleu {

    color: #21ccec;

}

.tmp-color-bleu-marine {

    color:#170657;


}
.tmp-color-orange {

    color: #f5ac42;

}

.sub-title-class
{
    margin-top: 5px;
    font-size: 10px
}
.title-1 {

    color: #fffefb;
    font-weight: bold;
    font-size: 128px;

}

.title-2 {

color: #170657;
font-weight: bold;
font-size: 32px;
line-height: 1.1;

}

.title-3 {

color: #170657;
font-size: 10px;
line-height: 1.5;


}

.title-4 {

color: #170657;
font-weight: bold;
font-size: 64px;
line-height: 1.05;

}


.txt-rg
        {
            text-align:right;
        }


.txt-lt
        {
            text-align:left;
        }






</style>


