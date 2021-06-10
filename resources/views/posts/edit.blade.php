@extends('adminlte::page')

@section('title', 'Edit blog post')

@section('content_header')
    <h1>Edit blog post "{{ $post->title }}"</h1>
@stop

@section('content')
    {{-- @foreach ($errors->all() as $message)
        <x-adminlte-callout theme="warning" title="Warning">
            {{ $message }}
        </x-adminlte-callout>
    @endforeach --}}
    @if (session('post_message'))
        {{-- @if (@session_start() && isset($_SESSION['post_message'])) --}}
        <x-adminlte-callout theme="success" title="Success">
            {{ session('post_message') }}
            {{-- {{ $_SESSION['post_message'] }} --}}
            {{-- @php unset($_SESSION['post_message']) @endphp --}}
        </x-adminlte-callout>
    @endif

    <form method="POST" action="{{ route('posts.update', $post) }}">
        @csrf
        @method('patch')

        <x-adminlte-input name="title" label="Title" placeholder="" top-class="col-md-6"
            value="{{ old('title') ?? $post->title }}" />

        <x-adminlte-input name="slug" label="Slug" placeholder="" top-class="col-md-6"
            value="{{ old('slug') ?? $post->slug }}" />

        <x-adminlte-select name="status" label="Post status" top-class="col-md-6">
            @foreach ($statuses as $key => $value)
                <option value="{{ $key }}" @if (old('status') === $key) selected @elseif ($post->status === $key) selected @endif>
                    {{ $value }}
                </option>
            @endforeach
        </x-adminlte-select>

        <x-adminlte-input name="published_at" label="Publication date" type="datetime-local" top-class="col-md-6"
            :value="$post->published_at ? $post->published_at->format('Y-m-d\TH:i:s') : '' " />

        <x-adminlte-textarea name="content" label="Content" top-class="col-md-6">
            {{ $post->content }}
        </x-adminlte-textarea>

        <x-adminlte-button class="btn-flat" type="submit" label="Submit" theme="success" icon="fas fa-lg fa-save" />
    </form>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
