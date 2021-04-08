@extends('adminlte::page')

@section('title', 'New blog post')

@section('content_header')
    <h1>New blog post</h1>
@stop

@section('content')
    @foreach ($errors->all() as $message)
        <x-adminlte-callout theme="warning" title="Warning">
            {{ $message }}
        </x-adminlte-callout>
    @endforeach

    <form method="POST" action="{{ route('posts.store') }}">
        @csrf

        <x-adminlte-input name="title" label="Title" top-class="col-md-6" />

        <x-adminlte-input name="slug" label="Slug" top-class="col-md-6" />

        <x-adminlte-select name="status" label="Post status" top-class="col-md-6">
            <option value="draft">
                Draft
            </option>
            <option value="published">
                Published
            </option>
            <option value="planned">
                Planned
            </option>
        </x-adminlte-select>

        <x-adminlte-input name="published_at" label="Publication date" type="datetime-local" top-class="col-md-6"/>

        <x-adminlte-textarea name="content" label="Content" top-class="col-md-6"></x-adminlte-textarea>

        <x-adminlte-button class="btn-flat" type="submit" label="Submit" theme="success" icon="fas fa-lg fa-save"/>
    </form>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
