<?php namespace App\Http\Controllers;

use App\Models\VrOrder;
use App\Models\VrPages;
use App\Models\VrReservations;
use Carbon\Carbon;
use DateTimeZone;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Input;

class VrOrderController extends Controller {

	/**
	 * Display a listing of the resource.
	 * GET /vrorder
	 *
	 * @return Response
	 */
	public function adminIndex()
	{
        $configuration ['title'] = trans('app.orders_list');
        $configuration ['list'] = VrOrder::get()->toArray();
        return view('admin.adminList', $configuration);
	}


	/**
	 * Show the form for creating a new resource.
	 * GET /vrorder/create
	 *
	 * @return Response
	 */
	public function adminCreate()
	{



	}

	/**
	 * Store a newly created resource in storage.
	 * POST /vrorder
	 *
	 * @return Response
	 */
	public function adminStore()
	{


    }

	/**
	 * Display the specified resource.
	 * GET /vrorder/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function adminShow($id)
	{

	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /vrorder/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function adminEdit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /vrorder/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function adminUpdate($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /vrorder/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function adminDestroy($id)
	{
		//
	}


}