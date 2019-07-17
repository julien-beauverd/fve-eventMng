<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class MainTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //factory(App\User::class, 50)->create()->each(function ($user) {});
        /**
         * compte administrateur
         */
        $user_1 = new \App\User([
            'email' => "event@fve.ch",
            'password' => bcrypt('admin'),
            'name' => 'Burnand',
            'first_name' => 'Frédéric',
            'company_name' => 'fédération vaudoise des entrepreneurs',
            'is_admin' => true,
            'email_verified_at' => '2019-06-20 00:00:00'
        ]);
        $user_1->save();

        /**
         * exemple utilisateur
         */
        $user_2 = new \App\User([
            'email' => "jean@dubois.ch",
            'password' => bcrypt('bois'),
            'name' => 'Dubois',
            'first_name' => 'Jean',
            'company_name' => 'Dubois SA',
            'is_admin' => false,
            'email_verified_at' => '2019-06-20 00:00:00'
        ]);
        $user_2->save();

        /**
         * exemple location
         */
        $location_1 = new \App\Location([
            'city' => 'Tolochenaz',
            'street' => 'Route Ignace Paderewski',
            'street_number' => 2,
            'zip_code' => '1131',
            'building' => 'bâtiment A'
        ]);
        $location_1->save();

        /**
         * exemple événement
         */
        $event_1 = new \App\Event([
            'location_id' => 1,
            'type' => 'grand-rdv',
            'name' => 'Conjoncture : Êtes-vous prêts ?',
            'description' => 'Madame, Monsieur,
            
            Nous ne savons pas quelle sera la tendance conjoncturelle dans la construction vaudoise, demain.
            
            Dans ce contexte incertain, les entreprises de la branche doivent développer des stratégies, mais lesquelles ?
            
            La fédération souhaite vous informer face à l’évolution du marché. Nous voulons vous aider à adopter une stratégie adaptée, en tenant compte de votre situation particulière.
            
            Grâce à des orateurs de choix, ce forum ciblé sur la construction vous aidera à tirer le meilleur des futurs développements. Des exemples de succès vous seront aussi présentés.',
            'image' => 'logo-event.png',
            'date' => '2019-07-21',
            'date_show_end' => Carbon::createFromDate('2019-07-21')->add(10, 'day')
        ]);
        $event_1->save();

        /**
         * l'exemple utilisateur participe à l'événement
         */
        $event_1->users()->save($user_1);

        /**
         * exemple document lié à l'événement 1
         */
        $document_1 = new \App\Document([
            'name' => 'exemple-événementFVE.pdf'
        ]);
        $document_1->save();
        $document_1->events()->save($event_1);

        $document_2 = new \App\Document([
            'name' => 'Rapport_FVE_2017_Web.pdf',
            'doc_to_download' => true,
            'title' => 'Rapport annuel de la fve 2017',
            'description' => 'Vous trouverez toutes les informations sur les activités ainsi que les résultats financiers de la fédération vaudoise des entrepreneurs au cours de l’année 2017.'
        ]);
        $document_2->save();

        $document_3 = new \App\Document([
            'name' => 'fve_info_8_2016_print_V_finale__2_.pdf',
            'doc_to_download' => true,
            'title' => 'Magazine INFO numéro 8',
            'description' => "le bulletin d'information n°8 de la fédération vaudoise des entrepreneurs."
        ]);
        $document_3->save();

        $document_4 = new \App\Document([
            'name' => 'Retraites-GrosOeuvre-Vaud-Communique.pdf',
            'doc_to_download' => true,
            'title' => 'Communiqué de presse du 3 mai 2018',
            'description' => 'Les retraites anticipées des employés ne sont pas en danger.'
        ]);
        $document_4->save();

        /**
         * programme de l'événement 1
         */
        $topic_1 = new \App\Topic([
            'event_id' => 1,
            'time' => '14:00',
            'title' => 'Bienvenue et propos introductifs',
            'speaker' => 'Frédéric Mamaïs',
            'description' => 'Journaliste, rubrique économique, RTS – La Première'
        ]);
        $topic_1->save();
        $topic_2 = new \App\Topic([
            'event_id' => 1,
            'time' => '14:10',
            'title' => 'Informations conjoncturelles',
            'speaker' => 'Délia Nilles',
            'description' => 'Depuis septembre 1994, Délia Nilles est chargée d’enseignement et de recherche à l’Institut CREA et à la Faculté des hautes études commerciales de l’Université de Lausanne,
            où elle enseigne les mathématiques.'
        ]);
        $topic_2->save();


        /**
         * exemple événement 2
         */
        $event_2 = new \App\Event([
            'location_id' => 1,
            'type' => 'rdv-formation',
            'name' => 'formation : Êtes-vous prêts ?',
            'description' => 'Madame, Monsieur,
                                Bonjour, ceci est un test',
            'image' => 'logo-event-2.png',
            'date' => '2019-05-24',
            'date_show_end' => Carbon::createFromDate('2019-05-24')->add(10, 'day')
        ]);
        $event_2->save();
        $document_1->events()->save($event_2);

        /**
         * l'exemple utilisateur participe à l'événement
         */
        $event_2->users()->save($user_1);

        /**
         * programme de l'événement 1
         */
        $topic_3 = new \App\Topic([
            'event_id' => 2,
            'time' => '18:00',
            'title' => 'Bienvenue',
            'speaker' => 'Jean Bildonet',
            'description' => 'métier test'
        ]);
        $topic_3->save();
        $topic_4 = new \App\Topic([
            'event_id' => 2,
            'time' => '18:40',
            'title' => 'Informations',
            'speaker' => 'Denis Fufredo',
            'description' => 'discours'
        ]);
        $topic_4->save();
    }
}
