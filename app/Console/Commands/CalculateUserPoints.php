<?php

namespace App\Console\Commands;

use App\Models\DateBinaryCalculation;
use App\Models\User;
use Illuminate\Console\Command;

class CalculateUserPoints extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'points:calculate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculate total points for left and right users';

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
        $users = User::all();
        $date = now()->format('Y-m-d');

        foreach ($users as $user) {
            $leftUserPoints = $this->calculateTotalPointsRecursive($user->left_placement, $date);
            $rightUserPoints = $this->calculateTotalPointsRecursive($user->right_placement, $date);

            $this->info('Username: ' . $user->username);
            $this->info('Left User Points: ' . $leftUserPoints);
            $this->info('Right User Points: ' . $rightUserPoints);
            $this->info('------------------------------------');

            if ($leftUserPoints > $rightUserPoints) {
                $binarylc = DateBinaryCalculation::create([
                    'date' => date('Y-m-d'),
                    'user_id' => $user->id,
                    'lp' => $leftUserPoints,
                    'rp' => $rightUserPoints,
                    'income' => $rightUserPoints,
                    'lc' => $leftUserPoints - $rightUserPoints,
                    'rc' => '0',
                ]);

                $user->main_wallet = $user->main_wallet + $binarylc->income;
                $user->save();
            }
            if ($leftUserPoints < $rightUserPoints) {
                $binaryrc = DateBinaryCalculation::create([
                    'date' => date('Y-m-d'),
                    'user_id' => $user->id,
                    'lp' => $rightUserPoints,
                    'rp' => $leftUserPoints,
                    'income' => $leftUserPoints,
                    'lc' => '0',
                    'rc' => $rightUserPoints - $leftUserPoints,
                ]);
                $user->main_wallet = $user->main_wallet + $binaryrc->income;
                $user->save();
            }
        }
    }

    private function calculateTotalPointsRecursive($placement, $date)
    {
        $user = User::where('username', $placement)->first();

        if ($user) {
            $points = $user->orders()->whereDate('created_at', $date)->sum('grand_point');

            $leftPoints = $this->calculateTotalPointsRecursive($user->left_placement, $date);
            $rightPoints = $this->calculateTotalPointsRecursive($user->right_placement, $date);

            $points += $leftPoints + $rightPoints;

            return $points;
        }

        return 0;
    }
}
