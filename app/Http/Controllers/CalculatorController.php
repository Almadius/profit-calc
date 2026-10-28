<?php
namespace App\Http\Controllers;

use App\Services\ProfitCalculatorService;
use Illuminate\Http\Request;

class CalculatorController extends Controller
{
    public function index()
    {
        return view('calculator'); // Покажем форму
    }

    public function calculate(Request $request, ProfitCalculatorService $calculator)
    {
        // Валидация входящих данных
        $data = $request->validate([
            'cost_price' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',
            'commission_percent' => 'required|numeric|min:0|max:100',
            'logistics_cost' => 'nullable|numeric|min:0',
            'ad_cost' => 'nullable|numeric|min:0',
            'tax_percent' => 'required|numeric|in:0,4,8', // 4% или 8% для РК
        ]);

        $result = $calculator->calculate(
            $data['cost_price'],
            $data['selling_price'],
            $data['commission_percent'],
            $data['logistics_cost'] ?? 0,
            $data['ad_cost'] ?? 0,
            $data['tax_percent']
        );

        return view('calculator', compact('result', 'data'));
    }
}
