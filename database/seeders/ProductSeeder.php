<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use App\Models\Product;
use Automattic\WooCommerce\Client;



class ProductSeeder extends Seeder
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

    public function getProducts($perPage=100, $page=1)
    {
        return $this->Woocomerce()->get('products?per_page='.$perPage.'&page='.$page);
    }


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categorias = Category::all();

        for ($i = 1; $i < 33; $i++){
            $agregarPagina = $this->getProducts(100, $i);
            
            if($agregarPagina == []){
                break;
            }else{
                foreach ($agregarPagina as $pagina) {
                    
                    $product = new Product();
                    if(isset($pagina->categories[0]->name))
                    {
                        $categoria = $categorias->where('name', $pagina->categories[0]->name)->first();
                        $product->category_id = $categoria->id;
                    }  
                    $product->name = $pagina->name;
                    $product->slug = $pagina->slug;
                    $product->permalink = $pagina->permalink;
                    $product->type = $pagina->type;
                    $product->status = $pagina->status;
                    $product->description = $pagina->description;
                    $product->sku = $pagina->sku;
                    $product->price = $pagina->price;
                    $product->stock_quantity = $pagina->stock_quantity;     
                    if(isset($pagina->attributes[0]->options[0]))
                    {
                        $product->marca = $pagina->attributes[0]->options[0];
                    }else{
                        $product->marca = null;
                    }                        
                    if(isset($pagina->images[0]->src))
                    {
                        $product->image = $pagina->images[0]->src;
                    }else{
                        $product->image = 'curso.png';
                    }
                    $product->save();
                }
                
            }
        }
    }
}
