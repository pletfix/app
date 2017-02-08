<?php

namespace App\Controllers;

use Core\Services\Contracts\Database;

class TestModel
{
    public $id;

    function __construct()
    {
        $this->id = 1;
    }
}

class TestDBController extends Controller
{
    private $t = 0;

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
    }

    /**
     * Show the index page.
     *
     * @return string
     */
    public function index()
    {
//        benchmark('fetig!!!', function($loop) {
//            echo $loop . ' ';
//            sleep(1);
//        }, 2);


//        $db = database('sqlsrv');
//        echo $db->version();
//        $schema->createTable('table5', ['a' => ['type' => 'string']]);
       // $db->insert('table1', ['a' => 'hallo']);
        //$db->insert('table1', ['flag' => true]);
//        dd($db->scalar('select top 1 a from table1'));


//        $stores = ['sqlite'];
//        $stores = ['sqlsrv'];
//        $stores = ['pgsql'];
//        $stores = ['mysql'];
//        $stores = ['mysql', 'pgsql', 'sqlite'];
        $stores = ['mysql', 'pgsql', 'sqlite', 'sqlsrv'];
        foreach ($stores as $store) {
            echo '<h1>' . $store . '</h1>';
            $this->test1($store);
            $this->test2($store);
            $this->test3($store);
            $this->test4($store);
        }

        return '<p><b>Successful!</b></p>';
    }

    /**
     * Run Test 1
     * @param string $store
     */
    public function test1($store)
    {
        $t = $this->t;

        echo "<p><b>Base Functionality of the Database Access Layer</b></p>";

        $collation = $this->getCollation($store, true);
        $columns = [
            'id'   => [
                'type'      => 'identity',
                'size'      => null,
                'scale'     => null,
                'nullable'  => false,
                'default'   => null,
                'collation' => null,
                'comment'   => null,
	        ],
            'small1'      => ['type' => 'smallint', 'nullable' => true],
            'integer1'    => ['type' => 'integer', 'comment' => 'I am cool!'],
            'integer2'    => ['type' => 'unsigned', 'nullable' => true],
            'bigint1'     => ['type' => 'bigint',  'nullable' => true],
            'numeric1'    => ['type' => 'numeric', 'nullable' => true],
            'numeric2'    => ['type' => 'numeric', 'size' => 4, 'scale' => 1, 'nullable' => true],
            'float1'      => ['type' => 'float', 'default' => 3.14, 'comment' => '3*3=9'],
            'float2'      => ['type' => 'float', 'nullable' => true],
            'string1'     => ['type' => 'string', 'nullable' => true],
            'string2'     => ['type' => 'string', 'size' => 50, 'default' => 'Panama'],
            'string3'     => ['type' => 'string', 'collation' => $collation, 'nullable' => true],
            'text1'       => ['type' => 'text', 'nullable' => true],
            'guid1'       => ['type' => 'guid', 'nullable' => true],
            'binary1'     => ['type' => 'binary','nullable' => true],
            'binary2'     => ['type' => 'binary', 'size' => 4, 'nullable' => true],
            'blob1'       => ['type' => 'blob', 'nullable' => true],
            'boolean1'    => ['type' => 'boolean', 'nullable' => true],
            'date1'       => ['type' => 'date', 'nullable' => true],
            'datetime1'   => ['type' => 'datetime', 'nullable' => true],
            'timestamp1'  => ['type' => 'timestamp', 'default' => 'CURRENT_TIMESTAMP'],
            'time1'       => ['type' => 'time', 'nullable' => true],
            'array1'      => ['type' => 'array', 'nullable' => true, 'comment' => 'Eine Rose ist eine Rose.'],
            'json1'       => ['type' => 'json', 'nullable' => true],
            'object1'     => ['type' => 'object', 'nullable' => true],
        ];

        // -------------------------------------------------------------------
        $t++;
        echo "Test $t: Connect<br/>";

        $db = database($store);
        $schema = $db->schema();
        $version = $db->version();
        if (is_null($version)) {
            dd("Test {$t}a failed!");
        }

        // -------------------------------------------------------------------
        $t++;
        echo "Test $t: Create $ Show Tables<br/>";

        try {
            $schema->dropTable('table1');
        } catch (\Exception $e) {
        }

        $schema->createTable('table1', $columns, ['comment' => 'Eine Testtabelle']);

        $tables = $schema->tables();
        if (count($tables) != 1) {
            dd("Test {$t}a failed!");
        }
        if (key($tables) != 'table1') {
            dd("Test {$t}b failed!");
        }
        if ($tables['table1']['name'] != 'table1') {
            dd("Test {$t}c failed!");
        }
        if ($tables['table1']['comment'] != 'Eine Testtabelle') {
            dd("Test {$t}d failed!");
        }

        // -------------------------------------------------------------------
        $t++;
        echo "Test $t: Rename Tables<br/>";
        try {
            $schema->dropTable('table3');
        } catch (\Exception $e) {
        }
        $schema->renameTable('table1', 'table3');
        $tables = $schema->tables();
        if (key($tables) != 'table3') {
            dd("Test {$t}a failed!");
        }
        $schema->renameTable('table3', 'table1');

        // -------------------------------------------------------------------
        $t++;
        echo "Test $t: Insert $ query Datasets<br/>";

        $n = $db->lastInsertId();
        if ($n !== 0) {
            dd("Test {$t}a failed!");
        }

        $db->insert('table1', ['integer1' => 1, 'integer2' => 11]);
        $n = $db->lastInsertId();
        if ($n !== 1) {
            dd("Test {$t}b failed!");
        }
        /** @noinspection SqlNoDataSourceInspection */
        $rows = $db->query('select * from table1');
        if (count($rows) != 1) {
            dd("Test {$t}c failed!");
        }
        if ($rows[0]['integer2'] != 11) {
            dd("Test {$t}d failed!");
        }

        // insert bulk

        $db->insert('table1', [
            ['integer1' => 1, 'integer2' => 12],
            ['integer1' => 1, 'integer2' => 13, 'text1' => 'hello'],
            ['integer1' => 2, 'integer2' => 21],
            ['integer1' => 2],
        ]);
        /** @noinspection SqlNoDataSourceInspection */
        $rows = $db->query('select * from table1');
        if (count($rows) != 5) {
            dd("Test {$t}e failed!");
        }

        $db->insert('table1', ['integer1' => 2, 'integer2' => 23]);
        $n = $db->lastInsertId();
        if ($n != 6) {
            dd("Test {$t}f failed!");
        }

        // -------------------------------------------------------------------
        $t++;
        echo "Test $t: Binding<br/>";

        /** @noinspection SqlNoDataSourceInspection */
        /** @noinspection SqlDialectInspection */
        $rows = $db->query('select * from table1 where integer1=? order by integer2 desc', [1]);
        if (count($rows) != 3) {
            dd("Test {$t}b failed!");
        }
        if ($rows[0]['integer2'] != 13) {
            dd("Test {$t}c failed!");
        }
        if ($rows[0]['text1'] != 'hello') {
            dd("Test {$t}d failed!");
        }
        /** @noinspection SqlNoDataSourceInspection */
        /** @noinspection SqlDialectInspection */
        $rows = $db->query('select * from table1 where integer1=:integer1 order by integer2 desc', ['integer1' => 1]);
        if (count($rows) != 3) {
            dd("Test {$t}e failed!");
        }
        if ($rows[0]['integer2'] != 13) {
            dd("Test {$t}f failed!");
        }

        // -------------------------------------------------------------------
        $t++;
        echo "Test $t: Update without where condition<br/>";

        $db->update('table1', ['float1' => 3.14]);
        /** @noinspection SqlNoDataSourceInspection */
        /** @noinspection SqlDialectInspection */
        $rows = $db->query('select * from table1 where float1=:float1', ['float1' => 3.14]);
        if (count($rows) != 6) {
            dd("Test {$t}c failed!");
        }


        // -------------------------------------------------------------------
        $t++;
        echo "Test $t: Update using question mark placeholders<br/>";

        $n = $db->update('table1', ['integer1' => 3, 'integer2' => 88], 'integer2=?', [13]);
        if ($n != 1) {
            dd("Test {$t}b failed!");
        }
        /** @noinspection SqlNoDataSourceInspection */
        /** @noinspection SqlDialectInspection */
        $rows = $db->query('select * from table1 where integer1=? order by integer2 desc', [3]);
        if (count($rows) != 1) {
            dd("Test {$t}c failed!");
        }
        if ($rows[0]['integer2'] != '88') {
            dd("Test {$t}d failed!");
        }

        // -------------------------------------------------------------------
        $t++;
        echo "Test $t: Update using named placeholders <br/>";

        $n = $db->update('table1', ['integer1' => 4, 'integer2' => 33], 'integer2<:integer2', ['integer2' => 13]);
        if ($n != 2) {
            dd("Test {$t}b failed!");
        }
        /** @noinspection SqlNoDataSourceInspection */
        /** @noinspection SqlDialectInspection */
        $rows = $db->query('select * from table1 where integer1=:integer1 order by integer2 desc', ['integer1' => 4]);
        if (count($rows) != 2) {
            dd("Test {$t}c failed!");
        }
        if ($rows[0]['integer2'] != '33') {
            dd("Test {$t}d failed!");
        }

        // -------------------------------------------------------------------
        $t++;
        echo "Test $t: Delete<br/>";

        $n = $db->delete('table1', 'integer1=:integer1', ['integer1' => 3]);
        if ($n != 1) {
            dd("Test {$t}a failed!");
        }
        $n = $db->delete('table1', 'integer1=?', [4]);
        if ($n != 2) {
            dd("Test {$t}b failed!");
        }
        /** @noinspection SqlNoDataSourceInspection */
        $rows = $db->query('select * from table1');
        if (count($rows) != 3) {
            dd("Test {$t}c failed!");
        }

        // -------------------------------------------------------------------
        $t++;
        echo "Test $t: Truncate<br/>";

        $db->truncate('table1');
        /** @noinspection SqlNoDataSourceInspection */
        $rows = $db->query('select * from table1');
        if (count($rows) != 0) {
            dd("Test {$t}a failed!");
        }

        // -------------------------------------------------------------------
        $t++;
        if ($store != 'pgsql') {  // TODO Test wegen Postgres übersprungen!!!! Problem mit case sensitive und Collate noch nicht gelöst

            echo "Test $t: Case sensitiv<br/>";
            $db->insert('table1', ['integer1' => 11, 'string1' => 'aa', 'string3' => 'aa']);
            $db->insert('table1', ['integer1' => 22, 'string1' => 'AA', 'string3' => 'AA']);

            /** @noinspection SqlNoDataSourceInspection */
            /** @noinspection SqlDialectInspection */
            $rows = $db->query('select * from table1 where string1=?', ['aa']); // string1 = utf8_unicode_ci
            if (count($rows) != 2) {
                dd("Test {$t}a failed!");
            }

            /** @noinspection SqlNoDataSourceInspection */
            /** @noinspection SqlDialectInspection */
            $rows = $db->query('select * from table1 where string3=?', ['aa']); // string3 = latin1_general_cs
            if (count($rows) != 1) {
                dd("Test {$t}b failed!");
            }
            if ($rows[0]['string1'] != 'aa') {
                dd("Test {$t}c failed!");
            }

        }

        // -------------------------------------------------------------------
        $t++;
        echo "Test $t: Drop Table<br/>";

        $schema->dropTable('table1');
        $tables = $schema->tables();
        if (count($tables) != 0) {
            dd("Test {$t}a failed!");
        }

        // -------------------------------------------------------------------
        $t++;
        echo "Test $t: Transaction Rollback<br/>";
        $schema->createTable('table1', $columns, ['comment' => 'Eine Testtabelle']);

        $error = false;
        try {
            $db->transaction(function (Database $db) use ($t) {
                $db->insert('table1', ['integer1' => 11]);
                /** @noinspection SqlNoDataSourceInspection */
                $rows = $db->query('select * from table1');
                if (count($rows) != 1) {
                    dd("Test {$t}a failed!");
                }
                $db->insert('table1', ['integer2' => 22]); // throw an error!
            });
        } catch (\Exception $e) {
            $error = true;
        }

        if (!$error) {
            dd("Test {$t}b failed!");
        }

        /** @noinspection SqlNoDataSourceInspection */
        $rows = $db->query('select * from table1');
        if (count($rows) != 0) {
            dd("Test {$t}v failed!");
        }

        // -------------------------------------------------------------------
        $t++;
        echo "Test $t: Transaction Commit<br/>";
        $db->truncate('table1');

        $db->transaction(function(Database $db) {
            $db->insert('table1', ['integer1' => 11]);
            $db->insert('table1', ['integer1' => 21, 'integer2' => 22]);
        });

        /** @noinspection SqlNoDataSourceInspection */
        $rows = $db->query('select * from table1');
        if (count($rows) != 2) {
            dd("Test {$t}a failed!");
        }

        // -------------------------------------------------------------------
        $t++;
        echo "Test $t: Interleaved Transaction Rollback<br/>";
        $db->truncate('table1');

        $error = false;
        try {
            $db->transaction(function(Database $db) use ($t) {
                $db->insert('table1', ['integer1' => 11]);
                $db->transaction(function(Database $db) use ($t) {
                    $db->insert('table1', ['integer1' => 21]);
                    $db->insert('table1', ['integer1' => 31, 'integer2' => 32]);
                    /** @noinspection SqlNoDataSourceInspection */
                    $rows = $db->query('select * from table1');
                    if (count($rows) != 3) {
                        dd("Test {$t}a failed!");
                    }
                });
                $db->insert('table1', ['integer2' => 42]); // throw an error!
            });
        } catch (\Exception $e) {
            $error = true;
        }

        if (!$error) {
            dd("Test {$t}b failed!");
        }

        /** @noinspection SqlNoDataSourceInspection */
        $rows = $db->query('select * from table1');
        if (count($rows) != 0) {
            dd("Test {$t}c failed!");
        }

        // -------------------------------------------------------------------
        $t++;
        echo "Test $t: Interleaved Transaction Commit<br/>";
        $db->truncate('table1');

        $db->transaction(function(Database $db) {
            $db->insert('table1', ['integer1' => 11]);
            $db->transaction(function(Database $db) {
                $db->insert('table1', ['integer1' => 21]);
                $db->insert('table1', ['integer1' => 31, 'integer2' => 32]);
            });
            $db->insert('table1', ['integer1' => 41, 'integer2' => 42]);
        });

        /** @noinspection SqlNoDataSourceInspection */
        $rows = $db->query('select * from table1');
        if (count($rows) != 4) {
            dd("Test {$t}a failed!");
        }

        // -------------------------------------------------------------------
        $t++;
        echo "Test $t: Transaction Rollback to Level 1<br/>";
        $db->truncate('table1');

        $db->insert('table1', ['integer1' => 1]);

        $db->beginTransaction(); // 1 -> level 1, 1 recordset
        $db->insert('table1', ['integer1' => 11]);
        /** @noinspection SqlNoDataSourceInspection */
        $rows = $db->query('select * from table1');
        if (count($rows) != 2) {
            dd("Test {$t}a failed!");
        }

        $db->beginTransaction(); // 2 ->  level 2, 2 recordsets
        $db->insert('table1', ['integer1' => 21]);
        /** @noinspection SqlNoDataSourceInspection */
        $rows = $db->query('select * from table1');
        if (count($rows) != 3) {
            dd("Test {$t}b failed!");
        }

        $db->beginTransaction(); // 3 -> level 3, 3 recordsets
        $db->insert('table1', ['integer1' => 31]);

        $db->beginTransaction(); // 4 -> level 4, 4 recordsets
        if ($db->transactionLevel() != 4) {
            dd("Test {$t}c failed!");
        }
        $db->insert('table1', ['integer1' => 41]); // 5 recordsets
        /** @noinspection SqlNoDataSourceInspection */
        $rows = $db->query('select * from table1');
        if (count($rows) != 5) {
            dd("Test {$t}d failed!");
        }
        $db->rollBack(); // 4 -> 4 recordsets, back to level 3
        if ($db->transactionLevel() != 3) {
            dd("Test {$t}e failed!");
        }
        $db->rollBack(); // 3 -> 3 recordsets, back to level 2
        if ($db->transactionLevel() != 2) {
            dd("Test {$t}f failed!");
        }
        /** @noinspection SqlNoDataSourceInspection */
        $rows = $db->query('select * from table1');
        if ($db->supportsSavepoints()) {
            if (count($rows) != 3) {
                dd("Test {$t}g failed!");
            }
        }
        else {
            if (count($rows) != 5) {
                dd("Test {$t}g failed!");
            }
        }
        $db->insert('table1', ['integer1' => 31]); // 4 recordsets
        /** @noinspection SqlNoDataSourceInspection */
        $rows = $db->query('select * from table1');
        if ($db->supportsSavepoints()) {
            if (count($rows) != 4) {
                dd("Test {$t}g failed!");
            }
        }
        else {
            if (count($rows) != 6) {
                dd("Test {$t}g failed!");
            }
        }

        $db->rollBack(); // 2 -> 2 recordsets, back to level 1
        if ($db->transactionLevel() != 1) {
            dd("Test {$t}i failed!");
        }
        /** @noinspection SqlNoDataSourceInspection */
        $rows = $db->query('select * from table1');
        if ($db->supportsSavepoints()) {
            if (count($rows) != 2) {
                dd("Test {$t}g failed!");
            }
        }
        else {
            if (count($rows) != 6) {
                dd("Test {$t}g failed!");
            }
        }

        $db->commit();  // 2 recordsets, set level 0
        if ($db->transactionLevel() != 0) {
            dd("Test {$t}k failed!");
        }
        /** @noinspection SqlNoDataSourceInspection */
        $rows = $db->query('select * from table1');
        if ($db->supportsSavepoints()) {
            if (count($rows) != 2) {
                dd("Test {$t}g failed!");
            }
        }
        else {
            if (count($rows) != 6) {
                dd("Test {$t}g failed!");
            }
        }

        $error = false;
        try {
            $db->rollBack();
        } catch (\Exception $e) {
            $error = true;
        }
        if (!$error) {
            dd("Test {$t}m failed!");
        }

        /** @noinspection SqlNoDataSourceInspection */
        $rows = $db->query('select * from table1');
        if ($db->supportsSavepoints()) {
            if (count($rows) != 2) {
                dd("Test {$t}g failed!");
            }
        }
        else {
            if (count($rows) != 6) {
                dd("Test {$t}g failed!");
            }
        }

        $this->t = $t;
    }

    private function getData($columns)
    {
        $guid = '6921339e-cb74-20e4-6570-e3501e790cd7';
        //$arr = [10, 20, 30];
        $data = [];

        foreach ($columns as $column => $options) {
            if ($column == 'id') continue;
            switch ($options['type']) {
                case 'smallint':    // 2 Byte
                case 'integer':     // 4 Byte
                case 'unsigned':     // 4 Byte
                case 'int': // (alias)
                case 'bigint':      // 8 Byte
                    $value = 1;
                    break;

                case 'numeric':
                    $value = (string)round(3.14, isset($options['size']) ? $options['size'] : 0);
                    break;

                case 'float':
                    $value = 3.14;
                    break;

                case 'string':
                case 'text':
                    $value = 'hello';
                    break;

                case 'guid':
                    $value = $guid;
                    break;

//                case 'binary':
//                case 'blob':
//                    $value = 'binary';
//                    break;

                case 'boolean':
                case 'bool': // (alias)
//                    $value = 1; // 'true'; todo bisher bei mysql
                    $value = true; // für postgres
                    break;

                case 'date':
                    $value = '2017-01-02'; // todo als DateTime
                    break;

                case 'datetime':
//                case 'timestamp':  // datetime with time zone
                    $value = '2017-01-02 15:30:10'; // todo als DateTime
                    break;

                case 'time':
                    $value = '15:30:10';
                    break;

//                // todo
//                case 'array':
//                    $value = (string)$arr;
//                    break;
//
//                case 'json':
//                    $value = json_encode($arr);
//                    break;
//
//                case 'object':
//                    $value = serialize(collect($arr));
//                    return 'TEXT';
                default:
                    $value = null;
            }

            $data[$column] = $value;
        }

        return $data;
    }

    /**
     * Run Test 2
     * @param string $store
     */
    public function test2($store)
    {
        $t = $this->t;
        $db = database($store);
        $schema = $db->schema();

        echo "<p><b>Explicit / Implicit inserting of not-null fields with and without defaults</b></p>";

        $collation = $this->getCollation($store, true);
        $columns = [
            'id'   => [
                'type'      => 'identity',
                'size'      => null,
                'scale'     => null,
                'nullable'  => false,
                'default'   => null,
                'collation' => null,
                'comment'   => null,
            ],
            'small1'      => ['type' => 'smallint', 'nullable' => true],
            'integer1'    => ['type' => 'integer', 'nullable' => true],
            'integer2'    => ['type' => 'unsigned', 'nullable' => true],
            'bigint1'     => ['type' => 'bigint',  'nullable' => true],
            'numeric1'    => ['type' => 'numeric', 'nullable' => true],
            'numeric2'    => ['type' => 'numeric', 'size' => 4, 'scale' => 2, 'nullable' => true],
            'float1'      => ['type' => 'float', 'nullable' => true],
            'string1'     => ['type' => 'string', 'nullable' => true],
            'string2'     => ['type' => 'string', 'size' => 50, 'nullable' => true],
            'string3'     => ['type' => 'string', 'collation' => $collation, 'nullable' => true],
            'text1'       => ['type' => 'text', 'nullable' => true],
            'guid1'       => ['type' => 'guid', 'nullable' => true],
//            'binary1'     => ['type' => 'binary','nullable' => true], // todo auch diese Felder testen
//            'binary2'     => ['type' => 'binary', 'size' => 4, 'nullable' => true],
//            'blob1'       => ['type' => 'blob', 'nullable' => true],
            'boolean1'    => ['type' => 'boolean', 'nullable' => true],
//            'date1'       => ['type' => 'date', 'nullable' => true],
//            'datetime1'   => ['type' => 'datetime', 'nullable' => true],
//            'timestamp1'  => ['type' => 'timestamp', 'nullable' => true],
//            'time1'       => ['type' => 'time', 'nullable' => true],
//            'array1'      => ['type' => 'array', 'nullable' => true],
//            'json1'       => ['type' => 'json', 'nullable' => true],
//            'object1'     => ['type' => 'object', 'nullable' => true],
        ];

        // -------------------------------------------------------------------
        $t++;
        echo "Test $t: All fields are set<br/>";

        try {
            $schema->dropTable('table1');
        } catch (\Exception $e) {
        }
        //$s = $db->errorInfo();
        $schema->createTable('table1', $columns);
        $data = $this->getData($columns);
        $db->insert('table1', $data);
        /** @noinspection SqlNoDataSourceInspection */
        /** @noinspection SqlDialectInspection */
        $rows = $db->query('select * from table1 order by id desc');
        //dd($rows);
        foreach ($rows[0] as $column => $value) {
            if ($column == 'id') {
                if ($value != 1) { // todo !==
                    dd("Test {$t}a failed by column $column");
                }
            }
            else if ($column == 'guid1') {
                if (strtolower($value) !== $data[$column]) {
                    dd("Test {$t}a failed by column $column");
                }
            }
            else {
                if ($value != $data[$column]) { // todo !==
                    dd("Test {$t}a failed by column $column");
                }
            }
        }

        // -------------------------------------------------------------------
        $t++;
        echo "Test $t: A nullable field is not set (without default)<br/>";

        foreach ($columns as $column => $options) {
            if ($column == 'id') continue;
            $data = $this->getData($columns);
            unset($data[$column]);

            $db->insert('table1', $data);
            /** @noinspection SqlNoDataSourceInspection */
            /** @noinspection SqlDialectInspection */
            $rows = $db->query('select * from table1 order by id desc');

            if (!is_null($rows[0][$column])) {
                dd("Test {$t}b failed by column $column");
            }
        }

        // -------------------------------------------------------------------
        $t++;
        echo "Test $t: Get a sclarar<br/>";

        $m = count($columns);

        /** @noinspection SqlNoDataSourceInspection */
        /** @noinspection SqlDialectInspection */
        $n = $db->scalar('select count(*) from table1');
        if ($n != $m) {
            dd("Test {$t}c failed");
        }

        // -------------------------------------------------------------------
        $t++;
        echo "Test $t: Get a cursor and check autoincrement<br/>";

        $id = 0;
        /** @noinspection SqlNoDataSourceInspection */
        /** @noinspection SqlDialectInspection */
        foreach ($db->cursor('select * from table1 order by id') as $row) {
            if ($row['id'] != ++$id) {
                dd("Test {$t}a failed");
            }
        };

        // -------------------------------------------------------------------
        $t++;
        echo "Test $t: Fetch a single Recordset<br/>";

        /** @noinspection SqlNoDataSourceInspection */
        /** @noinspection SqlDialectInspection */
        $rows = $db->single('select * from table1 where id=1');
        if (!is_array($rows)) {
            dd("Test {$t}a failed");
        }

        /** @noinspection SqlNoDataSourceInspection */
        /** @noinspection SqlDialectInspection */
        $model = $db->single('select * from table1 where id=?',[1], TestModel::class);
        if (!($model instanceof TestModel)) {
            dd("Test {$t}b failed");
        }

        // -------------------------------------------------------------------
        $t++;
        echo "Test $t: Fetch a list of Models<br/>";

        /** @noinspection SqlNoDataSourceInspection */
        /** @noinspection SqlDialectInspection */
        $rows = $db->query('select * from table1', [], TestModel::class);

        if (!($rows[0] instanceof TestModel)) {
            dd("Test {$t}a failed");
        }

        // -------------------------------------------------------------------
        $t++;
        echo "Test $t: Get a cursor for Models<br/>";

        /** @noinspection SqlNoDataSourceInspection */
        /** @noinspection SqlDialectInspection */
        foreach ($db->cursor('select * from table1', [], TestModel::class) as $model) {
            if (!($model instanceof TestModel)) {
                dd("Test {$t}a failed");
            }
        };

        // -------------------------------------------------------------------
        $t++;
        echo "Test $t: A not-nullable field is not set (without default)<br/>";

        $schema->dropTable('table1');
        foreach ($columns as $column => $options) {
            if ($column == 'id') continue;
            $columns[$column]['nullable'] = false;
        }
        $schema->createTable('table1', $columns);

        foreach ($columns as $column => $options) {
            if ($column == 'id') continue;
            $data = $this->getData($columns);
            unset($data[$column]);

            $error = false;
            try {
                $db->insert('table1', $data);
            } catch (\Exception $e) {
                $error = true;
            }

            if (!$error) {
                dd("Test {$t}d failed by column $column");
            }
        }

        // -------------------------------------------------------------------
        $t++;
        echo "Test $t: A nullable field is not set (with default)<br/>";

        $defaults = $this->getData($columns);

        $schema->dropTable('table1');
        foreach ($columns as $column => $options) {
            if ($column == 'id') continue;
            $columns[$column]['nullable'] = true;
            if (!in_array($columns[$column]['type'], ['blob', 'text'])) { // BLOB/TEXT column can't have a default value // todo test
                $columns[$column]['default'] = $defaults[$column];
            } else {
                $defaults[$column] = null;
            }
        }
        $schema->createTable('table1', $columns);

        foreach ($columns as $column => $options) {
            if ($column == 'id') continue;
            $data = $this->getData($columns);
            unset($data[$column]);

            $db->insert('table1', $data);
            /** @noinspection SqlNoDataSourceInspection */
            /** @noinspection SqlDialectInspection */
            $rows = $db->query('select * from table1 order by id desc');

            if ($column == 'guid1') {
                if (strtolower($rows[0][$column]) !== $defaults[$column]) {
                    dd("Test {$t}e failed by column $column");
                }
            }
            else {
                if ($rows[0][$column] != $defaults[$column]) { // todo !==
                    dd("Test {$t}e failed by column $column");
                }
            }
        }

        // -------------------------------------------------------------------
        $t++;
        echo "Test $t: A not-nullable field is not set (with default)<br/>";

        $defaults = $this->getData($columns);

        $schema->dropTable('table1');
        foreach ($columns as $column => $options) {
            if ($column == 'id') continue;
            if (in_array($columns[$column]['type'], ['blob', 'text'])) { // BLOB/TEXT column can't have a default value // todo test
                unset($columns[$column]);
                continue;
            }
            $columns[$column]['nullable'] = false;
            $columns[$column]['default'] = $defaults[$column];
        }
        $schema->createTable('table1', $columns);

        foreach ($columns as $column => $options) {
            if ($column == 'id') continue;
            $data = $this->getData($columns);
            unset($data[$column]);
            if (!in_array($columns[$column]['type'], ['blob', 'text'])) { // BLOB/TEXT column can't have a default value // todo test
                $db->insert('table1', $data);
                /** @noinspection SqlNoDataSourceInspection */
                /** @noinspection SqlDialectInspection */
                $rows = $db->query('select * from table1 order by id desc');
                if ($column == 'guid1') {
                    if (strtolower($rows[0][$column]) !== $defaults[$column]) {
                        dd("Test {$t}f failed by column $column");
                    }
                }
                else {
                    if ($rows[0][$column] != $defaults[$column]) { // todo !==
                        dd("Test {$t}f failed by column $column");
                    }
                }
            }

        }

        // -------------------------------------------------------------------
        $t++;
        echo "Test $t: A not-nullable field is explizit set null (with default)<br/>";

        foreach ($columns as $column => $options) {
            if ($column == 'id') continue;
            $data = $this->getData($columns);
            $data[$column] = null;

            $error = false;
            try {
                $db->insert('table1', $data);
            } catch (\Exception $e) {
                $error = true;
            }

            if (!$error) {
                dd("Test {$t}g failed by column $column");
            }
        }

        $this->t = $t;
    }

    private function getCollation($store, $cs = false)
    {
        switch ($store) {
            case 'mysql':
                return $cs ? 'latin1_general_cs' : 'utf8_unicode_ci';

            case 'pgsql':
                return null;

            case 'sqlite':
                return $cs ? 'BINARY' : 'NOCASE';

            case 'sqlsrv':
                return $cs ? 'Latin1_General_CS_AS' : 'Latin1_General_CI_AS';
        }

        return null;
    }

    /**
     * Run Test 3
     * @param string $store
     */
    public function test3($store)
    {
        $t = $this->t;

        echo "<p><b>Modify columns</b></p>";

        $collation = $this->getCollation($store, true);
        $columns = [
            'id'   => [
                'type'      => 'identity',
                'size'      => null,
                'scale'     => null,
                'nullable'  => false,
                'default'   => null,
                'collation' => null,
                'comment'   => null,
            ],
            'small1'      => ['type' => 'smallint', 'nullable' => true],
            'integer1'    => ['type' => 'integer', 'comment' => 'I am cool!'],
            'integer2'    => ['type' => 'unsigned', 'nullable' => true],
            'bigint1'     => ['type' => 'bigint',  'nullable' => true],
            'bigint2'     => ['type' => 'bigint', 'nullable' => true],
            'numeric1'    => ['type' => 'numeric', 'nullable' => true],
            'numeric2'    => ['type' => 'numeric', 'size' => 4, 'scale' => 1, 'nullable' => true],
            'float1'      => ['type' => 'float', 'default' => 3.14, 'comment' => '3*3=9'],
            'float2'      => ['type' => 'float', 'default' => 3.14],
            'float3'      => ['type' => 'float', 'nullable' => true],
            'string1'     => ['type' => 'string', 'nullable' => true, 'comment' => 'lola'],
            'string2'     => ['type' => 'string', 'size' => 50, 'default' => 'Panama'],
            'string3'     => ['type' => 'string', 'collation' => $collation, 'nullable' => true],
            'text1'       => ['type' => 'text', 'nullable' => true],
            'text2'       => ['type' => 'text',  'collation' => $collation, 'nullable' => true],
            'guid1'       => ['type' => 'guid', 'nullable' => true],
            'binary1'     => ['type' => 'binary','nullable' => true],
            'binary2'     => ['type' => 'binary', 'size' => 4, 'nullable' => true],
            'blob1'       => ['type' => 'blob', 'nullable' => true],
            'boolean1'    => ['type' => 'boolean', 'nullable' => true],
            'date1'       => ['type' => 'date', 'nullable' => true],
            'datetime1'   => ['type' => 'datetime', 'nullable' => true],
            'timestamp1'  => ['type' => 'timestamp', 'default' => 'CURRENT_TIMESTAMP'],
            'time1'       => ['type' => 'time', 'nullable' => true],
            'array1'      => ['type' => 'array', 'nullable' => true, 'comment' => 'Eine Rose ist eine Rose.'],
            'json1'       => ['type' => 'json', 'nullable' => true],
            'object1'     => ['type' => 'object', 'nullable' => true],
        ];

        // defaults for create a column:
        $expected = $columns;
        foreach ($expected as $column => $attr) {
            if (!isset($expected[$column]['nullable'])) {
                $expected[$column]['nullable'] = false;
            }
        }

        $collation = $this->getCollation($store);
        $expected['numeric1']['size']  = 10;
        $expected['numeric1']['scale'] = 0;
        $expected['string1']['size'] = 255;
        $expected['string3']['size'] = 255;
        $expected['binary1']['size'] = 2;
        $expected['string1']['collation'] = $collation;
        $expected['string2']['collation'] = $collation;
        $expected['text1']['collation'] = $collation;

        // -------------------------------------------------------------------
        $t++;
        echo "Test $t: Show columns<br/>";

        $db = database($store);
        $schema = $db->schema();
        try {
            $schema->dropTable('table1');
        } catch (\Exception $e) {
        }
        $schema->createTable('table1', $columns, ['comment' => 'Eine Testtabelle']);

        $info = $schema->columns('table1');

        foreach ($info as $column => $attributes) {
            if ($attributes['name'] != $column) {
                dd("Test {$t}a failed!");
            }
            $orig = $expected[$column];
            foreach ($attributes as $key => $attr) {
                if ($key == 'name') continue;
                if ($attributes['type'] == 'binary' && ($key == 'size' || $key == 'scale'))  continue; // todo Typ binary eliminieren!
                if (!isset($orig[$key])) { $orig[$key] = null; }
                if ($attr !== $orig[$key]) {
                    dd("Test {$t}b failed by column {$column}, attribute {$key}!");
                }
            }
            foreach ($orig as $key => $attr) {
                if ($attributes['type'] == 'binary' && ($key == 'size' || $key == 'scale'))  continue; // todo Typ binary eliminieren!
                if (!isset($attributes[$key])) { $attributes[$key] = null; }
                if ($attr !== $attributes[$key]) {
                    dd("Test {$t}c failed by column {$column}, attribute {$key}!");
                }
            }
        }

        // -------------------------------------------------------------------
        $t++;
        echo "Test $t: Add columns<br/>";

        $db = database($store);
        $schema = $db->schema();
        try {
            $schema->dropTable('table1');
        } catch (\Exception $e) {
        }
        $schema->createTable('table1', ['x' => ['type'=>'integer', 'default'=>0]], ['comment' => 'Eine Testtabelle']);
        $db->insert('table1', ['x' => 1]);

        foreach ($columns as $column => $attributes) {
            if ($column == 'id') continue;
            $schema->addColumn('table1', $column, $attributes);
        }

        $info = $schema->columns('table1');

        foreach ($info as $column => $attributes) {
            if ($column == 'x') continue;
            if ($attributes['name'] != $column) {
                dd("Test {$t}a failed!");
            }
            $orig = $expected[$column];
            foreach ($attributes as $key => $attr) {
                if ($key == 'name') continue;
                if ($attributes['type'] == 'binary' && ($key == 'size' || $key == 'scale'))  continue; // todo Typ binary eliminieren!
                if (!isset($orig[$key])) { $orig[$key] = null; }
                if ($attr !== $orig[$key]) {
                    dd("Test {$t}b failed by column {$column}, attribute {$key}!");
                }
            }
            foreach ($orig as $key => $attr) {
                if ($attributes['type'] == 'binary' && ($key == 'size' || $key == 'scale'))  continue; // todo Typ binary eliminieren!
                if (!isset($attributes[$key])) { $attributes[$key] = null; }
                if ($attr !== $attributes[$key]) {
                    dd("Test {$t}c failed by column {$column}, attribute {$key}!");
                }
            }
        }

        // -------------------------------------------------------------------
        $t++;
        echo "Test $t: Rename column<br/>";
        $db->delete('table1');
        $db->insert('table1', ['integer1' => 11, 'string1' => 'aaa']);
        $schema->renameColumn('table1', 'string1', 'string99');
        $info = $schema->columns('table1');
        if (isset($info['string1'])) {
            dd("Test {$t}a failed!");
        }
        if (!isset($info['string99'])) {
            dd("Test {$t}b failed!");
        }
        if ($info['string99']['comment'] != 'lola') {
            dd("Test {$t}c failed!");
        }
        /** @noinspection SqlNoDataSourceInspection */
        $str = $db->scalar('select string99 from table1');
        if ($str != 'aaa') {
            dd("Test {$t}d failed!");
        }

        // -------------------------------------------------------------------
        $t++;
        echo "Test $t: Drop column<br/>";
        $schema->dropColumn('table1', 'string99');
        $info = $schema->columns('table1');
        if (isset($info['string99'])) {
            dd("Test {$t}a failed!");
        }

        $this->t = $t;
    }

    /**
     * Run Test 4
     * @param string $store
     */
    public function test4($store)
    {
        $t = $this->t;

        echo "<p><b>Modify indexes</b></p>";

        $collation = $this->getCollation($store, true);
        $columns = [
            'id'   => [
                'type'      => 'unsigned',
                'size'      => null,
                'scale'     => null,
                'nullable'  => false,
                'default'   => null,
                'collation' => null,
                'comment'   => null,
            ],
            'integer1'    => ['type' => 'integer', 'comment' => 'I am cool!'],
            'string1'     => ['type' => 'string', 'nullable' => true],
            'string2'     => ['type' => 'string', 'size' => 50, 'default' => 'Panama'],
            'string3'     => ['type' => 'string', 'collation' => $collation, 'nullable' => true],
        ];

        $db = database($store);
        $schema = $db->schema();
        try {
            $schema->dropTable('table1');
        } catch (\Exception $e) {
        }
        $schema->createTable('table1', $columns, ['comment' => 'Eine Testtabelle']);

        $info = $schema->indexes('table1');
        if (count($info) != 0) {
            dd("Test {$t}a failed!");
        }

        // -------------------------------------------------------------------
        $t++;
        echo "Test $t: Add index<br/>";

        $schema->addIndex('table1', null,        ['columns' => ['string1']]);
        $schema->addIndex('table1', 'hanswurst', ['columns' => ['string3']]);
        $schema->addIndex('table1', null,        ['columns' => ['string2'],  'unique'  => true]);
        $schema->addIndex('table1', null,        ['columns' => ['integer1'], 'primary' => true]);
        $schema->addIndex('table1', null,        ['columns' => ['string1', 'string2', 'string3']]);

        // -------------------------------------------------------------------
        $t++;
        echo "Test $t: Show indexes<br/>";

        $info = $schema->indexes('table1');
        if (count($info) != 5) {
            dd("Test {$t}a failed!");
        }

        $idx = $info['table1_string1_index'];
        if ($idx['name'] != 'table1_string1_index' || $idx['columns'][0] != 'string1' || $idx['unique'] !== false || $idx['primary'] !== false) {
            dd("Test {$t}b failed!");
        }

        $idx = $info['hanswurst'];
        if ($idx['name'] != 'hanswurst' || $idx['columns'][0] != 'string3' || $idx['unique'] !== false || $idx['primary'] !== false) {
            dd("Test {$t}c failed!");
        }

        $idx = $info['table1_string2_unique'];
        if ($idx['name'] != 'table1_string2_unique' || $idx['columns'][0] != 'string2' || $idx['unique'] !== true || $idx['primary'] !== false) {
            dd("Test {$t}d failed!");
        }

        $idx = array_filter($info, function ($idx) { return $idx['primary']; });
        if (empty($idx)) {
            dd("Test {$t}e failed!");
        }
        $key = key($idx);
        $idx = $idx[$key];
        if (empty($idx) || $idx['columns'][0] != 'integer1' || $idx['unique'] !== true || $idx['primary'] !== true) {
            dd("Test {$t}f failed!");
        }

        $idx = $info['table1_string1_string2_string3_index'];
        if ($idx['name'] != 'table1_string1_string2_string3_index' || $idx['columns'][0] != 'string1' || $idx['columns'][1] != 'string2' || $idx['columns'][2] != 'string3' || $idx['unique'] !== false || $idx['primary'] !== false) {
            dd("Test {$t}g failed!");
        }

        // -------------------------------------------------------------------
        $t++;
        echo "Test $t: Drop indexes<br/>";

        $schema->dropIndex('table1', null, ['columns' => ['string1']]);
        $info = $schema->indexes('table1');
        if (count($info) != 4) {
            dd("Test {$t}g failed!");
        }

        $schema->dropIndex('table1', 'hanswurst');
        $schema->dropIndex('table1', null, ['columns' => ['string2'], 'unique'  => true]);
        $schema->dropIndex('table1', null, ['primary' => true]);
        $schema->dropIndex('table1', null, ['columns' => ['string1', 'string2', 'string3']]);

        $info = $schema->indexes('table1');
        if (count($info) != 0) {
            dd("Test {$t}h failed!");
        }

        // -------------------------------------------------------------------
        $t++;
        echo "Test $t: Bigidentify<br/>";

        try {
            $schema->dropTable('table1');
        } catch (\Exception $e) {
        }
        $schema->createTable('table1', ['id' => ['type'=>'identity', 'comment' => 'foo'], 'x' => ['type' => 'integer']]);
        $idx = $schema->indexes('table1');
        if (count($idx) != 1) {
            dd("Test {$t}a failed!");
        }
        $key = key($idx);
        $idx = $idx[$key];
        if (empty($idx) || $idx['columns'][0] != 'id' || $idx['unique'] !== true || $idx['primary'] !== true) {
            dd("Test {$t}b failed!");
        }

        try {
            $schema->dropTable('table1');
        } catch (\Exception $e) {
        }
        $schema->createTable('table1', ['id' => ['type'=>'bigidentity', 'comment' => 'foo'], 'x' => ['type' => 'integer']]);
        $db->insert('table1', ['x' => 10]);
        $db->insert('table1', ['x' => 20]);

        /** @noinspection SqlDialectInspection */
        $id = $db->scalar('select id from table1 where x = 20');
        if ($id != 2) {
            dd("Test {$t}c failed!");
        }

        $idx = $schema->indexes('table1');
        if (count($idx) != 1) {
            dd("Test {$t}d failed!");
        }
        $key = key($idx);
        $idx = $idx[$key];
        if (empty($idx) || $idx['columns'][0] != 'id' || $idx['unique'] !== true || $idx['primary'] !== true) {
            dd("Test {$t}e failed!");
        }

        $columns = $schema->columns('table1');
        $attributes = $columns['id'];
        if ($attributes['name'] != 'id' ||
            $attributes['type'] != 'bigidentity' ||
            $attributes['size'] !== null ||
            $attributes['nullable'] !== false ||
            $attributes['default'] !== null ||
            $attributes['collation'] !== null ||
            $attributes['comment'] != 'foo'
        ) {
            dd("Test {$t}f failed!");
        }

        // -------------------------------------------------------------------
        // todos:

        // exec() mit und ohne Bindings / mit und ohne Fehler
        // query mit und Fehler
        // division by zero


        // insert without values

        // CURRENT_TIMESTAMP

        //CREATE TEMPORARY TABLE (alle Mdoifikationen wie zuvor testen; Temp muss temp bleiben)
        //
        // unicode

        //if (in_array($type, ['text', 'blob'])) {
        //    $default = null; // TEXT and BLOB column can't have a default value
        //}

        // Unique-test:  Wert "a" ist vorhanden, "A" wird eingefügt:
        // Unique auf CI-Feld: "a" == "A" -> Error
        // Unique auf CS-Feld: "a" != "A" -> Geht

        // Abfrage auf Tabelle:
        // SELECT * FROM `table1` WHERE ci='a'
        // -> 2 Werte
        // SELECT * FROM `table1` WHERE cs='a'
        // -> 1 Werte

        /*
         * id, cs, ci
         *  "1","a1","a1"
            "3","A2","A2"
            "4","b2","b2"
            "5","B1","B1"

            Sortierung:
            ORDER BY cs
                -> A2, a1, B1, b2

            ORDER BY ci
                -> a1, A2, B1, b2
        */


        // columns(): default auch richtigen Typ prüfen

        // geht beim UMbenennen der Kommentar verloren?

        // unter SQLServer, s. recreateTable()
        // Bei einem fehlerhaften INSERT-Statement und mit aktiven Transaction wird ständig die App neu aufgerufen!!
        // (Browser meldet "Server antowrtet nicht"). Muss fehler vom Trieber sein.


        $this->t = $t;
    }
}
