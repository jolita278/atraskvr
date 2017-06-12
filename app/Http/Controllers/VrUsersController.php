<?php namespace App\Http\Controllers;

use App\Models\VrOrder;
use App\Models\VrUsers;
use Illuminate\Routing\Controller;
use Ramsey\Uuid\Uuid;

class VrUsersController extends Controller
{

    /**
     * Display a listing of the resource.
     * GET /vrusers
     *
     * @return Response
     */
    public function adminIndex()
    {
        $configuration ['title'] = trans('app.users_list');
        $configuration ['list'] = VrUsers::get()->toArray();
        return view('admin.adminList', $configuration);
    }

    /**
     * Show the form for creating a new resource.
     * GET /vrusers/create
     *
     * @return Response
     */
    public function adminCreate()
    {
    }

    /**
     * Store a newly created resource in storage.
     * POST /vrusers
     *
     * @return Response
     */
    public function adminStore()
    {

    }

    /**
     * Display the specified resource.
     * GET /vrusers/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function adminShow($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     * GET /vrusers/{id}/edit
     *
     * @param  int $id
     * @return Response
     */
    public function adminEdit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     * PUT /vrusers/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function adminUpdate($id)
    {

    }

    /**
     * Remove the specified resource from storage.
     * DELETE /vrusers/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function adminDestroy($id)
    {
        //
    }


}