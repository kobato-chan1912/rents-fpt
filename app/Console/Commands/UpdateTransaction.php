<?php

namespace App\Console\Commands;

use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use App\Services\BankService;
use Illuminate\Support\Str;
use App\Services\TransactionService;
class UpdateTransaction extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-transaction';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';
    protected $bank;
    protected $transactionService;
    public function __construct()
    {
      parent::__construct(); // Call the parent constructor
      $this->bank = new BankService(env("BANK_USER"), env("BANK_PASSWORD"), null, env("BANK_INFO"));
      $this->transactionService = new TransactionService();
    }
    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
      $transactions = $this->bank->getHistory();
      $status = $transactions["status"];
      if ($status) {
        $transactions = $transactions["data"]["data"]["transactions"];

        foreach ($transactions as $transaction) {

          $description = $transaction["description"];
          $query = Transaction::where("description", $description);
          $formatDescription = Str::lower($description);

          if (!$query->exists()) {
            $pattern = '/v10(\d+)/';

            preg_match($pattern, $formatDescription, $matches);
            if (isset($matches[1])) {
              try {
                $transactionId = (int)$matches[1];
                $transferAmount = $transaction["amount"];
                $transQuery = Transaction::findOrFail($transactionId);
                $needMoney = $transQuery->amount;
                if ($transferAmount >= $needMoney)
                {

                  // update
                  $this->transactionService->confrimTransaction($transactionId, $description);


                }
              } Catch(\Exception $e){

              }
            }
          }
        }
      }
    }
}
