<?php namespace App\Http\Controllers;

use App\Models\VrResources;
use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Illuminate\Routing\Controller;

class VrResourcesController extends Controller
{

    /**
     * Display a listing of the resource.
     * GET /vrresources
     *
     * @return Response
     */
    public function adminIndex()
    {
        $configuration ['title'] = trans('app.resources_list');
        $configuration ['list'] = VrResources::get()->toArray();
        $configuration ['new'] = url('admin/resources/create');


        //return view('admin.adminResourcesList')->with('vr_resources', $resources);
        return view('admin.adminList', $configuration);
    }

    /**
     * Show the form for creating a new resource.
     * GET /vrresources/create
     *
     * @return Response
     */
    public function adminCreate()
    {
        $configuration = $this->getFormFieldData();
        $configuration ['title_name'] = trans('app.file_upload');
        $configuration ['title'] = trans('app.resources');
        $configuration ['back_to_list'] = route('app.resources.index');
        return view('admin.adminForm',$configuration);
    }
    /**
     * Uploads file data
     * Creates generates file path
     *
     * @param UploadedFile $file
     * @return mixed
     */
    public function adminUpload(UploadedFile $file)
    {
        $data = [
            "size" => $file->getSize(),
            "mime_type" => $file->getMimeType(),
        ];
        $path = 'upload/' . date("Y/m/d") . '/';
        $fileName = Carbon::now()->timestamp . '_' .$file->getClientOriginalName();
        $file->move(public_path($path), $fileName);
        $data['path'] = $path . $fileName;
        return VRResources::create($data);
    }
    /**
     * Store a newly created resource in storage.
     * POST /resources
     *
     * @return mixed
     */
    protected function adminStore()
    {
        $vr_resources = request()->file('image');

        $this->adminUpload($vr_resources);
        return redirect('/admin/resources/');
    }

    /**
     * Display the specified resource.
     * GET /vrresources/{id}
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
     * GET /vrresources/{id}/edit
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
     * PUT /vrresources/{id}
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
     * DELETE /vrresources/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function adminDestroy($id)
    {
        VrResources::destroy($id);

        return json_encode(["success" => true, "id" => $id]);
    }

    public function getFormFieldData()
    {
        $configuration['fields'][] = [
            "type" => "file_upload",
        ];
        return $configuration;
    }
}