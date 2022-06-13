@extends('layout.default')

@section('title')
    <title>{{ __('common.contact') }}</title>
@endsection

@section('meta')
    <meta name="description" content="{{ __('common.contact') }} {{ config('other.title') }}.">
@endsection

@section('breadcrumbs')
    <li class="breadcrumbV2">
        <a href="{{ route('about') }}" class="breadcrumb__link">
            {{ __('common.about') }}
        </a>
    </li>
    <li class="breadcrumb--active">
        {{ __('common.contact') }}
    </li>
@endsection

@section('content')
    <div class="container box">
        <div class="row">
            <div class="col-md-4 box centered-form">
                <form role="form" method="POST" action="{{ route('contact.store') }}">
                    @csrf
                    <div class="form-group">
                        <label>
                            <input type="text" name="contact-name" placeholder="{{ __('common.name') }}"
                                   value="{{ auth()->user()->username }}" class="form-control" required>
                        </label>
                    </div>

                    <div class="form-group">
                        <label>
                            <input type="email" name="email" placeholder="{{ __('common.email') }}"
                                   value="{{ auth()->user()->email }}" class="form-control" required>
                        </label>
                    </div>

                    <div class="form-group">
                        <label>
                            <textarea name="message" placeholder="{{ __('common.message') }}" class="form-control"
                                      cols="30" rows="10"></textarea>
                        </label>
                    </div>

                    <button type="submit" class="btn btn-lg btn-primary btn-block">{{ __('common.submit') }}</button>
                </form>
            </div>

            <div class="col-sm-8">
                <div class="well well-sm mt-0">
                    <p class="lead text-green text-center"><i class="{{ config('other.font-awesome') }} fa-star"></i>
                        <strong>{{ __('common.contact-header') }}</strong> <i
                                class="{{ config('other.font-awesome') }} fa-star"></i></p>
                    <p class="lead text-orange text-center">{{ __('common.contact-desc') }}.</p>
                </div>
            </div>
        </div>
    </div>
@endsection
