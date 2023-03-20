<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

/**
 * Class DateDirectiveServiceProvider
 * @package App\Providers
 */
class DateDirectiveServiceProvider extends ServiceProvider
{

    const DAY = 'l';

    const DAY_SHORT = 'D';

    const DATE = 'n/j';

    const STAMP = 'M jS \@ g:ia';

    const DATE_SPAN = 'M j';

    const TIME = 'g:ia';

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // Add our date directives to Blade
        $self = $this;
        $partial = function($func) use ($self) {
            return function($date) use ($func, $self) {
                return $self->outputPhp($func, $date);
            };
        };

        Blade::directive('day', $partial('day'));
        Blade::directive('date', $partial('date'));
        Blade::directive('dayWithDate', $partial('dayWithDate'));
        Blade::directive('dateSpan', $partial('dateSpan'));
        Blade::directive('time', $partial('time'));
        Blade::directive('stamp', $partial('stamp'));
    }

    /**
     * Returns a string of PHP code to use for the directive
     *
     * @param $d
     * @param $format
     * @return string
     */
    public function outputPhp($func, $date)
    {
        return "<?php echo ".__CLASS__."::$func{$date}; ?>";
    }

    /**
     * Format as the weekday, with full text or short. If it's < 7 days just uses the day,
     * otherwise it includes the day and date
     *
     * @param Carbon $d
     * @param bool $full Use full text name. Pass false to get 3 letter. Default true.
     * @return string
     */
    static public function day(Carbon $d, $full = true)
    {
        if ($d->isToday()) {
            return trans('misc.today');

        } elseif ($d->diffInDays() < 7) {
            return $d->format($full ? self::DAY : self::DAY_SHORT);

        } else {
            return self::dayWithDate($d, $full);
        }
    }

    /**
     * Formats as 1/30
     *
     * @param Carbon $d
     * @return string
     */
    static public function date(Carbon $d)
    {
        return $d->format(self::DATE);
    }

    /**
     * Formats as Monday|Mon 1/30
     *
     * @param Carbon $d
     * @param bool $full Use full text name
     * @return string
     */
    static public function dayWithDate(Carbon $d, $full = true)
    {
        $format = ($full ? self::DAY : self::DAY_SHORT) . ' ' . self::DATE;
        return $d->format($format);
    }

    /**
     * Formats as Aug 1 - Aug 8
     *
     * @param Carbon $from
     * @param Carbon $to
     * @return string
     */
    static public function dateSpan(Carbon $from, Carbon $to)
    {
        return $from->format(self::DATE_SPAN) . ' &ndash; ' . $to->format(self::DATE_SPAN);
    }

    /**
     * Formats as 5:30pm
     *
     * @param Carbon $d
     * @return string
     */
    static public function time(Carbon $d)
    {
        return $d->format(self::TIME);
    }

    /**
     * Formats as Jan 1st @ 12:00am
     *
     * @param Carbon $d
     * @return string
     */
    static public function stamp(Carbon $d)
    {
        return $d->format(self::STAMP);
    }

    // just needed to satisfy the provider
    public function register()
    {
    }
}