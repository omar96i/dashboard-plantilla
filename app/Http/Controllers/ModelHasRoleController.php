<?php

namespace App\Http\Controllers;

use App\Models\ModelHasRole;
use Illuminate\Http\Request;

/**
 * Class ModelHasRoleController
 * @package App\Http\Controllers
 */
class ModelHasRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $modelHasRoles = ModelHasRole::paginate();

        return view('model-has-role.index', compact('modelHasRoles'))
            ->with('i', (request()->input('page', 1) - 1) * $modelHasRoles->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $modelHasRole = new ModelHasRole();
        return view('model-has-role.create', compact('modelHasRole'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(ModelHasRole::$rules);

        $modelHasRole = ModelHasRole::create($request->all());

        return redirect()->route('model-has-roles.index')
            ->with('success', 'ModelHasRole created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $modelHasRole = ModelHasRole::find($id);

        return view('model-has-role.show', compact('modelHasRole'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $modelHasRole = ModelHasRole::find($id);

        return view('model-has-role.edit', compact('modelHasRole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  ModelHasRole $modelHasRole
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ModelHasRole $modelHasRole)
    {
        request()->validate(ModelHasRole::$rules);

        $modelHasRole->update($request->all());

        return redirect()->route('model-has-roles.index')
            ->with('success', 'ModelHasRole updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $modelHasRole = ModelHasRole::find($id)->delete();

        return redirect()->route('model-has-roles.index')
            ->with('success', 'ModelHasRole deleted successfully');
    }
}
