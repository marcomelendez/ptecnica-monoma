<?php

namespace Api\UseCase\Candidate;

use Api\Domain\Contracts\CandidateInterface;

class CandidateAbstract
{
    const ROLE_AGENT   = "agent";
    const ROLE_MANAGER = "manager";

    protected CandidateInterface $candidateRepository;

    public function __construct(CandidateInterface $candidateRepository)
    {
        $this->candidateRepository = $candidateRepository;
    }

}