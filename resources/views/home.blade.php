@extends('layouts.app')

@section('title', 'Inicio')

@section('head')
<style>
html *{
    -webkit-font-smoothing: antialiased;
}

h3{
    font-weight: 300!important;
    font-size: 25px !important;
}

h4{
    font-size: 18px !important;
    font-weight: 300 !important;
}


footer{
    margin-top:100px;
    color: #555;
    background: #fff;
    padding: 25px;
    font-weight: 300;

}

.card.card-carousel {
    border: 0;
    margin-bottom: 30px;
    margin-top: 30px;
    border-radius: 6px ;
    color: rgba(0,0,0,.87);
    background: #fff;
    width: 100%;
    box-shadow: 0 2px 2px 0 rgba(0,0,0,.14), 0 3px 1px -2px rgba(0,0,0,.2), 0 1px 5px 0 rgba(0,0,0,.12);
}

.card.card-carousel img{
    border-radius: 6px;
}



.carousel-indicators {
    position: absolute;
    right: 0;
    bottom: 10px;
    left: 0;
    z-index: 15;
    display: flex;
    justify-content: center;
    padding-left: 0;
    margin-right: 15%;
    margin-left: 15%;
    list-style: none;
}

.carousel .carousel-indicators {
    bottom: 5px;
}

.carousel .carousel-indicators li {
    display: inline-block;
    width: 10px;
    height: 10px;
    text-indent: -999px;
    cursor: pointer;
    border: 1px solid #fff;
    border-radius: 10px;
    background: #fff;
    box-shadow: 0 2px 2px 0 rgba(0,0,0,.14), 0 3px 1px -2px rgba(0,0,0,.12), 0 1px 5px 0 rgba(0,0,0,.2);
    border-radius: 2px;
}

.carousel .carousel-indicators .active{
    margin: 11px 10px;
}

.carousel .carousel-indicators li {
    margin: 11px 10px;
}

.carousel .carousel-indicators .active {
    margin-top: 10px;
    transform: scale(1.5);
    box-shadow: 0 4px 5px 0 rgba(0,0,0,.14), 0 1px 10px 0 rgba(0,0,0,.12), 0 2px 4px -1px rgba(0,0,0,.2);
}

.carousel-inner {
    position: relative;
    width: 100%;
    overflow: hidden;
}

.carousel-item {
    position: relative;
    display: none;
    align-items: center;
    width: 100% !important;
    transition: transform .6s ease;
    backface-visibility: hidden;
    perspective: 1000px;
}

.carousel-item.active {
    display: block;
}

.carousel .carousel-caption {
    padding-bottom: 45px;
}

.carousel .carousel-caption .material-icons {
    position: relative;
    top: 5px;
}

.carousel .carousel-control-next .material-icons{
    z-index: 5;
    display: inline-block;
    font-size: 50px;
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    height: 50px;
    margin: auto;
}

.carousel .carousel-control-prev .material-icons {
    z-index: 5;
    display: inline-block;
    font-size: 50px;
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    height: 50px;
    margin: auto;
}
.footer p{
    margin-bottom: 0;
}
footer p a{
    color: #555;
    font-weight: 400;
}

footer p a:hover{
    color: #9f26aa;
    text-decoration: none;
}
</style>
@endsection

@section('page-title', 'Inicio')

@section('content')
    <div class="row" id="app">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Dashboard</h6>
                </div>
                <div class="card-body">
                    <home-index date="{{$date}}"></home-index>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Actividades</h6>
                </div>
                <div class="card-body" >
                    <proyectos-tecnico-actividades-calendario></proyectos-tecnico-actividades-calendario>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary"> Proyectos </h6>
                </div>
                <div class="card-body" >
                    <proyectos-index></proyectos-index>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
@endsection

