@extends('adminlte::page')

@section('title', 'New blog post')

@section('content_header')
    <h1>New blog post</h1>
@stop

@section('content')
    {{-- @foreach ($errors->all() as $message)
        <x-adminlte-callout theme="warning" title="Warning">
            {{ $message }}
        </x-adminlte-callout>
    @endforeach --}}

    <form method="POST" action="{{ route('posts.store') }}">
        @csrf

        <x-adminlte-input name="title" label="Title" top-class="col-md-6" value="{{ old('title') }}" />

        <x-adminlte-input name="slug" label="Slug" top-class="col-md-6" value="{{ old('slug') }}" />

        <x-adminlte-select name="status" label="Post status" top-class="col-md-6">
            {{-- <option value="draft" @if (old('status') === 'draft') selected @endif>
                Draft
            </option>
            <option value="published" @if (old('status') === 'published') selected @endif>
                Published
            </option>
            <option value="planned" @if (old('status') === 'planned') selected @endif>
                Planned
            </option> --}}
            @foreach ($statuses as $key => $value)
                <option value="{{ $key }}" @if (old('status') === $key) selected @endif>
                    {{ $value }}
                </option>
            @endforeach
        </x-adminlte-select>

        <x-adminlte-input name="published_at" label="Publication date" type="datetime-local" top-class="col-md-6"
            value="{{ old('published_at') }}" />

        <x-adminlte-textarea name="content" label="Content" top-class="col-md-6">
            {{ old('content') }}
        </x-adminlte-textarea>

        <x-adminlte-button class="btn-flat" type="submit" label="Submit" theme="success" icon="fas fa-lg fa-save" />
    </form>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
