<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Traits\Uploadable;
use App\Models\Article as Model;

class ArticleController extends Controller
{
    use Uploadable;

    public function getAll()
    {
        $records = Model::all();
        $data = ['code' => 200, 'records' => $records];
        return response($data);
    }

    public function get($id)
    {
        $record = Model::findOrFail($id);
        $data = ['code' => 200, 'record' => $record];
        return response($data);
    }

    public function add(Request $request)
    {
        $validated = $request->validate([
            'headline' => 'required',
            'content' => 'required',
            'date' => 'required|date',
            'image' => 'required|image|max:2048',
        ]); 

        $key = 'image';
        $validated[$key] = $this->upload($validated[$key], 'uploads/articles');

        Model::create($validated);
        $data = ['code' => 200];

        return response($data);
    }
    
    // public function update(Request $request, $id)
    // {
    //     $request->validate([
    //         'name' => 'required',
    //         'description' => 'required',
    //     ]);

    //     $record = Model::find($id);
    //     $record->update($request->all());

    //     return response(['code' => 200]);
    // }

    public function delete($id)
    {
        $record = Model::findOrFail($id);
        $record->delete();
        return response(['code' => 200]);
    }
}
