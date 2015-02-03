@extends('layouts.master')

@section('content')
	{{ Form::open(array('url' => 'films/store')) }}
	    
	    {{ Form::label('title', 'Title') }} 				{{ Form::text('title') }} <br />
	    {{ Form::label('genre', 'Genre') }} 				{{ Form::text('genre') }} <br />	
	    {{ Form::label('release_year', 'Year Released') }} 	{{ Form::text('release_year' )}} <br />
	    {{ Form::label('review_stars', 'Rating (out of 5)') }} 	{{ Form::text('review_stars') }} <br />
	    {{ Form::submit('Save And Return To Listings')}} <br />
	{{ Form::close() }}
@stop