<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LoanAgreementController extends Controller
{
    public function edit()
    {
        return view('pages.admin.loan-agreement.edit', [
            'agreementPath' => $this->settingValue('loan_agreement_path'),
            'agreementName' => $this->settingValue('loan_agreement_name'),
        ]);
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'agreement_pdf' => ['required', 'file', 'mimes:pdf', 'mimetypes:application/pdf', 'max:10240'],
        ]);

        $disk = Storage::disk('public');
        $previousPath = $this->settingValue('loan_agreement_path');
        $file = $data['agreement_pdf'];
        $path = $disk->putFile('cms/documents/loan-agreements', $file);

        Setting::updateOrCreate(
            ['group' => 'documents', 'key' => 'loan_agreement_path'],
            ['value' => [$path], 'type' => 'file', 'is_public' => false],
        );
        Setting::updateOrCreate(
            ['group' => 'documents', 'key' => 'loan_agreement_name'],
            ['value' => [$file->getClientOriginalName()], 'type' => 'text', 'is_public' => false],
        );

        if ($previousPath && $previousPath !== $path) {
            $disk->delete($previousPath);
        }

        return back()->with('success', 'Loan agreement PDF uploaded.');
    }

    public function destroy()
    {
        $path = $this->settingValue('loan_agreement_path');

        if ($path) {
            Storage::disk('public')->delete($path);
        }

        Setting::query()
            ->where('group', 'documents')
            ->whereIn('key', ['loan_agreement_path', 'loan_agreement_name'])
            ->delete();

        return back()->with('success', 'Loan agreement PDF removed.');
    }

    private function settingValue(string $key): ?string
    {
        return data_get(Setting::query()->where('group', 'documents')->where('key', $key)->first()?->value, '0');
    }
}
