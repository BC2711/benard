<?php

namespace App\Services;

use App\Models\ContentVersion;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class CmsVersionService
{
    public function capture(Model $model): ContentVersion
    {
        $version = $model->versions()->max('version') + 1;

        return $model->versions()->create([
            'version' => $version,
            'snapshot' => $model->attributesToArray(),
            'created_by' => Auth::id(),
        ]);
    }

    public function restore(Model $model, ContentVersion $version): void
    {
        abort_unless(
            $version->versionable_type === $model->getMorphClass()
            && $version->versionable_id === $model->getKey(),
            404
        );

        $this->capture($model);
        $model->fill($version->snapshot)->save();
    }
}
