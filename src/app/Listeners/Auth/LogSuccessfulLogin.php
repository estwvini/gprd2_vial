<?php

namespace App\Listeners\Auth;

use Altek\Accountant\Contracts\Notary;
use Altek\Accountant\Exceptions\AccountantException;
use Altek\Accountant\Resolve;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Config;

/**
 * Clase LogSuccessfulLogin
 *
 * @package App\Listeners\Auth
 */
class LogSuccessfulLogin
{

    const LOGIN = 'login';

    /**
     * Procesar evento.
     *
     * @param Login $event
     *
     * @return void
     * @throws AccountantException
     */
    public function handle(Login $event)
    {

        if ($event->guard !== 'web') {
            return;
        }

        $notary = Config::get('accountant.notary');

        if (!\is_subclass_of($notary, Notary::class)) {
            throw new AccountantException(\sprintf('Invalid Notary implementation: "%s"', $notary));
        }

        $implementation = Config::get('accountant.ledger.implementation');

        if (!\is_subclass_of($implementation, \Altek\Accountant\Contracts\Ledger::class)) {
            throw new AccountantException(\sprintf('Invalid Ledger implementation: "%s"', $implementation));
        }

        $ledger = new $implementation();

        $user = Resolve::user();
        // Set the Ledger properties
        foreach ($user->gather(self::LOGIN) as $property => $value) {
            $ledger->setAttribute($property, $value);
        }

        if ($ledger->usesTimestamps()) {
            $ledger->setCreatedAt($ledger->freshTimestamp())
                ->setUpdatedAt($ledger->freshTimestamp());
        }

        $ledger->setAttribute('pivot', []);

        // Sign and store the record
        $ledger->setAttribute('signature', \call_user_func([$notary, 'sign'], $ledger->attributesToArray()))->save();
    }
}
