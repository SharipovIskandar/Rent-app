<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\Enums\Gender;
use App\Models\Branch;
use App\Models\Status;
use App\Models\User;
use Illuminate\Testing\Fluent\Concerns\Has;
use MoonShine\Components\MoonShineComponent;
use MoonShine\Fields\Enum;
use MoonShine\Fields\Field;
use MoonShine\Fields\Number;
use MoonShine\Fields\Relationships\BelongsTo;
use MoonShine\Fields\Relationships\HasMany;
use MoonShine\Fields\Text;
use Illuminate\Database\Eloquent\Model;
use App\Models\Ad;

use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;

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
                Text::make("Ta'vsif", 'description')->hideOnIndex(),
                Text::make('Manzil', 'address'),
                Number::make('Narxi', 'price')->sortable(),
                Number::make('Xonalari', 'rooms')->sortable(),
                Enum::make('Jinsi', 'gender')->attach(Gender::class),
                BelongsTo::make('Filiallar', 'branch',resource:  new BranchResource())->sortable(),
                BelongsTo::make('Holati', 'status',resource:  new StatusResource())->sortable(),
                BelongsTo::make('Ega', 'user',resource: new UserResource)->hideOnIndex(),
                HasMany::make('Rasmlar', 'image', resource: new AdImageResource())->onlyLink(),
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
