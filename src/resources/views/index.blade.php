@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
    @if (session('flash_message'))
        <div class="message__success">
            {{ session('flash_message') }}
        </div>
    @endif
    @if (count($errors) > 0)
    <div class="message__error">
        <ul>
        @foreach ($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
        </ul>
    </div>
    @endif
    <div class="content">
        <form  class= "create__form" action="/todos" method="post">
            @csrf
            <input class= "create__input" type="text" name="content">
            <button class="content__create">作成</button>
        </form>
        <div class="content__todo">
            <h2>Todo</h2>
            <ul>
                @foreach($todos as $todo)
                <li class='content__todo--list'>
                    <div>
                        <form class= "todo__form" action="/todos/update" method="post">
                            @method('patch')
                            @csrf
                            <input class="todo__content" type="text" name="content" value="{{ $todo['content'] }}">
                            <input type="hidden" name="id" value="{{ $todo['id'] }}">
                            <button class= "button--blue">更新</button>
                        </form>
                        <form class= "todo__form" action="/todos/delete" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{ $todo['id'] }}">
                            <button class= "button--red">削除</button>
                        </form>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    </div>

@endsection