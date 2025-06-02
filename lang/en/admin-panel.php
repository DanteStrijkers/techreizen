<?php

return [
    'title' => 'Admin Panel',

    'tabs' => [
        'users' => 'Users',
        'trips' => 'Trips',
        'messages' => 'Messages',
    ],

    'users' => [
        'title' => 'User Management',
        'show_all' => 'Show All',
        'select_fields' => 'Select Fields',
        'actions' => 'Actions',
        'edit' => 'Edit',
        'delete' => 'Delete',
        'confirm_delete' => 'Are you sure you want to delete this traveller?',
        'export' => 'export',
        'search_label' => 'Search',
        'search_placeholder' => 'Type here to search ...',
    ],

    'trips' => [
        'title' => 'Trip Management',
        'name' => 'Trip Name',
        'description' => 'Description',
        'price' => 'Price',
        'status' => 'Status',
        'created_at' => 'Created At',
        'add' => 'Add',
        'edit' => 'Edit',
        'delete' => 'Delete',
        'confirm_delete' => 'Are you sure you want to delete this trip?',
        'no_trips' => 'No Trips found.',
        'form' => [
            'name' => 'Trip name',
            'description' => 'Description',
            'email' => 'Contact email',
            'price' => 'Price',
            'status' => [
                'active' => 'Active',
                'inactive' => 'Inactive',
            ],
        ],
    ],

    'messages' => [
        'title' => 'Messages',
        'select_trip' => 'Select Trip',
        'choose_trip' => 'Choose a trip',
        'your_message' => 'Your Message',
        'placeholder' => 'Type your message here...',
        'send' => 'Send Message',
    ],

    'export' => 'Export',
];
