<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Support\Facades\Storage;

class LoanAgreementController extends Controller
{
    public function download()
    {
        $path = data_get(Setting::query()->where('group', 'documents')->where('key', 'loan_agreement_path')->first()?->value, '0');
        $name = data_get(Setting::query()->where('group', 'documents')->where('key', 'loan_agreement_name')->first()?->value, '0', 'loan-agreement.pdf');

        abort_unless($path && Storage::disk('public')->exists($path), 404);

        return Storage::disk('public')->download($path, $name, [
            'Content-Type' => 'application/pdf',
        ]);
    }
}
