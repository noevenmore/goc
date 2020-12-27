<p class="my-0"><a class="btn btn-sm btn-primary w-100" href="{{route('index')}}">На сайт</a></p>
<p class="my-1"><a class="btn btn-sm btn-primary w-100" href="{{route('admin_index')}}">Админ панель</a></p>


<div onclick="toggleMenu(3)" class="btn btn-sm btn-success w-100 mt-2">Языки</div>
<div id="menu_items_3" class="w-100" style="display: none;">
    <p class="my-1"><a class="btn btn-sm btn-primary w-100" href="{{route('admin_lang_show')}}">Просмотр языков</a></p>
    <p class="my-1"><a class="btn btn-sm btn-primary w-100" href="{{route('admin_lang_add')}}">Добавить язык</a></p>
</div>

<div onclick="toggleMenu(4)" class="btn btn-sm btn-success w-100 mt-2">Категории</div>
<div id="menu_items_4" class="w-100" style="display: none;">
    <p class="my-1"><a class="btn btn-sm btn-primary w-100" href="{{route('admin_category_show')}}">Просмотр категорий</a></p>
    <p class="my-1"><a class="btn btn-sm btn-primary w-100" href="{{route('admin_category_add')}}">Добавить категорию</a></p>
</div>

<div onclick="toggleMenu(5)" class="btn btn-sm btn-success w-100 mt-2">Места</div>
<div id="menu_items_5" class="w-100" style="display: none;">
    <p class="my-1"><a class="btn btn-sm btn-primary w-100" href="{{route('admin_post_show')}}">Просмотр места</a></p>
    <p class="my-1"><a class="btn btn-sm btn-primary w-100" href="{{route('admin_post_add')}}">Добавить место</a></p>
</div>