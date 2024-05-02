<?php

namespace App\Decorators;

class SkillDecorator
{
    protected $skills = ['php', 'js', 'golang', 'java'];

    public function decorate($description)
    {
        $skill = $this->skills[array_rand($this->skills)];

        return $description ? "$description, $skill" : $skill;
    }
}
