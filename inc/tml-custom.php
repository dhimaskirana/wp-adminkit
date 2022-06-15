<?php

add_action('init', function () {
    tml_unregister_action('dashboard');
    foreach (tml_get_forms() as $form) {
        foreach (tml_get_form_fields($form) as $field) {
            if ('hidden' == $field->get_type()) {
                continue;
            }

            $field->render_args['before'] = '<div class="mb-3">';
            $field->render_args['after'] = '</div>';
            if ('checkbox' != $field->get_type() && 'submit' != $field->get_type()) {
                $field->add_class('form-control form-control-lg');
            }
            if ('submit' == $field->get_type()) {
                $field->add_class('btn btn-lg btn-primary');
            }
        }
    }
});
