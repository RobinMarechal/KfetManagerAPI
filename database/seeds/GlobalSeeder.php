<?php

use App\Category;
use App\Customer;
use App\Event;
use App\EventAccessory;
use App\EventProduct;
use App\Kfet;
use App\Menu;
use App\MoneyAdding;
use App\Order;
use App\OrderProduct;
use App\Product;
use App\Purchase;
use App\Restocking;
use App\Staff;
use App\Subcategory;
use Illuminate\Database\Seeder;

class GlobalSeeder extends Seeder
{
    private $cat_boisson;
    private $cat_boisson_chaude;
    private $cat_vienoiserie;
    private $cat_plat_rechauffe;
    private $cat_dessert;

    private $menu_cpp;
    private $menu_c;
    private $menu_petit_dej;

    private $subc_pizza;
    private $subc_plat_picard;
    private $subc_vienoiserie;
    private $subc_barre_choco;
    private $subc_chips;
    private $subc_boisson;
    private $subc_boisson_chaude;

    private $prod_pizza_royale;
    private $prod_pizza_4_fromages;
    private $prod_pizza_4_kebab;
    private $prod_plat_picard_riz_poulet;
    private $prod_plat_picat_saumon_pates;
    private $prod_vien_croissant;
    private $prod_vien_pain_chocolat;
    private $prod_barre_choco_lion;
    private $prod_barre_choco_snicker;
    private $prod_barre_choco_kitkat;
    private $prod_chips_poulet;
    private $prod_chips_bbq;
    private $prod_boisson_orangina;
    private $prod_boisson_coca_cherry;
    private $prod_boisson_coca_0;
    private $prod_boisson_oasis;
    private $prod_boisson_chaude_cafe;
    private $prod_boisson_chaude_cafe_long;
    private $prod_boisson_chaude_the_vert;

    private $staff_robin;
    private $staff_potter;

    private $cust_robin;
    private $cust_potter;
    private $cust_john;
    private $cust_jane;

    private $order_robin;
    private $order_robin_menu_cpp;
    private $order_potter_menu_petit_dej;
    private $order_john_cafe;
    private $order_jane_the;
    private $order_jane_the2;

    private $event1;
    private $event2;

    private $restocking;


    /**
     * Run the database seeds.
     * @return void
     */
    public function run ()
    {
        $this->kfet();
        $this->categories();
        $this->menus();
        $this->category_menu();
        $this->subcategories();
        $this->products();
        $this->staff();
        $this->customer();
        $this->orders();
        $this->order_product();
        $this->events();
        $this->event_accessories();
        $this->event_products();
        $this->restockings();
        $this->product_restocking();
        $this->money_addings();
        $this->purchases();
    }


    private function kfet ()
    {
        Kfet::create(['balance' => 500]);

        print("kfet tabled seeded\n");
    }


    private function categories ()
    {
        $this->cat_boisson = Category::create(['name' => 'boisson']);
        $this->cat_boisson_chaude = Category::create(['name' => 'boiss chaude']);
        $this->cat_vienoiserie = Category::create(['name' => 'viénoiserie']);
        $this->cat_plat_rechauffe = Category::create(['name' => 'plat réchauffé']);
        $this->cat_dessert = Category::create(['name' => 'dessert']);

        print("categories tabled seeded\n");
    }


    private function menus ()
    {
        $this->menu_cpp = Menu::create(['name' => "C++", "description" => "un repas complet", "price" => 3.6]);
        $this->menu_c = Menu::create(['name' => "C", "description" => "pour les petites faims", "price" => 3]);
        $this->menu_petit_dej = Menu::create(['name' => "Petit déj", "description" => "Pour bien commencer la journée", "price" => 1]);

        print("menus tabled seeded\n");
    }


    private function category_menu ()
    {
        $this->menu_cpp->categories()
                       ->syncWithoutDetaching([$this->cat_boisson->id, $this->cat_dessert->id, $this->cat_plat_rechauffe->id]);

        $this->menu_c->categories()
                     ->syncWithoutDetaching([$this->cat_boisson->id, $this->cat_plat_rechauffe->id]);

        $this->menu_petit_dej->categories()
                             ->syncWithoutDetaching([$this->cat_boisson_chaude->id, $this->cat_vienoiserie->id]);

        print("category_menu tabled seeded\n");
    }


    private function subcategories ()
    {
        $this->subc_pizza = Subcategory::create(['name' => 'pizza', 'price' => 2.6, 'category_id' => $this->cat_plat_rechauffe->id]);
        $this->subc_plat_picard = Subcategory::create(['name' => 'plat picard', 'price' => 2.25, 'category_id' => $this->cat_plat_rechauffe->id]);

        $this->subc_vienoiserie = Subcategory::create(['name' => 'viénoiserie', 'price' => 2.25, 'category_id' => $this->cat_vienoiserie->id]);

        $this->subc_barre_choco = Subcategory::create(['name' => 'barre chocolatée', 'price' => 0.6, 'category_id' => $this->cat_dessert->id]);
        $this->subc_chips = Subcategory::create(['name' => 'chips', 'price' => 0.6, 'category_id' => $this->cat_dessert->id]);

        $this->subc_boisson = Subcategory::create(['name' => 'boisson', 'price' => 0.6, 'category_id' => $this->cat_boisson->id]);

        $this->subc_boisson_chaude = Subcategory::create(['name' => 'boisson_chaude', 'price' => 0.6, 'category_id' => $this->cat_boisson_chaude->id]);

        print("subcategories tabled seeded\n");
    }


    private function products ()
    {
        $this->prod_pizza_royale = Product::create(['name' => 'pizza royale', 'quantity' => 15, 'subcategory_id' => $this->subc_pizza->id]);
        $this->prod_pizza_4_fromages = Product::create(['name' => 'pizza 4 fromages', 'quantity' => 20, 'subcategory_id' => $this->subc_pizza->id]);
        $this->prod_pizza_4_kebab = Product::create(['name' => 'pizza kebab', 'quantity' => 10, 'subcategory_id' => $this->subc_pizza->id]);

        $this->prod_plat_picard_riz_poulet = Product::create(['name' => 'riz poulet', 'quantity' => 10, 'subcategory_id' => $this->subc_plat_picard->id]);
        $this->prod_plat_picat_saumon_pates = Product::create(['name' => 'saumon pates', 'quantity' => 5, 'subcategory_id' => $this->subc_plat_picard->id]);

        $this->prod_vien_croissant = Product::create(['name' => 'croissant', 'quantity' => 5, 'subcategory_id' => $this->subc_vienoiserie->id]);
        $this->prod_vien_pain_chocolat = Product::create(['name' => 'pain au chocolat', 'quantity' => 8, 'subcategory_id' => $this->subc_vienoiserie->id]);

        $this->prod_barre_choco_lion = Product::create(['name' => 'lion', 'quantity' => 20, 'subcategory_id' => $this->subc_barre_choco->id]);
        $this->prod_barre_choco_snicker = Product::create(['name' => 'snicker', 'quantity' => 20, 'subcategory_id' => $this->subc_barre_choco->id]);
        $this->prod_barre_choco_kitkat = Product::create(['name' => 'kitkat', 'quantity' => 20, 'subcategory_id' => $this->subc_barre_choco->id]);

        $this->prod_chips_poulet = Product::create(['name' => 'chips poulet roti', 'quantity' => 20, 'subcategory_id' => $this->subc_chips->id]);
        $this->prod_chips_bbq = Product::create(['name' => 'chips barbecue', 'quantity' => 20, 'subcategory_id' => $this->subc_chips->id]);

        $this->prod_boisson_orangina = Product::create(['name' => 'orangina', 'quantity' => 25, 'subcategory_id' => $this->subc_boisson->id]);
        $this->prod_boisson_coca_cherry = Product::create(['name' => 'coca cola cherry', 'quantity' => 25, 'subcategory_id' => $this->subc_boisson->id]);
        $this->prod_boisson_coca_0 = Product::create(['name' => 'coca zero', 'quantity' => 25, 'subcategory_id' => $this->subc_boisson->id]);
        $this->prod_boisson_oasis = Product::create(['name' => 'oasis', 'quantity' => 25, 'subcategory_id' => $this->subc_boisson->id]);

        $this->prod_boisson_chaude_cafe = Product::create(['name' => 'café', 'quantity' => 99999, 'subcategory_id' => $this->subc_boisson_chaude->id]);
        $this->prod_boisson_chaude_cafe_long = Product::create(['name' => 'café long', 'quantity' => 99999, 'subcategory_id' => $this->subc_boisson_chaude->id]);
        $this->prod_boisson_chaude_the_vert = Product::create(['name' => 'thé vert', 'quantity' => 99999, 'subcategory_id' => $this->subc_boisson_chaude->id]);

        print("products tabled seeded\n");
    }


    private function staff ()
    {
        $this->staff_robin = Staff::create(['firstname' => 'Robin', 'lastname' => 'Maréchal', 'email' => 'robin@kfet.fr', 'role' => 'webmaster']);
        $this->staff_potter = Staff::create(['firstname' => 'potter', 'lastname' => 'poitevin', 'email' => 'potter@kfet.fr', 'role' => 'esclave']);

        print("staff tabled seeded\n");
    }


    private function customer ()
    {
        $this->cust_robin = Customer::create(['staff_id' => $this->staff_robin->id, 'balance' => 25]);
        $this->cust_potter = Customer::create(['staff_id' => $this->staff_potter->id, 'balance' => -500]);
        $this->cust_john = Customer::create(['firstname' => 'John', 'lastname' => 'Doe', 'balance' => 0]);
        $this->cust_jane = Customer::create(['firstname' => 'Jane', 'lastname' => 'Doe', 'balance' => 0]);

        print("customer tabled seeded\n");
    }


    private function orders ()
    {
        $this->order_robin = Order::create(['customer_id' => $this->cust_robin->id]);
        $this->order_robin_menu_cpp = Order::create(['customer_id' => $this->cust_robin->id, 'menu_id' => $this->menu_cpp->id]);

        $this->order_potter_menu_petit_dej = Order::create(['customer_id' => $this->cust_potter->id, 'menu_id' => $this->menu_petit_dej->id]);

        $this->order_john_cafe = Order::create(['customer_id' => $this->cust_john->id]);
        $this->order_jane_the = Order::create(['customer_id' => $this->cust_john->id]);
        $this->order_jane_the2 = Order::create(['customer_id' => $this->cust_john->id]);

        print("orders tabled seeded\n");
    }


    private function order_product ()
    {
        OrderProduct::create(['order_id' => $this->order_robin_menu_cpp->id, 'product_id' => $this->prod_pizza_royale->id]);
        OrderProduct::create(['order_id' => $this->order_robin_menu_cpp->id, 'product_id' => $this->prod_boisson_oasis->id]);
        OrderProduct::create(['order_id' => $this->order_robin_menu_cpp->id, 'product_id' => $this->prod_chips_bbq->id]);

        OrderProduct::create(['order_id' => $this->order_robin->id, 'product_id' => $this->prod_barre_choco_kitkat->id, 'quantity' => 2]);

        OrderProduct::create(['order_id' => $this->order_potter_menu_petit_dej->id, 'product_id' => $this->prod_vien_pain_chocolat->id]);
        OrderProduct::create(['order_id' => $this->order_potter_menu_petit_dej->id, 'product_id' => $this->prod_boisson_chaude_cafe->id]);

        OrderProduct::create(['order_id' => $this->order_john_cafe->id, 'product_id' => $this->prod_boisson_chaude_cafe->id]);

        OrderProduct::create(['order_id' => $this->order_jane_the->id, 'product_id' => $this->prod_boisson_chaude_the_vert->id]);

        OrderProduct::create(['order_id' => $this->order_john_cafe->id, 'product_id' => $this->prod_boisson_chaude_the_vert->id]);

        print("order_product tabled seeded\n");
    }


    private function events ()
    {
        $this->event1 = Event::create(['date' => '2017-09-07', 'description' => 'bbq rentrée']);
        $this->event2 = Event::create(['date' => '2017-09-20', 'description' => 'bbq puis guinguette']);

        print("events tabled seeded\n");
    }


    private function event_accessories ()
    {
        EventAccessory::create(['event_id' => $this->event1->id, 'name' => 'table', 'cost' => 10, "quantity" => 5]);
        EventAccessory::create(['event_id' => $this->event1->id, 'name' => 'barbeuc', 'cost' => 15, "quantity" => 2]);

        print("event_accessories tabled seeded\n");
    }


    private function event_products ()
    {
        EventProduct::create(['event_id' => $this->event1->id, 'product_id' => $this->prod_chips_bbq->id, 'cost' => 0.3, 'quantity_bought' => 50]);
        EventProduct::create(['event_id' => $this->event1->id, 'cost' => 1.5, 'quantity_bought' => 50, 'price' => 3, 'name' => 'saucisse']);

        EventProduct::create(['event_id' => $this->event2->id, 'cost' => 1.5, 'quantity_bought' => 80, 'price' => 3.2, 'name' => 'saucisse']);

        print("event_products tabled seeded\n");
    }


    private function restockings ()
    {
        $this->restocking = Restocking::create(['date' => '2017-09-03', 'cost' => 102.25, 'description' => 'courses de rentrée']);

        print("restockings tabled seeded\n");
    }


    private function product_restocking ()
    {
        $this->restocking->products()
                         ->syncWithoutDetaching([
                             $this->prod_pizza_royale->id     => ['quantity' => 20],
                             $this->prod_pizza_4_fromages->id => ['quantity' => 20],
                             $this->prod_chips_bbq->id        => ['quantity' => 50],
                         ]);

        print("product_restocking tabled seeded\n");
    }


    private function purchases ()
    {
        Purchase::create(['cost' => 150, 'description' => 'lave vaisselle', 'date' => '2017-09-20']);
        Purchase::create(['cost' => 3, 'description' => 'tasses', 'date' => '2017-09-20', 'quantity' => 15,]);
        Purchase::create(['cost' => 60, 'description' => 'fours', 'date' => '2017-09-20', 'quantity' => 2]);

        print("purchases tabled seeded\n");
    }


    private function money_addings ()
    {
        MoneyAdding::create(['amount' => 200, 'date' => '2017-09-10', 'reason' => 'répartition budgets BDE']);

        print("money_addings tabled seeded\n");
    }
}
