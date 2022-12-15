@extends('adminlte::page')

@section('css')
    <style>
        .show-title {
            padding: 0 18px 10px;
        }

        .show-sub-title {
            padding: 0 20px 18px;
        }

        .show-content {
            padding: 0 20px 18px;
        }

        @media (min-width: 768px) {
            .box-body {
                width: 65%;
            }
        }
    </style>
@endsection

@section('content_header')
    <!-- Content Header (Page header) -->
    <h1>
        {{-- Maintain Create --}}
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        {{-- <li><a href="#">Pages</a></li> --}}
        <li class="active">Maintain Show</li>
    </ol>
@endsection

@section('content')
    <!-- Main content -->
    <div class="row">
        {{-- 自訂 --}}
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title"></h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">
                    <p class="h4 show-title">{{ $show->title }}</p>
                    <p class="h5 show-sub-title">
                        <i class="fa fa-clock">&ensp;{{ $show->created_at->format('m/d/Y') }}&emsp;</i>
                        <i class="fa fa-user">&ensp;{{ $show->user->name }}&emsp;</i>
                        @if ($show->user_id == Auth::user()->id)
                            <i class="fa fa-pen">&ensp;<a
                                    href="{{ url('pages/maintains/' . $show->id) . '/edit' }}">Edit</a></i>
                        @endif
                    </p>
                    <div class="show-content">
                        {!! $show->content !!}
                    </div>
                    <p class="h5 show-sub-title">
                        <i class="fa fa-wrench">&ensp;{{ $show->status }}&emsp;</i>
                    </p>
                    <p class="h5 show-sub-title">
                        <i class="fa fa-calendar">
                            &ensp;
                            @if (!is_null($show->start_date))
                                {{ $show->start_date->format('m/d/Y') }} ~
                            @endif
                            @if (!is_null($show->end_date))
                                {{ $show->end_date->format('m/d/Y') }}
                            @endif
                        </i>
                    </p>
                </div><!-- /.box-body -->
                <div class="box-footer">
                </div>
            </div><!-- /.box -->
        </div>
    </div>

    <!-- /.content -->
@endsection

@section('js')
@endsection
