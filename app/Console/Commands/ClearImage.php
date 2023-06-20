<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Page;

class ClearImage extends Command{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'image:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear images from storage that no longer used';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(){
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(){
        $upload = collect(\File::allFiles(public_path('uploads/static/')));
        foreach($upload as $upload){
            $file = pathinfo($upload);
            $filename = $file['basename'] ?? null;
            if($filename && Page::where('template_contents', 'LIKE',  "%{$filename}%")->get()->count() == 0){
                @unlink($upload);
            }
        }
        $this->info('Images cleared successfully.');
        return 0;
    }
}
