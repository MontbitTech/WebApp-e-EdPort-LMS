<?php

function success_message ($message)
{
    return array('success' => true, 'data' => $message);
}

function failure_message ($message)
{
    return array('success' => false, 'data' => $message);
}