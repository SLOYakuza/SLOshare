@extends('layout.default')

@section('title')
    <title>{{ $user->username }} {{ __('user.tips') }}</title>
@endsection

@section('breadcrumbs')
    <li class="breadcrumbV2">
        <a href="{{ route('users.show', ['username' => $user->username]) }}" class="breadcrumb__link">
            {{ $user->username }}
        </a>
    </li>
    <li class="breadcrumbV2">
        <a href="{{ route('bonus') }}" class="breadcrumb__link">
            {{ __('bon.bonus') }} {{ __('bon.points') }}
        </a>
    </li>
    <li class="breadcrumb--active">
        {{ __('bon.tips') }}
    </li>
@endsection

@section('nav-tabs')
    @include('user.buttons.user')
@endsection

@section('content')
    <div class="container">
        <div class="block">
            <div class="some-padding">
                <div class="row">
                    <div class="col-sm-8">
                        <div class="well">
                            <h3>{{ __('bon.tips') }}</h3>
                            <table class="table table-condensed table-striped">
                                <thead>
                                <tr>
                                    <th>{{ __('bon.sender') }}</th>
                                    <th>{{ __('bon.receiver') }}</th>
                                    <th>{{ __('bon.points') }}</th>
                                    <th>{{ __('bon.date') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($bontransactions as $b)
                                    <tr>
                                        <td>
                                            <a href="{{ route('users.show', ['username' => $b->senderObj->username]) }}">
                                                <span class="badge-user text-bold">{{ $b->senderObj->username }}</span>
                                            </a>
                                        </td>
                                        <td>
                                            @if($b->whereNotNull('torrent_id'))
                                                @php $torrent = App\Models\Torrent::select(['anon'])->find($b->torrent_id) @endphp
                                            @endif
                                            @if(isset($torrent) && $torrent->anon === 1 && $b->receiver !== $user->id)
                                                <span class="badge-user text-bold">{{ __('common.anonymous') }}</span>
                                            @else
                                                <a href="{{ route('users.show', ['username' => $b->receiverObj->username]) }}">
                                                    <span class="badge-user text-bold">{{ $b->receiverObj->username }}</span>
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            {{ $b->cost }}
                                        </td>
                                        <td>
                                            {{ $b->date_actioned }}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="some-padding text-center">
                                {{ $bontransactions->links() }}
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">

                        <div class="text-blue well well-sm text-center">
                            <h2><strong>{{ __('bon.your-points') }}: {{ $userbon }}<br></strong></h2>
                        </div>

                        <div class="text-orange well well-sm text-center">
                            <div>
                                <h3>{{ __('bon.you-have-received-tips') }}: <strong>{{ $tips_received }}</strong>
                                    {{ __('bon.total-tips') }}</h3>
                            </div>
                            <div>
                                <h3>{{ __('bon.you-have-sent-tips') }}: <strong>{{ $tips_sent }}</strong>
                                    {{ __('bon.total-tips') }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
