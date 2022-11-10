<?php

namespace App\Http\Controllers;

use App\Models\ModelHasPermission;
use Illuminate\Http\Request;

/**
 * Class ModelHasPermissionController
 * @package App\Http\Controllers
 */
class ModelHasPermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $modelHasPermissions = ModelHasPermission::paginate();

        return view('model-has-permission.index', compact('modelHasPermissions'))
            ->with('i', (request()->input('page', 1) - 1) * $modelHasPermissions->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $modelHasPermission = new ModelHasPermission();
        return view('model-has-permission.create', compact('modelHasPermission'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(ModelHasPermission::$rules);

        $modelHasPermission = ModelHasPermission::create($request->all());

        return redirect()->route('model-has-permissions.index')
            ->with('success', 'ModelHasPermission created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $modelHasPermission = ModelHasPermission::find($id);

        return view('model-has-permission.show', compact('modelHasPermission'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $modelHasPermission = ModelHasPermission::find($id);

        return view('model-has-permission.edit', compact('modelHasPermission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  ModelHasPermission $modelHasPermission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ModelHasPermission $modelHasPermission)
    {
        request()->validate(ModelHasPermission::$rules);

        $modelHasPermission->update($request->all());

        return redirect()->route('model-has-permissions.index')
            ->with('success', 'ModelHasPermission updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $modelHasPermission = ModelHasPermission::find($id)->delete();

        return redirect()->route('model-has-permissions.index')
            ->with('success', 'ModelHasPermission deleted successfully');
    }
}
