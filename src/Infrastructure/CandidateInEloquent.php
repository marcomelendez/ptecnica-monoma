<?php

namespace Api\Infrastructure;

use Api\Domain\Contracts\CandidateInterface;
use App\Models\Candidate;
use Api\Domain\Entity\Candidate as CandidateEntity;
use Api\Domain\ValueObject\Candidate\CandidateId;
use Api\Domain\ValueObject\Candidate\CreatedBy;
use Api\Domain\ValueObject\Candidate\NameValueObject;
use Api\Domain\ValueObject\Candidate\Owner;
use Api\Domain\ValueObject\Candidate\Source;
use DateTime;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;


class CandidateInEloquent implements CandidateInterface
{
    /**
     * @return mixed
     */
    public function all()
    {
        return Cache::remember('candidates', 240, function () {
            $result = new Collection();
            $rows = DB::table('candidates')->get();

            foreach($rows as $row){
                $result->push(new CandidateEntity(new CandidateId($row->id),
                    new NameValueObject($row->name),
                    new Source($row->source),
                    new Owner($row->owner),
                    new CreatedBy($row->created_by),
                    new DateTime($row->created_at)));
            }
            return $result;
        });
    }

    /**
     * @param $id
     * @return CandidateEntity
     * @throws \Exception
     */
    public function find($id)
    {
        $candidateRow = Candidate::findOrFail($id);

        return new CandidateEntity(new CandidateId($candidateRow->id),
                    new NameValueObject($candidateRow->name),
                    new Source($candidateRow->source),
                    new Owner($candidateRow->owner),
                    new CreatedBy($candidateRow->created_by),
                    new DateTime($candidateRow->created_at));
    }

    public function create(CandidateEntity $candidate): array
    {
        $data = [
            'name'=>$candidate->getName()->value(),
            'source'=>$candidate->getSource()->value(),
            'owner'=>$candidate->getOwner()->value(),
            'created_by'=>$candidate->getCreatedBy()->value()
        ];

        $result = Candidate::create($data);

        return $result->toArray();
    }
}
