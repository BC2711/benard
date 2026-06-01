@php
    $editing = $consultation->exists;
    $preferredTime = old('preferred_time', $consultation->preferred_time?->format('H:i'));
@endphp

<form method="POST" action="{{ $editing ? route('management.consultation.update', $consultation) : route('management.consultation.store') }}" class="space-y-6">
    @csrf
    @if ($editing) @method('PUT') @endif

    <section class="admin-card p-5">
        <h2 class="text-lg font-bold">Customer Information</h2>
        <div class="mt-4 grid gap-4 md:grid-cols-2">
            <label class="text-sm font-bold">First name<input name="first_name" class="admin-input mt-2 h-11 w-full px-3" value="{{ old('first_name', $consultation->first_name) }}" required></label>
            <label class="text-sm font-bold">Last name<input name="last_name" class="admin-input mt-2 h-11 w-full px-3" value="{{ old('last_name', $consultation->last_name) }}" required></label>
            <label class="text-sm font-bold">Email address<input type="email" name="email" class="admin-input mt-2 h-11 w-full px-3" value="{{ old('email', $consultation->email) }}" required></label>
            <label class="text-sm font-bold">Phone number<input name="phone" class="admin-input mt-2 h-11 w-full px-3" value="{{ old('phone', $consultation->phone) }}" required></label>
        </div>
    </section>

    <section class="admin-card p-5">
        <h2 class="text-lg font-bold">Appointment Details</h2>
        <div class="mt-4 grid gap-4 md:grid-cols-2">
            <label class="text-sm font-bold">Preferred date<input type="date" name="preferred_date" class="admin-input mt-2 h-11 w-full px-3" value="{{ old('preferred_date', $consultation->preferred_date?->format('Y-m-d')) }}" @if (!$editing) min="{{ now()->format('Y-m-d') }}" @endif required></label>
            <label class="text-sm font-bold">Preferred time
                <select name="preferred_time" class="admin-input mt-2 h-11 w-full px-3" required>
                    <option value="">Select a time slot</option>
                    @foreach (['09:00' => '9:00 AM', '10:00' => '10:00 AM', '11:00' => '11:00 AM', '13:00' => '1:00 PM', '14:00' => '2:00 PM', '15:00' => '3:00 PM', '16:00' => '4:00 PM'] as $value => $label)
                        <option value="{{ $value }}" @selected($preferredTime === $value)>{{ $label }}</option>
                    @endforeach
                </select>
            </label>
            @if ($editing)
                <label class="text-sm font-bold">Status
                    <select name="status" class="admin-input mt-2 h-11 w-full px-3" required>
                        @foreach (['new', 'contacted', 'scheduled', 'cancelled'] as $status)
                            <option value="{{ $status }}" @selected(old('status', $consultation->status) === $status)>{{ ucfirst($status) }}</option>
                        @endforeach
                    </select>
                </label>
            @endif
            <label class="text-sm font-bold md:col-span-2">Message<textarea name="message" class="admin-input mt-2 min-h-32 w-full px-3 py-2" maxlength="2000">{{ old('message', $consultation->message) }}</textarea></label>
        </div>
    </section>

    <div class="flex flex-wrap justify-end gap-3">
        <a href="{{ route('management.consultation.index') }}" class="rounded-xl border border-slate-200 bg-white px-5 py-3 text-sm font-bold text-slate-700 dark:border-slate-800 dark:bg-slate-900 dark:text-slate-200">Cancel</a>
        <button class="rounded-xl bg-brand-700 px-5 py-3 text-sm font-bold text-white shadow-soft">{{ $editing ? 'Save Changes' : 'Create Request' }}</button>
    </div>
</form>
