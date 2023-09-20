<?php

namespace Api\Infrastructure;

use Api\Domain\Contracts\CandidateInterface;
use Api\Domain\Entity\Candidate as CandidateEntity;
use Api\Domain\ValueObject\Candidate\CandidateId;
use Api\Domain\ValueObject\Candidate\CreatedBy;
use Api\Domain\ValueObject\Candidate\NameValueObject;
use Api\Domain\ValueObject\Candidate\Owner;
use Api\Domain\ValueObject\Candidate\Source;
use DateTime;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
class CandidateInMemory implements CandidateInterface
{
    /**
     * @return Collection
     */
    public function all()
    {
        return $this->fixture();
    }

    /**
     * @param $id
     * @return \Closure|null
     * @throws Exception
     */
    public function find($id)
    {
        $collection = $this->fixture();

        $result = $collection->filter(function($row) use ($id){
            return $row->getId()->value() == $id;
        });

        if($result->isEmpty()){
            throw new Exception("Not found",404);
        }

        return $result->first();
    }

    /**
     * @param CandidateEntity $candidate
     * @return array
     */
    public function create(CandidateEntity $candidate): array
    {
        return $candidate->toArray();
    }

    /**
     * @return Collection
     */
    private function fixture()
    {
        $data = new Collection();

        for($i=1; $i<=10; $i++){

            $name = Str::random(10);

            $data->push(new CandidateEntity(new CandidateId($i),
                            new NameValueObject($name),
                            new Source("fotocasa"),
                            new Owner(1),
                            new CreatedBy(1),
                            new DateTime()));

        }

        return $data;
    }
}
