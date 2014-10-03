@extends('maintenance::layouts.main')

@section('header')
	<h1>{{ $title }}</h1>
@stop

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        <div class="panel-title">
           {{ $image->file_name }} 
           
           
           <div class="dropdown pull-right">
                <a href="#" class="text-muted dropdown-toggle" data-toggle="dropdown"><i class="fa fa-gear"></i></a>
                <ul class="dropdown-menu">
                    <li role="presentation">
                        <a data-method="delete" data-message="Are you sure you want to delete this image?" href="{{ route('maintenance.assets.images.destroy', array($asset->id, $image->id)) }}" role="menuitem">
                            <i class="fa fa-trash-o"></i> Delete
                        </a>
                    </li>
                </ul>
           </div>

        </div>
    </div>
    
    <div class="panel-body">
        <div class="col-md-12">
            <img class="img-responsive" src="{{ Storage::url($image->file_path.$image->file_name) }}">
        </div>
    </div>
    
</div>
@stop