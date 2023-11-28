@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="{{ asset('css/categories.css') }}" />
@endsection

@section('content')
@if (session('message'))
<div class="message__success">
{{ session('message') }}
</div>
@endif
@error('name')
<div class="message__error">
    @foreach ($errors->all() as $error)
    <li>{{$error}}</li>
    @endforeach
</div>
@enderror
<div class="container">
    <div class="form category-create">
        <form action="/categories" method="post">
            @csrf
            <input class="form__input" type="text" name="name" value="{{ old('name') }}">
            <button class="form__button">作成</button>
        </form>
    </div>
    <div class="content">
        <table>
            <tr>
                <th>category</th>
            </tr>
            @foreach($categories as $category)
            <tr class="content__list">
                <td>
                    <form action="/categories/update" method="post">
                        @method('patch')
                        @csrf
                        <input class="content__list__input" type="text" name='name' value="{{ $category['name'] }}" >
                        <input type="hidden" name='id' value="{{ $category['id'] }}" >
                        <button class="content__list__button--blue">更新</button>
                    </form>
                </td>
                <td>
                    <form action="/categories/delete" method="post">
                        @method('delete')
                        @csrf
                        <input type="hidden" name='id' value="{{ $category['id'] }}" >
                        <button class="content__list__button--red">削除</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection