<?php

declare(strict_types=1);

namespace App\Component\UniqueLink\Job;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Cache;
use Throwable;

final class GetLuckyJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable;

    public function __construct(
        private readonly string $cacheKey,
    ) {
    }

    public function handle(): void
    {
        try {
            $number = random_int(1, 1000);
            $amount = 0 === $number % 2 ? $this->calculate($number) : 0;

            $cached = Cache::get($this->cacheKey, []);
            $cached[] = [
                'number' => $number,
                'win' => $amount > 0,
                'amount' => $amount,
            ];

            Cache::put(
                $this->cacheKey,
                array_slice($cached, -3),
            );

            $this->delete();
        } catch (Throwable) {
            $this->release();
        }
    }

    private function calculate(int $number): int
    {
        return (int) ceil(match (true) {
            $number > 900 => $number * .7,
            $number > 600 => $number * .5,
            $number > 300 => $number * .3,
            default => $number * .1,
        });
    }
}
