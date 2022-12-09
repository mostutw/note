<?php

namespace App\Http\Controllers;

use App\Maintain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

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
        $order_by = isset($request->order_by) ? $request->order_by : 'id' ;
        $sort_by = isset($request->sort_by) ? $request->sort_by : 'desc';
        // 查詢
        $query = Maintain::query()->orderBy($order_by, $sort_by);
        // 篩選條件
        if ($request->title) {
            $query->where('title', 'like', '%' . $request->title . '%');
        }
        if ($request->content) {
            $query->where('content', 'like', '%' . $request->content . '%');
        }
        if ($request->status) {
            $query->where('status', $request->status);
        }
        // 分頁
        $query = $query->simplePaginate(15);
        // 儲存篩選
        $filters = [
            'title' => $request->title,
            'content' => $request->content,
            'status' => $request->status,
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
        $user =  Auth::user();
        $binding = [
            'user_id' => $user->id,
            'user_name' => $user->name,
            'today' => Carbon::now()->format('Y-m-d'),
        ];
        // dd($binding);
        return view('pages.maintain_create', $binding);
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
            'title' => 'required|max:255',
        ]);
        
        Maintain::create([
            'user_id' => $request->user()->id,
            'title' => $request->title,
            'content' => $request->content,
            'status' => $request->status,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        return redirect('/pages/maintains');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Maintain  $maintain
     * @return \Illuminate\Http\Response
     */
    public function show(Maintain $maintain)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Maintain  $maintain
     * @return \Illuminate\Http\Response
     */
    public function edit(Maintain $maintain)
    {
        //
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
        //
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
