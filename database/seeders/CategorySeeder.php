<?php

namespace Database\Seeders;

use App\Models\Category;
use Automattic\WooCommerce\Client;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{

    public function Woocomerce()
    {
        $woocomerce = new Client(
            env('API_URL', 'forge'),
            env('API_PUBLIC_KEY', 'forge'),
            env('API_PRIVATE_KEY', 'forge'),
            [
                'version' => 'wc/v3',
                'verify_ssl' => false
            ]
        );
        return $woocomerce;
    }
    
    public function getCategory()
    {
        return $this->Woocomerce()->get('products/categories');
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->getCategory() as $category) {
            $categoria = new Category();
            $categoria->name = $category->name;
            $categoria->slug = $category->slug;
            $categoria->description = $category->description;
            $categoria->display = $category->display;
            $categoria->image = $category->image;
            $categoria->save();
        }
    }
}
