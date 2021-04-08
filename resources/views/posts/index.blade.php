@extends('adminlte::page')

@section('title', 'Blog posts')

@section('plugins.Datatables', true)

@section('content_header')
    <h1>Blog posts</h1>
@stop

@section('content')
    @if (@session_start() && isset($_SESSION['post_message']))
        <x-adminlte-callout theme="success" title="Success">
            {{ $_SESSION['post_message'] }}
            @php unset($_SESSION['post_message']) @endphp
        </x-adminlte-callout>
    @endif

    @php
    $headers = ['status', 'title', 'slug', 'published_at', 'actions'];
    $config = [
        'data' => $posts->map(function($item) {
            return [
                $item->status,
                $item->title,
                $item->slug,
                $item->published_at,
                '<a href="'.route('posts.edit', $item).'" class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                    <i class="fa fa-lg fa-fw fa-pen"></i>
                </a>
                <a href="'.route('posts.show', $item).'" class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details">
                   <i class="fa fa-lg fa-fw fa-eye"></i>
                </a>
                <form method="POST" action="'.route('posts.destroy', $item).'">
                    <input type="hidden" name="_token" value="'.csrf_token().'" />
                    <input type="hidden" name="_method" value="delete">

                    <button class="btn btn-xs btn-default text-red mx-1 shadow" title="Delete">
                       <i class="fas fa-lg fa-trash"></i>
                    </button>
                </form>'
            ];
        }),
    ];
    @endphp

    <x-adminlte-datatable id="published_posts" :heads="$headers" head-theme="dark" :config="$config" striped hoverable bordered compressed/>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
