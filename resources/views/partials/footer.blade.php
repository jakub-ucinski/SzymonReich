<footer>
    @if (count($pages)>0)
        
    <div class="container text-center my-3">
        <h3>Informacje Prawne</h3>
        <div class="d-flex justify-content-center">
            @foreach ($pages as $page)
        <a class='mx-2' href="/pages/{{$page->id}}">{{$page->title}}</a>

            @endforeach
        </div>
    </div>

    @endif

    <div class="row">
        <div id="copyright" class='col-md'>Copyright &#169; <span class='bold'>2020 QoQos</span></div>
        <a href='mailto:jakub.s.ucinski@gmail.com' id="designed" class='col-md' >Realizacja: <span class='bold'>Jakub Uciński</span></a>
    </div>
</footer>