<?php

namespace Api\Domain\Contracts;

use Api\Domain\Entity\Candidate;

interface CandidateInterface
{
    public function all();

    public function find($id);

    public function create(Candidate $candidate): array;
}