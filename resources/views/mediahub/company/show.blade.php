@extends('layout.default')

@section('title')
    <title>{{ $company->name }} {{ __('mediahub.companies') }}</title>
@endsection

@section('meta')
    <meta name="description" content="{{ $company->name }} {{ __('mediahub.networks') }}">
@endsection

@section('breadcrumbs')
    <li class="breadcrumbV2">
        <a href="{{ route('mediahub.index') }}" class="breadcrumb__link">
            {{ __('mediahub.title') }}
        </a>
    </li>
    <li class="breadcrumbV2">
        <a href="{{ route('mediahub.companies.index') }}" class="breadcrumb__link">
            {{ __('mediahub.companies') }}
        </a>
    </li>
    <li class="breadcrumb--active">
        {{ $company->name }}
    </li>
@endsection

@section('content')
    <section class="panelV2">
        <h2 class="panel__heading">{{ __('mediahub.shows') }} ({{ $company->tv_count }})</h2>
        {{ $movies->links('partials.pagination') }}
        <div class="panel__body">
            @forelse($shows as $show)
                <div class="col-md-12">
                    <div class="card is-torrent">
                        <div class="card_head">
                            <span class="badge-user text-bold" style="float:right;">
                                {{ $show->number_of_seasons }} {{ __('mediahub.seasons') }}
                            </span>
                            <span class="badge-user text-bold" style="float:right;">
                                {{ $show->number_of_episodes }} {{ __('mediahub.episodes') }}
                            </span>
                        </div>
                        <div class="card_body">
                            <div class="body_poster">
                                <img src="{{ isset($show->poster) ? tmdb_image('poster_mid', $show->poster) : '/img/SLOshare/movie_no_image_holder_200x300.jpg' }}"
                                        class="show-poster">
                            </div>
                            <div class="body_description">
                                <h3 class="description_title">
                                    <a href="{{ route('mediahub.shows.show', ['id' => $show->id]) }}">{{ $show->name }}
                                        <span class="text-bold text-pink"> {{ substr($show->first_air_date, 0, 4) }}</span>
                                    </a>
                                </h3>
                                @if ($show->genres)
                                    @foreach ($show->genres as $genre)
                                        <span class="genre-label">{{ $genre->name }}</span>
                                    @endforeach
                                @endif
                                <p class="description_plot">
                                    {{ $show->overview }}
                                </p>
                            </div>
                        </div>
                        <div class="card_footer">
                            <div style="float: left;">

                            </div>
                        </div>
                    </div>
                </div>
            @empty
                No {{ __('mediahub.shows') }}
            @endforelse
        </div>
        {{ $movies->links('partials.pagination') }}
    </section>

    <section class="panelV2">
        <h2 class="panel__heading">{{ __('mediahub.cartoontvs') }} ({{ $company->cartoontv_count }})</h2>
        {{ $movies->links('partials.pagination') }}
        <div class="panel__body">
            @forelse($cartoontvs as $cartoontv)
                <div class="col-md-12">
                    <div class="card is-torrent">
                        <div class="card_head">
                            <span class="badge-user text-bold" style="float:right;">
                                {{ $cartoontv->number_of_seasons }} {{ __('mediahub.seasons') }}
                            </span>
                            <span class="badge-user text-bold" style="float:right;">
                                {{ $cartoontv->number_of_episodes }} {{ __('mediahub.episodes') }}
                            </span>
                        </div>
                        <div class="card_body">
                            <div class="body_poster">
                                <img src="{{ isset($cartoontv->poster) ? tmdb_image('poster_mid', $cartoontv->poster) : '/img/SLOshare/movie_no_image_holder_200x300.jpg' }}"
                                        class="show-poster">
                            </div>
                            <div class="body_description">
                                <h3 class="description_title">
                                    <a href="{{ route('mediahub.cartoontvs.show', ['id' => $cartoontv->id]) }}">{{ $cartoontv->name }}
                                        <span class="text-bold text-pink"> {{ substr($cartoontv->first_air_date, 0, 4) }}</span>
                                    </a>
                                </h3>
                                @if ($cartoontv->genres)
                                    @foreach ($cartoontv->genres as $genre)
                                        <span class="genre-label">{{ $genre->name }}</span>
                                    @endforeach
                                @endif
                                <p class="description_plot">
                                    {{ $cartoontv->overview }}
                                </p>
                            </div>
                        </div>
                        <div class="card_footer">
                            <div style="float: left;">

                            </div>
                        </div>
                    </div>
                </div>
            @empty
                Ni {{ __('mediahub.cartoontvs') }}
            @endforelse
        </div>
        {{ $movies->links('partials.pagination') }}
    </section>

    <section class="panelV2">
        <h2 class="panel__heading">{{ __('mediahub.movies') }} ({{ $company->movie_count }})</h2>
        {{ $shows->links('partials.pagination') }}
        <div class="panel__body">
            @forelse($movies as $movie)
                <div class="col-md-12">
                    <div class="card is-torrent">
                        <div class="card_head">
                            <span class="badge-user text-bold" style="float:right;">
                                <i class="far fa-fw fa-clock text-green"></i> {{ $movie->runtime }} mins
                            </span>
                        </div>
                        <div class="card_body">
                            <div class="body_poster">
                                <img src="{{ isset($movie->poster) ? tmdb_image('poster_mid', $movie->poster) : '/img/SLOshare/movie_no_image_holder_200x300.jpg' }}"
                                        class="show-poster">
                            </div>
                            <div class="body_description">
                                <h3 class="description_title">
                                    <a href="{{ route('mediahub.movies.show', ['id' => $movie->id]) }}">{{ $movie->title }}
                                        <span class="text-bold text-pink"> {{ substr($movie->release_date, 0, 4) }}</span>
                                    </a>
                                </h3>
                                @foreach ($movie->genres as $genre)
                                    <span class="genre-label">{{ $genre->name }}</span>
                                @endforeach
                                <p class="description_plot">
                                    {{ $movie->overview }}
                                </p>
                            </div>
                        </div>
                        <div class="card_footer">
                            <div style="float: left;">

                            </div>
                        </div>
                    </div>
                </div>
            @empty
                No {{ __('mediahub.movies') }}
            @endforelse
        </div>
        {{ $shows->links('partials.pagination') }}
    </section>

    <section class="panelV2">
        <h2 class="panel__heading">{{ __('mediahub.cartoons') }} ({{ $company->cartoon_count }})</h2>
        {{ $shows->links('partials.pagination') }}
        <div class="panel__body">
            @forelse($cartoons as $cartoon)
                <div class="col-md-12">
                    <div class="card is-torrent">
                        <div class="card_head">
                            <span class="badge-user text-bold" style="float:right;">
                                <i class="far fa-fw fa-clock text-green"></i> {{ $cartoon->runtime }} mins
                            </span>
                        </div>
                        <div class="card_body">
                            <div class="body_poster">
                                <img src="{{ isset($cartoon->poster) ? tmdb_image('poster_mid', $cartoon->poster) : '/img/SLOshare/movie_no_image_holder_200x300.jpg' }}"
                                        class="show-poster">
                            </div>
                            <div class="body_description">
                                <h3 class="description_title">
                                    <a href="{{ route('mediahub.cartoons.show', ['id' => $cartoon->id]) }}">{{ $cartoon->title }}
                                        <span class="text-bold text-pink"> {{ substr($cartoon->release_date, 0, 4) }}</span>
                                    </a>
                                </h3>
                                @foreach ($cartoon->genres as $genre)
                                    <span class="genre-label">{{ $genre->name }}</span>
                                @endforeach
                                <p class="description_plot">
                                    {{ $cartoon->overview }}
                                </p>
                            </div>
                        </div>
                        <div class="card_footer">
                            <div style="float: left;">

                            </div>
                        </div>
                    </div>
                </div>
            @empty
                No {{ __('mediahub.cartoons') }}
            @endforelse
        </div>
        {{ $shows->links('partials.pagination') }}
    </section>
@endsection
