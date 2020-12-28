@extends('admin.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="text-center"><strong>Admin Panel</strong></h3>
                <p><strong>Языки</strong> - можно добавлять/удалять нужные для отображения языки. Поля названия, текста и адресса автоматически будут создаваться для всех языков и станут доступны для заполнения в разделе "места".</p>
                <p><strong>Категории</strong> - категории мест (рестораны, парки, отели и тд). Могут меть подкатегории (фильтры). В категории указываются какие поля нужно будет отображать и показывать ли категорию на главной странице.</p>
                <p><strong>Юниты</strong> - отдельные места (заведения, события и тд) у которых есть своя категория. В них хранится вся информация и в зависимости от категории в которой находится место будут показанны или убранны данные (например для парков можно отключить время работы и почту администратора, а для ресторанов наоборот - включить; можно отключить отображение длительности для баров, а для экскурсий включить).</p>
                <p><strong>Меню</strong> - пункты меню которые будут отображаться в шапке и футере страницы.</p>
            </div>
        </div>
    </div>
@endsection