<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Placeholder Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used as placeholder for live page editor
    |
    */

    'image' => 'uploads/placeholder.png',
    'html' => '<h1><b>What is Lorem Ipsum?</b></h1><p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>',
    'heading' => '<h1>What is Lorem Ipsum?</h1>',
    'form' => [
        [
            'type' => 'text',
            'name' => 'firstname',
            'placeholder' => 'First name',
            'width' => '50',
            'required' => true,
        ],
        [
            'type' => 'text',
            'name' => 'lastname',
            'placeholder' => 'Last name',
            'width' => '50',
            'required' => true,
        ],
        [
            'type' => 'email',
            'name' => 'email',
            'placeholder' => 'Email',
            'width' => '50',
            'required' => true,
        ],
        [
            'type' => 'number',
            'name' => 'phone',
            'placeholder' => 'Phone',
            'width' => '50',
            'required' => true,
        ],
        /*[
            'type' => 'select',
            'name' => 'country',
            'placeholder' => 'Country',
            'width' => '50',
            'values' => ['Canada', 'United states'],
            'required' => true,
        ],
        [
            'type' => 'select',
            'name' => 'province',
            'placeholder' => 'Province',
            'width' => '50',
            'values' => ['Ontario', 'Arizon'],
            'required' => true,
        ],
        [
            'type' => 'radio',
            'name' => 'gender',
            'placeholder' => 'Gender',
            'width' => '50',
            'values' => ['Male', 'Female'],
            'required' => true,
        ],
        [
            'type' => 'checkbox',
            'name' => 'languages',
            'placeholder' => 'Languages',
            'width' => '50',
            'values' => ['English', 'French'],
            'required' => true,
        ],
        [
            'type' => 'textarea',
            'name' => 'message',
            'placeholder' => 'Your message',
            'width' => '100',
            'required' => false,
        ],*/
        [
            'type' => 'submit',
            'value' => 'Submit',
            'width' => '25',
        ],
    ]
];
