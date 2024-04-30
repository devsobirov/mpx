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

                foreach (self::getChildren($item->id) as $child) {
                    if ($this->isNewCategory($child['slug'], $item->id)) {
                        Category::create($child);
                    }
                }
            }
        }
    }

    public static function getParents(): array
    {
        $parents = [];
        $parents[] = self::getItemData(['ru' => 'Ключи', 'en' => 'Keys'], 1);
        $parents[] = self::getItemData(['ru' => 'Аккаунты', 'en' => 'Accounts'], 2);
        $parents[] = self::getItemData(['ru' => 'DLC'], 3);
        $parents[] = self::getItemData(['ru' => 'Золото', 'en' => 'Gold', 1]);
        $parents[] = self::getItemData(['ru' => 'Бустинг', 'en' => 'Busting', 1]);

        return $parents;
    }

    public static function getChildren($parent_id): array
    {
        $children = [];

        $children[] = self::getItemData(['ru' => 'Steam'], 1, $parent_id);
        $children[] = self::getItemData(['ru' => 'Xbox'], 1, $parent_id);
        return $children;
    }

    private static function getItemData(array $name, ?int $order = null, ?int $parentId = null)
    {
        return [
            'name' => $name,
            'parent_id' => $parentId,
            'order' => $order,
            'slug' => strtolower(\Str::slug($name['en'] ?? $name['ru'])),
        ];
    }

    private function isNewCategory(string $slug, ?int $parentId = null): bool
    {
        return !DB::table('categories')->where('slug', $slug)->where('parent_id', $parentId)->exists();
    }
}
