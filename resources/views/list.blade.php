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

            <ul class="list-group list-group-flush">
                @foreach($content as $item)
                    @if(!$item->pivot->watched)
                        <li class="list-group-item">
                            {{ $item->name }}
                            @if($item->author)- {{$item->author}}  @endif
                            <a class="del_a" onclick="select_content(this);"></a>
                        </li>
                @endif
            @endforeach
            <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#listModal" data-whatever="0">
                    +
                </button>
            </ul>
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
            <ul class="list-group list-group-flush">

                @foreach($content as $item)
                    @if($item->pivot->watched)
                        <li class="list-group-item">

                            {{ $item->name }}
                            @if($item->author)- {{$item->author}}  @endif
                            <a class="del_a" onclick="select_content(this);"> -</a>
                        </li>
                @endif
            @endforeach
            <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#listModal" data-whatever="1">
                    +
                </button>
            </ul>
        </div>
    </div>

    @include('modal')

@endsection
