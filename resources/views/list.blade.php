@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-lg-4 ml-auto text-center mb-5 mb-lg-0">
            <h2> Хочу
                @switch($contentType)
                    @case('music')
                 послушать
                    @break
                    @case('book')
                 прочесть
                    @break
                    @default
                 посмотреть
                @endswitch
            </h2>
            <div class="list-group">
                @foreach($content as $item)
                    @if(!$item->pivot->watched)
                        <a href="#" class="list-group-item list-group-item-action">
                            {{ $item->name }}
                            @if($item->author)- {{$item->author}}  @endif

                            <button type="button" class="close but-list">
                                <span aria-hidden="true">×</span>
                            </button>
                        </a>
                @endif
            @endforeach
            <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#listModal" data-whatever="0">+</button>
            </div>
        </div>

        {{--  Просмотренное  --}}
        <div class="col-lg-4 mr-auto text-center">
            <h2>
                @switch($contentType)
                    @case('music')
                    Прослушанное
                    @break

                    @case('book')
                    Прочитанное
                    @break

                    @default
                    Просмотренное
                @endswitch
            </h2>
            <div class="list-group">
                @foreach($content as $item)
                    @if($item->pivot->watched)
                        <a href="#" class="list-group-item list-group-item-action">
                            {{ $item->name }}
                            @if($item->author)- {{$item->author}}  @endif

                            <button type="button" class="close but-list">
                                <span aria-hidden="true">×</span>
                            </button>
                        </a>
                @endif
            @endforeach
            <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#listModal" data-whatever="1">+</button>
            </div>
        </div>
    </div>

    @include('modal')

@endsection
