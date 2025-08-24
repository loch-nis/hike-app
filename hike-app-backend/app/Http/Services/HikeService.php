<?php

namespace App\Services;

class HikeService
{
    public function createHike($title)
    {
        // todo refactor controller into this.
        // ask chat whether to use one public here and a lot of private helpers,
        // OR a lot of public, all called from the controller?

        // or honestly, model methods are also good abstractions?!

        // ^^ we are back to when OOP becomes weird - a service class?!?!?

        // https://medium.com/@laravelprotips/understanding-laravel-service-classes-a-comprehensive-guide-1f22310c70bd

        // could use actions, but reddit guy said fuck that. And honestly I might just leave the
        // controller with all the logic.. does not seem worth atm
    }
}
