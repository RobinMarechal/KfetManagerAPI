<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;

class Triggers extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up ()
    {
        DB::unprepared("CREATE TRIGGER `events_set_date_as_today_if_null` BEFORE INSERT ON `events`
                            FOR EACH ROW BEGIN
                        IF NEW.date IS NULL THEN
                            SET NEW.date = CURRENT_DATE;
                        END IF;
                        END");

        DB::unprepared("CREATE TRIGGER `money_addings_set_date_as_today_if_null` BEFORE INSERT ON `money_addings`
                         FOR EACH ROW BEGIN
                        IF NEW.date IS NULL THEN
                            SET NEW.date = CURRENT_DATE;
                        END IF;
                        END");


        DB::unprepared("CREATE TRIGGER `restockings_set_date_as_today_if_null` BEFORE INSERT ON `restockings`
                         FOR EACH ROW BEGIN
                        IF NEW.date IS NULL THEN
                            SET NEW.date = CURRENT_DATE;
                        END IF;
                        END");


        DB::unprepared("CREATE TRIGGER `delete_order_product_on_order_deletion` BEFORE DELETE ON `orders`
                         FOR EACH ROW BEGIN
                        END");


        DB::unprepared("CREATE TRIGGER `set_date_as_today_if_null` BEFORE INSERT ON `money_addings`
                         FOR EACH ROW BEGIN
                        IF NEW.date IS NULL THEN
                            SET NEW.date = CURRENT_DATE;
                        END IF;
                        END");


        DB::unprepared("CREATE TRIGGER `purchases_set_date_as_today_if_null` BEFORE INSERT ON `purchases`
                         FOR EACH ROW BEGIN
                        IF NEW.date IS NULL THEN
                            SET NEW.date = CURRENT_DATE;
                        END IF;
                        END");


        DB::unprepared("CREATE TRIGGER `update_kfet_on_event_accessory_insert` AFTER INSERT ON `event_accessories`
                         FOR EACH ROW BEGIN
                                SET @cost = NEW.cost;
                                SET @quantity = NEW.quantity;
                                SET @totalCost = @cost * @quantity;
                                
                                SET @balance = 0;
                                        (SELECT balance
                                 INTO @balance
                                 FROM kfet
                                 ORDER BY id DESC
                                 LIMIT 1);
                                        
                                SET @newBalance = @balance - @totalCost;
                                
                                        INSERT INTO kfet (balance, reason_table, reason_type, reason_id) VALUES (@newBalance, 'event_accessories','INSERT', NEW.id);
                                    
                            END");


        DB::unprepared("CREATE TRIGGER `update_kfet_on_event_accessory_update` AFTER UPDATE ON `event_accessories`
                         FOR EACH ROW BEGIN
                                SET @cost = NEW.cost;
                                SET @quantity = NEW.quantity - OLD.quantity;
                                SET @totalCost = @cost * @quantity;
                                
                                SET @balance = 0;
                                        (SELECT balance
                                 INTO @balance
                                 FROM kfet
                                 ORDER BY id DESC
                                 LIMIT 1);
                                        
                                SET @newBalance = @balance - @totalCost;
                                
                                        INSERT INTO kfet (balance, reason_table, reason_type, reason_id) VALUES (@newBalance, 'event_accessories','UPDATE', NEW.id);
                            
                            END");


        DB::unprepared("CREATE TRIGGER `update_kfet_and_stocks_on_product_restocking` AFTER INSERT ON `product_restocking`
                         FOR EACH ROW BEGIN
                                SET @quantity = NEW.quantity;
                                SET @product_id = NEW.product_id;
                                    
                                    SET @quantity = 0;
                                    
                                                (SELECT quantity
                                     INTO @quantity
                                     FROM products
                                     WHERE id = @product_id);
                                                
                                    SET @newStock = @quantity + @quantity;
                                    
                                                UPDATE products
                                    SET quantity = @newStock
                                    WHERE id = @product_id;
                                    
                            END");


        DB::unprepared("CREATE TRIGGER `update_kfet_on_event_product_insertion` AFTER INSERT ON `event_products`
                         FOR EACH ROW BEGIN
                                SET @unitCost = NEW.cost;
                                SET @quantity = NEW.quantity_bought;
                                SET @totalCost = @unitCost * @quantity;
                                SET @balance = 0;
                                
                                IF @totalCost != 0
                                THEN
                                                (SELECT balance
                                     INTO @balance
                                     FROM kfet
                                     ORDER BY id DESC
                                     LIMIT 1);
                                                
                                    SET @newBalance = @balance - @totalCost;
                                    
                                                INSERT INTO kfet (balance, reason_table, reason_type, reason_id) VALUES (@newBalance, 'event_products', 'INSERT', NEW.id);
                                            END IF;
                            
                            END");


        DB::unprepared("CREATE TRIGGER `update_kfet_on_event_product_update` AFTER UPDATE ON `event_products`
                         FOR EACH ROW BEGIN
                                SET @balance = 0;
                                SET @quantityBought = NEW.quantity_bought - OLD.quantity_bought;
                                SET @quantitySold = NEW.quantity_sold - OLD.quantity_sold;
                                SET @price = NEW.price;
                                SET @cost = NEW.cost;
                                
                                SET @toPay = @quantityBought * @cost;
                                SET @toCollect = @quantitySold * @price;
                                
                                        (SELECT balance
                                 INTO @balance
                                 FROM kfet
                                 ORDER BY id DESC
                                 LIMIT 1);
                                
                                SET @newBalance = @balance - @toPay + @toCollect;
                                
                                            INSERT INTO kfet (balance, reason_table, reason_type, reason_id) VALUES (@newBalance, 'event_products', 'UPDATE', NEW.id);
                                    
                            END");


        DB::unprepared("CREATE TRIGGER `update_kfet_on_money_addings` AFTER INSERT ON `money_addings`
                         FOR EACH ROW BEGIN
                                SET @amount = NEW.amount;
                                SET @balance = 0;
                                
                                IF @amount != 0
                                THEN
                                                (SELECT balance
                                     INTO @balance
                                     FROM kfet
                                     ORDER BY id DESC
                                     LIMIT 1);
                                                
                                    SET @newBalance = @balance + @amount;
                                    
                                                INSERT INTO kfet (balance, reason_table, reason_type, reason_id) VALUES (@newBalance, 'INSERT', 'INSERT', NEW.id);
                                        END IF;
                            
                            END");


        DB::unprepared("CREATE TRIGGER `update_kfet_on_order_product_if_no_menu` AFTER INSERT ON `order_product`
                         FOR EACH ROW BEGIN
                            SET @menuId = NULL;
                            
                            SELECT menu_id INTO @menuId
                            FROM orders
                            WHERE orders.id = NEW.order_id;
                            
                            IF @menuID IS NULL THEN
                                SET @balance = 0;
                                SET @price = 0;
                                SET @quantity = NEW.quantity;
                                
                                ### price
                                SELECT price INTO @price 
                                FROM products
                                WHERE products.id = NEW.product_id;
                                
                                IF @quantity != 0 AND @price != 0 THEN
                                
                                    ### balance
                                    SELECT balance INTO @balance
                                    FROM kfet 
                                    ORDER BY id DESC 
                                    LIMIT 1;
                                    
                                    SET @newBalance = @balance + @price * @quantity;
                                    
                                    INSERT INTO kfet (balance, reason_table, reason_type, reason_id)
                                    VALUES (@newBalance, 'order_product', 'INSERT', NEW.id);
                                
                                END IF;
                                
                            END IF;
                        END");


        DB::unprepared("CREATE TRIGGER `update_kfet_on_orders_menu_id_not_null` AFTER INSERT ON `orders`
                         FOR EACH ROW BEGIN
                            IF NEW.menu_id IS NOT NULL THEN
                                SET @balance = 0;
                                SET @menuPrice = 0;
                                
                                #### Get back the balance value
                                (SELECT balance
                                 INTO @balance
                                 FROM kfet
                                 ORDER BY id DESC
                                 LIMIT 1);
                                ####
                                
                                #### Select the price of the menu
                                (SELECT price 
                                 INTO @price 
                                 FROM menus 
                                 WHERE menus.id = NEW.menu_id);
                                ####
                                
                                SET @newBalance = @balance + @price;
                                
                                
                                #### Actualize the new balance value
                                INSERT INTO kfet (balance, reason_table, reason_type, reason_id)
                                    VALUES (@newBalance, 'orders', 'INSERT', NEW.id);
                                ####
                            END IF;
                        END");


        DB::unprepared("CREATE TRIGGER `update_kfet_on_purchases` AFTER INSERT ON `purchases`
                         FOR EACH ROW BEGIN
                                SET @cost = NEW.cost;
                                SET @quantity = NEW.quantity;
                                SET @totalPaid = @cost * @quantity;
                                SET @balance = 0;
                                
                                IF @cost != 0 AND @quantity != 0
                                THEN
                                                (SELECT balance
                                     INTO @balance
                                     FROM kfet
                                     ORDER BY id DESC
                                     LIMIT 1);
                                                
                                    SET @newBalance = @balance - @totalPaid;
                                    
                                                INSERT INTO kfet (balance, reason_table, reason_type, reason_id) VALUES (@newBalance, 'purchases', 'INSERT', NEW.id);
                                        END IF;
                            
                            END");


        DB::unprepared("CREATE TRIGGER `update_stock_on_order_product` AFTER INSERT ON `order_product`
                         FOR EACH ROW BEGIN
                                SET @quantity = NEW.quantity;
                                SET @productId = NEW.product_id;
                        
                                SET @actualStock = 0;
                                   
                                ### stock
                                (SELECT quantity 
                                 INTO @actualStock 
                                 FROM products 
                                 WHERE id = @productId);
                                                
                                SET @newStock = @actualStock - @quantity;
                                    
                                UPDATE products 
                                SET quantity = @newStock 
                                WHERE id = @productId;     
                         END");


        DB::unprepared("CREATE TRIGGER `update_stock_on_order_product_deletion` BEFORE DELETE ON `order_product`
                        FOR EACH ROW 
                        BEGIN
                        END");

        //

        DB::unprepared("CREATE TRIGGER `set_price_from_subcategory_on_insert_if_null` BEFORE INSERT ON `products`
                         FOR EACH ROW BEGIN
                            SET @subcatId = NEW.subcategory_id;
                            IF @subcatId IS NOT NULL THEN
                                SET @subcatPrice = 0;
                        
                                SELECT price INTO @subcatPrice FROM subcategories WHERE id = @subcatId;
                        
                                IF NEW.price IS NULL THEN
                                    SET NEW.price = @subcatPrice;
                                END IF;
                            END IF;
                        END");

        DB::unprepared("CREATE TRIGGER `set_names_on_insert_if_product_id_not_null` BEFORE INSERT ON `event_products`
                         FOR EACH ROW BEGIN
                            SET @productId = NEW.product_id;
                            IF @productId IS NOT NULL THEN
                                SET @productName = \"\";
                                SET @productPrice = 0;
                        
                                SELECT name, price INTO @productName, @productPrice FROM products WHERE id = @productId;
                        
                                IF NEW.name IS NULL THEN
                                    SET NEW.name = @productName;
                                END IF;
                        
                                IF NEW.price IS NULL THEN
                                    SET NEW.price = @productPrice;
                                END IF;
                            END IF;
                        END");

        DB::unprepared("CREATE TRIGGER `set_names_on_insert_if_staff_id_not_null` BEFORE INSERT ON `customers`
                         FOR EACH ROW BEGIN
                            SET @staffId = NEW.staff_id;
                            IF @staffId IS NOT NULL THEN
                                SET @staffFN = \"\";
                                SET @staffLN = \"\";
                                
                                SELECT firstname, lastname INTO @staffFN, @staffLN FROM staff WHERE id = @staffId;
                        
                                IF NEW.firstname IS NULL THEN
                                    SET NEW.firstname = @staffFN;
                                END IF;
                        
                                IF NEW.lastname IS NULL THEN
                                    SET NEW.lastname = @staffLN;
                                END IF;
                            END IF;
                        END");
    }


    /**
     * Reverse the migrations.
     * @return void
     */
    public function down ()
    {
        DB::unprepared('DROP TRIGGER IF EXISTS `events_set_date_as_today_if_null`');
        DB::unprepared('DROP TRIGGER IF EXISTS `money_addings_set_date_as_today_if_null`');
        DB::unprepared('DROP TRIGGER IF EXISTS `restockings_set_date_as_today_if_null`');
        DB::unprepared('DROP TRIGGER IF EXISTS `delete_order_product_on_order_deletion`');
        DB::unprepared('DROP TRIGGER IF EXISTS `set_date_as_today_if_null`');
        DB::unprepared('DROP TRIGGER IF EXISTS `purchases_set_date_as_today_if_null`');
        DB::unprepared('DROP TRIGGER IF EXISTS `update_kfet_on_event_accessory_insert`');
        DB::unprepared('DROP TRIGGER IF EXISTS `update_kfet_on_event_accessory_update`');
        DB::unprepared('DROP TRIGGER IF EXISTS `update_kfet_and_stocks_on_product_restocking`');
        DB::unprepared('DROP TRIGGER IF EXISTS `update_kfet_on_event_product_insertion`');
        DB::unprepared('DROP TRIGGER IF EXISTS `update_kfet_on_event_product_update`');
        DB::unprepared('DROP TRIGGER IF EXISTS `update_kfet_on_money_addings`');
        DB::unprepared('DROP TRIGGER IF EXISTS `update_kfet_on_order_product_if_no_menu`');
        DB::unprepared('DROP TRIGGER IF EXISTS `update_kfet_on_orders_menu_id_not_null`');
        DB::unprepared('DROP TRIGGER IF EXISTS `update_kfet_on_purchases`');
        DB::unprepared('DROP TRIGGER IF EXISTS `update_stock_on_order_product`');
        DB::unprepared('DROP TRIGGER IF EXISTS `update_stock_on_order_product_deletion`');
        DB::unprepared('DROP TRIGGER IF EXISTS `set_price_from_subcategory_on_insert_if_null`');
        DB::unprepared('DROP TRIGGER IF EXISTS `set_names_on_insert_if_product_id_not_null`');
        DB::unprepared('DROP TRIGGER IF EXISTS `set_names_on_insert_if_staff_id_not_null`');
    }
}
