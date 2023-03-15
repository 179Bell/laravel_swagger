<?php

namespace App\Console\Commands;

use App\Http\Services\StockService;
use Carbon\Carbon;
use Illuminate\Console\Command;
use App\Enums\CategoryType;
use App\Models\Stock;

class StockList extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:stocklist';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '在庫リストを取得してCSV出力する';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $fileName = Carbon::now()->format('YmdHis').'_stocklist.csv';
        $path = storage_path().'/csv/'.$fileName;

        $stream = fopen($path, 'w');

        $head = [
            '在庫量',
            '商品名',
            '商品カテゴリー',
        ];

        mb_convert_encoding($head, 'SJIS', 'UTF-8');
        fputcsv($stream, $head);

        $model = new Stock();
        $stocks = $model->getAllStocks();

        foreach ($stocks as $stock) {
            mb_convert_encoding($stock, 'SJIS', 'UTF-8');
            fputcsv($stream, [
                $stock->quantity,
                $stock->product_name,
                CategoryType::getDescription($stock->category_id),
            ]);
        }

        // $convertData = mb_convert_encoding($data, 'SJIS', 'UTF-8');
        fclose($stream);
    }
}
