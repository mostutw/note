<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
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
        $query = User::query()->orderBy($order_by, $sort_by);
        // 搜尋
        if ($request->table_search) {
            $query->where('name', 'like', '%' . $request->table_search . '%');
            $query->orWhere('email', 'like', '%' . $request->table_search . '%');
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
        return view('pages.user_list', $binding);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.user_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'confirm_passowrd' => ['same:password'],
        ];
        
        $request->validate($rules);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => hash::make($request->password),
        ]);

        return redirect('pages/users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $query = User::findOrFail($id);
        return view('pages.user_show')->with('show', $query);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $query = User::where('id', $id)->first();
        return view('pages.user_edit')->with('edit', $query);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'name' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'string', 'email', 'max:255', 'unique:users'],
            'new_password' => ['nullable', 'string', 'min:8'],
            'new_confirm_passowrd' => ['same:new_password'],
            'is_active' => ['nullable'],
        ];
        
        $request->validate($rules);
        $query = User::find($id);

        if ($query) {
            $query->name = $request->name == null ? $query->name : $request->name ;
            $query->email = $request->email == null ? $query->email : $request->email ;
            $query->password = $request->password == null ? $query->password : hash::make($request->new_password) ;
            $query->is_active = $request->is_active == null ? $query->is_active : $request->is_active ;
            $query->save();
        }
        return redirect('pages/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
