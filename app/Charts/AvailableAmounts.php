<?php

declare(strict_types = 1);

namespace App\Charts;

use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use App\Models\Availability;

class AvailableAmounts extends BaseChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        $amounts = [];
        $dates = [];

        for($i=0; $i < 5; $i++ ){
            $currWeek = \Carbon\Carbon::now()->subWeeks($i);
            $start = $currWeek->startOfWeek()->format('Y-m-d H:i:s');
            $end = $currWeek->endOfWeek()->format('Y-m-d H:i:s');
            $availability = Availability::whereBetween('date', array($start, $end))->count();
            $amounts[] = $availability;
            $dates[] = $currWeek->endOfWeek()->format('d\/m');
        }



        return Chartisan::build()
            ->labels($dates)
            ->dataset('Days Available', $amounts);
    }
}