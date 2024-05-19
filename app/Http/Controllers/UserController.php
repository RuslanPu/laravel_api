<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;


class UserController
{
    /** crud users */
    public function index()
    {
        $managers = User::all()
            ->where('type', '=', 1);
        return view('manager.index', compact('managers'));
    }

    public function createUser()
    {
        return view('user.create');
    }

    public function storeUser(Request $request)
    {
        User::create($request->all());
        return redirect('admin/dashboard')->with('success', 'User created successfully.');
    }

    public function editUser($id)
    {
        $user = User::findOrFail($id);
        return view('user.edit', compact('user'));
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->all());
        return redirect('admin/dashboard')->with('success', 'User updated successfully.');
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect('admin/dashboard')->with('success', 'User deleted successfully.');
    }

    /** crud managers */
    public function managers()
    {
        $managers = User::all()
            ->where('type', '=', 1);
        return view('manager.index', compact('managers'));
    }

    public function createManager(){
        return view('manager.create');
    }

    public function storeManager(Request $request)
    {
        $dataUser = $request->all();
        $dataUser['type'] = 1;
        User::create($dataUser);
        return redirect('admin/managers')->with('success', 'Manager created successfully.');
    }

    public function editManager($id)
    {
        $manager = User::findOrFail($id);
        return view('manager.edit', compact('manager'));
    }

    public function updateManager(Request $request, $id)
    {
        $manager = User::findOrFail($id);
        $manager->update($request->all());
        return redirect('admin/managers')->with('success', 'Manager updated successfully.');

    }

    public function deleteManager($id)
    {
        $manager = User::findOrFail($id);
        $manager->delete();
        return redirect('admin/managers')->with('success', 'Manager deleted successfully.');
    }

    /** crud admins */
    public function admins()
    {
        $admins = User::all()
            ->where('type', '=', 2);
        return view('admin.index', compact('admins'));
    }

    public function createAdmin()
    {
        return view('admin.create');
    }

    public function storeAdmin(Request $request)
    {
        $userData = $request->all();
        $userData['type'] = 2;
        User::create($userData);
        return redirect('admin/admins')->with('success', 'Admin created successfully.');
    }

    public function editAdmin($id)
    {
        $admin = User::findOrFail($id);
        return view('admin.edit', compact('admin'));
    }

    public function updateAdmin(Request $request, $id)
    {
        $admin = User::findOrFail($id);
        $admin->update($request->all());
        return redirect('admin/admins')->with('Admin updated successfully.');

    }

    public function deleteAdmin($id)
    {
        $admin = User::findOrFail($id);
        $admin->delete();
        return redirect('admin/admins')->with('Admin deleted successfully.');
    }

    /** crud clients */
    public function clients()
    {
        $clients = User::all()
            ->where('type', '=', '0');
        return view('client.index', compact('clients'));
    }

    public function createClient()
    {
        return view('client.create');
    }

    public function storeClient(Request $request)
    {
        $userData = $request->all();
        $userData['type'] = 0;
        User::create($userData);
        return redirect('admin/clients')->with('success', 'Client created successfully.');
    }

    public function editClient($id)
    {
        $client = User::findOrFail($id);
        return view('client.edit', compact('client'));
    }

    public function updateClient(Request $request, $id)
    {
        $client = User::findOrFail($id);
        $client->update($request->all());
        return redirect('admin/clients')->with('Client updated successfully.');

    }

    public function deleteClient($id)
    {
        $client = User::findOrFail($id);
        $client->delete();
        return redirect('admin/clients')->with('Client deleted successfully.');
    }


}
