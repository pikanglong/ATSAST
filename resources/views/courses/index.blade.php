@extends('layouts.app')

@section('template')

<style>
    .page-link {
        color: #ee6e73;
    }
    .page-link.active{
        background-color: #ee6e73;
        color: white!important;
    }
    .page-link:hover {
        color: #ee6e73;
    }
    .page-link:focus {
        box-shadow: 0 0 0 0.2rem rgba(238, 110, 115,.25);
    }
    nav.atsast-pagination{
        box-shadow: none;
    }
    canvas#atsast-background-canvas{
        position: fixed;
        z-index: -1;
        top:0;
    }
    /* .attsast-course{
        display: block;
        background-image: linear-gradient(135deg,rgba(0,0,0,0),rgba(0,0,0,0.25));
    } */
</style>
<div class="container mundb-standard-container">
    <section class="mb-5">
        <h1>课程</h1>
        <p>courses</p>
        <div class="row">
            @if(Auth::check() && Auth::user()->hasAccess('course.add'))
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <a class="attsast-course" href="{{$ATSAST_DOMAIN}}/course/add">
                        <div class="btn card text-white wemd-green mb-3 text-center">
                            <div class="card-body">
                                <i class="MDI plus"></i>
                                <h5 class="card-title mundb-text-truncate-1">添加课程</h5>
                                <p class="card-text mundb-text-truncate-1">添加你们的课程</p>
                            </div>
                        </div>
                    </a>
                </div>
            @endif
            @foreach($result as $r)
            <div class="col-lg-4 col-md-6 col-sm-12">
                <a class="attsast-course" href="{{$ATSAST_DOMAIN}}/course/{{$r->cid}}/detail">
                    <div class="btn card text-white {{$r->course_color}} mb-3 text-center">
                        <div class="card-body">
                            @if(strlen($r->course_logo) <= 3)
                                <i>{{$r->course_logo}}</i>
                            @else
                                <i class="{{$r->course_logo}}"></i>
                            @endif
                            <h5 class="card-title mundb-text-truncate-1">{{$r->course_name}}</h5>
                            <p class="card-text mundb-text-truncate-1">{{$r->course_desc}}</p>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
        <nav aria-label="Page navigation" class="atsast-pagination mt-5">
            <ul class="pagination justify-content-center">
                {{$paginator->links()}}
            </ul>
        </nav>
    </section>
</div>

@endsection
