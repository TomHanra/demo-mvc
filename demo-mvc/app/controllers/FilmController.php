<?php

/**
 * Demo of Model View Controller behaviour. Film is the model, we have several views in the film directory
 * and this is the controller.
 */
class FilmController extends \BaseController {

	private $filmRules = array(
			'title' => 'required',
			'release_year' => 'numeric|min:1910|digits:4',
			'review_stars' => 'required|numeric|between:0,5'
	);

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		// Show the list of films in the system
		return View::make("film/list", array('films' => Film::all()));
	}


	/**
	 * Show the form for adding a new film.
	 *
	 * @return Response
	 */
	public function getCreate()
	{
		// It's the edit view with no pre-filled data.
		return View::make("film/create");
	}


	/**
	 * Store a newly created film in storage.
	 *
	 * @return Response
	 */
	public function postStore()
	{
		// Get and validate data from POST request - do not accept get variables
		$validator = Validator::make(Input::all(), $this->filmRules);
		if ($validator->fails()) {
			// reject submission, redirect back to creation page
			return Redirect::to('films/create')->withErrors($validator);
		}

		$film = new Film;
		// populate film with validated data
		$film->title = Input::get("title");
		$film->genre = Input::get("genre");
		$film->release_year = Input::get("release_year");
		$film->review_stars = Input::get("review_stars");
		$film->save();
		// Redirect to the list page - Ideally this message should be localizable.
		return Redirect::to('films/index')->with("message", "Successfully added ".$film->name);
	}


	/**
	 * Display the specified film.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getShow($id)
	{
		// For now show and edit are the same thing
		return $this->getEdit($id);
	}


	/**
	 * Show the form for editing the specified film.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getEdit($id)
	{
		$film = Film::find($id);
		// If no film, rediect
		if (!$film) {
			// N.b. It's like an error but not as complicated.
			return Redirect::to('films/index')->withErrors(array("Film not found"));
		}
		return View::make("film/edit", array("film" => $film));
	}


	/**
	 * Update the specified film in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function postUpdate($id)
	{
		$film = Film::find($id);
		// If no film, reject.
		if (!$film) {
			return Redirect::to('films/index')->with("error", "Film not found");
		}
		$validator = Validator::make(Input::all(), $this->filmRules);
		if ($validator->fails()) {
			// reject submission, redirect back to creation page
			return Redirect::to('films/edit')->withErrors($validator);		
		}
		$film->title = Input::get("title");
		$film->genre = Input::get("genre");
		$film->release_year = Input::get("release_year");
		$film->review_stars = Input::get("review_stars");
		$film->save();
		// Redirect to the list page
		return Redirect::to('films/index');
	}


	/**
	 * Remove the specified film from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getDestroy($id)
	{
		// Assuming checks to see whether user can destroy entries has already been done at routing stage
		Film::destroy($id);
		// N.B. If there are ever "protected" films do not use destroy here. Consider soft-deletion most of the time.
		// Redirect to the list page
		return Redirect::to('films/index');
	}
}
