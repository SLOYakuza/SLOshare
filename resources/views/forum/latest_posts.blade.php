@extends('layout.default')

@section('title')
    <title>{{ __('common.latest-posts') }} - {{ __('forum.forums') }}</title>
@endsection

@section('meta')
    <meta name="description" content="Forum {{ __('common.latest-posts') }}">
@endsection

@section('breadcrumbs')
    <li class="breadcrumbV2">
        <a href="{{ route('forums.index') }}" class="breadcrumb__link">
            {{ __('forum.forums') }}
        </a>
    </li>
    <li class="breadcrumb--active">
        {{ __('common.latest-posts') }}
    </li>
@endsection

@section('nav-tabs')
    @include('forum.buttons')
@endsection

@section('main')
    <h2>{{ __('common.latest-posts') }}</h2>
    <ul class="topic-posts">
        @foreach ($results as $post)
            <li class="post-listings__item">
                <x-forum.post :post="$post" />
            </li>
        @endforeach
    </ul>
    {{ $results->links('partials.pagination') }}
@endsection

@section('sidebar')
    <section class="panelV2">
        <h2 class="panel__heading">{{ __('forum.post-quick-search') }}</h2>
        <div class="panel__body">
            <form class="form form--horizontal" method="GET" action="{{ route('forum_search_form') }}">
                <input type="hidden" name="sorting" value="created_at">
                <input type="hidden" name="direction" value="desc">
                <p class="form__group">
                    <input
                        id="body"
                        class="form__text"
                        name="body"
                        placeholder=""
                        type="text"
                        value="{{ isset($params) && is_array($params) && array_key_exists('body', $params) ? $params['body'] : '' }}"
                    >
                    <label class="form__label form__label--floating" for="body">
                        {{ __('forum.forums-post-search') }}
                    </label>
                </p>
                <button type="submit" class="form__button form__button--filled">
                    {{ __('common.search') }}
                </button>
            </form>
        </div>
    </section>
    @include('forum.stats')
@endsection
