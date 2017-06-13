<?php namespace App\Http\Controllers;

use App\Models\VrCategories;
use App\Models\VrCategoriesTranslations;
use App\Models\VrLanguageCodes;
use Illuminate\Routing\Controller;
use Ramsey\Uuid\Uuid;

class VrCategoriesController extends Controller
{

    /**
     * Display a listing of the resource.
     * GET /vrcategories
     *
     * @return Response
     *
     */
    public function adminIndex()
    {
        $configuration ['title'] = trans('app.categories_list');
        $configuration ['list'] = VrCategories::get()->toArray();

        $configuration ['new'] = route('app.categories.create');
        $configuration ['edit'] = 'app.categories.edit';
        $configuration ['showDelete'] ='app.categories.destroy';
        return view('admin.adminList', $configuration);
    }

    /**
     * Show the form for creating a new resource.
     * GET /vrcategories/create
     *
     * @return Response
     */
    public function adminCreate()
    {
        $configuration = $this->getFormFieldData();
        $configuration ['title_name'] = trans('app.new_record');
        $configuration ['title'] = trans('app.categories');
        $configuration ['url'] = route('app.categories.create');
        $configuration ['back_to_list'] = route('app.categories.index');
        return view('admin.adminForm', $configuration);
    }

    /**
     * Store a newly created resource in storage.
     * POST /vrcategories
     *
     * @return Response
     */
    public function adminStore()
    {
        $data = request()->all();
        $data['record_id'] = (VrCategories::create())->id;
        VrCategoriesTranslations::create($data);

        return redirect(route('app.categories.edit', $data['record_id']));
    }

    /**
     * Display the specified resource.
     * GET /vrcategories/{id}
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
     * GET /vrcategories/{id}/edit
     *
     * @param  int $id
     * @return Response
     */
    public function adminEdit($id)
    {
        $configuration = $this->getFormFieldData();
        $configuration ['url'] = route('app.categories.edit', $id);
        $configuration ['title_name'] = trans('app.edit_record');
        $configuration ['title'] = trans('app.categories');
        $configuration['back_to_list'] = route('app.categories.index');

        $configuration ['data'] = VrCategories::find($id)->toArray();
//dd( $configuration ['data']);

        return view('admin.adminForm', $configuration);
    }

    /**
     * Update the specified resource in storage.
     * PUT /vrcategories/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function adminUpdate($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /vrcategories/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function adminDestroy($id)
    {
        VrCategoriesTranslations::destroy(VrCategoriesTranslations::where('record_id', $id)->pluck('id')->toArray());
        VrCategories::destroy($id);

        return json_encode(["success" => true, "id" => $id]);
    }

    /**
     * Get form fields data
     *
     * @return mixed
     */
    public function getFormFieldData()
    {
        $configuration['fields'][] = [
            "type" => "drop_down",
            "key" => "language_code",
            "options" => getActiveLanguage(),
            "label" => trans('app.languages')
        ];
        $configuration['fields'][] = [
            "type" => "single_line",
            "key" => "name",
            "label" => trans('app.name')
        ];
        return $configuration;
    }


}