<?php

namespace App\Http\Controllers;

use App\Models\MEmployee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = MEmployee::all();

        return view('employee.index', compact('employees'));
    }

    public function create()
    {
        return view('employee.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $employee = MEmployee::create([
            'nama_karyawan' => $request->name,
            'tanggal_lahir' => $request->birth,
            'alamat' => $request->address,
            'email' => $request->email,
            'valid_from' => now(),
            'create_by' => auth()->user()->id,
            'create_date' => now(),
        ]);

        foreach ($request->family as $family) {
            if (!$family['name'] && !$family['relationship'] && !$family['birth']) {
                continue;
            } else {
                $employee->family()->create([
                    'nama_anggota_keluarga' => $family['name'],
                    'hubungan_keluarga' => $family['relationship'],
                    'tanggal_lahir_anggota_keluarga' => $family['birth'],
                ]);
            }
        }

        return redirect()->route('dashboard')->with('success', 'Employee created successfully.');
    }

    public function edit(MEmployee $employee)
    {
        $employee = MEmployee::with('family')->find($employee->id);

        return view('employee.edit', compact('employee'));
    }

    public function update(Request $request, MEmployee $employee)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $employee->update([
            'nama_karyawan' => $request->name,
            'tanggal_lahir' => $request->birth,
            'alamat' => $request->address,
            'email' => $request->email,
            'update_by' => auth()->user()->id,
            'update_date' => now(),
        ]);

        $employee->family()->delete();

        foreach ($request->family as $family) {
            if (!$family['name'] && !$family['relationship'] && !$family['birth']) {
                continue;
            } else {
                $employee->family()->create([
                    'nama_anggota_keluarga' => $family['name'],
                    'hubungan_keluarga' => $family['relationship'],
                    'tanggal_lahir_anggota_keluarga' => $family['birth'],
                ]);
            }
        }

        return redirect()->route('dashboard')->with('success', 'Employee updated successfully.');
    }

    public function destroy(MEmployee $employee)
    {
        $employee->delete();

        return redirect()->route('dashboard')->with('success', 'Employee deleted successfully.');
    }
}
