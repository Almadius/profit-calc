<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Калькулятор прибыли для Kaspi/Ozon</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">
<div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <h1 class="text-2xl font-bold mb-4">Калькулятор чистой прибыли</h1>

    <form action="/calculate" method="POST" class="space-y-4">
        @csrf
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium">Себестоимость (₸)</label>
                <input type="number" name="cost_price" value="{{ old('cost_price', $data['cost_price'] ?? '') }}" class="mt-1 block w-full border rounded p-2" required>
            </div>
            <div>
                <label class="block text-sm font-medium">Цена продажи (₸)</label>
                <input type="number" name="selling_price" value="{{ old('selling_price', $data['selling_price'] ?? '') }}" class="mt-1 block w-full border rounded p-2" required>
            </div>
            <div>
                <label class="block text-sm font-medium">Комиссия площадки (%)</label>
                <input type="number" step="0.1" name="commission_percent" value="{{ old('commission_percent', $data['commission_percent'] ?? '10.9') }}" class="mt-1 block w-full border rounded p-2" required>
            </div>
            <div>
                <label class="block text-sm font-medium">Логистика (₸)</label>
                <input type="number" name="logistics_cost" value="{{ old('logistics_cost', $data['logistics_cost'] ?? '0') }}" class="mt-1 block w-full border rounded p-2">
            </div>
            <div>
                <label class="block text-sm font-medium">Реклама (₸)</label>
                <input type="number" name="ad_cost" value="{{ old('ad_cost', $data['ad_cost'] ?? '0') }}" class="mt-1 block w-full border rounded p-2">
            </div>
            <div>
                <label class="block text-sm font-medium">Налог (%)</label>
                <select name="tax_percent" class="mt-1 block w-full border rounded p-2">
                    <option value="0">Без налога</option>
                    <option value="4" {{ (old('tax_percent', $data['tax_percent'] ?? '') == 4) ? 'selected' : '' }}>4% (Розничный налог РК)</option>
                    <option value="8" {{ (old('tax_percent', $data['tax_percent'] ?? '') == 8) ? 'selected' : '' }}>8% (Розничный налог РК)</option>
                </select>
            </div>
        </div>
        <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">Рассчитать</button>
    </form>

    @if(isset($result))
        <div class="mt-6 p-4 rounded-lg {{ $result['is_profitable'] ? 'bg-green-100 border-green-400' : 'bg-red-100 border-red-400' }} border">
            <h2 class="text-xl font-bold">Результат:</h2>
            <p>Чистая прибыль: <strong>{{ number_format($result['net_profit'], 2) }} ₸</strong></p>
            <p>Маржинальность: <strong>{{ $result['margin'] }}%</strong></p>
            @if(!$result['is_profitable'])
                <p class="text-red-700 font-bold mt-2">⚠️ Внимание! Товар убыточный!</p>
            @endif
        </div>
    @endif
</div>
</body>
</html>
