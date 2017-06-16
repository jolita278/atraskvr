<?php

namespace App\Http\Controllers;

use App\Models\VrMenuTranslations;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\VrMenu;
use Illuminate\Support\Facades\DB;
use Session;


class VrMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     * GET /vrmenu
     *
     * @return Response
     */
    public function adminIndex()
    {
        $configuration ['title'] = trans('app.menu_list');
        $configuration ['list'] = VrMenu::get()->toArray();
        $configuration ['new'] = route('app.menu.create');
        $configuration ['edit'] = 'app.menu.edit';
        $configuration ['showDelete'] = 'app.menu.destroy';


        return view('admin.adminList', $configuration);
    }

    /**
     * Show the form for creating a new resource.
     * GET /vrmenu/create
     *
     * @return Response
     */
    public function adminCreate()
    {
        $configuration = $this->getFormFieldData();
        $configuration ['title_name'] = trans('app.new_record');
        $configuration ['title'] = trans('app.menus');
        $configuration ['url'] = route('app.menu.create');
        $configuration ['back_to_list'] = route('app.menu.index');
        return view('admin.adminForm', $configuration);

    }

    /**
     * Store a newly created resource in storage.
     * POST /vrmenu
     *
     * @return Response
     */


    public function adminStore()
    {
//        dd(request()->all());

        $data = request()->all();
        $data['record_id'] = (VrMenu::create($data))->id;
        VrmenuTranslations::create($data);

        return redirect(route('app.menu.edit', $data['record_id']));
    }

    /**
     * Display the specified resource.
     * GET /vrmenu/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function adminShow($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     * GET /vrmenu/{id}/edit
     *
     * @param  int $id
     * @return Response
     */
    public function adminEdit($id)
    {
        $configuration = $this->getFormFieldData();
        $configuration ['url'] = route('app.menu.edit', $id);
        $configuration ['title_name'] = trans('app.edit_record');
        $configuration ['title'] = trans('app.menus');
        $configuration ['back_to_list'] = route('app.menu.index');

        $configuration ['data'] = VrMenu::find($id)->toArray();
        $configuration ['data']['name'] = $configuration ['data']['translation']['name'];
        $configuration ['data']['url'] = $configuration ['data']['translation']['url'];
        $configuration ['data']['language_code'] = $configuration ['data']['translation']['language_code'];

        return view('admin.adminForm', $configuration);
    }

    /**
     * Update the specified resource in storage.
     * PUT /vrmenu/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function adminUpdate($id)
    {
        $data = request()->all();
        $record = VrMenu::find($id);
        $record->update($data);

        $translation = VrmenuTranslations::where('record_id', $id)->get()
            ->where('language_code', $data['language_code'])
            ->first();
        if ($translation) {
            $translation->update($data);
        } else {
            $data['record_id'] = $record->id;
            VrmenuTranslations::create($data);
        }
        return redirect(route('app.menu.edit',  $record->id));

    }

    /**
     * Remove the specified resource from storage.
     * DELETE /vrmenu/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function adminDestroy($id)
    {
        VrmenuTranslations::destroy(VrmenuTranslations::where('record_id', $id)->pluck('id')->toArray());
        VrMenu::destroy($id);

        return json_encode(["success" => true, "id" => $id]);

    }

    /**
     * Get form fields data
     *
     * @return mixed
     */
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
            "type" => "single_line",
            "key" => "name",
            "label" => trans('app.name')
        ];
        $configuration['fields'][] = [
            "type" => "drop_down",
            "key" => "vr_parent_id",
            "options" => VrMenuTranslations::where('language_code', $language)->pluck('name', 'record_id')->toArray(),
            "label" => trans('app.parent')
        ];
        $configuration['fields'][] = [
            "type" => "single_line",
            "key" => "url",
            "label" => trans('app.url')
        ];
        $configuration['fields'][] = [
            "type" => "single_line",
            "key" => "sequence",
            "label" => trans('app.sequence')
        ];
        $configuration['fields'][] = [
            "type" => "check_box",
            "key" => "new_window",
            "options" => [
                [
                    "name" => "new_window",
                    "value" => "1",
                    "title" => trans('app.yes'),
                ],
            ],
            "label" => trans('app.new_window')
        ];

        return $configuration;
    }

}