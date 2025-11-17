<?php

namespace App\Http\Controllers;

use App\Models\Funcionario;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class FuncionarioController extends Controller
{
    public function index()
    {
        $funcionarios = Funcionario::all();
        return view('funcionarios.index', compact('funcionarios'));
    }

    public function create()
    {
        return view('funcionarios.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomeFuncionario' => 'required',
            'cargoFuncionario' => 'required',
            'salarioFuncionario' => 'required|numeric'
        ]);

        Funcionario::create($request->all());

        return redirect()->route('funcionarios.index')
            ->with('success', 'Funcionário cadastrado com sucesso!');
    }

    public function edit($id)
    {
        $funcionario = Funcionario::findOrFail($id);
        return view('funcionarios.edit', compact('funcionario'));
    }

    public function update(Request $request, $id)
    {
        $funcionario = Funcionario::findOrFail($id);

        $funcionario->update($request->all());

        return redirect()->route('funcionarios.index')
            ->with('success', 'Funcionário atualizado com sucesso!');
    }

    public function destroy($id)
    {
        Funcionario::findOrFail($id)->delete();

        return redirect()->route('funcionarios.index')
            ->with('success', 'Funcionário removido com sucesso!');
    }

    /* ============================
       EXPORTAR CSV
    ============================ */
    public function exportCsv()
    {
        $funcionarios = Funcionario::all();

        $csv = "ID;Nome;Cargo;Salário\n";

        foreach ($funcionarios as $f) {
            $csv .= "{$f->id};{$f->nomeFuncionario};{$f->cargoFuncionario};{$f->salarioFuncionario}\n";
        }

        return response($csv)
            ->header('Content-Type', 'text/csv')
            ->header('Content-Disposition', 'attachment; filename=funcionarios.csv');
    }

    /* ============================
       EXPORTAR PDF
    ============================ */
    public function exportPdf()
    {
        $funcionarios = Funcionario::all();

        $pdf = Pdf::loadView('exports.funcionarios_pdf', compact('funcionarios'));

        return $pdf->download('funcionarios.pdf');
    }
}
