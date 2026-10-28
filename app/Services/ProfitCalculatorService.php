<?php
namespace App\Services;

class ProfitCalculatorService
{
    public function calculate(
        float $costPrice,
        float $sellingPrice,
        float $commissionPercent,
        float $logistics,
        float $adCost,
        float $taxPercent
    ): array {
        // 1. Считаем комиссию площадки
        $commissionAmount = $sellingPrice * ($commissionPercent / 100);

        // 2. Считаем налог (в РК розничный налог 4% или 8%) [citation:4][citation:7]
        $taxAmount = $sellingPrice * ($taxPercent / 100);

        // 3. Считаем все расходы
        $totalExpenses = $costPrice + $commissionAmount + $logistics + $adCost + $taxAmount;

        // 4. Чистая прибыль
        $netProfit = $sellingPrice - $totalExpenses;

        // 5. Маржинальность (в %)
        $margin = $sellingPrice > 0 ? ($netProfit / $sellingPrice) * 100 : 0;

        return [
            'net_profit' => round($netProfit, 2),
            'margin' => round($margin, 2),
            'is_profitable' => $netProfit > 0,
            'commission_amount' => round($commissionAmount, 2),
            'tax_amount' => round($taxAmount, 2),
        ];
    }
}
