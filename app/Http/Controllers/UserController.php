<?php

namespace App\Http\Controllers;

use App\Branch;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.users.index')->with('users',User::get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name','name')->all();

        return view('admin.users.create')->with('branches',Branch::get())->with('roles',$roles);
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
           'name'=>'required',
           'email'=>'required|email|unique:users,email',
           'branch_id'=>'required',
           'password'=>'required',
   ];

   $customMessages = [
        'name.required' => 'اسم المستخدم مطلوب',
        'email.email' => 'البريد الإلكتروني يجب أن يكون بيرد الكتروني صالح',
        'email.unique' => 'البريد الإلكتروني موجود مسبقا',
        'email.required' => 'البريد الإلكتروني مطلوب',
        'branch_id.required' => 'الفرع مطلوب  مطلوب',
        'password.required' => 'كلمة المرور مطلوبة  مطلوب',
   ];

   $this->validate($request, $rules, $customMessages);
   $request_all = $request->all();
   $request_all['image']= 'user/profile.png';
   $request_all['password']= bcrypt($request->password);  
  $user= User::create($request_all);
  $user->assignRole('مستخدم');

   return redirect()->route('users.index')->with(['success'=>'تم اضافة المستخدم بنجاح']);
   
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::pluck('name','name')->all();

        return view('admin.users.edit')->with('branches',Branch::get())->with('user',$user)->with('roles',$roles);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
    //   dd(auth()->user()->hasRole('مستخدم'));
        $rules = [
            'name'=>'required',
            'email'=>'required|email|unique:users,email,'.$user->id,
            'branch_id'=>'required',
    ];
 
    $customMessages = [
         'name.required' => 'اسم المستخدم مطلوب',
         'email.email' => 'البريد الإلكتروني يجب أن يكون بيرد الكتروني صالح',
         'email.unique' => 'البريد الإلكتروني موجود مسبقا',
         'email.required' => 'البريد الإلكتروني مطلوب',
         'branch_id.required' => 'الفرع مطلوب  مطلوب',
    ];
 
    $this->validate($request, $rules, $customMessages);
    $request_all = $request->except(['password','image']);
    if($request->password != null){
        $request_all['password'] = bcrypt($request->password);  
    }
   $user->update($request_all);
   DB::table('model_has_roles')->where('model_id',$user->id)->delete();
   $user->assignRole('مستخدم');

    return redirect()->route('users.index')->with(['success'=>'تم اضافة المستخدم بنجاح']);
    }

  
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with(['success'=>'تم حذف المستخدم بنجاح']);

    }
}
