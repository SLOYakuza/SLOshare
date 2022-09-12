@extends('layout.default')

@section('title')
    <title>Možni Leech Goljufi - {{ __('staff.staff-dashboard') }}</title>
@endsection

@section('meta')
    <meta name="description" content="Possible Leech Cheaters - {{ __('staff.staff-dashboard') }}">
@endsection

@section('breadcrumbs')
    <li class="breadcrumbV2">
        <a href="{{ route('staff.dashboard.index') }}" class="breadcrumb__link">
            {{ __('staff.staff-dashboard') }}
        </a>
    </li>
    <li class="breadcrumb--active">
        {{ __('staff.possible-leech-cheaters') }}
    </li>
@endsection

@section('page', 'page__cheaters--index')

@section('main')
    <section class="panelV2">
        <h2 class="panel__heading">
            {{ __('staff.possible-leech-cheaters') }} (Ghost Leechers)
        </h2>
        <div class="data-table-wrapper">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>{{ __('common.user') }}</th>
                        <th>{{ __('user.member-since') }}</th>
                        <th>{{ __('user.last-login') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cheaters as $cheater)
                        <tr>
                            <td>
                                <x-user_tag :anon="false" :user="$cheater->user" />
                            </td>
                            <td>
                                <time datetime="{{ $cheater->user->created_at ?? '' }}">
                                    {{ $cheater->user->created_at ?? 'N/A' }}
                                </time>
                            </td>
                            <td>
                                <time datetime="{{ $cheater->user->last_login ?? '' }}">
                                    {{ $cheater->user->last_login ?? 'N/A'}}
                                </time>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $cheaters->links('partials.pagination') }}
    </section>
@endsection