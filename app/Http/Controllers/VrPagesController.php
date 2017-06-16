<?php namespace App\Http\Controllers;

use App\Models\VrCategories;
use App\Models\VrCategoriesTranslations;
use App\Models\VrPages;
use App\Models\VrPagesTranslations;
use App\Models\VrResources;
use Illuminate\Routing\Controller;

class VrPagesController extends Controller {

	/**
	 * Display a listing of the resource.
	 * GET /vrpages
	 *
	 * @return Response
	 */

	public function adminIndex()
	{
        $configuration ['title'] = trans('app.pages_list');
        $configuration ['list'] = VrPages::/*with(['cover'])->*/get()->toArray();
        $configuration ['new'] = route('app.pages.create');
        $configuration ['edit'] = 'app.pages.edit';
        $configuration ['showDelete'] = 'app.pages.destroy';
        $config['cover'] = VrResources::all()->pluck('path', 'id')->toArray();
        dd($configuration);
        return view('admin.adminList', $configuration);
	}


	/**
	 * Show the form for creating a new resource.
	 * GET /vrpages/create
	 *
	 * @return Response
	 */
	public function adminCreate()
	{
        $configuration = $this->getFormFieldData();
        $configuration ['title_name'] = trans('app.new_record');
        $configuration ['title'] = trans('app.pages');
        $configuration ['url'] = route('app.pages.create');
        $configuration ['back_to_list'] = route('app.pages.index');
        return view('admin.adminForm', $configuration);
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /vrpages
	 *
	 * @return Response
	 */
	public function adminStore()
	{
        $data = request()->all();
        dd($data);
        $data['record_id'] = (VrPages::create($data))->id;
        VrPagesTranslations::create($data);

        return redirect(route('app.pages.edit', $data['record_id']));

    }

	/**
	 * Display the specified resource.
	 * GET /vrpages/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function adminShow($id)
	{

	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /vrpages/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function adminEdit($id)
	{
        $configuration = $this->getFormFieldData();
        $configuration ['url'] = route('app.pages.edit', $id);
        $configuration ['title_name'] = trans('app.edit_record');
        $configuration ['title'] = trans('app.pages');
        $configuration ['back_to_list'] = route('app.pages.index');
        $configuration ['data'] = VrPages::find($id)->toArray();
        $configuration ['data']['title'] = $configuration ['data']['translation']['title'];
        $configuration ['data']['slug'] = $configuration ['data']['translation']['slug'];
        $configuration ['data']['description_short'] = $configuration ['data']['translation']['description_short'];
        $configuration ['data']['description_long'] = $configuration ['data']['translation']['description_long'];
        $configuration ['data']['language_code'] = $configuration ['data']['translation']['language_code'];

        return view('admin.adminForm', $configuration);
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /vrpages/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function adminUpdate($id)
	{
        $data = request()->all();
        $record = VrPages::find($id);
        $record->update($data);

        $translation = VrPagesTranslations::where('record_id', $id)->get()
            ->where('language_code', $data['language_code'])
            ->first();
        if ($translation) {
            $translation->update($data);
        } else {
            $data['record_id'] = $record->id;
            VrPagesTranslations::create($data);
        }
        return redirect(route('app.pages.edit',  $record->id));
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /vrpages/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function adminDestroy($id)
	{
        VrPagesTranslations::destroy(VrPagesTranslations::where('record_id', $id)->pluck('id')->toArray());
        Vrpages::destroy($id);

        return json_encode(["success" => true, "id" => $id]);
	}

    public function getFormFieldData()
    {
        $language = request('language_code');
        if ($language == null)
            $language = app()->getLocale();

        $configuration['fields'][] = [
            "type" => "drop_down",
            "key" => "language_code",
            "options" => getActiveLanguage(),
            "label" => trans('app.languages')
        ];
        $configuration['fields'][] = [
            "type" => "drop_down",
            "key" => "category_id",
            "options" => VrCategoriesTranslations::where('language_code', $language)->pluck('name', 'record_id')->toArray(),
            "label" => trans('app.categories')
        ];
        $configuration['fields'][] = [
            "type" => "single_line",
            "key" => "title",
            "label" => trans('app.title')
        ];
        $configuration['fields'][] = [
            "type" => "single_line",
            "key" => "slug",
            "label" => trans('app.slug')
        ];
        $configuration['fields'][] = [
            "type" => "text_area",
            "key" => "description_short",
            "label" => trans('app.description_short')
        ];
        $configuration['fields'][] = [
            "type" => "text_area",
            "key" => "description_long",
            "label" => trans('app.description_long')
        ];
        $configuration['fields'][] = [
            "type" => "drop_down",
            "key" => "cover_id",
            "options" => VrResources::pluck('path', 'id')->toArray(),
            "label" => trans('app.cover')
        ];

        return $configuration;
    }

}