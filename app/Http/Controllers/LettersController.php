<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Letter;
use App\Models\Classification;
use App\Models\Department;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LettersExport;

class LettersController extends Controller
{
    public function index()
    {
        $letters = Letter::with(['classification', 'department'])->latest()->get();
        $classifications = Classification::all();
        $departments = Department::all();

        return view('letters.index', compact('letters', 'classifications', 'departments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'letter_number' => 'required|unique:letters',
            'subject' => 'required',
            'date' => 'required|date',
            'urgency' => 'required|in:biasa,penting,rahasia',
            'classification_id' => 'required|exists:classifications,id',
            'department_id' => 'required|exists:departments,id',
            'file_path' => 'required|mimes:pdf|max:2048',
        ]);

        $path = $request->file('file_path')->store('letters', 'public');

        Letter::create([
            'letter_number' => $request->letter_number,
            'subject' => $request->subject,
            'date' => $request->date,
            'urgency' => $request->urgency,
            'classification_id' => $request->classification_id,
            'department_id' => $request->department_id,
            'file_path' => $path,
        ]);

        return redirect()->back()->with('success', 'Surat berhasil disimpan.');
    }

    public function update(Request $request, $id)
    {
        $letter = Letter::findOrFail($id);

        $request->validate([
            'letter_number' => 'required|unique:letters,letter_number,' . $id,
            'subject' => 'required',
            'date' => 'required|date',
            'urgency' => 'required|in:biasa,penting,rahasia',
            'classification_id' => 'required|exists:classifications,id',
            'department_id' => 'required|exists:departments,id',
            'file_path' => 'nullable|mimes:pdf|max:2048',
        ]);

        $data = $request->except('file_path');

        if ($request->hasFile('file_path')) {
            if ($letter->file_path) {
                Storage::disk('public')->delete($letter->file_path);
            }
            $data['file_path'] = $request->file('file_path')->store('letters', 'public');
        }

        $letter->update($data);

        return redirect()->back()->with('success', 'Surat berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $letter = Letter::findOrFail($id);

        if ($letter->file_path) {
            Storage::disk('public')->delete($letter->file_path);
        }

        $letter->delete();

        return redirect()->back()->with('success', 'Surat berhasil dihapus.');
    }

    public function exportExcel()
    {
        return Excel::download(new LettersExport, 'rekap-arsip-surat.xlsx');
    }
}
