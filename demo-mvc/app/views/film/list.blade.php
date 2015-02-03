@extends('layouts.master')

@section('content')
	<ul>
		@forelse ($films as $film)
	    	<li><a href="{{URL::to('films/show/'. $film->id)}}">{{$film->title}}</a>[<a href="{{URL::to('films/destroy/'. $film->id)}}">Delete</a>]</li>
	    @empty
	    	<p>There are currently no films in the system</p>
	    @endforelse
	</ul>
@stop