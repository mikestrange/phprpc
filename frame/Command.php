<?php
/**
 * Created by PhpStorm.
 * User: MikeRiy
 * Date: 16/12/2
 * Time: 23:38
 */

interface Command
{
    public function execute($message);
}