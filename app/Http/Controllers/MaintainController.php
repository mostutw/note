<?php

namespace App\Http\Controllers;

use App\Maintain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MaintainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // 排序
        $order_by = isset($request->order_by) ? $request->order_by : 'id';
        $sort_by = isset($request->sort_by) ? $request->sort_by : 'desc';
        // 查詢
        $query = Maintain::query()->orderBy($order_by, $sort_by);
        // 搜尋
        if ($request->table_search) {
            $query->where('title', 'like', '%' . $request->table_search . '%');
            $query->orWhere('content', 'like', '%' . $request->table_search . '%');
        }
        // 分頁
        $query = $query->simplePaginate(15);
        // 儲存篩選
        $filters = [
            'table_search' => $request->table_search,
        ];
        // 綁定
        $binding = [
            'list' => $query,
            'filters' => $filters,
            'order_by' => $order_by,
            'sort_by' => $sort_by,
        ];
        // dd($binding);
        return view('pages.maintain_list', $binding);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.maintain_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'         => 'required|max:100',
            'start_date'    => 'nullable|date|required_with:end_date|required_if:status,processing',
            'end_date'      => 'nullable|date|after_or_equal:start_date|required_if:status,solved',
            'content'       => 'required_with:end_date',
            'status'        => 'required',
        ]);

        Maintain::create([
            'user_id' => Auth::user()->id,
            'title' => $request->title,
            'content' => $request->content,
            'status' => $request->status,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        return redirect('pages/maintains');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $query = Maintain::findOrFail($id);
        return view('pages.maintain_show')->with('show', $query);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $query = Maintain::where('id', $id)->where('user_id', Auth::user()->id)->first();
        return view('pages.maintain_edit')->with('edit', $query);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Maintain  $maintain
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Maintain $maintain)
    {
        $request->validate([
            'title'         => 'required|max:100',
            'start_date'    => 'nullable|date|required_with:end_date|required_if:status,processing',
            'end_date'      => 'nullable|date|after_or_equal:start_date|required_if:status,solved',
            'content'       => 'required_with:end_date',
            'status'        => 'required',
        ]);

        $query = $maintain->findOrFail($request->id);

        if (Auth::user()->id == $query->user_id) {
            $query->title = $request->title;
            $query->content = $request->content;
            $query->status = $request->status;
            $query->start_date = $request->start_date;
            $query->end_date = $request->end_date;
            $query->save();
        }
        return redirect('pages/maintains/' . $request->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Maintain  $maintain
     * @return \Illuminate\Http\Response
     */
    public function destroy(Maintain $maintain)
    {
        //
    }
}
