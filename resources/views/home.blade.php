@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <div id="portfolio">
                <div class="container-fluid p-0">
                    <div class="row no-gutters">

                        @if($topContents)
                            @foreach($topContents as $key => $item)
                                <div class="col-lg-4 col-sm-6">
                                    <a class="portfolio-box" href="">
                                        <img class="img-fluid mx-auto d-block" src="{{ $links[$key] ?? ('/images/icons/' . $item->type  . '.png') }}" alt=""/>
                                        <div class="portfolio-box-caption">
                                            <div class="project-category text-white-50">
                                                {{$item->type}}
                                            </div>
                                            <div class="project-name">
                                                {{$item->name}}
                                                @if($item->author)
                                                    <br>
                                                    {{$item->author}}
                                                @endif
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
