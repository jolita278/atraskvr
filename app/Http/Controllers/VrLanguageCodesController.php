<?php namespace App\Http\Controllers;

use App\Models\VrLanguageCodes;
use Illuminate\Routing\Controller;

class VrLanguageCodesController extends Controller
{

    /**
     * Display a listing of the resource.
     * GET /vrlanguagecodes
     *
     * @return Response
     */
    public function adminIndex()
    {
        $configuration ['title'] = trans('app.languages_list');
        $configuration ['list'] = VrLanguageCodes::get()->toArray();
        $configuration ['call_to_action'] = 'app.languages.edit';
        return view('admin.adminList', $configuration);
    }


    /**
     * Show the form for creating a new resource.
     * GET /vrlanguagecodes/create
     *
     * @return Response
     */
    public function adminCreate()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     * POST /vrlanguagecodes
     *
     * @return Response
     */
    public function adminStore()
    {
        //
    }

    /**
     * Display the specified resource.
     * GET /vrlanguagecodes/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function adminShow($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * GET /vrlanguagecodes/{id}/edit
     *
     * @param  int $id
     * @return Response
     */
    public function adminEdit($id)
    {
//
    }

    /**
     * Update the specified resource in storage.
     * PUT /vrlanguagecodes/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function adminUpdate($id)
    {
        $record = VrLanguageCodes::find($id);
        $data = request()->all();
        $record->update($data);

        return $record;

	}

    /**
     * Remove the specified resource from storage.
     * DELETE /vrlanguagecodes/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function adminDestroy($id)
    {
        //
    }

}