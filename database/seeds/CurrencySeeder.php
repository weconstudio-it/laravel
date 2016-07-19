<?php

use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currencies = [
            ['symbol' => '€', 'name' => 'Euro', 'short_name' => 'EUR'],
            ['symbol' => '$', 'name' => 'Dollaro Australiano', 'short_name' => 'AUD'],
            ['symbol' => '$', 'name' => 'Dollaro Canadese', 'short_name' => 'CAD'],
            ['symbol' => 'CHF', 'name' => 'Fransco Svizzero', 'short_name' => 'CHF'],
            ['symbol' => 'TL', 'name' => 'Lira Turca', 'short_name' => 'TRL'],
            ['symbol' => '-', 'name' => 'Yuan Cina', 'short_name' => 'CNY'],
            ['symbol' => 'zł', 'name' => 'Zloty Polacco', 'short_name' => 'PLN'],
            ['symbol' => '-', 'name' => 'Real Brasile', 'short_name' => 'BRL'],
            ['symbol' => 'kr', 'name' => 'Corona Danese', 'short_name' => 'DKK'],
            ['symbol' => '£', 'name' => 'Sterlina Inglese', 'short_name' => 'GBP'],
            ['symbol' => '¥', 'name' => 'Yen Giapponese', 'short_name' => 'JPY'],
            ['symbol' => 'kr', 'name' => 'Corona Norvegese', 'short_name' => 'NOK'],
            ['symbol' => 'kr', 'name' => 'Corona Svedese', 'short_name' => 'SEK'],
            ['symbol' => '$', 'name' => 'Dollaro USA', 'short_name' => 'USD'],
            ['symbol' => '-', 'name' => 'Rand Sud Africa', 'short_name' => 'ZAR'],
            ['symbol' => '$', 'name' => 'Dollaro Neozelandese', 'short_name' => 'NZD'],
            ['symbol' => '-', 'name' => 'Peso Messicano', 'short_name' => 'MXN'],
            ['symbol' => 'KM', 'name' => 'Marco bosniaco convertibile', 'short_name' => 'BAM'],
            ['symbol' => 'B', 'name' => 'Lev bulgaro', 'short_name' => 'BGN'],
            ['symbol' => 'kč', 'name' => 'Corona ceca', 'short_name' => 'CZK'],
            ['symbol' => 'kn', 'name' => 'Kuna croata', 'short_name' => 'HRK'],
            ['symbol' => 'Ft', 'name' => 'Fiorino ungherese', 'short_name' => 'HUF'],
            ['symbol' => 'ден', 'name' => 'Dinaro macedone', 'short_name' => 'MKD'],
            ['symbol' => 'lei', 'name' => 'Nuovo leu rumeno', 'short_name' => 'RON'],
            ['symbol' => 'РСД', 'name' => 'Dinaro serbo', 'short_name' => 'RSD'],
        ];

        $c_id = [];
        foreach ($currencies as $c) {
            $currency = new \App\Models\Currency();
            $currency->fromArray($c);
            $currency->save();

            $c_id[] = $currency->getId();
        }

        foreach ($c_id as $cid) {
            $currency_validity = new \App\Models\CurrenciesRateValidity();
            $currency_validity->setIdCurrency($cid);
            $currency_validity->setStart(date('Y-m-d'));
            $currency_validity->setEnd(date('2050-12-31'));
            $currency_validity->setValue(1.00);
            $currency_validity->setActive(true);

            $currency_validity->save();
        }
    }
}