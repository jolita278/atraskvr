<?php namespace App\Http\Controllers;

use App\Models\VrCategories;
use Illuminate\Routing\Controller;
use Ramsey\Uuid\Uuid;

class VrCategoriesController extends Controller {




	/**
	 * Display a listing of the resource.
	 * GET /vrcategories
	 *
	 * @return Response
     *
	 */
	public function index()
	{
        $configuration ['listName'] = trans('app.categories_list');
        $configuration ['list'] = VrCategories::get()->toArray();
        $configuration ['new'] = url('admin/categories/create');
        return view('admin.adminList', $configuration);
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /vrcategories/create
	 *
	 * @return Response
	 */
	public function create()
	{

	}

	/**
	 * Store a newly created resource in storage.
	 * POST /vrcategories
	 *
	 * @return Response
	 */
	public function store()
	{
	    //
	}

	/**
	 * Display the specified resource.
	 * GET /vrcategories/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        //
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /vrcategories/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
       //
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /vrcategories/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
       //
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /vrcategories/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        //
	}


}