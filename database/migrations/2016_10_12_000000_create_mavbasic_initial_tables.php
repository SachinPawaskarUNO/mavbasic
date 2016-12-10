<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMavBasicInitialTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        DB::unprepared('CREATE PROCEDURE my_procedure( IN param INT(10) )  BEGIN  /* here your SP code */ END');

        /* count_rows(text, text)
         * This function gets the number of records in each table in the schema
         * Use the query below to get the count_rows
         * select table_schema, table_name, count_rows(table_schema, table_name) from information_schema.tables
         *      where table_schema not in ('pg_catalog', 'information_schema') and table_type='BASE TABLE'
         *      order by 3 desc
         *
         */
        DB::unprepared ('create or replace function count_rows(schema text, tablename text) returns integer
            as $body$
                declare
                    result integer;
                    query varchar;
                begin
                    query := \'SELECT count(1) FROM \' || schema || \'.\' || tablename;
                    execute query into result;
                    return result;
                end;
            $body$
            language plpgsql;'
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//        DB::unprepared('DROP PROCEDURE IF EXISTS my_procedure');
        DB::unprepared('DROP function IF EXISTS count_rows(text, text)');
    }
}
