<?php

return [
    'attributes' => [
        'name' => [
            'text' => 'Name',
            'placeholder' => 'John Doe',
        ],
        'email' => [
            'text' => 'Email',
            'placeholder' => 'john.doe@example.com',
        ],
        'social_handle' => [
            'text' => 'Social Media Handle',
            'placeholder' => 'Photography Social Media Name'
        ],
        'photo' => [
            'text' => 'Photo',
            'description' => 'Minimum resolution: 1920px x 1080px (or 1080px x 1920px)',
            'placeholder' => 'Select photo',
        ],
        'camera_metadata' => [
            'text' => 'Camera Information',
            'description' => 'Camera model, settings, lens model, lighting equipment, etc.',
            'placeholder' => "Camera: Canon EOS 5D\nSettings: 1/200, f/2.8, ISO 100\nLens: EF 70-300mm f/4-5.6 IS II USM",
        ],
        'featuring' => [
            'text' => 'Featuring',
            'placeholder' => 'Name / Social handle of cosplayer(s)',
        ],
        'comment' => [
            'text' => 'Comments',
            'placeholder' => 'Anything you\'d like to add?',
        ],
        'uploader' => [
            'text' => 'Uploader',
        ],
    ],
    'pages' => [
        'index' => [
            'title' => 'Photos',
            'create_action' => 'Add a new submission',
            'details' => 'Details',
            'delete_action' => 'Delete',
        ],
        'show' => [
            'title' => 'Photo Details',
            'delete_action' => 'Delete',
        ],
        'create' => [
            'title' => 'Submit Photo',
            'form_title' => 'Photo Submission',
            'alert' => 'Name / Email are used for managing your uploads. If you haven\'t already registered, '
                      .'an account will be generated automatically for you. Since no one should know your '
                      .'password but you, after your initial submission, please request to <a href=":REQUEST_URL">reset your password</a>.',
            'submit' => 'Submit Photo',
        ],
    ],
];