<?php

return [
    'title' => 'Admin Paneel',

    'tabs' => [
        'users' => 'Gebruikers',
        'trips' => 'Reizen',
        'messages' => 'Berichten',
    ],

    'users' => [
        'title' => 'Gebruikersbeheer',
        'show_all' => 'Toon alles',
        'select_fields' => 'Selecteer velden',
        'actions' => 'Acties',
        'edit' => 'Bewerken',
        'delete' => 'Verwijderen',
        'confirm_delete' => 'Weet je zeker dat je deze reiziger wilt verwijderen?',
    ],

    'trips' => [
        'title' => 'Reisbeheer',
        'name' => 'Reisnaam',
        'description' => 'Beschrijving',
        'price' => 'Prijs',
        'status' => 'Status',
        'created_at' => 'Aangemaakt op',
        'add' => 'Toevoegen',
        'edit' => 'Bewerken',
        'delete' => 'Verwijderen',
        'confirm_delete' => 'Weet je zeker dat je deze reis wilt verwijderen?',
        'no_trips' => 'Geen reizen gevonden.',
        'form' => [
            'name' => 'Reisnaam',
            'description' => 'Beschrijving',
            'email' => 'Contact e-mail',
            'price' => 'Prijs',
            'status' => [
                'active' => 'Actief',
                'inactive' => 'Inactief',
            ],
        ],
    ],

    'messages' => [
        'title' => 'Berichten',
        'select_trip' => 'Selecteer een reis',
        'choose_trip' => 'Kies een reis',
        'your_message' => 'Je bericht',
        'placeholder' => 'Typ hier je bericht...',
        'send' => 'Bericht versturen',
    ],

    'export' => 'Exporteren',
];
