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
        <li><a href="#">Pages</a></li>
        <li class="active">Maintain Create</li>
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
                <form role="form" action="{{ url('pages/maintains') }}" method="post" >
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="col-md-12">
                            <div class="form-group-row">
                                <div class="col-md-2">
                                    <label for="user">User</label>
                                    <input type="text" class="form-control" name="user_name" placeholder="" value="{{ $user_name }}" readonly>
                                </div>
                                <div class="col-md-2">
                                    <label for="created_at">Date</label>
                                    <input type="date" class="form-control" name="created_at" placeholder="" value="{{ $today }}" readonly>
                                </div>
                                
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group-row">
                                <!-- checkbox -->
                                <div class="col-md-12">
                                    {{-- <label>類別</label>
                                    <div class="form-group-row">
                                        <div class="col-md-1">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="type[]" value="1" />
                                                    系統
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="type[]" value="2" />
                                                    軟體
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="type[]" value="3" />
                                                    硬體
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="type[]" value="4" />
                                                    網路
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="type[]" value="5" />
                                                    其他
                                                </label>
                                            </div>
                                        </div>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group-row">
                                <div class="col-md-9">
                                    <!-- textarea -->
                                    <div class="form-group">
                                        <label>Title</label>
                                        <textarea class="form-control" name="title" rows="2" placeholder="Add title ..."></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group-row">
                                <div class="col-md-9">
                                    <!-- textarea -->
                                    <div class="form-group">
                                        <label>Content</label>
                                        <textarea class="form-control" name="content" rows="10" placeholder="Add content ..."></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group-row">
                                
                                <div class="col-md-2">
                                    <!-- select -->
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select class="form-control" name="status">
                                            <option value="pending">pending</option>
                                            <option value="processing">processing</option>
                                            <option value="solved">solved</option>
                                            <option value="canceled">canceled</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <label for="start_date">Start Date</label>
                                    <input type="date" class="form-control" name="start_date" placeholder="" value="">
                                </div>
                                <div class="col-md-2">
                                    <label for="InputFixDate">End Date</label>
                                    <input type="date" class="form-control" name="end_date" placeholder="">
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
    <!-- left column -->
    {{-- <div class="col-md-6">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Quick Example</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">File input</label>
                            <input type="file" id="exampleInputFile">
                            <p class="help-block">Example block-level help text here.</p>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox"> Check me out
                            </label>
                        </div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div><!-- /.box -->

            <!-- Form Element sizes -->
            <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title">Different Height</h3>
                </div>
                <div class="box-body">
                    <input class="form-control input-lg" type="text" placeholder=".input-lg">
                    <br />
                    <input class="form-control" type="text" placeholder="Default input">
                    <br />
                    <input class="form-control input-sm" type="text" placeholder=".input-sm">
                </div><!-- /.box-body -->
            </div><!-- /.box -->

            <div class="box box-danger">
                <div class="box-header">
                    <h3 class="box-title">Different Width</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-3">
                            <input type="text" class="form-control" placeholder=".col-xs-3">
                        </div>
                        <div class="col-xs-4">
                            <input type="text" class="form-control" placeholder=".col-xs-4">
                        </div>
                        <div class="col-xs-5">
                            <input type="text" class="form-control" placeholder=".col-xs-5">
                        </div>
                    </div>
                </div><!-- /.box-body -->
            </div><!-- /.box -->

            <!-- Input addon -->
            <div class="box box-info">
                <div class="box-header">
                    <h3 class="box-title">Input Addon</h3>
                </div>
                <div class="box-body">
                    <div class="input-group">
                        <span class="input-group-addon">@</span>
                        <input type="text" class="form-control" placeholder="Username">
                    </div>
                    <br />
                    <div class="input-group">
                        <input type="text" class="form-control">
                        <span class="input-group-addon">.00</span>
                    </div>
                    <br />
                    <div class="input-group">
                        <span class="input-group-addon">$</span>
                        <input type="text" class="form-control">
                        <span class="input-group-addon">.00</span>
                    </div>

                    <h4>With icons</h4>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                        <input type="text" class="form-control" placeholder="Email">
                    </div>
                    <br />
                    <div class="input-group">
                        <input type="text" class="form-control">
                        <span class="input-group-addon"><i class="fa fa-check"></i></span>
                    </div>
                    <br />
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                        <input type="text" class="form-control">
                        <span class="input-group-addon"><i class="fa fa-ambulance"></i></span>
                    </div>

                    <h4>With checkbox and radio inputs</h4>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <input type="checkbox">
                                </span>
                                <input type="text" class="form-control">
                            </div><!-- /input-group -->
                        </div><!-- /.col-lg-6 -->
                        <div class="col-lg-6">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <input type="radio">
                                </span>
                                <input type="text" class="form-control">
                            </div><!-- /input-group -->
                        </div><!-- /.col-lg-6 -->
                    </div><!-- /.row -->

                    <h4>With buttons</h4>
                    <p class="margin">Large: <code>.input-group.input-group-lg</code></p>
                    <div class="input-group input-group-lg">
                        <div class="input-group-btn">
                            <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">Action
                                <span class="fa fa-caret-down"></span></button>
                            <ul class="dropdown-menu">
                                <li><a href="#">Action</a></li>
                                <li><a href="#">Another action</a></li>
                                <li><a href="#">Something else here</a></li>
                                <li class="divider"></li>
                                <li><a href="#">Separated link</a></li>
                            </ul>
                        </div><!-- /btn-group -->
                        <input type="text" class="form-control">
                    </div><!-- /input-group -->
                    <p class="margin">Normal</p>
                    <div class="input-group">
                        <div class="input-group-btn">
                            <button type="button" class="btn btn-danger">Action</button>
                        </div><!-- /btn-group -->
                        <input type="text" class="form-control">
                    </div><!-- /input-group -->
                    <p class="margin">Small <code>.input-group.input-group-sm</code></p>
                    <div class="input-group input-group-sm">
                        <input type="text" class="form-control">
                        <span class="input-group-btn">
                            <button class="btn btn-info btn-flat" type="button">Go!</button>
                        </span>
                    </div><!-- /input-group -->
                </div><!-- /.box-body -->
            </div><!-- /.box -->

        </div> --}}
    <!--/.col (left) -->
    <!-- right column -->
    {{-- <div class="col-md-6">
            <!-- general form elements disabled -->
            <div class="box box-warning">
                <div class="box-header">
                    <h3 class="box-title">General Elements</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <form role="form">
                        <!-- text input -->
                        <div class="form-group">
                            <label>Text</label>
                            <input type="text" class="form-control" placeholder="Enter ..." />
                        </div>
                        <div class="form-group">
                            <label>Text Disabled</label>
                            <input type="text" class="form-control" placeholder="Enter ..." disabled />
                        </div>

                        <!-- textarea -->
                        <div class="form-group">
                            <label>Textarea</label>
                            <textarea class="form-control" rows="3" placeholder="Enter ..."></textarea>
                        </div>
                        <div class="form-group">
                            <label>Textarea Disabled</label>
                            <textarea class="form-control" rows="3" placeholder="Enter ..." disabled></textarea>
                        </div>

                        <!-- input states -->
                        <div class="form-group has-success">
                            <label class="control-label" for="inputSuccess"><i class="fa fa-check"></i> Input with
                                success</label>
                            <input type="text" class="form-control" id="inputSuccess" placeholder="Enter ..." />
                        </div>
                        <div class="form-group has-warning">
                            <label class="control-label" for="inputWarning"><i class="fa fa-warning"></i> Input with
                                warning</label>
                            <input type="text" class="form-control" id="inputWarning" placeholder="Enter ..." />
                        </div>
                        <div class="form-group has-error">
                            <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> Input with
                                error</label>
                            <input type="text" class="form-control" id="inputError" placeholder="Enter ..." />
                        </div>

                        <!-- checkbox -->
                        <div class="form-group">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" />
                                    Checkbox 1
                                </label>
                            </div>

                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" />
                                    Checkbox 2
                                </label>
                            </div>

                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" disabled />
                                    Checkbox disabled
                                </label>
                            </div>
                        </div>

                        <!-- radio -->
                        <div class="form-group">
                            <div class="radio">
                                <label>
                                    <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1"
                                        checked>
                                    Option one is this and that&mdash;be sure to include why it's great
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                                    Option two can be something else and selecting it will deselect option one
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="optionsRadios" id="optionsRadios3" value="option3"
                                        disabled />
                                    Option three is disabled
                                </label>
                            </div>
                        </div>

                        <!-- select -->
                        <div class="form-group">
                            <label>Select</label>
                            <select class="form-control">
                                <option>option 1</option>
                                <option>option 2</option>
                                <option>option 3</option>
                                <option>option 4</option>
                                <option>option 5</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Select Disabled</label>
                            <select class="form-control" disabled>
                                <option>option 1</option>
                                <option>option 2</option>
                                <option>option 3</option>
                                <option>option 4</option>
                                <option>option 5</option>
                            </select>
                        </div>

                        <!-- Select multiple-->
                        <div class="form-group">
                            <label>Select Multiple</label>
                            <select multiple class="form-control">
                                <option>option 1</option>
                                <option>option 2</option>
                                <option>option 3</option>
                                <option>option 4</option>
                                <option>option 5</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Select Multiple Disabled</label>
                            <select multiple class="form-control" disabled>
                                <option>option 1</option>
                                <option>option 2</option>
                                <option>option 3</option>
                                <option>option 4</option>
                                <option>option 5</option>
                            </select>
                        </div>

                    </form>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div> --}}
    <!--/.col (right) -->
    </div>
    <!-- /.content -->
@endsection
