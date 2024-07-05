<?php
// app/Http/Controllers/EmployeeController.php
namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;



class EmployeeController extends Controller {

    
    public function index(){
        $employees = Employee::all();
        return view('employees.index', compact('employees'));
    }

    public function store(Request $request) {
        $request->validate([
            'firstname' => 'required|string|max:255',
            'middlename' => 'nullable|string|max:255',
        ]);

        Employee::create($request->all());

        return redirect()->route('employees.index')
            ->with('success', 'Employee added successfully.');
    }



    public function update(Request $request, $id) {
        $request->validate([
            'firstname' => 'required|string|max:255',
            'middlename' => 'nullable|string|max:255',
        ]);

        $employee = Employee::findOrFail($id);
        $employee->update($request->all());

        if ($request->ajax()) {
            return response()->json(['success' => true]);
        }

        return redirect()->route('employees.index')
            ->with('success', 'Employee updated successfully.');
    }

    public function destroy($id){
        $employee = Employee::findOrFail($id);
        $employee->delete();

    return redirect()->route('employees.index')
        ->with('success', 'Employee deleted successfully.');
    }

}



