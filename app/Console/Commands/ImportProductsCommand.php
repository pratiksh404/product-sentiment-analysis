<?php

namespace App\Console\Commands;

use App\Imports\ProductImport;
use App\Imports\ReviewImport;
use Illuminate\Console\Command;

class ImportProductsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:product  {--only-products} {--only-reviews}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to import amazon product';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->output->title('Starting import');
        if ($this->option('only-products')) {
            file_exists(public_path('sentiment/products/sentiment_products.xlsx'))
                ? (new ProductImport)->withOutput($this->output)->import(public_path('sentiment/products/sentiment_products.xlsx'))
                : $this->output->error('File not found');
        } elseif ($this->option('only-reviews')) {
            file_exists(public_path('sentiment/products/sentiment_product_review.xlsx'))
                ? (new ReviewImport)->withOutput($this->output)->import(public_path('sentiment/products/sentiment_product_review.xlsx'))
                : $this->output->error('File not found');
        } else {
            file_exists(public_path('sentiment/products/sentiment_products.xlsx'))
                ? (new ProductImport)->withOutput($this->output)->import(public_path('sentiment/products/sentiment_products.xlsx'))
                : $this->output->error('File not found');
            file_exists(public_path('sentiment/products/sentiment_product_review.xlsx'))
                ? (new ReviewImport)->withOutput($this->output)->import(public_path('sentiment/products/sentiment_product_review.xlsx'))
                : $this->output->error('File not found');
        }
        $this->output->success('Import successful');
    }
}
