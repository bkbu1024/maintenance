@extends('maintenance::layouts.buttons.dropdown')

@section('dropdown.body.content')
    <li>
        <a
                href="{{ route('maintenance.inventory.show', array($attendee->id)) }}"
                data-method="delete"
                data-token="{{ csrf_token() }}"
                data-message="Are you sure you want to remove this attendee?">
            <i class="fa fa-trash-o"></i> Remove Attendee
        </a>
    </li>
@overwrite
