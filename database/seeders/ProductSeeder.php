<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Milon\Barcode\DNS1D;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        $productImages = [
            'https://st.myideasoft.com/idea/di/34/myassets/products/572/tsk-tisort-2020.jpg?revision=1593324979',
            'https://cdn.dsmcdn.com/ty348/product/media/images/20220304/17/62629383/69951497/1/1_org_zoom.jpg',
            "https://cdn.dsmcdn.com/mnresize/500/-/ty328/product/media/images/20220209/18/47636736/90086941/3/3_org.jpg",
            "https://www.kammana.com/spree/products/2248/product/minimal-trio-tisort-erkek-tshirt-tasarla-on3.png?1587665743",
            "https://images.farktorcdn.com/img/800x1200/Library/Upl/5500142/Product/8683285474562-0.jpg",
            "https://cdn.modamizbir.com/Uploads/UrunResimleri/thumb/fume-baskili-yikamali-bayan-tisort-106807-94717463.jpg",
            "https://romancdn.sysrun.net/Content/ProductImage/Original/637902755498826529-8681822250525_(3).JPG?width=500&height=750&bgcolor=white",
            "https://images.farktorcdn.com/img/800x1200/Library/Upl/5500142/Product/8683285446477-1.jpg",
            "https://cdn.shopify.com/s/files/1/0269/9243/products/Coronakolonyaerkektisort_1182x.jpg?v=1584172258"

        ];

        for ($i=0; $i < 30; $i++) {
            $code=rand(2000,99999);
            $barcode = (DNS1D::getBarcodeSVG($code, 'C128'));

            $randomImg  = array_rand($productImages,1);
            $price = $faker->randomFloat(3,1,500);
            Product::create([
                'user_id' => 1,
                'file' => $productImages[$randomImg],
                'name' => $faker->sentence(2),
                'code' => $code,
                'price' =>$price+50,
                'cors' => $price,
                "qty"=> rand(500,5000),
                "end_qty"=> rand(500,5000),
                // "packQty"=> 1,
                // 'sizes'=>'S-M-L-XL-XXL',
                'content'=>$faker->sentence(6),
                'category_id' => rand(1,5),
                'pattern_id' => rand(1,3),
                'material_id' => rand(1,3),
                'brand_id' => rand(1,3),
                'season_id' => rand(1,3),
                'barcode'=> base64_encode($barcode)
            ]);
        }
    }
}
