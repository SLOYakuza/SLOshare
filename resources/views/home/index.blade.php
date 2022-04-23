@extends('layout.default')

@section('content')
    <div class="container-fluid">
        @include('blocks.news')
        @include('blocks.poll')
        @include('blocks.recommended')

        @include('blocks.tops_torrents')
        @include('blocks.latest_topics')
        @include('blocks.latest_posts')
        @include('blocks.online')
        @include('blocks.notification')
    </div>
@endsection
