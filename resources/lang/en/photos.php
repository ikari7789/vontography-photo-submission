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
        'accept_terms' => [
            'text' => 'I accept the <a href=":terms_url" target="_blank" rel="noopener noreferrer">Terms and Conditions <font-awesome-icon icon="external-link-alt" /></a>',
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
            'one_photo_per_critique_warning' => 'Only one photo allowed per critique.',
            'photographer_permission_warning' => 'If you are not the photographer, you <strong>MUST</strong> get approval from the photographer. Please mention that you have done so in the comments section.',
            'username_email_warning' => 'Name / Email are used for managing your uploads. If you haven\'t already registered, '
                      .'an account will be generated automatically for you. Since no one should know your '
                      .'password but you, after your initial submission, please request to <a href=":request_url">reset your password</a>.',
            'submit' => 'Submit Photo',
        ],
    ],
];