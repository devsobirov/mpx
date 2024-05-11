<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    public function run(): void
    {
        foreach (self::getParents() as $parent) {
            if ($this->isNewCategory($parent['slug'])) {
                $item = Category::create($parent);

                foreach (self::getChildren($item->slug) as $child) {
                    if ($this->isNewCategory($child['slug'])) {
                        Category::create($child);
                    }
                }
            }
        }
    }

    public static function getParents(): array
    {
        $parents = [];
        $parents[] = self::getItemData(['ru' => 'Ключи', 'en' => 'Keys']);
        $parents[] = self::getItemData(['ru' => 'Аккаунты', 'en' => 'Accounts']);
        $parents[] = self::getItemData(['ru' => 'DLC']);
        $parents[] = self::getItemData(['ru' => 'Золото', 'en' => 'Gold']);
        $parents[] = self::getItemData(['ru' => 'Бустинг', 'en' => 'Busting']);

        return $parents;
    }

    public static function getChildren($parent_id): array
    {
        $children = [];

        $children[] = self::getItemData(['ru' => 'Steam'],  $parent_id);
        $children[] = self::getItemData(['ru' => 'Xbox'],  $parent_id);
        return $children;
    }

    private static function getItemData(array $name, ?string $parent = null)
    {
        $slug = strtolower(\Str::slug($name['en'] ?? $name['ru']));
        $slug = $parent ?
            $parent . '/' . $slug
            : $slug;
        return [
            'name' => $name,
            'parent' => $parent,
            'slug' => $slug,
        ];
    }

    private function isNewCategory(string $slug): bool
    {
        return !DB::table('categories')->where('slug', $slug)->exists();
    }
}
