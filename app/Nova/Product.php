<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\BelongsTo;
use Illuminate\Http\Request;

class Product extends Resource
{
    public static $model = \App\Models\Product::class;

    public static $title = 'name';

    public static $search = [
        'id',
        'name'
    ];

    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),

            Text::make('Name')->sortable()->rules('required', 'max:255'),

            Textarea::make('Description')->alwaysShow(),

            Number::make('Price')->rules('required', 'numeric')->step(0.01),

            Number::make('Old Price')->step(0.01)->nullable(),

            Number::make('Discount')->step(0.01)->nullable(),

            Boolean::make('Is Active')->trueValue(true)->falseValue(false),

            Image::make('Image', 'image_path')
                ->disk('public')
                ->path('images')
                ->nullable()
                ->thumbnail(function ($value) {
                    return $this->image_path ? url('/storage/' . $value) : null;
                }),

            BelongsTo::make('Category'), // الفئة الرئيسية

            BelongsTo::make('Subcategory'), // الفئة الفرعية
        ];
    }

    public function cards(Request $request)
    {
        return [];
    }

    public function filters(Request $request)
    {
        return [];
    }

    public function lenses(Request $request)
    {
        return [];
    }

    public function actions(Request $request)
    {
        return [];
    }
}
