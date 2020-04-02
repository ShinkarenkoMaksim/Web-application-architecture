<?php

namespace App\Http\Controllers\Admin;

use App\Resource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $resources = Resource::query()->get();

        return view('admin.resources', ['resources' => $resources]);
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        $resource = new Resource();
        return view('admin.addResource', ['resource' => $resource]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Resource $resource
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request, Resource $resource)
    {
        if ($request->isMethod('post')) {
            $this->validate($request, Resource::rules(), [], Resource::attributeNames());
            $resource->fill($request->all());

            $result = $resource->save();

            if ($result) {
                return redirect()->route('admin.resources.index')->with('success', 'Ресурс добавлен');
            } else {
                $request->flash();
                return redirect()->route('admin.resources.create')->with('error', 'Ошибка добавления ресурса!');
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Resource  $resource
     */
    public function edit(Resource $resource)
    {
        return view('admin.addResource', [
            'resource' => $resource,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Resource  $resource
     */
    public function update(Request $request, Resource $resource)
    {
        if ($request->isMethod('PUT')) {
            $this->validate($request, Resource::rules(), [], Resource::attributeNames());
            $resource->fill($request->all());

            $result = $resource->save();

            if ($result) {
                return redirect()->route('admin.resources.index')->with('success', 'Ресурс исправлен');
            } else {
                $request->flash();
                return redirect()->route('admin.resources.create')->with('error', 'Ошибка изменения ресурса!');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Resource  $resource
     */
    public function destroy(Resource $resource)
    {
        $resource->delete();
        if ($resource) {
            return redirect()->route('admin.resources.index')->with('success', 'Ресурс удален');
        } else {
            return redirect()->route('admin.resources.index')->with('error', 'Ошибка удаления');
        }
    }
}
