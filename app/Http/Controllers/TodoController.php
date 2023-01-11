<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoRequest;
use App\Models\Todo;
use App\Models\TodoTag;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;

class TodoController extends Controller
{
    public function index()
    {
        $query = Todo::query()->where('user_id', auth()->id());

        $tags = app(Pipeline::class)
            ->send($query)
            ->through([
                \App\QueryFilters\TodoFilter::class,
                \App\QueryFilters\TodoLimitFilter::class,
                \App\QueryFilters\TodoTagsFilter::class,
            ])
            ->thenReturn()
            ->get();

        return view('dashboard', [
            'todo' => $tags,
        ]);
    }

    public function create()
    {
    }

    public function store(TodoRequest $request)
    {
        $todo = Todo::query()->create([
            'todo' => $request->todo,
            'user_id' => auth()->id() ?? 1,
        ]);
        foreach ($request->tags as $item) {
            TodoTag::query()->create([
                'todo_id' => $todo->id,
                'tag' => $item,
            ]);
        }

        return response()->json(Todo::query()->with('tags')->find($todo->id));
    }

    public function show($id)
    {
    }

    public function edit($id)
    {
    }

    public function update(Request $request, $id)
    {
    }

    public function destroy($id)
    {
        Todo::query()->where('user_id', auth()->id())->find($id)->delete();

        return redirect('/dashboard');
    }
}
