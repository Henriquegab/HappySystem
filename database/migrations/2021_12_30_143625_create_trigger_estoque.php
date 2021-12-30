<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateTriggerEstoque extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        DB::unprepared('
        

            CREATE TRIGGER Trigger_pedidos_produtos_insert AFTER INSERT
            ON pedidos_produtos
            FOR EACH ROW
            BEGIN
                UPDATE produtos SET estoque = estoque - NEW.quantidade
            WHERE id = NEW.produto_id;
            END

           

        
        ');

        DB::unprepared('
        

            CREATE TRIGGER Trigger_pedidos_produtos_update AFTER UPDATE
            ON pedidos_produtos
            FOR EACH ROW
            BEGIN
                UPDATE produtos SET estoque = estoque + OLD.quantidade - NEW.quantidade
            WHERE id = OLD.produto_id;
            END


           

        
        ');

        DB::unprepared('
        

            CREATE TRIGGER Trigger_pedidos_produtos_delete AFTER DELETE
            ON pedidos_produtos
            FOR EACH ROW
            BEGIN
                UPDATE produtos SET estoque = estoque + OLD.quantidade
            WHERE id = OLD.produto_id;
            END


           

        
        ');

        


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER `Trigger_pedidos_produtos_delete`');
        DB::unprepared('DROP TRIGGER `Trigger_pedidos_produtos_update`');
        DB::unprepared('DROP TRIGGER `Trigger_pedidos_produtos_insert`');
    }
}
