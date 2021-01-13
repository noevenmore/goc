<p class="my-0"><a class="btn btn-sm btn-primary w-100" href="{{route('index')}}">На сайт</a></p>
<p class="my-1"><a class="btn btn-sm btn-primary w-100" href="{{route('admin_index')}}">Админ панель</a></p>

@if (Gate::allows('isAdmin'))
<div onclick="toggleMenu(3)" class="btn btn-sm btn-success w-100 mt-2">Языки</div>
<div id="menu_items_3" class="w-100" style="display: none;">
    <p class="my-1"><a class="btn btn-sm btn-primary w-100" href="{{route('admin_lang_show')}}">Просмотр языков</a></p>
    <p class="my-1"><a class="btn btn-sm btn-primary w-100" href="{{route('admin_lang_add')}}">Добавить язык</a></p>
</div>
@endif

@if (Gate::allows('isModer'))
<div onclick="toggleMenu(4)" class="btn btn-sm btn-success w-100 mt-2">Категории</div>
<div id="menu_items_4" class="w-100" style="display: none;">
    <p class="my-1"><a class="btn btn-sm btn-primary w-100" href="{{route('admin_category_show')}}">Просмотр категорий</a></p>
    <p class="my-1"><a class="btn btn-sm btn-primary w-100" href="{{route('admin_category_add')}}">Добавить категорию</a></p>
</div>
@endif

<div onclick="toggleMenu(5)" class="btn btn-sm btn-success w-100 mt-2">Юниты</div>
<div id="menu_items_5" class="w-100" style="display: none;">
    <p class="my-1"><a class="btn btn-sm btn-primary w-100" href="{{route('admin_post_show')}}">Просмотр юнитов</a></p>
    <p class="my-1"><a class="btn btn-sm btn-primary w-100" href="{{route('admin_post_add')}}">Добавить юнит</a></p>
</div>

@if (Gate::allows('isAdmin'))
<div onclick="toggleMenu(6)" class="btn btn-sm btn-success w-100 mt-2">Меню</div>
<div id="menu_items_6" class="w-100" style="display: none;">
    <p class="my-1"><a class="btn btn-sm btn-primary w-100" href="{{route('admin_menu_item_show')}}">Просмотр меню</a></p>
    <p class="my-1"><a class="btn btn-sm btn-primary w-100" href="{{route('admin_menu_item_add')}}">Добавить меню</a></p>
</div>
@endif

@if (Gate::allows('isAdmin'))
<div onclick="toggleMenu(100)" class="btn btn-sm btn-success w-100 mt-2">Система</div>
<div id="menu_items_100" class="w-100" style="display: none;">
    <p class="my-1"><a class="btn btn-sm btn-primary w-100" href="{{route('admin_mp_slider_show')}}">Просмотр слайдеров на главной</a></p>
    <p class="my-1"><a class="btn btn-sm btn-primary w-100" href="{{route('admin_mp_slider_add')}}">Добавить слайдер на главной</a></p>
    <p class="my-1"><a class="btn btn-sm btn-primary w-100" href="{{route('admin_social_links_show')}}">Просмотреть социальные сети</a></p>
    <p class="my-1"><a class="btn btn-sm btn-primary w-100" href="{{route('admin_social_links_add')}}">Добавить социальные сети</a></p>
    <p class="my-1"><a class="btn btn-sm btn-primary w-100" href="{{route('admin_system_config_edit')}}">Системные значение</a></p>
    <p class="my-1"><a class="btn btn-sm btn-primary w-100" href="{{route('admin_users_show')}}">Пользователи</a></p>
</div>
@endif