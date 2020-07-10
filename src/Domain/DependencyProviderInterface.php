<?php


namespace Domain;


interface DependencyProviderInterface
{
    public function check(): void;
}
