<?php

namespace App\Http\Controllers;

use App\Models\TodoList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TodoListController extends Controller
{
    public function index()
    {
        $user = DB::table('todo_lists')->get();
        return response()->json($user);
    }

    public function create(Request $request)
    {

        $this->validate($request, [
            'description' => 'required',
        ]);

        $description = $request->input('description');
        $id = DB::table('todo_lists')->insertGetId(
            [
                'description' => $request->input('description'),
                'created_at' => now()
            ]
        );
        $data = ['id' => $id, 'description' => $description];

        return response()->json($data,201);
    }

    public function  delete(Request $request)
    {
        $id = $request->input('id');
        DB::table('todo_lists')->where('id', $id)->delete();
        return response()->json('element delete',202);
    }
}
