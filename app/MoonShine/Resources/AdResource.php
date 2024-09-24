<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use MoonShine\Fields\Number;
use MoonShine\Fields\Text;
use Illuminate\Database\Eloquent\Model;
use App\Models\Ad;

use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Field;
use MoonShine\Components\MoonShineComponent;

/**
 * @extends ModelResource<Ad>
 */
class AdResource extends ModelResource
{
    protected string $model = Ad::class;

    protected string $title = 'Ads';

    /**
     * @return list<MoonShineComponent|Field>
     */
    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->sortable(),
                Text::make('Sarlavha', 'title'),
                Text::make("Ta'vsif", 'description'),
                Text::make('Sarlavha', 'title'),
                Text::make('Manzil', 'address'),
                Number::make('Narxi', 'price'),
                Number::make('Xonalari', 'rooms'),
                Text::make('Filiali', 'branch'),
            ]),
        ];
    }

    /**
     * @param Ad $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [];
    }
}
