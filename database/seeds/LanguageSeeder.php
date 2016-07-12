<?php

use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $language = new \App\Models\Language();
        $language->setDescription('Italiano');
        $language->setIso6391('it');
        $language->setCode('ita');
        $language->setI18n('it_IT');
        $language->setActive(1);
        $language->save();

        $language = new \App\Models\Language();
        $language->setDescription('English');
        $language->setIso6391('en');
        $language->setCode('eng');
        $language->setI18n('en_GB');
        $language->setActive(1);
        $language->save();

        $language = new \App\Models\Language();
        $language->setDescription('Français');
        $language->setIso6391('fr');
        $language->setCode('fra');
        $language->setI18n('fr_FR');
        $language->setActive(1);
        $language->save();

        $language = new \App\Models\Language();
        $language->setDescription('Deutsch');
        $language->setIso6391('de');
        $language->setCode('deu');
        $language->setI18n('de_DE');
        $language->setActive(1);
        $language->save();

        $language = new \App\Models\Language();
        $language->setDescription('Español');
        $language->setIso6391('es');
        $language->setCode('esp');
        $language->setI18n('es_ES');
        $language->setActive(1);
        $language->save();
    }
}