<?php

namespace App\Http\Controllers;

use Api\Infrastructure\CandidateInEloquent;
use Api\UseCase\Candidate\CreateCandidate;
use Api\UseCase\Candidate\GetAllCandidates;
use Api\UseCase\Candidate\GetCandidate;

use Illuminate\Http\Request;

class CandidateController extends Controller
{
    public function index()
    {
        $candidatesUseCase = new GetAllCandidates(new CandidateInEloquent());
        return $candidatesUseCase->execute();
    }

    public function show($id)
    {
        $candidatesUseCase = new GetCandidate(new CandidateInEloquent());
        return $candidatesUseCase->execute($id);
    }

    public function store(Request $request)
    {
        $candidatesUseCase = new CreateCandidate(new CandidateInEloquent());
        return $candidatesUseCase->execute($request->all());     
    }
}
