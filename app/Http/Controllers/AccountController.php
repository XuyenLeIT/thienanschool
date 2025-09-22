<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\RegisterMail;
use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;

class AccountController extends Controller
{
    private function handleAvatarUpload($file, $oldPath = null)
    {
        $filename = time().'_'.$file->getClientOriginalName();
        if (!file_exists(public_path('avatars'))) mkdir(public_path('avatars'), 0755, true);
        $file->move(public_path('avatars'), $filename);
        if ($oldPath && file_exists(public_path($oldPath))) unlink(public_path($oldPath));
        return 'avatars/'.$filename;
    }

    private function generateRandomPassword($length = 8)
    {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        return substr(str_shuffle(str_repeat($chars, $length)), 0, $length);
    }

    public function index()
    {
        $authUser = session('auth_user');
        $accounts = Account::where('id','!=',$authUser->id)->get();
        return view('admin.accounts.index', compact('accounts','authUser'));
    }

    public function create()
    {
        $authUser = session('auth_user');
        $roles = ['manager','teacher','kitchen','nanny','admin'];
        if ($authUser->role==='manager') $roles = array_diff($roles,['manager','admin']);
        $classGrades = Account::$classGrades;
        return view('admin.accounts.create', compact('roles','authUser','classGrades'));
    }

    public function store(Request $request)
    {
        $roles = ['manager','teacher','kitchen','nanny','admin'];
        $validated = $request->validate([
            'fullname'=>'required|string|max:255',
            'email'=>'required|email|unique:accounts,email',
            'phone'=>'nullable|string|max:20',
            'address'=>'nullable|string|max:255',
            'role'=>['required', Rule::in($roles)],
            'startdate'=>'required|date',
            'classname'=>'nullable|string|max:50',
            'note'=>'nullable|string|max:255',
            'status'=>'nullable|boolean',
            'admin_approve'=>'nullable|boolean',
            'avatar'=>'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            DB::beginTransaction();
            $account = new Account();
            if ($request->hasFile('avatar')) $account->avatar = $this->handleAvatarUpload($request->file('avatar'));
            $password = $this->generateRandomPassword(8);

            $account->fill([
                'fullname'=>$validated['fullname'],
                'email'=>$validated['email'],
                'phone'=>$validated['phone'] ?? null,
                'address'=>$validated['address'] ?? null,
                'role'=>$validated['role'],
                'startdate'=>$validated['startdate'] ?? null,
                'classname'=>$validated['role']==='teacher' ? ($validated['classname'] ?? null) : null,
                'note'=>$validated['note'] ?? null,
                'status'=>$validated['status'] ?? 0,
                'admin_approve'=>$validated['admin_approve'] ?? 0,
                'password'=>$password,
            ]);
            $account->save();

            Mail::to($account->email)->send(new RegisterMail($account->fullname,$account->email,$password));
            DB::commit();
            return redirect()->route('admin.accounts.index')->with('success','Account tạo thành công và email đã gửi.');
        } catch (\Throwable $e) {
            DB::rollBack();
            \Log::error('Lỗi tạo account: '.$e->getMessage());
            return back()->withInput()->with('error','Có lỗi: '.$e->getMessage());
        }
    }

    public function edit($id)
    {
        $account = Account::findOrFail($id);
        $authUser = session('auth_user');
        $roles = ['manager','teacher','kitchen','nanny','admin'];
        if ($authUser->role==='manager') $roles = array_diff($roles,['manager','admin']);
        $classGrades = Account::$classGrades;
        return view('admin.accounts.edit', compact('account','roles','authUser','classGrades'));
    }

    public function update(Request $request, $id)
    {
        try {
            $account = Account::findOrFail($id);
            $roles = ['manager','teacher','kitchen','nanny','admin'];
            $validated = $request->validate([
                'fullname'=>'required|string|max:255',
                'email'=>['required','email',Rule::unique('accounts')->ignore($account->id)],
                'phone'=>'nullable|string|max:20',
                'address'=>'nullable|string|max:255',
                'role'=>['required', Rule::in($roles)],
                'password'=>'nullable|string|min:6|confirmed',
                'startdate'=>'required|date',
                'classname'=>'nullable|string|max:50',
                'note'=>'nullable|string|max:255',
                'status'=>'nullable|boolean',
                'admin_approve'=>'nullable|boolean',
                'avatar'=>'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $account->fill($validated);
            if (!empty($validated['password'])) $account->password = $validated['password'];
            if ($request->hasFile('avatar')) $account->avatar = $this->handleAvatarUpload($request->file('avatar'), $account->avatar);
            $account->save();

            return redirect()->route('admin.accounts.index')->with('success','Account cập nhật thành công.');
        } catch (\Throwable $e) {
            \Log::error('Lỗi cập nhật account: '.$e->getMessage());
            return back()->withInput()->with('error','Có lỗi: '.$e->getMessage());
        }
    }

    public function show($id)
    {
        $account = Account::findOrFail($id);
        return view('admin.accounts.show', compact('account'));
    }

    public function ban(Request $request, $id)
    {
        try {
            $account = Account::findOrFail($id);
            $authUser = session('auth_user');

            if ($authUser->role==='manager' && in_array($account->role,['admin','manager'])) {
                return back()->with('error','Bạn không có quyền vô hiệu hóa account này.');
            }

            $reason = $request->input('reason')==='Khác' 
                ? $request->input('other_reason') ?? 'Không rõ' 
                : $request->input('reason');

            $account->status = $account->status ? 0 : 1;
            $account->reason_ban = $account->status ? null : $reason;
            $account->save();

            return redirect()->route('admin.accounts.index')
                ->with('success',$account->status ? 'Account đã được kích hoạt.' : 'Account đã bị vô hiệu hóa.');
        } catch (\Throwable $e) {
            \Log::error('Lỗi khi thay đổi trạng thái account: '.$e->getMessage());
            return back()->with('error','Có lỗi: '.$e->getMessage());
        }
    }
}
