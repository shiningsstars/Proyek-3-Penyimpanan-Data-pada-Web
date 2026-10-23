<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangeRoleRequest;
use App\Models\User;
use App\Services\RoleManagementService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index(): View
    {
        $users = User::orderBy('nama_lengkap')
            ->get(['id_user', 'nama_lengkap', 'username', 'role']);

        return view('admin.users', compact('users'));
    }

    public function update(
        ChangeRoleRequest $request,
        User $user,
        RoleManagementService $service
    ): RedirectResponse {
        $data = $request->validated();

        $service->changeRole($request->user(), $user, $data['role']);

        return back()->with('status', 'Role diperbarui.');
    }
}