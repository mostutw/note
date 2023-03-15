@extends('adminlte::page')

@section('css')
@endsection

@section('content_header')
    <!-- Content Header (Page header) -->
    <h1>
        {{-- Maintain Create --}}
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        {{-- <li><a href="#">Pages</a></li> --}}
        <li class="active">Maintain Edit</li>
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
                <form role="form" action="{{ url('pages/maintains/' . $edit->id) }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="box-body">
                        <div class="col-md-12">
                            <div class="form-group-row">
                                <!-- checkbox -->
                                <div class="col-md-12">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group-row">
                                <div class="col-md-8">
                                    <!-- textarea -->
                                    <div class="form-group">
                                        <label>{{ trans('maintain.title ') }}</label>
                                        <input type="text" class="form-control" name="title" placeholder=""
                                            value="{{ old('title', $edit->title) }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group-row">
                                <div class="col-md-8">
                                    <!-- textarea -->
                                    <div class="form-group">
                                        <label>{{ trans('maintain.content ') }}</label>
                                        <textarea class="form-control" id="mytextarea" name="content" rows="10" placeholder="">{{ old('content', $edit->content) }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group-row">

                                <div class="col-md-2">
                                    <!-- select -->
                                    <div class="form-group">
                                        <label>{{ trans('maintain.content') }}</label>
                                        <select class="form-control" name="status">
                                            <option value="pending" @if (old('status', $edit->status) == 'pending') selected @endif>
                                                pending</option>
                                            <option value="processing" @if (old('status', $edit->status) == 'processing') selected @endif>
                                                processing</option>
                                            <option value="solved" @if (old('status', $edit->status) == 'solved') selected @endif>
                                                solved
                                            </option>
                                            <option value="canceled" @if (old('status', $edit->status) == 'canceled') selected @endif>
                                                canceled</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <label for="start_date">{{ trans('maintain.start_date') }}</label>
                                    <input type="date" class="form-control" name="start_date" placeholder=""
                                        value="@if (!is_null($edit->start_date)) {{ $edit->start_date->format('Y-m-d') }} @endif">
                                </div>
                                <div class="col-md-2">
                                    <label for="end_date">{{ trans('maintain.end_date') }}</label>
                                    <input type="date" class="form-control" name="end_date" placeholder=""
                                        value="@if (!is_null($edit->end_date)) {{ $edit->end_date->format('Y-m-d') }} @endif">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group-row">
                                <div class="col-md-3">
                                    {{-- <label for="upload_file">檔案上傳</label>
                                    <input type="file" id="upload_file" multiple> --}}
                                </div>
                                {{-- <p class="help-block"> block-level help text here.</p> --}}
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group-row">
                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </form>
            </div><!-- /.box -->
        </div>
    </div>
    <!-- /.content -->
@endsection

@section('js')
    <!-- tinymce -->
    <script src='https://cdn.tiny.cloud/1/hn3o0tmszhnrb0adtmub1316kgfdva1wwx1dcwivusv5n56a/tinymce/4/tinymce.min.js'>
    </script>
    <script>
        tinymce.init({
            selector: '#mytextarea'
        });
    </script>
@endsection
