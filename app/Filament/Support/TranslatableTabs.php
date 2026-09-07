<?php

namespace App\Filament\Support;

use Closure;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;

class TranslatableTabs
{
    /**
     * Build a locale-tabbed group of form fields for translatable attributes.
     *
     * @param  array<string, Closure(string $statePath): \Filament\Forms\Components\Component>  $fields
     *         Map of attribute name => a closure that receives the dot-notation
     *         state path (e.g. "title.en") and returns the field for it.
     */
    public static function make(array $fields): Tabs
    {
        $locales = config('languages.available');
        $defaultLocale = config('languages.default');

        return Tabs::make('translations')
            ->contained(false)
            ->columnSpanFull()
            ->tabs(
                collect($locales)
                    ->map(function (string $localeLabel, string $locale) use ($fields, $defaultLocale) {
                        return Tab::make($locale)
                            ->label($localeLabel)
                            ->schema(
                                collect($fields)
                                    ->map(function (Closure $factory, string $name) use ($locale, $defaultLocale) {
                                        $field = $factory("{$name}.{$locale}");

                                        // Only the default locale is mandatory; other locales
                                        // may be left blank without failing validation.
                                        if ($locale !== $defaultLocale && method_exists($field, 'required')) {
                                            $field->required(false);
                                        }

                                        return $field;
                                    })
                                    ->values()
                                    ->all()
                            );
                    })
                    ->values()
                    ->all()
            );
    }
}
