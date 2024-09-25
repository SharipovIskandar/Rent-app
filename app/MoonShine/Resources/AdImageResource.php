<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\Models\Image;
use Illuminate\Database\Eloquent\Model;

use MoonShine\Fields\Text;
use MoonShine\Resources\ModelResource;
use MoonShine\Fields\ID;
use MoonShine\Fields\Field;
use MoonShine\Components\MoonShineComponent;

/**
 * @extends ModelResource<Image>
 */
class AdImageResource extends ModelResource
{
    protected string $model = Image::class;

    protected string $title = 'Images';

    protected string $column = 'name';

    /**
     * @return list<Field>
     */
    public function indexFields(): array
    {
        return [
            Text::make('Name', 'name'),
        ];
    }

    /**
     * @return list<MoonShineComponent|Field>
     */
    public function formFields(): array
    {
        return [
            ID::make()->sortable(),
        ];
    }

    /**
     * @return list<Field>
     */
    public function detailFields(): array
    {
        return [
            ID::make()->sortable(),
        ];
    }

    /**
     * @param Image $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [];
    }
}
