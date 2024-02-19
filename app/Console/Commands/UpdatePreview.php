<?php

namespace App\Console\Commands;

use App\Models\Feedback;
use Carbon\Carbon;
use Illuminate\Console\Command;
use App\Services\VideoService;

class UpdatePreview extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:preview';
    protected $VideoService;

    public function __construct(VideoService $VideoService)
    {
        parent::__construct(); // Call the parent constructor
        $this->VideoService = $VideoService;
    }

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $feedbacks = Feedback::all();
        $now = Carbon::now();
        foreach ($feedbacks as $feedback) {
            if ($now >= $feedback->update_preview_time)
            {
                try {
                    $dlink = $this->VideoService->crawlVideoSource($feedback->youtube)[1];
                    if ($dlink !== null) {
                        $feedback->update(["dlink" => $dlink, "update_preview_time" => Carbon::now()->addHours(2)]);
                    }

                } catch (\Exception $e){}
            }

        }
    }
}
