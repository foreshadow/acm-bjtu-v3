<?php

function success($message = '成功')
{
    return ['message' => $message, 'type' => 'success', 'icon' => 'ok'];
}

function failure($message = '失败')
{
    return ['message' => $message, 'type' => 'danger', 'icon' => 'remove'];
}
