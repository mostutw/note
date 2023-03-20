@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('css')

@endsection

@section('content_header')
    <h1>{{ trans('home.dashboard') }}</h1>
@stop

@section('content')
    {{ trans('home.login') }}<br>
    {{ trans('home.name') }} : {{ $user->name }}<br>
    {{ trans('home.role') }} : {{ $user->role }}<br>
    {{ trans('home.permission') }} :

    @can('isAdmin')
        <span class="badge badge-secondary">{{ trans('home.all') }}</span>
    @else
        @forelse($permission_list as $value)
            <span class="badge badge-secondary">{{ $value }}</span>
        @empty
            <span class="badge badge-secondary">{{ trans('home.na') }}</span>
        @endforelse
    @endcan

@stop
