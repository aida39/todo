@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}" />
@endsection

@section('content')
@if (session('message'))
<div class="message__success">
    {{ session('message') }}
</div>
@endif
@error('content')
<div class="message__error">
    @foreach ($errors->all() as $error)
    <li>{{$error}}</li>
    @endforeach
</div>
@enderror
<div class="container">
    <div class="form todo-create">
        <div class="form__title">新規作成</div>
        <form action="/todos" method="post">
            @csrf
            <input class="form__input" type="text" name="content" value="{{ old('content') }}">
            <select class="form__categories" name="category_id" >
                <option value="">カテゴリ</option>
                @foreach($categories as $category)
                <option value="{{$category['id']}}">{{$category['name']}}</option>
                @endforeach
            </select>
            <button class="form__button">作成</button>
        </form>
    </div>
    <div class="form todo-search">
        <div class="form__title">Todo検索</div>
        <form action="/todos/search" method="get">
            @csrf
            <input class="form__input" type="text" name="content">
            <select class="form__categories" name="category_id" >
                <option value="">カテゴリ</option>
                @foreach($categories as $category)
                <option value="{{$category['id']}}">{{$category['name']}}</option>
                @endforeach
            </select>
            <button class="form__button">検索</button>
        </form>
    </div>
    <div class="content">
        <table>
            <tr>
                <th>
                    <span class='content__header'>Todo</span>
                    <span class='content__header'>カテゴリ</span>
                </th>
            </tr>
            @foreach($todos as $todo)
            <tr class="content__list">
                <td>
                    <form action="/todos/update" method="post">
                        @method('patch')
                        @csrf
                        <input class="content__list__input" type="text" name='content' value= "{{$todo['content']}}">
                        <input type="hidden" name='id' value= "{{$todo['id']}}">
                        <p class="content__list__category">{{$todo['category']['name']}}</p>
                        <button class="content__list__button--blue">更新</button>
                    </form>
                </td>
                <td>
                    <form action="/todos/delete" method="post">
                        @method('delete')
                        @csrf
                        <input type="hidden" name='id' value= "{{$todo['id']}}">
                        <button class="content__list__button--red">削除</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection