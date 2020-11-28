@extends('page')

@section('content')
    <div id="allcontent">
        @if(!empty($content))
            <div class="list">
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
                <ul>
                    @foreach($content as $item)
                        <li>
                            {{ $item->name }} <a class="del_a" onclick="select_content(this);"></a>
                        </li>
                    @endforeach
                    <?php
                    //    Старинная реализация
                    // $arr_length = count($array_content1);
                    // for ($i = 0; $i < $arr_length; $i++) {
                    //     echo '<li>' . $array_content1[$i] . '<a class="del_a" onclick="select_content(this);"></a></li>';
                    // }
                    // ?>
                    <li id="show1" onclick="setwatch(1)"> +</li>
                </ul>
            </div>
        @endif

        @if(!empty($content))
            <div class="list">
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
                <ul>
                    @foreach($content as $item)
                        <li>{{ $item->name }} <a class="del_a" onclick="select_content(this);"></a></li>
                    @endforeach
                    <li id="show0" onclick="setwatch(0)"> +</li>
                </ul>
            </div>
        @endif
    </div>

    <dialog class="dialog" id="add">
        <h3> Добавление элемента </h3>
        <form method="POST" action="php/addContent.php" name="addform">
            <input type="text" placeholder="Название" name="name" class="input_data"> <br>
            <input type="submit" value="Добавить" class="dialog-button">
            <input type="button" onclick="dialogAdd.close();" value="Отмена" class="dialog-button">

            <input type="text" name="watch" value="watch" style="display:none;">
        </form>
    </dialog>

    <dialog class="dialog" id="delete">
        <h3> Удалить элемент? </h3>
        <form method="POST" action="php/deleteContent.php" name="deleteform">
            <input type="text" name="namecontent" value="Название" class="input_data" readonly> <br>
            <input type="submit" value="Удалить" class="dialog-button">
            <input type="button" onclick="dialogDelete.close();" value="Отмена" class="dialog-button">
        </form>
    </dialog>

    <script src="js/dialog-polyfill.js"></script>
    <script src="js/dialog.js"></script>
    <script src="js/forforms.js"></script>

@endsection
