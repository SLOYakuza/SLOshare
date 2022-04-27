@extends('layout.default')

@section('title')
    <title>{{ __('page.title-donations') }}</title>
@endsection

@section('meta')
    <meta name="description" content="{{ __('common.donations') }}">
@endsection

@section('breadcrumb')
    <li>
        <a href="{{ route('donationslos') }}" itemprop="url" class="l-breadcrumb-item-link">
            <span itemprop="title" class="l-breadcrumb-item-link-title">{{ config('other.title') }}
                {{ __('common.donations') }}</span>
        </a>
    </li>
@endsection

@section('content')
    <div class="container box">
        <div class="col-md-12 page">
            <div class="alert alert-info" id="alert1">
                <div class="text-center">
                    <span>
                    </span>
                </div>
            </div>
            <div class="row black-list">
                <h2></h2>
                    <div class="col-xs-6 col-sm-4 col-md-3">
                        <div class="text-center black-item">
                            <h4>{{ $client }}</h4>
                            <span>
                            <form action="https://www.paypal.com/donate" method="post" target="_top">
                            <input type="hidden" name="hosted_button_id" value="9VSKWN3QQJCQU" />
                            <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Donate with PayPal button" />
                            <img alt="" border="0" src="https://www.paypal.com/en_SI/i/scr/pixel.gif" width="1" height="1" />
                            </form>
                            </span>
                            <i class="fal fa-ban text-red black-icon"></i>
                        </div>
                    </div>
            </div>
        </div>
    </div>
@endsection
