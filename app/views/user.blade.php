@extends('layouts.master')

@section('body.main')

    <div class="col-md-2">
        <ul class="nav nav-pills nav-stacked">
            <li role="presentation" class="active"><a href="#">Profile</a></li>
            <li role="presentation" class=""><a href="#">API</a></li>
        </ul>
    </div>

    <div class="col-md-10">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Here all your avatars</h3>
            </div>
            <div class="panel-body">
                <div class="container-fluid">

                    {{-- upload field --}}
                    <p>Select image below or <a href="#" id="uploadImage"><b>upload</b></a></p>

                    <div class="row">

                        {{Form::open(Array('route'=>'avatar.store',
                                            'method'=>'post',
                                            'files'=>true,
                                            'enctype'=>'multipart/form-data'))}}

                        <div class="upload-field hidden">
                            <b id="fileName"></b>
                            {{Form::submit('Upload', array('class'=>'btn btn-sm btn-primary', 'id'=>'btnSubmit'))}}
                            <button id="btnCancel" class="btn btn-sm btn-danger" type="reset">Cancel</button>
                        </div>
                        @if($errors->any())
                            <ul>
                                @foreach($errors->all() as $message)
                                    <li style="color:#ac2925;">{{$message}}</li>
                                @endforeach
                            </ul>
                        @endif
                        {{Form::file('inputFile', array('id'=>'inputFile', 'class'=>'hidden'))}}
                        {{Form::close()}}
                    </div>

                    <br/>

                    {{-- show all avatars --}}
                    <div class="row">
                        @foreach(Auth::user()->avatars as $avatar)
                            <div class="col-sm-6 col-md-3">
                                <div class="thumbnail">
                                    <a href="/avatar/{{$avatar->id}}">
                                        {{
                                        HTML::image(
                                                url('userimage/'.Auth::user()->id.'/'.$avatar->filename),
                                                '', # alt attribute
                                                array('class' => 'thumb', 'id' => substr($avatar->filename, 0, 5))
                                        )
                                        }}
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>

        </div>
    </div>
    </div>

@endsection

@stop